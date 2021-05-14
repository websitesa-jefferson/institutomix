<?php

use yii\db\Migration;

class m190814_222541_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->auth();
        $this->menu();
        $this->users();
    }

    public function auth()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS = 0;");

        $this->truncateTable('auth_rule');
        $this->truncateTable('auth_item');

        $arr = [
            ['/*', '2', '', '', '', '1565305637', '1565305637'],
            ['/gridview/*', '2', '', '', '', '1566939955', '1566939955'],
            ['/site/*', '2', '', '', '', '1565374022', '1565374022'],
            ['/site/error', '2', '', '', '', '1565374022', '1565374022'],
            ['/site/login', '2', '', '', '', '1565374022', '1565374022'],
            ['/site/reset-password', '2', '', '', '', '1565374022', '1565374022'],
            ['/site/request-password-reset', '2', '', '', '', '1565374022', '1565374022'],
            ['/register/*', '2', '', '', '', '1565374022', '1565374022'],
            ['admin', '1', 'Administrador do sistema', '', '', '1565700759', '1565706115'],
            ['convidado', '1', 'Usuário Acesso Externo', '', '', '1565700759', '1565706115'],
        ];
        // adiciona dados
        $this->batchInsert('auth_item', ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at'], $arr);

        $this->truncateTable('auth_item_child');
        $arr = [
            ['admin', '/site/*'],
            ['admin', '/register/*'],
            ['convidado', '/site/error'],
            ['convidado', '/site/login'],
            ['convidado', '/site/reset-password'],
            ['convidado', '/site/request-password-reset'],
        ];
        // adiciona dados
        $this->batchInsert('auth_item_child', ['parent', 'child'], $arr);
        $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
    }

    public function menu()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS = 0;");
        $this->addColumn('menu', 'icon', $this->string(20));

        $this->truncateTable('menu');
        $arr = [
            ['1', 'Cadastros', '', '', '', '', 'clone'],
            ['2', 'Clientes', '1', '/register/customer/index', '3', '', 'users'],
            ['3', 'Cidades', '1', '/register/city/index', '2', '', 'map-o'],
            ['4', 'Estados', '1', '/register/state/index', '1', '', 'map'],
        ];

        // adiciona dados
        $this->batchInsert('menu', ['id', 'name', 'parent', 'route', 'order', 'data', 'icon'], $arr);
        $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
    }

    public function users()
    {
        $this->addColumn('user', 'fullname', $this->string(64));
        $this->addColumn('user', 'created_by', $this->integer());
        $this->addColumn('user', 'updated_by', $this->integer());

        $this->batchInsert('user',
            ['fullname', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'status', 'created_at', 'updated_at'], [
                ['Administrador', 'admin', 'yt9WSCQq5wI0cCMQdALmpa4sZQZcfuWk', '$2y$13$99zMJGpe0kunZNH8RnXGEupJh/p3dGJM9P6yInj9yFjnYsoE1oA8.', null, 'webmaster@localhost', 10, 1476068969, 1476068969],
            ]);

        $this->batchInsert('auth_assignment',
            ['item_name', 'user_id'], [
                ['admin', '1']
            ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return false;
    }
}
