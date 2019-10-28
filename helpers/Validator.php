<?php

  header('Content-Type: text/html; charset=utf-8');
  
  class Validator{

    public static function validate_quantidade($qtd){
      return is_numeric($qtd) && $qtd > 0;
    }

    public static function validate_idade($idade){

      if (!is_numeric($idade)) {
        return ['status' => false,'msg' => "a idade deve ser um número inteiro\n"];
      }
      else if ($idade < 0) {
        return ['status' => false,'msg' => "a idade deve ser maior ou igual a 0\n"];
      }
      else if ($idade < 18) {
        return ['status' => true,'msg' => 'idade aceita','faixa'=>'faixa1'];
      }
      else if ($idade < 41) {
        return ['status' => true,'msg' => 'idade aceita','faixa'=>'faixa2'];
      }
      else {
        return ['status' => true,'msg' => 'idade aceita','faixa'=>'faixa3'];
      }
    }

    public static function validate_registro($registro,$registros){
      return in_array($registro, $registros);
    }
  }