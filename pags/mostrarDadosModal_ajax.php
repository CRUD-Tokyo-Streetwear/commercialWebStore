<?php
require_once('../sistema/usuario.php');
$u = new Usuario("charlie", "localhost", "root", "");

if (isset($_POST['admId'])) {
    $admId = $_POST['admId'];
    try {
        $result = $u->mostrarDadosAdmin($admId);
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} 
?>

