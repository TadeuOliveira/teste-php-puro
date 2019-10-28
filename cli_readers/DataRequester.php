<?php

  header('Content-Type: text/html; charset=utf-8');
  
  //o validador é uma classe auxiliar para a validacao de cada entrada em seu respectivo formato
  include 'helpers/Validator.php';
  //o gerenciador de receitas é responsavel por processar e armazenar as informacoes inseridas pelo usuario, a fim de gerar um relatorio ao fim do programa
  include 'models/IncomeManager.php';

  class DataRequester{

    private $planos;
    private $registros;
    private $pdo;

    public function __construct($planos,$registros,PDO $pdo){
      $this->planos = $planos;
      $this->registros = $registros;
      $this->pdo = $pdo;
    }

    public function request_data(){

      //instancia gerenciador de receitas
      $income_manager = new IncomeManager($this->planos);

      $qtd = $this->get_qtd();

      //para cada beneficiario, recebe e valida suas informacoes inseridas
      for($i = 1; $i <= $qtd; $i++){

        $validated_idade = $this->get_idade($i);

        $nome = readline("insira o nome do {$i}º beneficiário: ");

        $registro = $this->get_registro($i);

        //ao final de cada iteracao, armazena os dados recebidos no gerenciador de receitas, buscando dependencias no banco de dados
        $codigo_nome = $this->pdo->query("
          SELECT codigo,nome
          FROM planos
          WHERE registro='{$registro}'
        ")->fetch(PDO::FETCH_ASSOC);

        $plano_codigo = $codigo_nome['codigo'];
        $plano_nome = $codigo_nome['nome'];

        $income_manager->insert_beneficiario_por_plano($plano_nome);

        $minimo_vidas = $income_manager->get_beneficiario_por_plano($plano_nome);

        $preco = $this->pdo->query("
          SELECT {$validated_idade['faixa']} 
          FROM precos 
          WHERE codigo={$plano_codigo}
          AND minimo_vidas <= {$minimo_vidas}
          ORDER BY minimo_vidas DESC
        ")->fetch(PDO::FETCH_COLUMN);

        echo "preço: {$preco}\n";

        $income_manager->add_beneficiario($nome,$validated_idade['value'],$plano_nome,$preco);
       
        $income_manager->update_preco_por_plano($preco,$plano_nome);
      }

      //apos a insercao de todos os usuarios e suas informacoes, o gerenciador de receitas termina a computacao da receita e é retornado para apresentar os resultados
      return $income_manager;
    }

    private function get_qtd(){

      $qtd = readline("insira aqui a quantidade de beneficiários: ");        

      $is_valid = Validator::validate_quantidade($qtd);

      if($is_valid) return $qtd;
      
      return $this->get_qtd();      
    }

    private function get_idade($index){

      $idade = readline("insira a idade do {$index}º beneficiário: ");

      $validated_idade = Validator::validate_idade($idade);
          
      if($validated_idade['status']) {

        $validated_idade['value'] = $idade;

        return $validated_idade;
      }

      echo $validated_idade['msg'];

      return $this->get_idade($index);
    }
  }

  private function get_registro($index){
    
    $registro = readline("insira o registro do plano do {$index}º beneficiário: ");

    $is_valid = Validator::validate_registro($registro, $this->registros);

    if($is_valid) return $registro;

    echo "registro inválido \n";

    return $this->get_registro($index);

  }