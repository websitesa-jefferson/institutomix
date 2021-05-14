<?php

/**
 * @Class CrudActionColumn
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\components;

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\ActionColumn;
use common\bases\BaseFilterActionColumn;

class CrudActionColumn extends ActionColumn
{
    protected function initDefaultButtons()
    {
        $this->options = ['style' => 'width:120px;'];
        $this->buttonView();
        $this->buttonUpdate();
    }

    protected function permission()
    {
        return str_replace('/index', '', (new BaseFilterActionColumn)->getRoute());
    }

    protected function checkPermission($permission)
    {
        return (new BaseFilterActionColumn)->checkPermission($permission);
    }

    protected function buttonCreate()
    {
        $permission = $this->permission();
        $this->buttons['create'] = function ($url, $model, $key) {
            $options['class'] = 'btn btn-success';
            $options['style'] = 'margin-right:5px';
            $options['title'] = 'Criar '. Yii::t('register', $model->formName());
            return Html::a("<i class='glyphicon glyphicon-plus'></i>", ['create'], $options);
        };
        $this->visibleButtons['create'] = function ($model, $key, $index) use ($permission) {return $this->checkPermission($permission.'/'.'create');};
    }

    protected function buttonView()
    {
        $permission = $this->permission();
        $this->buttons['view'] = function ($url, $model, $key) {
            $options['title'] = 'Exibir '. Yii::t('register', $model->formName());
            $options['class'] = 'btn btn-success btn-xs';
            $options['data-pjax'] = 0;
            return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, $options);
        };
        $this->visibleButtons['view'] = function ($model, $key, $index) use ($permission) {return $this->checkPermission($permission.'/'.'view');};
    }

    protected function buttonUpdate()
    {
        $permission = $this->permission();
        $this->buttons['update'] = function ($url, $model, $key) {
            $options['title'] = 'Alterar '. Yii::t('register', $model->formName());
            $options['class'] = 'btn btn-warning btn-xs';
            $options['data-pjax'] = 0;
            return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, $options);
        };
        $this->visibleButtons['update'] = function ($model, $key, $index) use ($permission) {return $this->checkPermission($permission.'/'.'update');};
    }

    protected function buttonDelete()
    {
        $permission = $this->permission();
        $this->buttons['delete'] = function ($url, $model, $key) {
            $options['title'] = 'Deletar Selecionados';
            $options['data-url'] = Url::to(['delete']);
            $options['class'] = 'modalDeletarButton btn btn-danger';
            return Html::a("<i class='glyphicon glyphicon-trash'></i>", '#', $options);
        };
        $this->visibleButtons['delete'] = function ($model, $key, $index) use ($permission) {return $this->checkPermission($permission.'/'.'delete');};
    }
    
}