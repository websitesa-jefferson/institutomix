<?php

/**
 * Interface StateServiceInterface
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

namespace institutomix\modules\register\services;

use institutomix\modules\register\models\State;

interface StateServiceInterface 
{
    function State();

    function StateSearch();

    function buscarPorId(int $id);

    function buscarTodos();

    function salvar(State $state);

    function deletar($id);

}
