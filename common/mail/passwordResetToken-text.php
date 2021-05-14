<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Olá <b><?= $user->username ?></b>,

Clique no link abaixo para redefinir sua senha:

<?= $resetLink ?>
