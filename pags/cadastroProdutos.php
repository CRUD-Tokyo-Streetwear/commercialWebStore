<?php
session_start();

if (!isset($_SESSION['ADM_ID'])) {
    header("location: index.php");
    exit;
}

require_once('../sistema/usuario.php');
require_once('../sistema/produto.php');
$u = new Usuario("charlie", "localhost", "root", "");
$p = new Produto("charlie", "localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charlie StreetWear</title>
    <link rel="icon" href="../images\Charlie.png">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

    <!--Barra de navegação-->
    <nav class="navbar" style="background-color: black;">
        <div class="container-fluid text-light">
            <a href="pagInicio.php" class="navbar-brand ">
                <img src="../images\logoCharlieBranco.svg" alt="logo Charlie" class="p-2" width="180">
            </a>
            <div class="d-flex justify-content-end me-5">
                <div class="d-flex">
                    <?php
                    $admId = $_SESSION["ADM_ID"];
                    $imagem = $u->mostrarImagemAdmin($admId);
                    $imagemPadrao = 'images/userIcon.png';

                    if ($imagem) {
                        echo '<img class="imgPerfil rounded-circle object-fit-cover " src="' . $imagem . '" width="60px" height="60px" >';
                    } else {
                        echo '<svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 16 16" style="cursor: pointer;" width="50">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg>';
                    }
                    ?>
                    <div class="ms-3 d-flex flex-column justify-content-center align-items-center">
                        <div class="d-flex flex-row align-items-center">
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <p class="m-0 pe-1">
                                    <?php
                                        $admId = $_SESSION['ADM_ID'];
                                        echo $u->mostrarDadosAdmin($admId)['ADM_NOME'];
                                        ?>
                                    </p>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                    <li><a class="dropdown-item" href="perfil.php">Configuração</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" name="sair" href="../sistema/sair.php">Sair</a></li>
                                </ul>
                            </div>
                        </div>
                        <p class="m-0 pe-2">Administrador</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!--Menu lateral-->
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 min-vh-100 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white">
                    <span class="fs-5 pb-3 mb-md-0 d-none d-sm-inline">
                        Menu
                    </span>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start fs-5" id="menu">
                        <li class="nav-item">
                            <a href="pagInicio.php" class="d-flex align-items-center nav-link px-0 text-light">
                                <img src="../images\homeIcon.png" alt="Icone de Início" style="width: 20px;"><span class="ms-2 d-none d-sm-inline">Início</span>
                            </a>
                        </li>
                        <li>
                            <a href="perfil.php" class="d-flex align-items-center nav-link px-0 text-light">
                                <img src="../images\userIcon.png" alt="Icone de Administradores" style="width: 19px;"><span class="ms-2 d-none d-sm-inline">Perfil</span>
                            </a>
                        </li>
                        <li>
                            <a href="listarAdmins.php" class="d-flex align-items-center nav-link px-0 text-light">
                                <img src="../images\groupUserIcon.png" alt="Icone de Administradores" style="width: 27px;"><span class="ms-2 d-none d-sm-inline">Administradores</span>
                            </a>
                        </li>
                        <li>
                            <a href="listarProdutos.php" class="d-flex align-items-center nav-link px-0 text-light">
                                <img src="../images\shirtIcon.png" alt="Icone de Administradores" style="width: 27px;"><span class="ms-2 d-none d-sm-inline">Listar Produtos</span>
                            </a>
                        </li>
                        <li>
                            <a href="cadastroProdutos.php" class="d-flex align-items-center nav-link px-0 text-light">
                                <img src="../images\addIcon.png" alt="Icone de Administradores" style="width: 25px;filter:invert(1);"><span class="ms-2 d-none d-sm-inline">Cadastrar Produtos</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--Tela central-->
            <div class="container justify-content-center align-items-center mt-5" style="height: 100%; max-width: 40vw;">
                <div class="text-end mb-5 text-light">
                    <button type="button" class="btn" style="background-color:#88d02c; font-weight: 600" data-bs-toggle="modal" data-bs-target="#exampleModal">adicionar categoria</button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar nova categoria</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="novaCategoria" method="POST">
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" name="nome_categoria">
                                    </div>
                                    <div class="mb-3">
                                        <label for="descricao" class="form-label">Descrição</label>
                                        <textarea class="form-control" id="descricao" name="descricao_categoria" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <input type="checkbox" class="form-check-input" id="produto_Ativo" name="produto_ativo_categoria" checked>
                                        <label class="form-check-label ms-2" for="produto_Ativo">Categoria ativo</label>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary" name="salvar_categoria">Salvar</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>

                <?php

                    if(isset($_POST['salvar_categoria'])){
                        $nome_categoria = $_POST['nome_categoria'];
                        $descricao_categoria = $_POST ['descricao_categoria'];
                        $produto_ativo_categoria = $_POST ['produto_ativo_categoria'];

                        if ($p-> adicionarCategoria($nome_categoria, $descricao_categoria, $produto_ativo_categoria)){
                            echo '<script>setTimeout(function(){ window.location.href = "cadastroProdutos.php"; }, 0010);</script>';
                        }
                    } 
                ?>
                <div class="container d-flex flex-column align-items-start justify-content-center border rounded-4 mt-5" style="background-color:#f0f0f0">

                    <!--Cadastro Produto-->
                    <div class="d-flex justify-content-between ms-2 me-2 mt-3 mb-3">
                        <form id="produtoForm" method="POST" class="row g-3">

                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome">
                            </div>
                            <div class="col-md-6">
                                <label for="preco" class="form-label">Preço</label>
                                <input type="text" class="form-control" name="preco" required>
                            </div>
                            <div class="col-md-6">
                                <label for="precoDesconto" class="form-label">Desconto</label>
                                <input type="text" class="form-control" id="precoDesconto" name="preco_desconto">
                            </div>
                            <div class="col-md-6">
                                <label for="Estoque" class="form-label">Estoque</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="estoque" name="produtoQtd">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5"><!--div da categoria-->
                                <select name="categoria" class="form-select" aria-label="Default select example">

                                    <option>Categoria</option>

                                    <?php
                                    $result = $p->listarCategorias();
                                    while ($categoria_data = $result->fetch()) {
                                        echo '<option> ' . $categoria_data['CATEGORIA_NOME'] . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>


                                  <!--   BOTAO PARA ADICIONAR AS IMAGENS -->
                            <div class="col-md-6">
                                
                                <!-- Campo de url -->
                                <div id="containerImagens" class="col-md-6">
                                <label for="botaoAdicionarImagem" class="form-label">Imagem URL</label>
                                <input type="text" class="form-control imagem-url"  name="imagem_url[]">
                                </div>

                                <br>
                                <!-- Botao de adicionar mais campos -->
                                <button type="button" class="btn btn-secondary" id="botaoAdicionarImagem" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Adicionar mais imagens</button>

                               </div>

                            <div class="col-md-6">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                            </div>
                            <div class="d-flex mb-4 ms-3 mt-5 form-check">
                                <input type="checkbox" class="form-check-input" id="produto_Ativo" name="produto_ativo" checked>
                                <label class="form-check-label ms-2" for="produto_Ativo">Produto Ativo</label>
                            </div>

                            <!-- salvar alterações -->
                            <div class="col-md-6 ms-2">
                                <button type="submit" class="btn btn-dark" name="botao">Cadastrar</button>
                            </div>


                            <?php
                            if (isset($_POST['botao'])) {
                                //Cadastra na tabela de produto
                                $nome = $_POST['nome'];
                                $preco = floatval($_POST['preco']);
                                $precoDesconto = floatval($_POST['preco_desconto']);
                                $descricao = $_POST['descricao'];
                                $categoria = $p->pegaIdCategoria();
                                $produtoAtivo = $_POST['produto_ativo'];

                                //Cadastra na tabela de imagem_produto
                                if ($p->cadastrarProduto($nome, $descricao, $preco, $precoDesconto, $categoria, $produtoAtivo) && isset($categoria)) {
                                    $produtoId = $p->pegaIdProduto($nome, $descricao);
                                    $p->cadastrarEstoque($produtoId);
                                    $p->cadastrarImagens($produtoId);
                                    echo "Produto cadastrado com sucesso!";
                                } else {
                                    echo "Falha ao cadastrar produto... Verifique se todos os campos foram preenchidos";
                                }
                            }
                            ?>

                        </form>
                    </div><!--Fecha a div do formulário-->
                </div><!--Fecha a segunda div da tela central-->
            </div><!--Fecha tela central-->
        </div><!--Fecha a segunda div do menu lateral-->
    </div><!--Fecha a div do menu lateral-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../script/adicionarImagens.js"></script>
</body>

</html>