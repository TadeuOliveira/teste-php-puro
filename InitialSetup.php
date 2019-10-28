<?php

  header('Content-Type: text/html; charset=utf-8');

  //inclui o arquivo responsavel pelo carregamento de variaveis de ambeinte
  include 'EnvVariablesLoader.php';
  include 'setup/DatabaseMigrator.php';
  include 'setup/DatabaseSeeder.php';

  //carrega as variaveis de ambiente
  $env_loader = new EnvVariablesLoader();

  $env_data = $env_loader->data;

  //migrando bancos de dados
  $migrator = new DatabaseMigrator($env_data);

  $migrator->migrate();

  //alimentando o banco de dados com os arquivos json
  $pdo = new PDO("{$env_data['dbconn']}:host={$env_data['dbhost']}:{$env_data['dbport']};dbname={$env_data['dbname']}","{$env_data['dbuser']}","{$env_data['dbpass']}");

  $seeder = new DatabaseSeeder($pdo);

  $seeder->seed('planos');
  $seeder->seed('precos');