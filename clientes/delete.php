<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");   
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//-> ALTERAÇÃO DE CLIENTE...
if (($acao == 'excluir') && ($param != '')){
   $db  = DB::conexaoDB();

   try {      
      $sql = "DELETE FROM tab_clientes WHERE cli_codigo={$param} ";     
      $retorno = $db->prepare($sql);
      $update  = $retorno->execute();
   
      if ($update){
         echo json_encode(["AVISO"=>'Cliente excluído com sucesso.']);
      }    
   } catch(Exception $erro) {
      echo json_encode(["ERRO"=>'Erro ao executar a exclusão do cliente: '.$erro->getMessage()]);
   }         
}
?>