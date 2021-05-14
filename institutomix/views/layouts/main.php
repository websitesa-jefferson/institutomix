<?php

use yii\web\View;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

if (Yii::$app->controller->action->id === 'login'
    || Yii::$app->controller->action->id === 'error'
    || Yii::$app->controller->action->id === 'request-password-reset'
    || Yii::$app->controller->action->id === 'reset-password') {
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render('main-login', ['content' => $content]);
} else {
    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    echo kartik\dialog\Dialog::widget();
    dmstr\web\AdminLteAsset::register($this);
    common\assets\AppAsset::register($this);
    lo\widgets\loading\JqueryLoadingAsset::register($this);
?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <!--id de rolagem suave da pagina-->
    <body class="skin-red sidebar-mini wysihtml5-supported" id="header" data-auto-collapse-size="768">
    <!--<body class="hold-transition skin-blue sidebar-mini" id="header">-->
    <?php $this->beginBody() ?>
    <div id="loader"></div>
    <div class="wrapper">
        <?= $this->render('header.php', ['directoryAsset' => $directoryAsset]) ?>
        <?= $this->render('left.php', ['directoryAsset' => $directoryAsset]) ?>
        <?= $this->render('content.php', ['content' => $content, 'directoryAsset' => $directoryAsset]) ?>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php Yii::$app->view->registerJs("
$(document).ready(function() {
    $(this).on('pjax:start', function (data, content) {jQuery('body').loading({'stoppable':true,'theme':'light','message':'Aguarde...',zIndex:9999});});
    $(this).on('pjax:complete', function (data, content) {jQuery('body').loading('stop');});
});
", View::POS_END) ?>
    <?php $this->endPage() ?>
<?php } ?>
