<?php

  header('Content-Type: text/html; charset=utf-8');

  //inclui o arquivo responsavel pelo carregamento de variaveis de ambeinte, criacao de tabelas e registro de informacoes no banco de dados
  include 'InitialSetup.php';

  //inclui a classe Session. Ela representa a rotina principal do programa, onde este recebe e processa informacoes inseridas pelo usuario
  include 'Session.php';

  //instancia e inicia sessao
  $session = new Session($pdo);

  $session->start();
