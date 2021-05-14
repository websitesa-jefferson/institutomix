<?php

/**
 * @Class CheckHelper
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\helpers;

class StatusHelper
{
    /**
     * Altera os status via ajax
     * @param type $model
     * @param type $status passado no momento do click do botão
     * @param type $status1
     * @param type $status2
     * @param type $relations
     * @param type $dependentes
     * @param type $campo
     * @return type
     */
    public static function alterarStatus($model, $status, $status1, $status2, $relations = '', $dependentes = 'false', $campo = 'status')
    {
        $model->$campo = ($status == $status1) ? $status2 : $status1;

        if ($model->save()) {
            if ($dependentes == 'true' && CheckHelper::valorExiste($relations)) {
                foreach ($model->$relations as $relation) {
                    $relation->$campo = $model->$campo;
                    $relation->save();
                }
            }
            return true;
        }
        return false;
    }

}