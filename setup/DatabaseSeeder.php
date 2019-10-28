<?php

  header('Content-Type: text/html; charset=utf-8');
  
  class DatabaseSeeder{

    private $pdo;

    public function __construct(PDO $pdo){

      $this->pdo = $pdo;
    }

    function seed($table){
      //le informacoes nos arquivos .json e as insere no banco de dados em suas respectivas tabelas
      $$table = json_decode(file_get_contents("data/{$table}.json"),true);

      $sql = "INSERT INTO {$table} VALUES ";

      foreach($$table as $i => $arr_fields){
          $sql .= "(";
          foreach ($arr_fields as $field => $value) {
            $sql .= "'{$value}',";
          }
          $sql = substr($sql, 0, -1);
          $sql .= "),";
        }
        $sql = substr($sql, 0, -1);

        $this->pdo->query($sql);
    }
  }