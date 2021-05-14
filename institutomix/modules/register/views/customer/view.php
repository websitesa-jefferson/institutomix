<?php

/**
* @category Yii2
* @package  Jefferson C. Dias
* @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model institutomix\modules\register\models\Customer */

$this->title = 'Cliente';
?>
<div class="customer-view">
    <div class="panel panel-default" style="margin-top:10px;">
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    ['attribute' => 'city.name_code', 'label' => 'Cidade'],
                    ['label' => 'Criado Por', 'attribute' => 'cadastradoPor.fullname'],
                    'created_at:datetime',
                    ['label' => 'Alterado Por', 'attribute' => 'alteradoPor.fullname'],
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>
    <?= Html::button('Fechar', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) ?>
</div>
