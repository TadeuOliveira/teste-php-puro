<?php

  class MusicalTasteTester{

    public static function test(){
      //essa vai ser minha maior vigarice
      $genero = md5(readline("antes de mais nada, insira aqui o melhor gênero musical: "));

      switch ($genero) {
        case '8a47a61e26cf0145fe3f5a226ca9573b':
          echo "aí sim, meu(minha) consagrado(a) \n";  
          break;
        case '86094b61cb9f63b77f982ceae03e95f0':
          echo "ótimo palpite, mas não \n";
          break;
        case '9a1f30943126974075dbd4d13c8018ac':
          echo "seja mais específico(a) na próxima vez \n";
          break;
        default:
          echo "apesar de não ter um bom gosto musical, pode continuar \n";
          break;
      }
    }
  }