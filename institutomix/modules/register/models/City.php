<?php

/**
 * @Class City
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

namespace institutomix\modules\register\models;

use common\models\User;
use common\bases\BaseActiveRecord;

/**
 * This is the model class for table "register_city".
 *
 * @property integer $id
 * @property string $name
 * @property integer $state_id
 * @property integer $is_capital
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property State $state
 * @property Customer[] $customers
 */
class City extends BaseActiveRecord
{
    const CAPITAL_NAO = 'Não';
    const CAPITAL_SIM = 'Sim';

    public $name_code;
    public $str_capital;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'register_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'state_id'], 'required'],
            [['state_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'filter', 'filter' => 'mb_strtoupper'],
            [['is_capital'], 'string', 'max' => 3],
            [['is_capital'], 'filter', 'filter' => 'mb_strtoupper'],
            [['name', 'state_id'], 'unique', 'targetAttribute' => ['name', 'state_id'], 'message' => 'A combinação de "Nome" e "Estado" já existe.'],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'name' => 'Nome',
            'state_id' => 'Estado',
            'is_capital' => 'É capital?',
            'str_capital' => 'É capital?',
            'created_by' => 'Criado Por',
            'created_at' => 'Criado Em',
            'updated_by' => 'Alterado Por',
            'updated_at' => 'Alterado Em',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['city_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCadastradoPor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAlteradoPor()
    {
        return !is_null($this->updated_by) ? $this->hasOne(User::className(), ['id' => 'updated_by']) : null;
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $capital = $this->is_capital == 1 ? '(Capital)' : '';
        $this->str_capital = $this->is_capital == 1 ? 'Sim' : 'Não';
        $this->name_code = $this->name .' - '. $this->state->code .' '. $capital;
    }

}
