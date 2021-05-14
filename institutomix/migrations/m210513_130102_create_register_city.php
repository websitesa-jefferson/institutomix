<?php

use yii\db\Schema;

class m210513_130102_create_register_city extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('register_city', [
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
            'name' => $this->string(64)->notNull(),
            'state_id' => 'INT(10) UNSIGNED NOT NULL',
            'is_capital' => 'TINYINT(3) UNSIGNED NOT NULL DEFAULT 0',
            'created_by' => 'INT(10) UNSIGNED NULL DEFAULT NULL',
            'created_at' => $this->datetime(),
            'updated_by' => 'INT(10) UNSIGNED NULL DEFAULT NULL',
            'updated_at' => $this->datetime(),
            'PRIMARY KEY (`id`) USING BTREE',
            'FOREIGN KEY ([[state_id]]) REFERENCES register_state ([[id]]) ON DELETE NO ACTION ON UPDATE NO ACTION',
            'UNIQUE INDEX `name_state_id` (`name`, `state_id`) USING BTREE',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('register_city');
    }
}
