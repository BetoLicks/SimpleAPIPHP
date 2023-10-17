<?php
//require('funcoes.php');
//retornaHeader('');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");   
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
date_default_timezone_set("America/Sao_Paulo");


if (isset($_GET['path'])){
   $path = explode('/',$_GET['path']);
} else {
   echo 'Rota inválida';
}

if (isset($path['0'])){
   $api = $path[0];
} else {
   echo 'Rota inválida';
}

if (isset($path['1'])){
   $acao = $path[1];
} else {
   $acao = '';
}

if (isset($path['2'])){
   $param = $path[2];
} else {
   $param = '';
}

$metodo = $_SERVER['REQUEST_METHOD'];

include_once "classes/db.class.php";
include_once "clientes/clientes.php";


/*
<!-- https://www.youtube.com/watch?v=GWHaatWwoOY&list=PLONnF1F_8i3HRLzXUCyQcXLkV-tajP_MH

https://dzkrrbb.medium.com/rest-api-with-php-get-post-put-delete-8365fe092618 -->
*/
?>