## DOCUMENTAÇÃO

### Acessar diretório do docker:
~~~~
cd yii2-advanced
~~~~

### Subir o container:
~~~~
docker-compose up -d --build
~~~~

### Acessar o terminal do container do Docker
~~~~
docker exec -it yii2-advanced_ws_1 bash
~~~~

Dependências:
#### Instalar as dependências com o composer
~~~~
composer install
~~~~

#### limpar runtime, atribuir permissão ao projeto
~~~~
./clear.sh
~~~~

Ambientes para rodar migrates:
#### Criar tabelas RBAC e Admin
~~~~
CREATE DATABASE `institutomix`; (Executar no cliente do MySql)
php yii-institutomix migrate-rbac
php yii-institutomix migrate-admin
php yii-institutomix migrate
php yii-institutomix migrate-datas
~~~~

#### Acessando o sistema
~~~~
https://localhost/institutomix/web
login: admin
senha: admin1
~~~~
