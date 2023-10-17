<?php
class DB{
   public static function conexaoDB(){
      $servidor = 'localhost';
      $usuario  = 'root';
      $senha    = '';
      $banco    = 'simpleapiphp';

      try {      
         return new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));    
      } catch(PDOException $erro) {
         echo 'ERRO: ' . $erro->getMessage();
      }      
   }
}