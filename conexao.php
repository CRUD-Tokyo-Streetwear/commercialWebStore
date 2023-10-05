<?php
//Conexão com o banco de dados
$server = "localhost";
$user = "root";
$password = "";
$dbname = "pi_webstore";

$connection = mysqli_connect($server, $user, $password, $dbname);

//Mensagem de alerta Erro ou Sucesso
function message($text, $type) {
    echo "<div class='alert alert-$type' role='alert'>
            $text
          </div>";
}

?>