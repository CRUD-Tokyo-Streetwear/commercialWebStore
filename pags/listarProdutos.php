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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="bg-light overflow-y-hidden">

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
                        echo '<svg xmlns="http://www.w3.org/2000/svg" class="" fill="white" viewBox="0 0 16 16" style="cursor: pointer;" width="50">
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

            <!--Orienta na vertical a tela central, barra de pesquisa, add produto-->
            <div class="col flex-wrap d-flex justify-content-start align-items-center flex-column" style="background-color: #d9d9d9;">

                <!--Barra de pesquisa, add produto e exibir em icone grande produtos-->
                <div class="col col-11 mt-5 mb-5 d-flex justify-content-between">

                    <form action="" class="d-flex justify-content-between col col-md-4 py-2 px-3" style="background-color: #f0f0f0;">
                        <input type="text" value="<?php if (isset($_GET['search'])) {
                                                        echo $_GET['search'];
                                                    } ?>" name="search" class="form-control border border-0 fs-5" placeholder="Pesquisar produto" aria-label="Pesquisar" style="background-color: #f0f0f0;">
                        <button type="submit" class="border border-0 ms-1"><img src="../images\loupeIcon.png" alt="Icone de lupa da barra de pesquisa" style="width:32px;"></button>
                    </form>

                    <div class="col col-xl-4 d-flex justify-content-evenly align-items-center">
                        <a href="cadastroProdutos.php" class="nav-link text-light">
                            <div class="fs-5 p-2 rounded-2" style="background-color: #202020; font-weight: 600">
                                Adicionar produto
                            </div>
                        </a>
                        <div>
                            <img src="../images\squaresWindowIcon.png" alt="Janela de quadrados para expandir os produtos" style="width:40px;">
                        </div>
                    </div>
                </div>

                <!--Tela central-->
                <div class="col col-11 bg-light overflow-y-scroll" style="height: 60vh;">
                    <table class="table table-hover text-center">
                        <thead class="align-middle">
                            <tr class="table-secondary">
                                <th class="py-3" scope="col">ID</th>
                                <th class="py-3" scope="col">Foto</th>
                                <th class="py-3" scope="col">Nome</th>
                                <th class="py-3" scope="col">Preço</th>
                                <th class="py-3" scope="col">Desconto</th>
                                <th class="py-3" scope="col">Categoria</th>
                                <th class="py-3" scope="col">Estoque</th>
                                <th class="py-3" scope="col">Descrição</th>
                                <th class="py-3" scope="col">Status do Produto</th>
                                <th class="py-3" scope="col">Editar/Excluir</th>
                            </tr>
                        </thead>

                        <tbody class="align-middle">
                            <?php

                            $result = !isset($_GET['search']) ? $p->listarProdutos() : $p->pesquisarProduto();
                            //Verifica se será listado todos os produtos ou somente os produtos pesquisados

                            if (isset($result)) {
                                $produtos = []; // Array para armazenar os produtos

                                while ($product_data = $result->fetch()) {
                                    // Verifica se o produto já foi adicionado ao array de produtos
                                    if (!isset($produtos[$product_data['PRODUTO_ID']])) {
                                        // Se não, adiciona o produto ao array
                                        $produtos[$product_data['PRODUTO_ID']] = $product_data;
                                    }
                                }

                                // Agora, itera sobre os produtos únicos e exibe na tabela
                                foreach ($produtos as $product_data) {

                                    $product_data['PRODUTO_ATIVO'] = $product_data['PRODUTO_ATIVO'] == 1 ? 'Ativo' : 'Inativo'; // Trocar os valores 0 e 1 para Ativo ou Não

                                    echo '<tr>';
                                    echo '<th scope="row">' . $product_data['PRODUTO_ID'] . "</th>";

                                    if (isset($product_data['IMAGEM_URL']) && !empty($product_data['IMAGEM_URL'])) {

                                        // Imagem do produto que ao clicar abre um carrossel com as demais imagens//
                                        echo '<td>';
                                        echo '<button type="button" class="btn btn-link abrir-modal" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#exampleModal" 
                                        data-id="' . $product_data['PRODUTO_ID'] . '">';
                                        echo '<img src="' . $product_data['IMAGEM_URL'] . '" 
                                        alt="Imagem do produto" class="rounded-4" style="width: 70px; height: 70px; object-fit: contain;">';
                                        echo '</button>';
                                        echo '</td>';
                                    } else {
                                        echo '<td><img src="../images/noProductImage.jpg" alt="Imagem do produto" class="rounded-4" style="width: 70px;"></td>';
                                    }
                                    echo '<td>' . $product_data['PRODUTO_NOME'] . '</td>';
                                    echo '<td>' . 'R$ ' . $product_data['PRODUTO_PRECO'] .',00'. '</td>';
                                    echo '<td>' . $product_data['PRODUTO_DESCONTO'] . '%' . '</td>';
                                    echo '<td>' . $product_data['CATEGORIA_NOME'] . '</td>';
                                    echo '<td>' . $product_data['PRODUTO_QTD'] . '</td>';
                                    echo '<td>' . $product_data['PRODUTO_DESC'] . '</td>';
                                    echo '<td>' . $product_data['PRODUTO_ATIVO'] . '</td>';
                                    echo '<td>';
                                    echo '<div class= "d-flex justify-content-center" >';

                                    //Botao para Atualizar produto
                                    echo '<button type="button" name="edit" value="Edit" id="' . $product_data['PRODUTO_ID'] . '"
                                    class="btn btn-primary open-modal edit_data" data-bs-toggle="modal" data-bs-target="#add_data_Modal" style="border: none; outline: none; background: transparent; padding-top: 2px;">';
                                    echo '<img src="../images\pencilIcon.png" style="width:18px;" >';
                                    echo '</button>';

                                    //Botao para Deletar produto
                                    echo '<form action="" method="POST">';
                                    echo '<input type="hidden" name="delete" value="' . $product_data['PRODUTO_ID'] . '">'; // ícone de lixeira para deletar instâncias
                                    echo '<button type="submit" class="ms-2" name="excluir_produto" style="border: none; outline: none; background: transparent;" >
                                                <img src="../images/trashCanIcon.png" style= "width:18px;" > 
                                            </button>';
                                    echo '</form>';
                                    echo '</div>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            }
                            if (isset($_POST['delete'])) {  //Chama o método de excluir produto se a pessoa clicar no ícone de lixeira

                                $produtoId = $_POST['delete'];

                                if ($p->excluirProduto($produtoId)) {
                                    echo '<script>setTimeout(function(){ window.location.href = "listarProdutos.php"; }, 0010);</script>';
                                    exit;
                                } else {
                                    echo 'Não foi possível excluir o produto.';
                                }
                            }
                            ?>

                            <!-- Modal att produto -->
                            <div class="modal fade" id="add_data_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex align-items-center">
                                            <h1 class="modal-title fs-5 me-1" id="staticBackdropLabel">Editar Produto:</h1>
                                            <b>
                                                <p class="fs-5 p-0 m-0" id="exibirProdutoId"></p>
                                            </b>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="insert_form">

                                                <div class="d-flex justify-content-around text-light">
                                                    <label for="url_img1" class="form-label bg-dark text-center border border-black border-1" style="width: 25px; height: 25px;">1</label>
                                                    <label for="url_img2" class="form-label bg-dark text-center border border-black border-1" style="width: 25px; height: 25px;">2</label>
                                                    <label for="url_img3" class="form-label bg-dark text-center border border-black border-1" style="width: 25px; height: 25px;">3</label>

                                                </div>

                                                <div id="container_imagens_produto">
                                                    <div id="img_produto1"></div>
                                                    <div id="img_produto2"></div>
                                                    <div id="img_produto3"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <div>Imagem URL 1:</div>
                                                    <input type="url" class="form-control mb-2" id="url_img1" name="url_img1">

                                                    <div>Imagem URL 2:</div>
                                                    <input type="url" class="form-control mb-2" id="url_img2" name="url_img2">

                                                    <div>Imagem URL 3:</div>
                                                    <input type="url" class="form-control" id="url_img3" name="url_img3">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nome" class="form-label">Nome:</label>
                                                    <input type="text" class="form-control" id="nome" name="nome">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="desc" class="form-label">Descrição:</label>
                                                    <input type="text" class="form-control" id="desc" name="desc">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="preco" class="form-label">Preço:</label>
                                                    <input type="text" class="form-control" id="preco" name="preco">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="desconto" class="form-label">Desconto:</label>
                                                    <input type="text" class="form-control" id="desconto" name="desconto">
                                                </div>
                                                <div class="mb-3">
                                                    <select name="categoria" id="categoria" class="form-select" aria-label="Default select example">
                                                        <?php
                                                        $result = $p->listarCategorias();

                                                        if (isset($result)) {
                                                            while ($categoria_data = $result->fetch()) {

                                                                if ($categoria_data['CATEGORIA_ATIVO'] == 1) echo '<option> ' . $categoria_data['CATEGORIA_NOME'] . '</option>';
                                                            }
                                                        }
                                                        ?>

                                                    </select>

                                                </div>
                                                <div class="mb-3">
                                                    <label for="estoque" class="form-label">Estoque:</label>
                                                    <input type="text" class="form-control" id="estoque" name="estoque">
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label" for="status">Status</label>
                                                    <input type="checkbox" class="form-check-input" id="status" name="status">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ignorar</button>

                                                    <input type="hidden" name="produtoId" id="produtoId">
                                                    <button type="submit" class="btn btn-primary" id="enviar" value="enviar" name="enviar">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- AJAX -->

                            <!-- Pegar dados do ADM com AJAX -->
                            <script>
                                $(document).ready(function() {
                                    var produtoId;

                                    function enableInput(nextInputId) {
                                        var currentInput = document.getElementById(event.target.id);
                                        var nextInput = document.getElementById(nextInputId);

                                        if (currentInput.value.trim() !== "") {
                                            nextInput.removeAttribute("disabled");
                                        } else {
                                            nextInput.value = "";
                                            nextInput.setAttribute("disabled", "disabled");
                                        }
                                    }

                                    function carregarDadosProduto(produtoId) {
                                        $.ajax({
                                            url: "mostrarDadosModal_ajax.php",
                                            method: "POST",
                                            data: {
                                                produtoId: produtoId
                                            },
                                            dataType: "json",
                                            success: function(data) {
                                                console.log("Dados do produto:", data);

                                                var exibirProdutoId = document.querySelector('#exibirProdutoId');
                                                exibirProdutoId.innerHTML = produtoId;
                                                // Altera as classes do elemento #container_imagens_produto
                                                var containerImagens = $('#container_imagens_produto');
                                                if (data.IMAGENS.length > 0) {
                                                    containerImagens.removeClass('d-flex justify-content-center').addClass('d-flex justify-content-between');

                                                    // Limpar o conteúdo existente
                                                    containerImagens.empty();

                                                    // Criar elementos de imagem para cada URL no array
                                                    for (var i = 0; i < data.IMAGENS.length; i++) {
                                                        var imagemUrl = data.IMAGENS[i] || 'https://anest-iwata.com.br/wp-content/uploads/2016/10/Sem-imagem.png';
                                                        var imagemElement = $('<img>').attr('src', imagemUrl);
                                                        imagemElement.addClass('object-fit-contain mb-3');
                                                        imagemElement.attr('width', 250);
                                                        imagemElement.attr('height', 150);

                                                        // Adicionar a imagem à div com id 'img_produto'+(i+1)
                                                        var divId = 'img_produto' + (i + 1);
                                                        var divElement = $('<div>').attr('id', divId).append(imagemElement);
                                                        containerImagens.append(divElement);
                                                    }
                                                } else {
                                                    containerImagens.removeClass('d-flex justify-content-between').addClass('d-flex justify-content-center');
                                                }

                                                // Preencher os campos do modal com os dados recebidos
                                                $('#url_img1').val(data.IMAGENS[0]);
                                                $('#url_img2').val(data.IMAGENS[1]);
                                                $('#url_img3').val(data.IMAGENS[2]);
                                                $('#nome').val(data.PRODUTO_NOME);
                                                $('#preco').val(data.PRODUTO_PRECO);
                                                $('#desconto').val(data.PRODUTO_DESCONTO);
                                                $('#desc').val(data.PRODUTO_DESC);
                                                $('#categoria').val(data.CATEGORIA_NOME);
                                                $('#estoque').val(data.PRODUTO_QTD);
                                                $('#status').prop('checked', data.PRODUTO_ATIVO == 1);
                                                $('#produtoId').val(data.PRODUTO_ID);
                                                $('#enviar').val("Update");

                                                // Exibir o modal
                                                $('#add_data_Modal').modal('show');
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                                console.error("Erro na solicitação Ajax:", textStatus, errorThrown);
                                            }
                                        });
                                    }

                                    $(document).on('click', '.edit_data', function() {
                                        produtoId = $(this).attr("id");
                                        console.log("Produto ID:", produtoId);
                                        carregarDadosProduto(produtoId);
                                    });


                                    // ATUALIZAR DADOS COM AJAX //
                                    $('#insert_form').submit(function(e) {
                                        e.preventDefault(); // Evitar que o formulário seja enviado normalmente

                                        // Coletar os dados do formulário
                                        var url_img1 = $('#url_img1').val();
                                        var url_img2 = $('#url_img2').val();
                                        var url_img3 = $('#url_img3').val();
                                        var nome = $('#nome').val();
                                        var preco = $('#preco').val();
                                        var desconto = $('#desconto').val();
                                        var desc = $('#desc').val();
                                        var categoria = $('#categoria').val();
                                        var estoque = $('#estoque').val();
                                        var status = $('#status').prop('checked') ? 1 : 0; // 1 se estiver marcado, 0 se não estiver

                                        // Executar a solicitação AJAX para atualizar os dados
                                        $.ajax({
                                            url: "atualizar_modal_ajax.php",
                                            method: "POST",
                                            data: {
                                                produtoId: produtoId, // Usando o valor já coletado
                                                url_img1: url_img1,
                                                url_img2: url_img2,
                                                url_img3: url_img3,
                                                nome: nome,
                                                preco: preco,
                                                desconto: desconto,
                                                desc: desc,
                                                categoria: categoria,
                                                estoque: estoque,
                                                status: status,
                                            },
                                            dataType: "json",
                                            success: function(data) {
                                                console.log("Dados atualizados com sucesso:", data);
                                                // Fechar o modal após a atualização
                                                $('#add_data_Modal').modal('hide');
                                                location.reload();
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                                $('#add_data_Modal').modal('hide');
                                                console.error("Erro na solicitação Ajax:", textStatus, errorThrown);
                                                console.log("Resposta do servidor:", jqXHR.responseText);
                                            }
                                        });
                                    });
                                });
                            </script>

                        </tbody>


                        <!-- Modal Ao apertar na imagem-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalhes do Produto</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="modal-content">


                                    </div>

                                </div>
                            </div>
                        </div>

                    </table>


                </div>

            </div>
        </div> <!--Fecha a div do menu lateral-->


        <!-- AJAX PARA EXIBIR AS FOTOS DO PRODUTO ESCOLHIDO -->
        <script>
            $(document).ready(function() {
                $('.abrir-modal').on('click', function() {
                    var produtoId = $(this).data('id');
                    console.log(produtoId)

                    // Fazer a solicitação AJAX para obter as imagens do produto
                    $.ajax({
                        url: 'obter_imagens_ajax.php',
                        type: 'GET',
                        data: {
                            produtoId: produtoId
                        },
                        dataType: 'json',
                        success: function(response) {
                            exibirImagensNoModal(response);
                        },
                        error: function(error) {
                            console.error('Erro na solicitação AJAX:', error);
                        }
                    });
                });

                function exibirImagensNoModal(imagens) {
                    // Limpar o conteúdo existente do modal
                    $('#modal-content').empty();

                    // Adicionar cada imagem ao modal com as classes para centralização
                    imagens.forEach(function(imagemUrl) {
                        var imagemElement = $('<img src="' + imagemUrl + '" class="img-fluid img-thumbnail imagem-aparencia" alt="Imagem do Produto">');
                        var contenedorElement = $('<div class="imagem-flex"></div>').append(imagemElement);

                        $('#modal-content').append(contenedorElement);
                    });

                    // Abrir o modal
                    $('#exampleModal').modal('show');
                }
            });
        </script>

        <style>
            .imagem-flex {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .imagem-aparencia {
                width: 60%;
                margin-top: 20px;
                background-color: #1e1e1e;
            }
        </style>





        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>