<?php
require_once('../sistema/usuario.php');
require_once('../sistema/produto.php');

$p = new Produto("charlie", "localhost", "root", "");
$u = new Usuario("charlie", "localhost", "root", "");


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
    $desc = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
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

    $imagensURL = [];

    for ($i = 1; $i <= 3; $i++) {
        $inputName = "url_img{$i}";

        if (isset($_POST[$inputName]) && !empty($_POST[$inputName])) {
            $imagensURL[] = filter_var($_POST[$inputName], FILTER_SANITIZE_URL);
        } else {
            $imagensURL[] = null;
        }
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
