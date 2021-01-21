# Sistema Comercial Web - SCW (estudo)

## Nossos canais 

## Telegram
Grupos no Telegram:
Grupo dedicado a aulas em PHP, Javascript, CSS, HTML e tecnologias diversas relacionadas a web.
https://t.me/codigo_limpo

## PHP Café
Grupo dedicado a linguagem PHP, tecnologias diversas e ao bendito café.
https://t.me/PHP_Cafe

## Web Site

Site da Ipage:
https://www.ipage.com.br/


## Seja matenedor deste projeto

https://www.paypal.com/donate?token=9RoUO8evLimoTEAdLTtywSoWGY0V6Can3f8OcYUg1yjYcinnnAxYrtoRDxs58j-3B1h--7rKAR8I805W


## Apoie este projeto fazendo doações com o PIX

pix: diogenesdias.nubank@gmail.com


## O projeto

Aplicação de estudo CRUD estilo painel administrativo contruída com PHP, MariaDB, JavaScript, JQuery, HTML 5, CSS3 e BootStrap.

Esta aplicação tem o objetivo de ensinar conceitos da programação relacionados ao mundo real e das tecnologias descritas acima.

Saber criar um CRUD, entender como funcionam as requisições em AJAX, o que é um layout responsivo, como gerir banco de dados? Dentre outras rotinas do dia a dia do desenvolvimento web.

## Características

  * Compatível em PHP 7 ou superior
  * Banco de dados em MySql
  * Bootstrap
  * JQuery
  * Template SBAdmin
  * Controle de rotas via .htaccess
  * Criptografia dos dados ao realizar uam solicitação GET
  * Gestão de variáveis de sessão com criptografia/descriptografia
  * Classe para abstração de dados com PDO
  * Log de usuários
  * Log de exceções
  * Classe para informações gerais da aplicação
  * Api para consulta produtos pelo seu código EAN-13
  * Classe para gerir paginação de dados
  * Relatórios em PDF
  * Classe para gestão de permissões de usuários a nível de tabela
  * Api para consulta de cep
  * Classe autoload padrão PSR-4
  * Adição/atualização via ajax
  * Encapsulamento de scripts em javascript
  * Troca de informações entre modais
  * Troca de informações entre PHP e javascript
  * Criptografia 64 bits no envio de dados
  * Técnica de callback em javascript
  * Tratamento global de erros em javascript
  * Scripts de autoload de dados nas input text
  * Gestão de envio de e-mail com o pacote PHPMailer
  * Controle de acesso via captcha com o comando imagecreatefrompng
  * Script para evitar preenchimento automático de dados via robô
  * Estrutura modular do projeto e organização das pastas
  * Rotina de recuperação da senha do usuário através de e-mail
  
## Visualizar

https://www.ipagesoftware.com.br/scw/www/

## Dados acesso
* email: curso@ipage.com.br
* senha: 123456

## Características

