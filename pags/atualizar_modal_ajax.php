<?php
require_once('../sistema/usuario.php');
require_once('../sistema/produto.php');

$p = new Produto("Charlie", "144.22.157.228:3306", "Charlie", "Charlie");
$u = new Usuario("Charlie", "144.22.157.228:3306", "Charlie", "Charlie");



// Coletar dados da solicitação AJAX ADMINISTRADOR
if (isset($_POST['admId'])) {
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

// Coletar dados da solicitação AJAX CATEGORIA
if (isset($_POST['categoriaId'])) {
    $categoriaId = filter_var($_POST['categoriaId'], FILTER_SANITIZE_STRING);
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
    $desc = filter_var($_POST['desc'], FILTER_SANITIZE_EMAIL);
    $status = filter_var($_POST['status'], FILTER_VALIDATE_INT);

    // Realizar a atualização no banco de dados
    try {
        $result = $p->atualizarCategoriaModal($categoriaId, $nome, $desc, $status);
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}

// Coletar dados da solicitação AJAX PRODUTO
if (isset($_POST['produtoId'])) {
    $produtoId = filter_var($_POST['produtoId'], FILTER_SANITIZE_STRING);
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
    $desc = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
    $preco = filter_var($_POST['preco'], FILTER_SANITIZE_STRING);
    $desconto = filter_var($_POST['desconto'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_VALIDATE_INT);
    $estoque = filter_var($_POST['estoque'], FILTER_SANITIZE_STRING);

    $imagensURL = array();

    if (isset($_POST['url_img1']) && !empty($_POST['url_img1'])) {
        $imagensURL[] = filter_var($_POST['url_img1'], FILTER_SANITIZE_URL);
    } else {
        $imagensURL[] = null;
    }

    if (isset($_POST['url_img2']) && !empty($_POST['url_img2'])) {
        $imagensURL[] = filter_var($_POST['url_img2'], FILTER_SANITIZE_URL);
    } else {
        $imagensURL[] = null;
    }

    if (isset($_POST['url_img3']) && !empty($_POST['url_img3'])) {
        $imagensURL[] = filter_var($_POST['url_img3'], FILTER_SANITIZE_URL);
    } else {
        $imagensURL[] = null;
    }

    //Recebe o nome da categoria capturado pela tag SECTION e busca pelo ID correspondente aquele nome
    $categoriaNome = filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);
    $categoria = $p->pegaIdCategoria($categoriaNome);


    // Realizar a atualização no banco de dados
    try {
        $result = $p->atualizarProdutoModal($produtoId, $nome, $desc, $preco, $desconto, $categoria, $estoque, $imagensURL, $status);
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
