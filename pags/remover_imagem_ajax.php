<?php
require_once('../sistema/usuario.php');

$u = new Usuario("Charlie", "144.22.157.228:3306", "Charlie", "Charlie");

try {
    session_start();
    if (isset($_SESSION["ADM_ID"])) {
        $resultado = $u->removerImagemPerfil();
        echo json_encode($resultado);
    } else {
        echo json_encode(['error' => 'Sessão não iniciada']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>