* Aplicação em PHP 7 (https://pt.wikipedia.org/wiki/PHP) ou superior com controle de rotas definidas no arquivo .htaccess (https://pt.wikipedia.org/w/index.php?search=htaccess&title=Especial%3APesquisar&go=Ir&ns0=1).
* Banco de dados em Mysql ou MariaDb (https://pt.wikipedia.org/wiki/MariaDB).
* Layout baseado sobre o FrameWork (https://pt.wikipedia.org/wiki/Framework) BootStrap (https://pt.wikipedia.org/wiki/Bootstrap_(framework_front-end)).
* CRUD (https://pt.wikipedia.org/wiki/CRUD) com as operação de inserção via ajax (https://pt.wikipedia.org/wiki/Ajax), leitura/pesquisa em planilha, atualização (via ajax) e exclusão de dados.
* A aplicação é separada por módulos diversos que ficam separados nas suas respectivas pasta, facilitando assim a remoção de móudlo atual ou adição de novos módulos.
* Aplicação possui rotina de registro de licença de uso através de chave de acesso com criptografia de 256 kbytes.

## O que você aprenderá em PHP?

* PDO Classe para abstração de banco de dados em PHP
* Sessões
* Controle de permissões de usuários
* Envio de e-mail com a classe PHPMailer (https://en.wikipedia.org/wiki/PHPMailer)

## O que você aprenderá em Javascript?

* Encapsulamento
* Classes
* Conceitos da linguagem

## O que você aprenderá em JQuery?

* Manipulação do DOM (https://en.wikipedia.org/wiki/Document_Object_Model)
* Requisições em AJAX

## O que você aprenderá em BootStrap?

* Sistema de grid
* Definição de colunas e linhas
* Componentes do bootstrap

## O que você aprenderá em MySql/MariaDb?

* O que é um banco de dados
* O que é tabela
* Linguagem SQL


## Estrutura de pastas do projeto

O projeto possui uma estrutura de pastas bem definidas, cada uma com a sua relavância e importância, são elas:


## Configurações

Para que a aplicação funcione adequadamente é preciso realizar um pré-cadastro no endereço abaixo:
https://www.ipagesoftware.com.br/license_key/www/lic_pre_cadastro/

Ao realizar o rpé-cadastro com sucesso, será lhe enviado um e-mail com a sua licença de uso que deverá ser adicionada/modificada no arquivo de config.php da aplicação que fica na raiz do projeto.

root -> config.php

// Chave responsável pela licença de uso
define("ACCESS_KEY", "coloque aqui a tua licença de uso");


## Configuração do path da aplicação local

Para que a aplicação funcione adequadamente, você deverá configurar a constante URL no arquivo config.php
Você deverá configurar a constante URL para uso da aplicação no localhost e no seu servidor da web.

## Configuração DAS API's

A aplicação utiliza algumas api's para explanar o seu uso, são elas:

* API de coleta de informações de um produto através do seu código de barras também conhecido como EAN13 (https://pt.wikipedia.org/wiki/EAN-13).
* API de licença de uso. Esta api é de uso obrigatório ela verifica periodicamente o registro da aplicação, controle da validada da licença e necessita de uma chave de licença para ser validada em nosso servidor.
Para que o módulo produto funcione adequadamente, você deverá adquirir a chave do nosso Web Service no seguinte endereço:

https://ipage.com.br/ipage/wskey_produto/

* API de consulta a CEP's. Esta api é utilizada para auxiliar no preenchimento automático de cadastros através do CEP informado. É necessário adquirir uma chave de licença no link abaixo:
https://ipage.com.br/ipage/wskey/

A chave de licença deverá ser inserida/modificada no arquivo ipageCep.js que fica na pasta assets/js/

root
 ->
  assets
      ->
       js


## Estrutura das pastas do projeto

## aplication

A pasta aplication é constituída de duas pastas, são elas:
controles e views.

root
 ->
  aplication
      ->
       controles
      ->
       views

## controles

A pasta controles temos os script para gerir captcha e email com o pacote do PHPMailer (https://en.wikipedia.org/wiki/PHPMailer).

root
 ->
  aplication
      ->
       controles


## views

root
 ->
  aplication
      ->
       views
           ->
            access
           ->
            autocomplete
           ->
            cadastros
           ->
            estoque
           ->
            financeiro
           ->
            index
           ->
            produto
           ->
            relatorios
           ->
            user


## Módulo access

Neste módulo temos os sub-módulos responsáveis pelo login, esqueci a senha, permissões do usuário, controle de sessões e crud do usuário.

## Módulo autocomplete

Neste módulo é responsável pelas chamadas ao autocompletar de dados das caixas input do projeto.

## Módulo cadastros

Neste módulo temos os cadastros iniciais do projeto, são eles:
cadastro de clientes, cadastro de empresas, cadastro de vendedores, associação do usuário com o vendedor, associação do vendedor ao cliente.

## Módulo estoque

Este módulo é responsável pelo ajuste e moviemntação do estoque.

## Módulo financeiro

A ideia é controlar várias contas (procedências) financeiras, como contas à pagar e contas a receber.
O módulo constitue dos seguintes sub-módulos:
Cadastro de agência bancária, cartão de crédito, gestão do contas à pagar\receber, formas de pagamento, plano de contas e emissão de recibo e relatórios diversos.

## Módulo index

Este módulo gerencia a página inicial da aplicação

## Módulo produto

Este módulo é responsável pela gestão de produtos, são eles:
cadastro fabricante, fornecedor, grupo, produto, unidade de medida

## Módulo relatórios

Neste módulo temos os scripts para emissão de relatórios em PDF do contas a pagar\receber e emissão de recibo

## Módulo user

Este módulo gerencia o perfil do usuário e a redefinição da su asenha

Nota: alguns módulos só serão disponibilizados para download para os que fizerem uma singela doação ;-).

## Pasta assets

root
 ->
  assets
      ->
       css
      ->
       font-awesome
      ->
       fonts
      ->
       images
      ->
       js


## Pasta assets/css

Nesta pasta temos o css do bootstrap, sb-admin (template da aplicação), loader.css (responsável pela animação da carga da página), popup-cookies (responsável pelas rotinas de LGPD), custom (reponsável pela customização realizada desenvolvedor), morris (https://morrisjs.github.io/morris.js/).

root
 ->
  assets
      ->
       css
           ->
            plugins

## Pasta assets/font-awesome

Nesta pasta temos as fontes utilizadas pelo bootstrap (https://fontawesome.com/v3.2.1/).

root
 ->
  assets
      ->
       font-awesome

## Pasta assets/fonts

Nesta pasta temos as fontes utilizadas pela aplicação.

root
 ->
  assets
      ->
       fonts


## Pasta assets/images

Nesta pasta temos as imagens utilizadas ple apalicação, como logo tipo, e redes sociais.

root
 ->
  assets
      ->
       images
           ->
            social


## Pasta assets/js

Nesta pasta temos os scripts do bootstrap, api cep, scripts do módulo views, cookies, date e hora, aplicação.

root
 ->
  assets
      ->
       js

## Pasta assets/js/plugins

Nesta pasta temos os scripts com os plugins para gerir mensagens de alerta, combobox, data picker, números em extenso, números monetários, auto completar input, máscxara de texto, notificações, chart, scroll com efeito, select, textarea, critografia base 64.

root
 ->
  assets
      ->
       js
           ->
            plugins


## Pasta log

Nesta pasta são armazenados o log de erros da aplicação.
O log dew erros poderá ser ativado/desativado no config da aplicação.

root
 ->
  log

## Pasta src

Nesta pasta estão as classes utilizadas pela aplicação, são elas:

root
 ->
  src
      ->
       About
      ->
       BarCode
      ->
       Conexao
      ->
       Delete
      ->
       JSON
      ->
       Layout
      ->
       Paginacao
      ->
       Recursos
      ->
       Seguranca
      ->
       Utilities      

## Pasta src/About

Classe reponsável pelo módulo "sobre" da aplicação.

root
 ->
  src
      ->
       About

## Pasta src/BarCode

Classe reponsável pela geração de código de barras a partir do código EAN-13 do produto.

root
 ->
  src
      ->
       BarCode


## Pasta src/Conexao

Classe reponsável pela conexão com o banco de dados da aplicação.
Para configurar a conexão é necessário configurar os dados da conexão no método defConn.

root
 ->
  src
      ->
       Conexao

## Pasta src/Delete

Classe reponsável pelas rotinas de exclusão de dados da aplicação.

root
 ->
  src
      ->
       Delete


## Pasta src/JSON

Classe reponsável pelas rotinas de json da aplicação.

root
 ->
  src
      ->
       JSON


## Pasta src/Layout

Classe reponsável pelo layout da aplicação.

root
 ->
  src
      ->
       Layout


## Pasta src/Paginacao

Classe responsável pela paginação dos dados.

root
 ->
  src
      ->
       Layout


## Pasta src/Recursos

Nesta pasta temos as classes responsável pela gestão do console e as sessões do usuário.

root
 ->
  src
      ->
       Recursos


## Pasta src/Seguranca

Nesta pasta temos as classes responsável pelas rotinas de criptografia e permissões do usuários.

root
 ->
  src
      ->
       Seguranca

## Pasta src/Utilities

Classe com diversos métodos auxiliares da aplicação.

root
 ->
  src
      ->
       Utilities


## Pasta vendor

Conjunto de classes geradas pelo composer para gerir o auto carga das classes utilizadas pela aplicação.

root
 ->
  vendor
 

## Arquivo .htaccess

Neste arquivo temos as configurações do apache e as definições das rotas da aplicação.

## Arquivo config.php

Neste arquivo temos as configurações da aplicação.

## Arquivo functions.php

Neste arquivo temos as funções genéricas da aplicação.


## Arquivo inc_js.php

Neste arquivo temos todos os arquivo js da aplicação que são carregados em todas as páginas.

# Criando e configurando arquivo composer.json:
{
    "name": "ipagesoftware/scw",
    "description": "Sistema Gestor Web",
    "type": "project",
    "authors": [
        {
            "name": "Diógenes Dias",
            "email": "diogenesdias@hotmail.com"
        }
    ],
    "require": {

    },
    "autoload": {
        "psr-4": {
            "App\\": "src"
        }
    }    
}

## Após criar o arquivo coomposer.json execute o seguinte comando:
composer install 
na pasta onde o arquivo composer.json se encontra.

Após este procedimento os arquivos de autoload estarão configurados.

## Banco de dados
O banco de dados encontra-se na pasta sql.

root -> sql

Importe o arquivo banco_de_dados.sql em seu gerenciador de banco de dados.

Caso não tenha nenhum gerenciador de banco de dados eu sugiro o heidisql:
https://www.heidisql.com/download.php

## Sublime Text

Para quem utiliza o Sublime text como seu editor de script, na raiz temos o arquivo do projeto:
scw_estudo.sublime-project

## Maiores informações

Você poderá ler um pequeno manual em PDF (Manual configuração SCW) que está na pasta raiz.
https://github.com/ipagesoftware/scw/blob/main/Manual%20configura%C3%A7%C3%A3o%20SCW.pdf
