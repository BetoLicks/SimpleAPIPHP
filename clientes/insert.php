<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");   
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
date_default_timezone_set("America/Sao_Paulo");

//-> INCLUSÃO DE CLIENTE...
if (($acao == 'inclui') && ($param == '')){
   $sql = "INSERT INTO tab_clientes (";        
   
   //-> CAMPOS...
   $cnt = 1;
   foreach (array_keys($_POST) as $campo){
      if (count($_POST) > $cnt){
         $sql .= "{$campo},";
      } else {
         $sql .= "{$campo}";
      }
      $cnt++;
   }
   
   //-> VALORES...
   $sql .= ") VALUES (";     
   $cnt = 1;    
   foreach (array_values($_POST) as $valor){
      if (count($_POST) > $cnt){
         $sql .= "'{$valor}',";
      } else {
         $sql .= "'{$valor}'";
      }
      $cnt++;
   }

   $sql .= ")";         
   $act = 'insertOne';

   $retorno = $db->prepare($sql);
   $insert  = $retorno->execute();

   if ($insert){
      echo json_encode(["AVISO"=>'Cliente cadastrado com sucesso.']);
   } else {
      echo json_encode(["ERRO"=>'Erro na execução da inerção do cliente']);
   }                     
}

  
?>