## DOCUMENTAÇÃO

### Acessar diretório do docker:
~~~~
cd institutomix
~~~~

### Subir o container:
~~~~
docker-compose up -d --build
~~~~

### Acessar o terminal do container do Docker
~~~~
docker exec -it institutomix_ws_1 bash
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
#Executar no cliente do MySql
CREATE DATABASE `institutomix`;
~~~~
~~~~
#Acesso ao cliente do MySql
user: root
pass: root
~~~~
Executar comandos abaixo no bash do Docker:
~~~~
php yii-institutomix migrate-rbac
~~~~
~~~~
php yii-institutomix migrate-admin
~~~~
~~~~
php yii-institutomix migrate
~~~~
~~~~
php yii-institutomix migrate-datas
~~~~

#### Acessando o sistema
Abrir o navegador e digitar os dados abaixo:
~~~~
https://localhost/institutomix/web
login: admin
senha: admin1
~~~~
