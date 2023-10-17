<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");   
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
date_default_timezone_set("America/Sao_Paulo");

//-> ALTERAÇÃO DE CLIENTE...
if (($acao == 'alterar') && ($param != '')){
   $sql = "UPDATE tab_clientes SET ";        
   
   //-> CAMPOS...
   $cnt = 1;
   foreach (array_keys($_POST) as $campo){
      if (count($_POST) > $cnt){
         $sql .= "{$campo} = '{$POST[$campo]}',";
      } else {
         $sql .= "{$campo} = '{$POST[$campo]}' ";
      }
      $cnt++;
   }      

   $sql .= " WHERE cli_codigo={$param}";     
   var_dump($sql);

   $retorno = $db->prepare($sql);
   $insert  = $retorno->execute();

   if ($insert){
       echo json_encode(["AVISO"=>'Cliente cadastrado com sucesso.']);
   } else {
       echo json_encode(["ERRO"=>'Erro na execução da a do cliente']);
   }                     
}




      
?>