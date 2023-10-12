<?php
//Definição de variáveis para conectar com o banco
$server = "localhost";
$user = "root";
$password = "";
$dbname = "pi_webstore";

//Conexão com o banco de dados
$conn = new PDO("mysql:host=$server; dbname=$dbname; user=$user; password=$password");

//Função para mandar mensagem de sucesso ou erro
function message($text, $type)
{
  echo "<div class='alert alert-$type' role='alert'>
    $text
  </div>";
}
