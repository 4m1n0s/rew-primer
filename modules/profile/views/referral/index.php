<?php
/* @var \yii\web\View $this */

use yii\helpers\Html;
use app\modules\dashboard\helpers\GridViewTemplateHelper;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Referral Program');
?>

<!-- post content -->
<div class="post-content">
    <!-- Post item-->
    <div class="post-item">
        <div class="post-content-details">
            <div class="seperator"><span>Referral Link</span></div>
            <blockquote>
                <p>Your Code is <strong><?php echo $referralCode; ?></strong>
                    <br>Share Link below to get percents!
                </p>
                <p></p>
                <p>
                    <span id="clipboard-copy-btn" class="glyphicon glyphicon-copy" title="Add to ClipBoard" aria-hidden="true"></span>
                    <span id="clipboard-copy-text"><?php echo $referralLink ?></span>
                </p>
                <p><span id="clipboard-copy-helper" class="hide">Added to ClipBoard</span></p>
            </blockquote>

            <?php if ($dataProvider->count): ?>
                <div class="seperator"><span>Referrals</span></div>
                <div class="table-responsive">
                    <?php \yii\widgets\Pjax::begin();
                    echo \yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        'tableOptions' => [
                            'class' => 'table table-striped',
                        ],
                        'columns' => [
                            [
                                'label' => 'Username',
                                'value' => function($row) {
                                    return ArrayHelper::getValue($row, 'username');
                                }
                            ],
                            [
                                'label' => 'Email',
                                'value' => function($row) {
                                    return ArrayHelper::getValue($row, 'email');
                                }
                            ],
                            [
                                'headerOptions' => ['style' => 'width: 120px;min-width: 120px;'],
                                'attribute' => 'total_amount',
                                'value' => function($row) {
                                    return intval(ArrayHelper::getValue($row, 'total_amount'));
                                }
                            ]
                        ]
                    ]);
                    \yii\widgets\Pjax::end(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<!-- END: post content -->

<?php

$js = <<< JS
$('#clipboard-copy-btn').click(function(e) {
    copyToClipboard($('#clipboard-copy-text'));
});

function copyToClipboard(element) {
    var temp = $("<input>");
    $("body").append(temp);
    temp.val($(element).text()).select();
    document.execCommand("copy");
    temp.remove();
    $("#clipboard-copy-helper").removeClass('hide');
    $("#clipboard-copy-helper").delay(3000).hide(400)
}
JS;

$this->registerJs($js)
?>