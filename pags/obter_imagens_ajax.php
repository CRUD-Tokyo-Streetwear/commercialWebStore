<?php
require_once('../sistema/produto.php');
$p = new Produto("charlie", "localhost", "root", "");

if (isset($_GET['produtoId'])) {
    
    $produtoId = $_GET['produtoId'];

    $imagens = $p->getImagensProduto($produtoId);

    header('Content-Type: application/json');
    echo json_encode($imagens);
} else {
    http_response_code(400); 
    echo json_encode(array('erro' => 'produtoId nao esta definido na solicitação.'));
}
?>