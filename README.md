# Teste de PHP Puro

Este foi um projeto que eu desenvolvi para demonstrar meus conhecimentos de PHP "vanilla". Seu enunciado é descrito em detalhes no arquivo **enunciado.txt**.

## Requisitos

Esta aplicação requer PHP 7.x e o gerenciador de pacotes composer.  
É necessário também um sistema de banco de dados para o qual a classe de PHP *PDO* ofereça um driver. Eles encontram-se [neste link](https://www.php.net/manual/pt_BR/pdo.drivers.php).


## Instalação

Abra seu terminal, navegue até a pasta do projeto e execute o seguinte comando:

    composer install || php composer.phar install

Você deve, também, criar um arquivo **.env** na raiz do diretório na mesma estrutura de **.env.example**, onde devem ser armazenadas as informações para o acesso ao banco de dados.  
Você pode fazer isso manualmente através de sua GUI ou, caso esteja usando linux ou mac, através dos comandos abaixo:

    touch .env
    vim .env

## Uso

Na pasta do projeto, execute o seguinte comando:

    php main.php

Toda a aplicação funciona na CLI. Divirta-se.
