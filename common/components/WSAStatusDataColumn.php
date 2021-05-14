<?php

namespace common\components;

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\DataColumn;

class WSAStatusDataColumn extends DataColumn
{
    public function renderDataCellContent($model, $key, $index)
    {
        $className = $model->className();

        if ($className === 'common\models\User') {
            switch ($model->status) {
                case 10:
                    $cor = 'success';
                    $status = $className::STATUS_ATIVO;
                    break;
                case 0:
                    $cor = 'danger';
                    $status = $className::STATUS_INATIVO;
                    break;
                default:
                    $cor = 'default';
                    $status = '-';
                    break;
            }
        } else {
            switch ($model->status) {
                case $className::STATUS_ATIVO:
                    $cor = 'success';
                    $status = $className::STATUS_ATIVO;
                    break;
                case $className::STATUS_INATIVO:
                    $cor = 'danger';
                    $status = $className::STATUS_INATIVO;
                    break;
                default:
                    $cor = 'default';
                    $status = '-';
                    break;
            }            
        }
        $options = [
            'id' => "alterarStatus",
            'title' => 'Alterar Status',
            'class' => "btn btn-$cor btn-xs",
            'data-url' => Url::to(['alterar-status'], true),
            'data-id' => $model->id,
            'data-campo' => $this->attribute,
            'data-status' => $model->status,
        ];
        return Html::button($status, $options);
    }
}
