<?php
require_once('../sistema/produto.php');
$p = new Produto("Charlie", "144.22.157.228:3306", "Charlie", "Charlie");

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