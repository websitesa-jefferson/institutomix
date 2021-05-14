<?php

/**
 * @Class OperationsModalWidget
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\widgets;

use yii\helpers\Html;

class OperationsModalWidget extends \common\widgets\OperationsWidget
{
    protected function buttonCreate()
    {
        if ($this->checkPermission($this->permission().'/'.'create')) {
            $options['class'] = 'btn btn-success showModalButton';
            $options['style'] = 'margin-right:5px';
            $options['title'] = "Criar $this->btName";
            echo Html::a("<i class='glyphicon glyphicon-plus'></i> Criar $this->btName", ['create'], $options);
        }
    }
}
