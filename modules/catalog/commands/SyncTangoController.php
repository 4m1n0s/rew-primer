<?php

namespace app\modules\catalog\commands;

use app\modules\catalog\models\CatalogMeta;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductGroup;
use app\modules\catalog\models\RefProductGroup;
use yii\base\ErrorException;
use yii\console\Controller;
use yii\helpers\Json;

/**
 * Class SyncTango
 * @package app\modules\catalog\commands
 */
class SyncTangoController extends Controller
{
    public function actionFill()
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', 'https://integration-api.tangocard.com/raas/v2/catalogs?verbose=true', [
                'headers' => [
                    'Authorization' => 'Basic ' . \Yii::$app->params['tangocards_auth']
                ]
            ]);
            $body = $res->getBody();
            $data = Json::decode($body);

            foreach ($data['brands'] as $brand) {
                if (empty($brand['items']) || !is_array($brand['items'])) {
                    continue;
                }

                $products = [];
                foreach ($brand['items'] as $item) {
                    if ($item['rewardType'] != 'gift card') {
                        continue;
                    }
                    if (!in_array('US', $item['countries'])) {
                        continue;
                    }
                    $products[] = $item;
                }

                if (empty($products)) {     // Do not save empty group after product filters
                    continue;
                }

                // Save group
                $groupMeta = CatalogMeta::find()
                    ->where(['type' => CatalogMeta::TYPE_GROUP, 'key' => 'brandKey', 'value' => $brand['brandKey']])
                    ->one();
                if ($groupMeta) {
                    $groupModel = ProductGroup::findOne(['id' => $groupMeta->entity]);
                } else {
                    $groupModel = new ProductGroup();
                    $groupModel->name = $brand['brandName'];
                    $groupModel->image = $brand['imageUrls']['300w-326ppi'];
                    $groupModel->description = $brand['description'];
                }

                $groupModel->status = ($brand['status'] == 'active') ? 1 : 0;
                $groupModel->save();

                CatalogMeta::set(CatalogMeta::TYPE_GROUP, $groupModel->id, 'brandKey', $brand['brandKey']);
                CatalogMeta::set(CatalogMeta::TYPE_GROUP, $groupModel->id, 'status', $brand['status']);
                CatalogMeta::set(CatalogMeta::TYPE_GROUP, $groupModel->id, 'createdDate', $brand['createdDate']);
                CatalogMeta::set(CatalogMeta::TYPE_GROUP, $groupModel->id, 'lastUpdateDate', $brand['lastUpdateDate']);

                // Save products
                foreach ($products as $product) {
                    if ($product['valueType'] == 'FIXED_VALUE') {
                        $productModel = Product::findOne(['sku' => $product['utid'], 'vendor' => Product::VENDOR_TANGOCARD]);
                        if (!$productModel) {
                            $productModel = new Product();
                            $productModel->type = Product::TYPE_GIFT_CARD;
                            $productModel->vendor = Product::VENDOR_TANGOCARD;
                            $productModel->sku = $product['utid'];
                            $productModel->name = $product['rewardName'];
                            $productModel->price = $product['faceValue'];
                            $productModel->status = ($product['status'] == 'active') ? Product::IN_STOCK : Product::OUT_OF_STOCK;
                            if (!$productModel->save()) {
                                throw new ErrorException('Could not save ' . Product::class . PHP_EOL . Json::encode($productModel->errors));
                            }
                            $refProductGroupModel = new RefProductGroup();
                            $refProductGroupModel->group_id = $groupModel->id;
                            $refProductGroupModel->product_id = $productModel->id;
                            if (!$refProductGroupModel->save()) {
                                throw new ErrorException('Could not save ' . RefProductGroup::class . PHP_EOL . Json::encode($refProductGroupModel->errors));
                            }
                        } else {
                            if ($productModel->status && $product['status'] != 'active') {
                                $productModel->status = Product::OUT_OF_STOCK;
                            }
                            $productModel->price = $product['faceValue'];
                            if (!$productModel->save()) {
                                throw new ErrorException('Could not save ' . Product::class . PHP_EOL . Json::encode($productModel->errors));
                            }
                        }

                        CatalogMeta::set(CatalogMeta::TYPE_PRODUCT, $product['utid'], 'faceValue', $product['faceValue']);
                    } elseif ($product['valueType'] == 'VARIABLE_VALUE') {
                        if ($variablePrices = \Yii::$app->keyStorage->get('catalog.variable_prices')) {
                            $variablePrices = explode(',', $variablePrices);
                        } else {
                            $variablePrices = [50,100,200,500,1000];
                        }
                        $productModels = Product::findAll(['sku' => $product['utid'], 'vendor' => Product::VENDOR_TANGOCARD]);
                        if (empty($productModels)) {
                            foreach ($variablePrices as $price) {
                                if ($product['minValue'] > $price || $product['maxValue'] < $price) {
                                    continue;
                                }
                                $productModel = new Product();
                                $productModel->type = Product::TYPE_GIFT_CARD;
                                $productModel->vendor = Product::VENDOR_TANGOCARD;
                                $productModel->sku = $product['utid'];
                                $productModel->name = $product['rewardName'];
                                $productModel->price = $price;
                                $productModel->status = ($product['status'] == 'active') ? Product::IN_STOCK : Product::OUT_OF_STOCK;
                                if (!$productModel->save()) {
                                    throw new ErrorException('Could not save ' . Product::class . PHP_EOL . Json::encode($productModel->errors));
                                }

                                $refProductGroupModel = new RefProductGroup();
                                $refProductGroupModel->group_id = $groupModel->id;
                                $refProductGroupModel->product_id = $productModel->id;
                                if (!$refProductGroupModel->save()) {
                                    throw new ErrorException('Could not save ' . RefProductGroup::class . PHP_EOL . Json::encode($refProductGroupModel->errors));
                                }
                            }
                        } else {
                            foreach ($productModels as $productModel) {
                                if ($product['minValue'] > $productModel->price || $product['maxValue'] < $productModel->price) {
                                    $productModel->status = Product::OUT_OF_STOCK;
                                    $productModel->save();
                                }
                            }
                        }
                        CatalogMeta::set(CatalogMeta::TYPE_PRODUCT, $product['utid'], 'minValue', $product['minValue']);
                        CatalogMeta::set(CatalogMeta::TYPE_PRODUCT, $product['utid'], 'maxValue', $product['maxValue']);
                    } else {
                        continue;
                    }

                    CatalogMeta::set(CatalogMeta::TYPE_PRODUCT, $product['utid'], 'status', $product['status']);
                    CatalogMeta::set(CatalogMeta::TYPE_PRODUCT, $product['utid'], 'createdDate', $product['createdDate']);
                    CatalogMeta::set(CatalogMeta::TYPE_PRODUCT, $product['utid'], 'lastUpdateDate', $product['lastUpdateDate']);
                }
            }

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack(); // TODO: Handle errors
        }
    }
}