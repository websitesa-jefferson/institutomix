<?php

/**
 * @Class BaseModule
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\bases;

use Yii;
use yii\base\Module;

class BaseModule extends Module
{
    public function init()
    {
        parent::init();

        Yii::setAlias('@module', '@app/modules/'.$this->id);
        Yii::$app->mailer->viewPath = '@module/views/mails';
    }
}