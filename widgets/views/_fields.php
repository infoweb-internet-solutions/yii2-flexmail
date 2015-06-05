<?php
use kartik\helpers\Html;
?>
<?= Html::textInput('fields[2426ced136024a631a2a0672a269b700]', '', [
    'class' => 'form-control',
    'placeholder' => Yii::t('frontend', 'Vul hier je e-mailadres in'),
    'addon' => [
        'append' => [
            'content' => Html::button(Yii::t('frontend', 'Verzenden'), ['class'=>'btn btn-primary']),
            'asButton' => true
        ]
    ]
]); ?>

<?= Html::submitButton('Verzenden', [
    'class' => 'btn btn-primary',
]) ?>

<?php /*
<div class="form-group">
    <label class="control-label" for="name"><?= Yii::t('frontend', 'Naam') ?></label>
    <?= Html::textInput('fields[1a2f3e3b4cebe60c0e9659520e7e121a]', '', [
        'class' => 'form-control',
        'placeholder' => Yii::t('frontend', 'Naam'),
        'id' => 'name',
    ]); ?>
</div>
<div class="form-group">
    <label class="control-label" for="email"><?= Yii::t('frontend', 'E-mail') ?></label>
    <?= Html::textInput('fields[2426ced136024a631a2a0672a269b700]', '', [
        'class' => 'form-control',
        'placeholder' => Yii::t('frontend', 'E-mail'),
        'id' => 'email',
    ]); ?>
</div>
*/ ?>

