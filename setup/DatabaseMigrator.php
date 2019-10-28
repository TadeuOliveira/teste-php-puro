<?php
  
  header('Content-Type: text/html; charset=utf-8');

  class DatabaseMigrator{

    private $db_data = array();
    private $pdo;

    public function __construct($database_data){
      $this->db_data = $database_data;
      $this->pdo = new PDO("{$this->db_data['dbconn']}:host={$this->db_data['dbhost']}:{$this->db_data['dbport']}",
        $this->db_data['dbuser'],
        $this->db_data['dbpass']);
    }

    public function migrate(){
      //tenta migrar as tabelas planos e precos
      try{
        $this->pdo->exec("CREATE DATABASE {$this->db_data['dbname']}");

        $this->pdo->exec("USE {$this->db_data['dbname']}");

        $this->pdo->exec("CREATE TABLE planos(
          registro varchar(255) not null,
          nome varchar(255) not null,
          codigo int unsigned auto_increment primary key
          )");

        $this->pdo->exec("CREATE TABLE precos(
          codigo int unsigned,
          minimo_vidas int default 0,
          faixa1 decimal(10,2) not null,
          faixa2 decimal(10,2) not null,
          faixa3 decimal(10,2) not null,
          CONSTRAINT comp_id primary key (
            codigo,minimo_vidas
        ))");
      }
      catch(PDOException $e){
        echo $e;
      }      
    }
  }