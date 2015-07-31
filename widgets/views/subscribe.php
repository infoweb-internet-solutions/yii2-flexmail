<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin([
    'action' => '//www.flexmail.eu/subscribe',
    'options' => $options,
    'method' => 'post',
]); ?>

<?= Html::hiddenInput('public-key', $publicKeys[Yii::$app->language]) ?>
<?php foreach ($mailingLists[Yii::$app->language] as $mailingList): ?>
<?= Html::hiddenInput('mid[]', $mailingList) ?>
<?php endforeach; ?>

<?= Html::hiddenInput('style_error', 'font-family:Trebuchet MS, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;') ?>

<?= $this->render($template) ?>

<iframe id='iframe_flxml_submit' name='iframe_flxml_submit' style='width:100%;height:40px;visibility:visible;display:block;background-color:transparent' allowtransparency='true' src='//www.flexmail.eu/public/blank.html' frameborder='0' scrolling='no'></iframe>

<?php ActiveForm::end(); ?>