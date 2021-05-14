<?php

/**
 * @Class CheckHelper
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\helpers;

use Yii;
use yii\console\Exception;

class CheckHelper
{
    /**
     * valida um ou mais argumentos passados na função existem
     * @param string
     * @return bolean
     */
    public static function valorExiste($obj)
    {
        $num_args = func_num_args();
        if ($num_args > 1) {
            for ($i = 0; $i < $num_args; $i++) {
                $filter = func_get_arg($i);
                if (!isset($filter) or empty($filter) or is_null($filter)) {
                    return false;
                }
            }
            return true;
        } else {
            if (!isset($obj) or empty($obj) or is_null($obj)) {
                return false;
            }
            return true;
        }
    }

    /**
     * Verifica se o diretorio existe, caso não, o mesmo é criado
     * @param string $folder
     * @return string $dir, hexadecimal $mode=0777, bolean $recursive=true
     */
    public static function diretorioExiste($dir, $mode = 0777, $recursive = true)
    {
        if (!is_dir($dir)) { // se o diretorio não existe, cria.
            if (@mkdir($dir, $mode, $recursive)) {
                chmod($dir, $mode);
                return true;
            } else {
                throw new Exception('Diretório não foi criado.');
            }
        }
        return false;
    }

    /**
     * verifica se o usuario tem permissão ou o papel solicitado
     * @param string $name
     * @param string $type getPermissionsByUser || getRolesByUser
     * @return bool
     */
    public static function can($name, $type)
    {
        $authItem = Yii::$app->authManager->$type(Yii::$app->user->getId());
        return isset($authItem[$name]);
    }

}