<?php
/* @var \yii\web\View $this */
?>

<?php
$userID = Yii::$app->user->identity->id;
$js = <<< JS
var pollfishConfig = {
    api_key: "6dddba2d-9512-4a5a-a221-2f8d2f3c4997",
    indicator_position: "TOP_LEFT",
    debug: true,
    uuid: $userID,
    ready: pollfishReady
};

function pollfishReady() {
    Pollfish.showFullSurvey();
}
JS;

$this->registerJs($js, \yii\web\View::POS_END);
$this->registerJsFile('https://storage.googleapis.com/pollfish_production/sdk/webplugin/pollfish.min.js', [
    'position' => \yii\web\View::POS_END,
    'depends' => \app\assets\FrontAsset::class
]);
?>
