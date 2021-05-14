<?php

/**
 * @Class Module
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace institutomix\modules\admin;

use common\bases\BaseModule;

class Module extends BaseModule
{
    public $controllerNamespace = 'institutomix\modules\admin\controllers';

    public function init()
    {
        parent::init();
    }
}