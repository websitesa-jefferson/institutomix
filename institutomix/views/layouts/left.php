<?php

use yii\helpers\Html;
use dmstr\widgets\Menu;
use common\helpers\MenuAdminlteHelper;
$papel = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
$p = count($papel) ? array_pop($papel)->name : 'Sem Papel';
?>
<aside class="main-sidebar">

    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left info">
                <p><?= ucfirst($p) ?></p>
            </div>
            <br>
        </div>
        <?= Menu::widget([
            'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
            'items' => MenuAdminlteHelper::getAssignedMenu(Yii::$app->user->id, null, null, true)
        ]) ?>
    </section>

</aside>
