<?php

  header('Content-Type: text/html; charset=utf-8');
  
  include 'models/Beneficiario.php';

  class IncomeManager{

    //array de beneficiarios
    private $beneficiarios = array();

    //soma dos valores arrecadados para cada plano
    private $total_por_plano = array();

    //numero de beneficiarios para cada plano
    private $beneficiarios_por_plano = array();


    public function __construct($planos){
      foreach ($planos as $i => $plano) {
        $this->beneficiarios_por_plano[$plano] = 0;
        $this->total_por_plano[$plano] = 0;
      }
    }

    public function insert_beneficiario_por_plano($plano){
      $this->beneficiarios_por_plano[$plano]++;
    }

    public function get_beneficiario_por_plano($plano){
      return $this->beneficiarios_por_plano[$plano];
    }

    public function add_beneficiario($nome,$idade,$plano,$preco){
      array_push($this->beneficiarios, new Beneficiario($nome,$idade,$plano,$preco));
    }

    public function update_preco_por_plano($preco,$plano){
      $this->total_por_plano[$plano] += $preco;
    }

    public function print_total_por_plano(){
      foreach ($this->total_por_plano as $plano => $v) {
        echo "Receita do plano {$plano}: R$ {$v} \n";
      }
      echo "\n";
    }

    public function print_beneficiarios(){
      foreach($this->beneficiarios as $beneficiario){
        echo 
          "beneficiário {$beneficiario->nome} ".
          "de {$beneficiario->idade} anos ".
          "pagou {$beneficiario->preco} ".
          "no plano {$beneficiario->plano}\n";
      }
    }
  }