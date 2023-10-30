<?php
//Definição de variáveis para conectar com o banco
$server = "localhost";
$user = "root";
$password = "";
$dbname = "pi_webstore";

//Conexão com o banco de dados
$connection = mysqli_connect($server, $user, $password, $dbname);

//Função para mandar mensagem de sucesso ou erro
function message($text, $type)
{
  echo "<div class='alert alert-$type' role='alert'>
        $text
    </div>
    <a href='index.php' class='btn btn-primary'>Ok</a>";
}
