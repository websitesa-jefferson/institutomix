<?php

/**
* @category Yii2
* @package  Jefferson C. Dias
* @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

$this->title = 'Criar Cidade';
?>
<div class="city-create">
    <div class="panel panel-default" style="margin-top:10px;">
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
                'states' => $states,
            ]) ?>
        </div>
    </div>
</div>
