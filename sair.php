<?php
//Destrói os dados da sessão para deslogar
session_start();
ob_start();
unset($_SESSION['id'], $_SESSION['user']);

header("Location: index.php");