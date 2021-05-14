<?php

/**
 * Interface CustomerServiceInterface
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

namespace institutomix\modules\register\services;

use institutomix\modules\register\models\Customer;

interface CustomerServiceInterface 
{
    function Customer();

    function CustomerSearch();

    function buscarPorId(int $id);

    function buscarTodos();

    function salvar(Customer $customer);

    function deletar($id);

}
