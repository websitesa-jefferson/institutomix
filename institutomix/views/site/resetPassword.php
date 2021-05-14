<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use dmstr\widgets\Alert;
use yii\bootstrap\ActiveForm;

$this->title = 'Redefinir Senha';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputOptions' => ['autofocus' => true, 'class' => 'form-control', 'tabindex' => '1'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<div class="login-layer">
<div class="login-box">
    <?= Alert::widget() ?>
    <h3 class='login-box-msg text-teal'><?= Html::encode($this->title) ?></h3>
    <div class="login-box-body">
        <p class='login-box-msg' style='color: whitesmoke;'>Escolha sua nova senha.</p>

        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <?= $form
                ->field($model, 'password', $fieldOptions1)
                ->label(false)
                ->passwordInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row"><br>
            <div class="col-xs-12">
                <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary pull-right']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

        <?= Html::a('Voltar para o login.', ['login'], ['style' => 'color: whitesmoke;']) ?>

    </div>
</div>
</div>
