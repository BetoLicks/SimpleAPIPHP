<?php

if ($api == 'clientes'){
   if ($metodo == 'GET'){
      $db = DB::conexaoDB();
      $retorno = $db->prepare("SELECT * FROM tab_clientes ORDER BY cli_nome");
      $retorno->execute();
      $linhas = $retorno->fetchAll(PDO::FETCH_ASSOC);

      var_dump($linhas);

   }
}