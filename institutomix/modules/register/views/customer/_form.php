<?php

/**
* @category Yii2
* @package  Jefferson C. Dias
* @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

use yii\web\View;
use yii\helpers\Url;
use yii\widgets\Pjax;
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
                    'state_id' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => '\kartik\select2\Select2',
                        'options' => [
                            'data' => $states,
                            'options' => [
                                'placeholder' => '« Selecione »',
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            'pluginEvents' => [
                                "select2:select" => "function(data){dependentPjax(data.params.data.id);}",
                            ],
                        ]
                    ],
                ]
            ]
        ]
    ])  ?>

    <?php Pjax::begin(['id'=>'city-pjax']) ?>
        <?= FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => false,
            'rows' => [
                [
                    'attributes' => [
                        'city_id' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\select2\Select2', 'options' => ['data' => $cities, 'options' => ['placeholder' => '« Selecione »'], 'pluginOptions' => ['allowClear' => true]]],
                    ]
                ]
            ]
        ])  ?>
    <?php Pjax::end() ?>

    <?= FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => false,
        'rows' => [
            [
                'attributes' => [
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
<?php $this->registerJs("
function dependentPjax(state_id) {
    if (state_id != '') {
        $.pjax.reload({
            method: 'get',
            push: false,
            replace: false,
            pushRedirect: true,
            replaceRedirect: false,
            url: '". Url::to([$view]) ."',
            container: '#city-pjax',
            timeout: false,
            data: {
                id: '". $model->id ."',
                state_id: state_id
            }
        });
    }
}
", View::POS_END) ?>
