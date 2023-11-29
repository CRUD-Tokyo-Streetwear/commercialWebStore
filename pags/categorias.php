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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">

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

            <!--Orienta na vertical a tela central, barra de pesquisa, add produto-->
            <div class="col flex-wrap d-flex justify-content-start align-items-center flex-column" style="background-color: #d9d9d9;">

                <!--Barra de pesquisa, add produto e exibir em icone grande produtos-->
                <div class="col col-11 mt-5 mb-5 d-flex justify-content-between">
                    <form action="" class="d-flex justify-content-between col col-md-4 py-2 px-3" style="background-color: #f0f0f0;">
                        <input type="text" value="<?php if (isset($_GET['search'])) {
                                                        echo $_GET['search'];
                                                    } ?>" name="search" class="form-control border border-0 fs-5" placeholder="Pesquisar categoria" aria-label="Pesquisar" style="background-color: #f0f0f0;">
                        <button type="submit" class="border border-0 ms-1"><img src="../images\loupeIcon.png" alt="Icone de lupa da barra de pesquisa" style="width:32px;"></button>
                    </form>


                    <div class="col col-xl-5 d-flex justify-content-around align-items-center">


                        <a href="cadastroProdutos.php" class="nav-link text-light">
                            <div class="fs-5 p-2 rounded-2" style="background-color: #202020; font-weight: 600; white-space: nowrap;">
                                Cadastrar produto
                            </div>
                        </a>

                        <!--Botão para add nova categoria-->
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="fs-5 p-2 text-light rounded-2" style="background-color: #202020; font-weight: 600;white-space: nowrap;">
                                adicionar categoria
                            </div>
                        </button>

                        <!--Quadrado para redimensionar os produtos-->
                        <div>
                            <img src="../images\squaresWindowIcon.png" alt="Janela de quadrados para expandir os produtos" style="width:40px;">
                        </div>

                    </div>
                </div>

                <!-- Modal Adicionar Categoria-->
                <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar nova categoria</h1>
                            </div>
                            <div class="modal-body">
                                <form id="novaCategoria" method="POST">
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" name="nome_categoria" required>
                                    </div>
                                    <div class="mt-2">
                                        <label for="descricao" class="form-label">Descrição</label>
                                        <textarea class="form-control" id="descricao" name="descricao_categoria" rows="3" required></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <input type="checkbox" class="form-check-input bg-danger border-0" id="produto_Ativo" name="produto_ativo_categoria" checked>
                                        <label class="form-check-label ms-2" for="produto_Ativo">Categoria ativo</label>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-dark" name="salvar_categoria">Salvar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                //Código para cadastrar categoria
                if (isset($_POST['salvar_categoria'])) {
                    $nome_categoria = $_POST['nome_categoria'];
                    $descricao_categoria = $_POST['descricao_categoria'];
                    $produto_ativo_categoria = isset($_POST['produto_ativo_categoria']) ? 1 : 0;

                    if ($p->adicionarCategoria($nome_categoria, $descricao_categoria, $produto_ativo_categoria)) {
                        echo '<script>setTimeout(function(){ window.location.href = "categorias.php"; }, 1500);</script>';
                        echo '<div class="alert alert-success" role="alert">Categoria cadastrada com sucesso!</div>';
                    }
                }
                ?>

                <!--Tela central-->
                <div class="col col-11 bg-light overflow-y-scroll" style="height: 60vh;">

                    <table class="table table-hover text-center">

                        <thead class="align-middle">
                            <tr class="table-secondary">
                                <th class="py-3" scope="col">ID</th>
                                <th class="py-3" scope="col">Categoria</th>
                                <th class="py-3" scope="col">Descrição</th>
                                <th class="py-3" scope="col">Ativo/Inativo</th>
                                <th class="py-3" scope="col">Operação</th>
                            </tr>
                        </thead>

                        <tbody class="align-middle">
                            <?php

                            $categorias = !isset($_GET['search']) ? $p->listarCategorias() : $p->pesquisarCategoria();

                            if (isset($categorias)) {
                                while ($categoria_data = $categorias->fetch()) {

                                    $categoria_data['CATEGORIA_ATIVO'] = $categoria_data['CATEGORIA_ATIVO'] == 1 ? 'Ativo' : 'Inativo'; // Trocar os valores 0 e 1 para Ativo ou Não


                                    echo '<tr>';
                                    echo  '<th>' . $categoria_data['CATEGORIA_ID'] . '</th>';
                                    echo    '<td>' . $categoria_data['CATEGORIA_NOME'] . '</td>';
                                    echo    '<td>' . $categoria_data['CATEGORIA_DESC'] . '</td>';
                                    echo '<td>' . $categoria_data['CATEGORIA_ATIVO'] . '</td>';
                                    echo    '<td>';
                                    echo '<div class= "d-flex justify-content-center" >';

                                    //Botão para editar categoria
                                    echo '<button type="button" name="edit" value="Edit" id="' . $categoria_data['CATEGORIA_ID'] . '"
                                    class="btn btn-primary open-modal edit_data" data-bs-toggle="modal" data-bs-target="#add_data_Modal" style="border: none; outline: none; background: transparent; padding-top: 2px;">';
                                    echo '<img src="../images\pencilIcon.png" style="width:18px;" >';
                                    echo '</button>';

                                    //Botão para deletar categoria
                                    echo '<form action="" method="POST">';
                                    echo '<input type="hidden" name="deleteCategoria" value="' . $categoria_data['CATEGORIA_ID'] . '">'; // ícone de lixeira para deletar instâncias
                                    echo '<button type="submit" class="ms-2" name="excluir_produto" style="border: none; outline: none; background: transparent;" >
                                                <img src="../images/trashCanIcon.png" style= "width:18px;" > 
                                            </button>';
                                    echo '</form>';

                                    echo '</div>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            }


                            if (isset($_POST['deleteCategoria'])) {  //Chama o método de excluir categoria

                                $categoriaId = $_POST['deleteCategoria'];

                                if ($p->excluirCategoria($categoriaId)) {
                                    echo '<script>setTimeout(function(){ window.location.href = "categorias.php"; }, 0010);</script>';
                                    exit;
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">Não foi possível cadastrar a categoria!</div>';
                                }
                            }

                            ?>

                            <!-- modal -->
                            <div class="modal fade" id="add_data_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Categoria</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="insert_form">
                                                <div class="mb-3">
                                                    <label for="nome" class="form-label">Nome:</label>
                                                    <input type="text" class="form-control" id="nome" name="nome">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="desc" class="form-label">Descrição:</label>
                                                    <input type="text" class="form-control" id="desc" name="desc" value="<?php  ?>">
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label" for="status">Status</label>
                                                    <input type="checkbox" class="form-check-input bg-danger border-0" id="status" name="status">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fechar</button>

                                                    <input type="hidden" name="categoriaId" id="categoriaId">
                                                    <button type="submit" class="btn btn-dark" id="enviar" value="enviar" name="enviar">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- AJAX -->

                            <!-- Pegar dados do ADM com AJAX -->
                            <script>
                                $(document).ready(function() { // isso diz que só sera executado o ajax apos a pagina estar totalmente carregada

                                    var categoriaId;

                                    function carregarDadosCategoria(categoriaId) {
                                        $.ajax({
                                            url: "mostrarDadosModal_ajax.php", // Substitua pela URL correta do seu servidor
                                            method: "POST",
                                            data: {
                                                categoriaId: categoriaId
                                            },
                                            dataType: "json",
                                            success: function(data) {
                                                console.log("Dados da categoria:", data);

                                                // Preencher os campos do modal com os dados recebidos
                                                $('#nome').val(data.CATEGORIA_NOME);
                                                $('#desc').val(data.CATEGORIA_DESC);
                                                $('#status').prop('checked', data.CATEGORIA_ATIVO == 1);
                                                $('#categoriaId').val(data.CATEGORIA_ID);
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
                                        // ao clicar no botao com classe .edit_data é coletado o id
                                        categoriaId = $(this).attr("id"); // id do adm guardado nessa variável

                                        console.log("Categoria ID:", categoriaId);
                                        carregarDadosCategoria(categoriaId);
                                    });


                                    // ATUALIZAR DADOS COM AJAX //
                                    $('#insert_form').submit(function(e) {
                                        e.preventDefault(); // Evitar que o formulário seja enviado normalmente

                                        // Coletar os dados do formulário
                                        var nome = $('#nome').val();
                                        var desc = $('#desc').val();
                                        var status = $('#status').prop('checked') ? 1 : 0; // 1 se estiver marcado, 0 se não estiver

                                        // Executar a solicitação AJAX para atualizar os dados
                                        $.ajax({
                                            url: "atualizar_modal_ajax.php",
                                            method: "POST",
                                            data: {
                                                categoriaId: categoriaId, // Usando o valor já coletado
                                                nome: nome,
                                                desc: desc,
                                                status: status
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
                    </table>
                </div><!--Fecha a tela central-->


            </div> <!--Orienta a barra de pesquisa, o botão de categoria e a tabela-->
        </div> <!--Fecha a div do menu lateral-->


        <script src="script\script.js"></script>
        </script>
</body>

</html>