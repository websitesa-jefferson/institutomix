<?php

use yii\db\Migration;

class m190814_222542_register extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->states();
        $this->cities();
        $this->customer();
    }

    public function states()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS = 0;");

        $arr = [
            ['Acre', 'AC'],
            ['Alagoas', 'AL'],
            ['Amazonas', 'AM'],
            ['Amapá', 'AP'],
            ['Bahia', 'BA'],
            ['Ceará', 'CE'],
            ['Distrito Federal', 'DF'],
            ['Espírito Santo', 'ES'],
            ['Goiás', 'GO'],
            ['Maranhão', 'MA'],
            ['Minas Gerais', 'MG'],
            ['Mato Grosso do Sul', 'MS'],
            ['Mato Grosso', 'MT'],
            ['Pará', 'PA'],
            ['Paraíba', 'PB'],
            ['Pernambuco', 'PE'],
            ['Piauí', 'PI'],
            ['Paraná', 'PR'],
            ['Rio de Janeiro', 'RJ'],
            ['Rio Grande do Norte', 'RN'],
            ['Rondônia', 'RO'],
            ['Roraima', 'RR'],
            ['Rio Grande do Sul', 'RS'],
            ['Santa Catarina', 'SC'],
            ['Sergipe', 'SE'],
            ['São Paulo', 'SP'],
            ['Tocantins', 'TO'],
        ];

        // adiciona dados
        $this->batchInsert('register_state', ['name', 'code'], $arr);
        $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
    }

    public function cities()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS = 0;");

        $arr = [
            ['DISTRITO FEDERAL', 7, 1],
            ['TERESINA', 17, 0],
            ['SÃO GONÇALO', 19, 0],
        ];

        // adiciona dados
        $this->batchInsert('register_city', ['name', 'state_id', 'is_capital'], $arr);
        $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
    }

    public function customer()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS = 0;");

        $arr = [
            ['MARIA DAS DORES', 1],
            ['JORGE DA SILVA', 2],
            ['RONALDO ALENCAR', 3],
        ];

        // adiciona dados
        $this->batchInsert('register_customer', ['name', 'city_id'], $arr);
        $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('register_customer');
        $this->truncateTable('register_city');
        $this->truncateTable('register_state');
    }
}
