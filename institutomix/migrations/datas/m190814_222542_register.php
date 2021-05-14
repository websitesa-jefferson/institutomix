<?php

use yii\db\Migration;

class m190814_222542_register extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->state();
    }

    public function state()
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

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('register_state');
    }
}
