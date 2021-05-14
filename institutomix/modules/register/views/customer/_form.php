<?php

/**
* @category Yii2
* @package  Jefferson C. Dias
* @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

use yii\helpers\Html;
use kartik\builder\Form;
use kartik\form\ActiveForm;
use kartik\builder\FormGrid;

/* @var $this yii\web\View */
/* @var $model institutomix\modules\register\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'validateOnBlur' => true,
        'validateOnSubmit' => false,
    ]) ?>

    <?= FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => false,
        'rows' => [
            [
                'attributes' => [
                      'name' => ['type' => Form::INPUT_TEXT, 'options' => ['maxlength' => true]],
                      'city_id' => ['type' => Form::INPUT_TEXT, 'options' => ['maxlength' => true]],
                      'actions' => [
                           'type' => Form::INPUT_RAW, 'value' =>
                               Html::submitButton('Fechar', ['class' => 'btn btn-default', 'style' => 'margin-left:5px;', 'data-dismiss' => 'modal']).
                               Html::submitButton($model->isNewRecord ? 'Criar' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right'])
                      ]
                ]
            ]
        ]
    ])  ?>

    <?php ActiveForm::end() ?>

</div>
