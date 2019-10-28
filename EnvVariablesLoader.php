<?php

  header('Content-Type: text/html; charset=utf-8');

  class EnvVariablesLoader {

    private $data = array();

    public function __construct(){
      
      require __DIR__ . '/vendor/autoload.php';

      $dotenv = Dotenv\Dotenv::create(__DIR__);

      $dotenv->load();

      $this->data["dbconn"] = getenv('DB_CONNECTION');
      $this->data["dbhost"] = getenv('DB_HOST');
      $this->data["dbport"] = getenv('DB_PORT');
      $this->data["dbname"] = getenv('DB_DATABASE');
      $this->data["dbuser"] = getenv('DB_USERNAME');
      $this->data["dbpass"] = getenv('DB_PASSWORD');

    }

    public function __get($name){

      if($name == 'data')
        return $this->data;
      else if(array_key_exists($name, $this->data))
        return $data[$name];
      else
        return "not found";
    }
  }