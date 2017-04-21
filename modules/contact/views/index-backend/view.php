<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\Contact */
/* @var $reply \app\modules\contact\form\Reply */

$this->title = $model->id;
$this->params['breadcrumbs'][] = [
    'label' => 'Contacts',
    'url' => ['index'],
    'template' => '<li> {link} <i class="fa fa-circle"></i></li>'
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-view">

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'create_date:date',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => $model->getStatus(true)
            ],
            'name',
            'email:email',
            'subject',
            'message:html'
        ],
    ]) ?>

    <?php $form = \yii\widgets\ActiveForm::begin(); ?>
    <?php echo $form->field($reply, 'message')->widget(dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => [
            'language' => 'en',
            'height' => '500',
            'allowedContent' => false,
            'fullPage' => false,
            'qtBorder' => '0',
            'startupShowBorders' => false,
            'extraPlugins' => 'justify',
            'disableNativeSpellChecker' => true,
            'removePlugins' => 'scayt',
        ],
    ])->label(false) ?>
    <?php echo Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
    <?php $form->end(); ?>

</div>
