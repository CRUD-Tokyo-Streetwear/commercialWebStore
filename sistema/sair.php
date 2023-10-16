<?php 

session_start(); 
unset($_SESSION['ADM_ID']); //Destruindo a sessao do usuario
header("location: ../index.php");

?>