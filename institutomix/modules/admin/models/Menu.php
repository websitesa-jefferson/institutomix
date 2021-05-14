<?php

/**
 * @Class Menu
 * @category Yii2
 * @author  Jefferson C. Dias <jeffersoncosta2@hotmail.com>
 */

namespace institutomix\modules\admin\models;

use mdm\admin\models\Menu as MenuMdm;

/**
 * {@inheritdoc}
 */
class Menu extends MenuMdm
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_name'], 'in',
                'range' => static::find()->select(['name'])->column(),
                'message' => 'Menu "{value}" not found.'],
            [['parent', 'route', 'data', 'order', 'icon'], 'default'],
            [['parent'], 'filterParent', 'when' => function() {
                return !$this->isNewRecord;
            }],
            [['order'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'parent' => 'Pai',
            'parent_name' => 'Nome do Pai',
            'route' => 'Rota',
            'order' => 'Ordem',
            'data' => 'Data',
            'icon' => 'Ícone',
        ];
    }
}
