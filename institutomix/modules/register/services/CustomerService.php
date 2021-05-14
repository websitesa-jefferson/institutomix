<?php

/**
 * @Class CustomerService
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

namespace institutomix\modules\register\services;

use common\bases\BaseService;
use institutomix\modules\register\models\Customer;
use institutomix\modules\register\models\search\CustomerSearch;

class CustomerService extends BaseService implements CustomerServiceInterface 
{
    /**
    * Cria um objeto Customer.
    * @return object
    */
    public function Customer()
    {
        return new Customer();
    }

    /**
    * Cria um objeto CustomerSearch.
    * @return object
    */
    public function CustomerSearch()
    {
        return new CustomerSearch();
    }

    /**
     * Busca a partir do ID
     * @return boolean
     */
    public function buscarPorId(int $id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            return false;
        }
    }

    /**
     *  Busca todos os registros
     * @return object
     */
    public function buscarTodos()
    {
        return Customer::find()->orderBy('name')->all();
    }

    /**
     * Salva no db.
     * @param Customer $customermodel
     * @return boolean
     */
    public function salvar(Customer $customer)
    {
        return $customer->save();
    }

    /**
     * Deleta registro a partir do ID
     * @param int $id
     * @return boolean
     */
    public function deletar($id)
    {
        if (Customer::deleteAll(['in', 'id', $id])) {
            return true;
        } else {
            return false;
        }
    }

}
