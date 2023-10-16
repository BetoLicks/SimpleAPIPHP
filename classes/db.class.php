<?php

class DB{
   public static function conexaoDB(){
      $servidor = 'localhost';
      $usuario  = 'root';
      $senha    = '';
      $banco    = 'simpleapiphp';

      ///return new PDO("mysql:host={$host};banco={$banco};charset=UTF8;".$user,$pass);

      try {      
         return new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));    
         ///$pdo->exec("SET lc_time_names = 'pt_BR'");            
      } catch(PDOException $erro) {
         echo 'ERRO: ' . $erro->getMessage();
      }      
   }
}