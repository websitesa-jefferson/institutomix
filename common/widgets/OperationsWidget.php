<?php

/**
 * @Class OperationsWidget
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\widgets;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Widget;
use common\bases\BaseFilterActionColumn;

class OperationsWidget extends Widget
{
    public $btName;

    public function run()
    {
        $this->buttonCreate();
        $this->buttonDelete();
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
        if ($this->checkPermission($this->permission().'/'.'create')) {
            $options['class'] = 'btn btn-success';
            $options['style'] = 'margin-right:5px';
            $options['title'] = "Criar $this->btName";
            echo Html::a("<i class='glyphicon glyphicon-plus'></i>", ['create'], $options);
        }
    }

    protected function buttonDelete()
    {
        if ($this->checkPermission($this->permission().'/'.'delete')) {
            $options['class'] = 'modalDeletarButton btn btn-danger';
            $options['style'] = 'margin-right:5px';
            $options['data-url'] = Url::to(['delete']);
            $options['title'] = 'Deletar Selecionados';
            echo Html::a("<i class='glyphicon glyphicon-trash'></i>", '#', $options);
        }
    }
}
