<?php

/**
* @category Yii2
* @package  Jefferson C. Dias
* @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\select2\Select2;
use common\helpers\ModalAjaxHelper;
use common\widgets\OperationsModalWidget;

/* @var $this yii\web\View */
/* @var $searchModel institutomix\modules\register\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cidades';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['id'=>'gridForm', 'timeout' => false, 'enablePushState' => false]) ?>
    <?= ModalAjaxHelper::widget(['id' => 'modal-ajax', 'selector' => '.showModalButton', 'size' => ModalAjaxHelper::SIZE_LARGE, 'options' => ['class' => 'header-primary', 'data-backdrop' => 'static', 'style' => 'top: 0px;', 'tabindex' => false], 'autoClose' => true, 'pjaxContainer' => '#gridForm']) ?>
    <?= \common\widgets\AlertWidget::widget() ?>
    <?php $gridColumns = [
        ['attribute' => 'id', 'options' => ['class'=>'col-sm-1']],
        'name',
        [
            'attribute' => 'state_id',
            'value' => 'state.name_code',
            'filter' => Select2::widget([
                'model' => $searchModel,
                'attribute' => 'state_id',
                'data' => $states,
                'options' => ['placeholder' => '« Todos »', 'class' => 'form-control'],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ])
        ],
        [
            'attribute' => 'is_capital',
            'value' => 'str_capital',
            'options' => ['class'=>'col-sm-2'],
            'filter' => Html::activeDropDownList($searchModel, 'is_capital', $capital, ['class' => 'form-control', 'prompt' => '« Todos »'])
        ],
        ['class' => 'common\components\CrudModalActionColumn'],
        ['class' => '\kartik\grid\CheckboxColumn']
    ] ?>
    <?= GridView::widget([
        'id' => 'wsaGrid',
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'filterModel' => $searchModel,
        'filterSelector' => 'select[name="per-page"]',
        'responsive' => false,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
        ],
        'toolbar' => [
            ['content'=> OperationsModalWidget::widget(['btName' => 'Cidade'])],
            \nterms\pagesize\PageSize::widget(['label' => 'Itens', 'options' => ['style'=>'height: 34px;']])
        ]
    ]) ?>
<?php Pjax::end() ?>
