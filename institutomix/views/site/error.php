<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
?>
<div class="login-box">
    <div class="site-error" style="text-align: center">
        <div class="alert alert-danger">
            <h4>
                <?= Html::encode($exception->getMessage()) ?>
            </h4>
        </div>
    </div>
</div>
