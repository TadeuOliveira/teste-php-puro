<?php

  header('Content-Type: text/html; charset=utf-8');
  
  class Beneficiario{

    private $nome;
    private $idade;
    private $plano;
    private $preco;

    public function __construct($nome,$idade,$plano,$preco){
      $this->nome = $nome;
      $this->idade = $idade;
      $this->plano = $plano;
      $this->preco = $preco;
    }

    public function __get($name){
      return $this->$name;
    }
  }