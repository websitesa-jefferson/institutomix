<?php

/**
 * @Class TxtHelper
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\helpers;

use Yii;

class TextHelper extends \yii\helpers\StringHelper
{
    /**
     * Remover acentos e caracteres especiais
     * @param String $txt
     * @param Bool $rmspace Remover espaços
     * @param Bool $upcase  Caixa alta
     * @return String $txt
     */
    public static function removerAcentos ($txt, $rmspace = false, $upcase = true, $simbol = '-')
    {
        $txt = strtr(trim($txt), [
            'Š' => 'S', 'š' => 's', '�?' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z', 'ž' => 'z',
            'Č' => 'C', '�?' => 'c', 'Ć' => 'C', 'ć' => 'c', 'À' => 'A', '�?' => 'A',
            'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', '�?' => 'I',
            'Í' => 'I', 'Î' => 'I', '�?' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
            'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U',
            'Ü' => 'U', '�?' => 'Y', 'Þ' => 'B', 'à' => 'a', 'á' => 'a', '&' => 'e',
            'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i',
            'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
            'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u',
            'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'Ŕ' => 'R',
            '¢' => 'c', 'º' => 'o', 'ª' => 'a', 'ŕ' => 'r', '¹' => '1', '²' => '2',
            '³' => '3', '\\' => '', 'ß' => 'Ss',
            "'" => '', '"' => '', '´' => '', '`' => '', '¬' => '', '!' => '', '@' => '',
            '¨' => '', '#' => '', '$' => '', '%' => '', '*' => '', '(' => '', ')' => '',
            '+' => '', '=' => '', '§' => '', '{' => '', '}' => '', '^' => '', '£' => '',
            '~' => '', '[' => '', ']' => '', ':' => '', ';' => '', '/' => '', '|' => '',
            '.' => '', '?' => '', '°' => 'o', '<' => '', '>' => ''
        ]);

        if ($rmspace) {
            $txt = strtr(trim($txt), [' ' => $simbol]);
        }

        if ($upcase) {
            $txt = mb_strtoupper($txt, Yii::$app->charset);
        } else {
            $txt = mb_strtolower($txt, Yii::$app->charset);
        }

        return str_replace('--', '-', $txt);
    }
}