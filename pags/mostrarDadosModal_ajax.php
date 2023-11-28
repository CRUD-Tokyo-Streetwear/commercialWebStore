<?php
require_once('../sistema/usuario.php');
require_once('../sistema/produto.php');

$u = new Usuario("charlie", "localhost", "root", "");
$p = new Produto("charlie", "localhost", "root", "");

//Exibe administrador
if (isset($_POST['admId'])) {
    $admId = $_POST['admId'];
    try {
        $result = $u->mostrarDadosAdmin($admId);
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}  

//Exibe categoria
if (isset($_POST['categoriaId'])) {
    $categoriaId = $_POST['categoriaId'];
    try {
        $result = $p->mostrarDadosCategoria($categoriaId);
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}  

//Exibe produto
if (isset($_POST['produtoId'])) {
    $produtoId = $_POST['produtoId'];
    try {
        $result = $p->mostrarDadosProduto($produtoId);
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}  