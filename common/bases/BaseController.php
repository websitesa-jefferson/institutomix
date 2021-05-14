<?php

/**
 * @Class BaseController
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\bases;

use yii\web\Controller;

class BaseController extends Controller
{
    protected $request;

    public function behaviors()
    {
        return [
            ['class' => 'common\bases\BaseFilter'],
        ];
    }
}
