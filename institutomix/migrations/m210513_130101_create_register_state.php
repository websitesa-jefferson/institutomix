<?php

use yii\db\Schema;

class m210513_130101_create_register_state extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('register_state', [
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
            'name' => $this->string(64)->notNull(),
            'code' => $this->char(2)->notNull(),
            'created_by' => 'INT(10) UNSIGNED NULL DEFAULT NULL',
            'created_at' => $this->datetime(),
            'updated_by' => 'INT(10) UNSIGNED NULL DEFAULT NULL',
            'updated_at' => $this->datetime(),
            'PRIMARY KEY (`id`) USING BTREE',
            'UNIQUE INDEX `name` (`name`) USING BTREE',
            'UNIQUE INDEX `code` (`code`) USING BTREE',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('register_state');
    }
}
