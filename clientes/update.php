<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");   
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//-> ALTERAÇÃO DE CLIENTE...
if (($acao == 'alterar') && ($param != '')){
   $db  = DB::conexaoDB();

   try {      
      $sql = "UPDATE tab_clientes SET ";        
      //-> ELIMINANdo O PRIMEIRO ITEM DO ARRAY...
      array_shift($_POST);
      //-> CAMPOS...
      $cnt = 1;
      foreach (array_keys($_POST) as $campo){
         if (count($_POST) > $cnt){
            $sql .= "{$campo} = '{$_POST[$campo]}',";
         } else {
            $sql .= "{$campo} = '{$_POST[$campo]}' ";
         }
         $cnt++;
      }      
   
      $sql .= " WHERE cli_codigo={$param}";        
      $retorno = $db->prepare($sql);
      $update  = $retorno->execute();
   
      if ($update){
         echo json_encode(["AVISO"=>'Dados do cliente alterados com sucesso.']);
      }    
   } catch(Exception $erro) {
      echo json_encode(["ERRO"=>'Erro ao executar a alteração dos dados do cliente: '.$erro->getMessage()]);
   }         
}
?>