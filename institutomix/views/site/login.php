<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Entrar';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputOptions' => ['autofocus' => true, 'class' => 'form-control', 'tabindex' => '1'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<?= \common\widgets\AlertWidget::widget() ?>
<div class="login-layer">
    <div class="login-box">
    <h3 class='login-box-msg text-teal'><?= Yii::$app->name ?></h3>
    <div class="login-box-body">
        <p class='login-box-msg' style='color: whitesmoke;'>Faça seu login para começar</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-xs-12">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary pull-right', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

        <?= Html::a('Esqueci minha senha.', ['request-password-reset'], ['style' => 'color: whitesmoke;']) ?>

    </div>
</div>
</div>
