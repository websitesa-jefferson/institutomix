<?php

/**
 * @Class State
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
*/

namespace institutomix\modules\register\models;

use common\models\User;
use common\bases\BaseActiveRecord;

/**
 * This is the model class for table "register_state".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property City[] $cities
 */
class State extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'register_state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'filter', 'filter' => 'mb_strtoupper'],
            [['code'], 'string', 'max' => 2],
            [['code'], 'filter', 'filter' => 'mb_strtoupper'],
            [['name'], 'unique'],
            [['code'], 'unique']
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
            'code' => 'Sigla',
            'created_by' => 'Criado Por',
            'created_at' => 'Criado Em',
            'updated_by' => 'Alterado Por',
            'updated_at' => 'Alterado Em',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['state_id' => 'id']);
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

}
