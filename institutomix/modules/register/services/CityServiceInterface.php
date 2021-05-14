<?php

/**
 * Interface CityServiceInterface
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

namespace institutomix\modules\register\services;

use institutomix\modules\register\models\City;

interface CityServiceInterface 
{
    function City();

    function CitySearch();

    function buscarPorId(int $id);

    function buscarTodos();

    function buscarPorEstado(int $id);

    function salvar(City $city);

    function deletar($id);

    public function listarCapital();

}
