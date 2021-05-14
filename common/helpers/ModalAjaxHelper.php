<?php

/**
 * @Class ModalAjaxHelper
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\helpers;

class ModalAjaxHelper extends \lo\widgets\modal\ModalAjax
{
    /**
     * register pjax event
     */
    protected function defaultSubmitEvent()
    {
        $expression = [];

        if ($this->autoClose) {
            $expression[] = "$(this).modal('toggle');";
        }

        if ($this->pjaxContainer) {
            $expression[] = "$.pjax.reload({container : '$this->pjaxContainer', timeout: false});";
        }

        $script = implode("\r\n", $expression);

        $this->events[self::EVENT_MODAL_SUBMIT] = new \yii\web\JsExpression("
            function(event, data, status, xhr) {
                if(status){
                    $script
                }
            }
        ");
    }

}