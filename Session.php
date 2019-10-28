<?php

  header('Content-Type: text/html; charset=utf-8');
  
  include 'cli_readers/MusicalTasteTester.php';
  include 'cli_readers/DataRequester.php';

  class Session{

    private $pdo;

    public function __construct(PDO $pdo){
      $this->pdo = $pdo;
    }

    public function start(){
      MusicalTasteTester::test();      

      //recebe nomes e registros dos planos
      $infos = $this->get_planos_infos();

      extract($infos);

      //envia informacoes da sessao para que o DataRequester processe as entradas
      $requester = new DataRequester($planos_nomes,$planos_registros,$this->pdo);

      //processa entradas do usuario e retorna o gerenciador de receitas, após ter colhido estas informacoes
      $income_manager = $requester->request_data();

      //nas proximas duas linhas, imprime os resultados
      //primeiro, a receita em cada plano
      $income_manager->print_total_por_plano();

      //segundo, as informacoes de cada registro de cada usuario em seu plano de saude escolhido
      $income_manager->print_beneficiarios();

    }

    private function get_planos_infos(){
      $planos_data = $this->pdo->query("
        SELECT registro, nome 
        FROM planos
      ")->fetchAll(PDO::FETCH_ASSOC);

      $planos_registros = array();
      $planos_nomes = array();

      foreach ($planos_data as $i => $arr) {
        foreach ($arr as $key => $value) {
          $key == 'registro' ? array_push($planos_registros, $value) : array_push($planos_nomes, $value);
        }
      }
      return compact('planos_registros','planos_nomes');
    }
  }