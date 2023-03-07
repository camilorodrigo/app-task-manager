# Sistema Gerenciador de Tarefas
app-task-manager
Consiste na criação de um sistema de gerenciamento de tarefas

## 🚀 Engenharia de Software

DER - DIAGRAMA DE ENTIDADE E RELACIONAMENTO

No diretório: app-task-manager/ENGENHARIA DE SOFTWARE/DER

- Contém o Diagrama (DER) 
- Software modelagem: MYSQL Workbench 8.0 
- Arquivo 1: APP_TASK_MANAGER_DER_UTF8_MYSAM.mwb
- Arquivo 2: Por precaução contém APP_TASK_MANAGER_DER_UTF8_MYSAM.pdf
- Arquivo 3: Por precaução contém APP_TASK_MANAGER_DER_UTF8_MYSAM.png
- Arquivo 4: Por precaução contém também o EXPORT do banco: apptaskmanagerdb.sql

### 📋 Pré-requisitos

De que coisas você precisa para instalar o software e como instalá-lo?

```
PHP: 8.0.13
Framework: Laravel (Framework PHP para Artesãos da Web) Versão Laravel: 8.83.27
MYSQL : 8.0.21
```

### 🔧 Instalação

Efetue o clone do projeto para seu ambiente local. Para tal, você poderá realizar o comando git clone utilizando uma chave SSH ou via HTTPS.

```
SSH:
git@github.com:camilorodrigo/app-task-manager.git
HTTPS:
Git clone https://github.com/camilorodrigo/app-task-manager.git
```
## ⚙️ Executando os testes

Vejamos como executar os testes automatizados para este sistema.

### ⌨️ Testes via Postman

No diretório: app-task-manager/ENGENHARIA DE SOFTWARE/TESTS
- Contém documentação de testes POSTMAN
Link: https://documenter.getpostman.com/view/20463767/2s93CRKBK9
- Para reproduzir os testes será necessário importar o arquivo  app-task-manager/ENGENHARIA DE SOFTWARE/TESTS/ E-Get API - Gerenciador de Tarefas.postman_collection.json
- Em seguida com o Postman aberto clique na Collection E-Get API - Gerenciador de Tarefas > no painel que abrirá a direita navegue até a aba variables e informe um id, codigo de usuário e status da tarefa de acordo com a sua base de dados. OBS: É importante toda vez que logar atribuir o novo token na variável token sempre após o bearear
### ⌨️ Testes PHPUnit - Teste de Login

- Para efetuarmos um teste de login primeiro será necessário cadastrar um usuário com e-mail e senha no banco de dados 
- Em seguida abrir o terminal dentro da pasta src/ e rodar o seguinte comando:

Para rodar tudo o que está na classe AuthControllerTest use o comando:
```
php artisan test --filter=AuthControllerTest
```
Para rodar apenas um método específico você deverá colocar dois pontos 2x e em seguida informar o nome do método que deseja rodar. Veja:

```
php artisan test --filter=AuthControllerTest::test_login
php artisan test --filter=AuthControllerTest::test_usuario_not_int
```

### ⌨️ Testes PHPUnit - Services

Para que este teste venha funcionar perfeitamente será necessário informar um id válido na base de dados e no método testCheckIfEmailAlreadyExists informar um email cadastrado no banco de dados.

```
php artisan test --filter=CheckDataServiceTest
php artisan test --filter=CheckDataServiceTest::testCheckTaskExists
php artisan test --filter=CheckDataServiceTest::testCheckUserExists
php artisan test --filter=CheckDataServiceTest::testCheckThereIsAssignmentInTask
php artisan test --filter=CheckDataServiceTest::testCheckIfEmailAlreadyExists
php artisan test --filter=CheckDataServiceTest::testCheckIfTitleTaksAlreadyExists
```

Para que o teste abaixo em CreateAssignmentServiceTest venha funcionar será necessário informar um array de atributos. Vejamos:

```
 $attributes = array(
            'codigo_usuario' => 1,
            'codigo_tarefa' => 1
        );

php artisan test --filter=CreateAssignmentServiceTest
```

Para que o teste abaixo em CreateTaskServiceTest venha funcionar será necessário informar um array de atributos. Vejamos:

```
$attributes = array(
            'titulo' => "TASK TEST 6",
            'descricao' => "ONE TASK TEST",
            'data_inicio' => '03/03/2023',
            'data_fim' => '04/03/2023'
        );

php artisan test --filter=CreateTaskServiceTest
```
Para que o teste abaixo em CreateUserServiceTest venha funcionar será necessário informar um array de atributos. Vejamos:

```
 $attributes = array(
             'nome' => "RODRIGO",
             'email' => "r@gmail.com",
             'senha' => '123'
         );

php artisan test --filter=CreateUserServiceTest
```

Para que este teste em RemoveTaskServiceTest venha funcionar perfeitamente será necessário informar um id de uma tarefa existente na base de dados.

```
 php artisan test --filter=RemoveTaskServiceTest
```

Para que o teste abaixo em UpdateTaskServiceTest venha funcionar será necessário informar um array de atributos e um id da tarefa existenta no banco de dados. Vejamos:

```
        $idTask = 1; 
        $attributes = array(
            'titulo' => "ONE TASK",
            'descricao' => "ONE TASK TEST",
            'data_inicio' => '04/03/2023',
            'data_fim' => '05/03/2023'
        );

php artisan test --filter=UpdateTaskServiceTest::testUpdateTask
```
## 🛠️ Construído com

Mencione as ferramentas que você usou para criar seu projeto

* [Laravel](https://laravel.com/) - Laravel (Framework PHP para Artesãos da Web)
* [Postman](https://www.postman.com/) - Postman
* [MYSQL Workbench](https://www.mysql.com/products/workbench/) - MySQL Workbench é uma ferramenta visual unificada para arquitetos de banco de dados

## ✒️ Autores

Mencione todos aqueles que ajudaram a levantar o projeto desde o seu início

* **Dev.** - *Desenvolvido por* - [Rodrigo Camilo](https://github.com/camilorodrigo)

## 🎁 Expressões de gratidão

* Conte a outras pessoas sobre este projeto 📢;

---
⌨️ com ❤️ por [Rodrigo Camilo](https://github.com/camilorodrigo)😊