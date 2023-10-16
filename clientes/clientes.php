<?php

if ($api == 'clientes'){
//-> TENTA A CONEXÃO COM O BANCO...
$db  = DB::conexaoDB();

//---------------------------------------------------------------------------------------------------------
//-> GET
//---------------------------------------------------------------------------------------------------------
   if ($metodo == 'GET'){
      //-> ERRO DE ROTA...
      if ($acao == ''){
         echo json_encode(["ERRO"=>'Rota inexistente']);
      } else {
         $sql = '';
         $act = '';         

         //---------------------------------------------------------------------------------------------------------
         //-> LISTAGEM DE TODOS OS CLIENTES...
         //---------------------------------------------------------------------------------------------------------
         if (($acao == 'lista') && ($param == '')){
            $sql = 'SELECT * FROM tab_clientes ORDER BY cli_nome';         
            $act = 'listAll';
         }

         //---------------------------------------------------------------------------------------------------------
         //-> RETORNA UM ÚNICO CLIENTE...
         //---------------------------------------------------------------------------------------------------------
         if (($acao == 'lista') && ($param != '')){
            $sql = "SELECT * FROM tab_clientes WHERE cli_codigo = '$param' ";
            $act = 'listOne';            
         }
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

      if (isset($linhas)){
         echo json_encode(["dadosCliente"=>$linhas]);
      } else {
         echo json_encode(["AVISO"=>'Erro na execução da API']);
      }                     
   

   }

//---------------------------------------------------------------------------------------------------------
//-> POST
//---------------------------------------------------------------------------------------------------------
   if ($metodo == 'POST'){
         //---------------------------------------------------------------------------------------------------------
         //-> INCLUSÃO DE CLIENTE...
         //---------------------------------------------------------------------------------------------------------
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
   }   
}