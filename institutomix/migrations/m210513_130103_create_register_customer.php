<?php

use yii\db\Schema;

class m210513_130103_create_register_customer extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('register_customer', [
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
            'name' => $this->string(64)->notNull(),
            'city_id' => 'INT(10) UNSIGNED NOT NULL',
            'created_by' => 'INT(10) UNSIGNED NULL DEFAULT NULL',
            'created_at' => $this->datetime(),
            'updated_by' => 'INT(10) UNSIGNED NULL DEFAULT NULL',
            'updated_at' => $this->datetime(),
            'PRIMARY KEY (`id`) USING BTREE',
            'FOREIGN KEY ([[city_id]]) REFERENCES register_city ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'UNIQUE INDEX `name_city_id` (`name`, `city_id`) USING BTREE',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('register_customer');
    }
}
