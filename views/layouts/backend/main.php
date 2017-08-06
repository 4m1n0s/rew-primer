<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\BackendAsset;

BackendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<?= $this->render('_elements/head'); ?>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        <?php $this->beginBody() ?>
        <!-- BEGIN HEADER -->
        <?= $this->render('_elements/header'); ?>
        <!-- END HEADER -->

        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->

        <!-- BEGIN CONTAINER -->
        <div class="page-container">

            <!-- BEGIN SIDEBAR -->
            <?= $this->render('_elements/main-menu'); ?>
            <!-- END SIDEBAR -->

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <?php if (!empty($this->params['pageTitle'])): ?>
                        <!-- BEGIN PAGE TITLE-->
                        <h3 class="page-title">
                            <?= $this->params['pageTitle'] ?> <small><?= isset($this->params['pageSmallTitle']) ? $this->params['pageSmallTitle'] : '' ?></small>
                        </h3>
                        <!-- END PAGE TITLE-->
                    <?php endif; ?>
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <?php echo yii\widgets\Breadcrumbs::widget([
                            'options' => [
                                'class' => 'page-breadcrumb'
                            ],
                            'homeLink' => [
                                'label' => 'Home',
                                'url' => ['/dashboard/index-backend/index'],
                            ],
                            'itemTemplate' => '<li> {link} <i class="fa fa-angle-right"></i></li>',
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);
//                                                    var_dump($this->params['breadcrumbs']); exit
                        ?>

                        <div class="page-toolbar"></div>
                    </div>
                    <!-- END PAGE BAR -->

                    <?= \app\modules\dashboard\widgets\Alert::widget() ?>
                    <!-- END PAGE HEADER-->
                    <?= $content ?>
                    <?php yii\bootstrap\Modal::begin([
                        'header' => '',
                        'size' => \yii\bootstrap\Modal::SIZE_LARGE,
                        'id' =>'view-modal',
                    ]);
                    yii\bootstrap\Modal::end(); ?>
                </div> 
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->

        <?= $this->render('_elements/footer'); ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
