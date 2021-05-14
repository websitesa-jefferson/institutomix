<?php

/**
 * Classe WSAHelper
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\components;

use newerton\fancybox\FancyBox;

class WSAHelper
{
    /**
     * Retornar matriz de constantes para uma classe
     * @param string      $classe  ClassName
     * @param null|string $prefixo Prefix like e.g. "KEY_"
     * @param boolean     $assoc  Return associative array with constant name as key
     * @param array       $exclui Exclui array de valores
     * @return array
     */
    public static function getConstantes($classe, $prefixo = null, $assoc = false, $exclui = [])
    {
        $reflexao = new \ReflectionClass($classe);
        $constantes = $reflexao->getConstants();
        $values = [];

        foreach ($constantes as $constante => $value) {
            if (($prefixo && strpos($constante, $prefixo) !== false) || $prefixo === null) {
                if (in_array($value, $exclui)) {
                    continue; //Ignora o nó atual e vai para o próximo
                }
                if ($assoc) {
                    $values[$value] = $value;
                } else {
                    $values[] = $value;
                }
            }
        }
        return $values;
    }
}
