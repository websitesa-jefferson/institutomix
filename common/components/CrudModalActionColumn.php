<?php

/**
 * @Class CrudModalActionColumn
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\components;

use Yii;
use yii\helpers\Html;

class CrudModalActionColumn extends \common\components\CrudActionColumn
{
    protected function buttonCreate()
    {
        $permission = $this->permission();
        $this->buttons['create'] = function ($url, $model, $key) {
            $options['style'] = 'margin-right:5px';
            $options['title'] = 'Criar '. Yii::t('register', $model->formName());
            $options['class'] = 'btn btn-success showModalButton';
            return Html::a("<i class='glyphicon glyphicon-plus'></i>", ['create'], $options);
        };
        $this->visibleButtons['create'] = function ($model, $key, $index) use ($permission) {return $this->checkPermission($permission.'/'.'create');};
    }

    protected function buttonView()
    {
        $permission = $this->permission();
        $this->buttons['view'] = function ($url, $model, $key) {
            $options['title'] = 'Exibir '. Yii::t('register', $model->formName());
            $options['class'] = 'btn btn-success btn-xs showModalButton';
            return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, $options);
        };
        $this->visibleButtons['view'] = function ($model, $key, $index) use ($permission) {return $this->checkPermission($permission.'/'.'view');};
    }

    protected function buttonUpdate()
    {
        $permission = $this->permission();
        $this->buttons['update'] = function ($url, $model, $key) {
            $options['title'] = 'Alterar '. Yii::t('register', $model->formName());
            $options['class'] = 'btn btn-warning btn-xs showModalButton';
            return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, $options);
        };
        $this->visibleButtons['update'] = function ($model, $key, $index) use ($permission) {return $this->checkPermission($permission.'/'.'update');};
    }
    
}