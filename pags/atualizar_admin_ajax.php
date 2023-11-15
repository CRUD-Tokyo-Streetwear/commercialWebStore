<?php
require_once('../sistema/usuario.php');

$u = new Usuario("charlie", "localhost", "root", "");

if (isset($_POST['admId'])) {
    // Coletar dados da solicitação AJAX
    $admId = filter_var($_POST['admId'], FILTER_SANITIZE_STRING);
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $status = filter_var($_POST['status'], FILTER_VALIDATE_INT);

     // Realizar a atualização no banco de dados
     try {
         $resultado = $u->atualizarDadosAdminModal($admId, $nome, $email, $status);
         echo json_encode($resultado);
     } catch (Exception $e) {
         echo json_encode(['error' => $e->getMessage()]);
     }
 }
 ?>