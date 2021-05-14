<?php

/**
 * @Class EmailHelper
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace common\helpers;

class EmailHelper
{
    /**
     * Envia email utilizando o mailer configurado na aplicação
     * @param string|array $remetentes
     * @param string|array $para
     * @param string|array $bcc
     * @param string $assunto
     * @param string $template
     * @param array $variaveis
     * @param string $attachs
     * @return boolean Retorna
     */
    public static function enviar($remetentes, $para, $bcc, $assunto, $template, $variaveis, array $attachs = [])
    {
        $message = \Yii::$app->mailer->compose($template, $variaveis);
        $message->setFrom($remetentes);
        $message->setTo($para);
        $message->setBcc($bcc);
        $message->setSubject($assunto);

        if (is_countable($attachs) && count($attachs)) {
            foreach ($attachs as $attach) {
                if (file_exists($attach)) {
                    $message->attach($attach);
                }
            }
        }

        if ($message->send()) {
            return true;
        }
        return false;
    }
}