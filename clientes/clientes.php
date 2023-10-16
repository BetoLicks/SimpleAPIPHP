<?php

if ($api == 'clientes'){
   if ($metodo == 'GET'){
      //-> ERRO DE ROTA...
      if ($acao == ''){
         echo json_encode(["ERRO"=>'Rota inexistente']);
      }

      //-> TENTA A CONEXÃO COM O BANCO...
      $db  = DB::conexaoDB();
      $sql = '';
      $act = '';

      //-> LISTAGEM DE TODOS OS CLIENTES...
      if (($acao == 'lista') && ($param == '')){
         $sql = 'SELECT * FROM tab_clientes ORDER BY cli_nome';         
         $act = 'listAll';
      }

      //-> RETORNA UM ÚNICO CLIENTE...
      if (($acao == 'lista') && ($param != '')){
         $sql = "SELECT * FROM tab_clientes WHERE cli_codigo = '$param' ";
         $act = 'listOne';            
      }

      $retorno = $db->prepare($sql);
      $retorno->execute();

      //-> AÇÃO A SER TOMADA...
      switch ($act) {
         case 'listAll':
            $linhas = $retorno->fetchAll(PDO::FETCH_ASSOC);
            break;
         case 'listOne':
            $linhas = $retorno->fetchObject();
            break;
     }      

      if ($linhas){
         echo json_encode(["dadosCliente"=>$linhas]);
      } else {
         echo json_encode(["AVISO"=>'Nenhum cliente encontrado']);
      }         






   }
}