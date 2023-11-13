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
    <link rel="icon" href="images\Charlie.png">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            
            if($imagem){
              echo '<img class="imgPerfil rounded-circle object-fit-cover " src="' . $imagem . '" width="60px" height="60px" >';
            }else{
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
                                        echo $u->mostrarDadosAdmin()['ADM_NOME'];
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
                    <form class="d-flex justify-content-between col col-md-4 py-2 px-3" style="background-color: #f0f0f0;">
                        <input class="form-control border border-0 fs-5" type="search" placeholder="Pesquisar" aria-label="Search" style="background-color: #f0f0f0;">
                        <button class="btn" type="submit"><img src="../images\loupeIcon.png" alt="Icone de lupa da barra de pesquisa" style="width:32px;"></button>
                    </form>

                    <div class="col col-xl-3 d-flex justify-content-around align-items-center">
                        <a href="cadastroProdutos.php" class="nav-link text-light">
                            <div class="d-flex align-items-center fs-5 p-2" style="background-color: #88d02c;">
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
                            $result = $p->listarProdutos();

                            if(isset($result)){
                            while ($product_data = $result->fetch()) {

                                $product_data['PRODUTO_ATIVO'] = $product_data['PRODUTO_ATIVO'] == 1 ? 'Ativo' : 'Inativo'; //Trocar os valores 0 e 1 para Ativo ou Não

                                echo '<tr>';
                                echo '<th scope="row">' . $product_data['PRODUTO_ID'] . "</th>";
                                if(isset($product_data['IMAGEM_URL'])){
                                    echo '<td><img src="'.$product_data['IMAGEM_URL'] .'" alt="Imagem do produto" class="rounded-4" style="width: 70px; height: 70px; object-fit: contain;"></td>'; 
                                }else{
                                    echo '<td><img src="../images/noProductImage.jpg" alt="Imagem do produto" class="rounded-4" style="width: 70px;"></td>'; 
                                }
                                echo '<td>' . $product_data['PRODUTO_NOME'] . '</td>';
                                echo '<td>' . $product_data['PRODUTO_PRECO'] . '</td>';
                                echo '<td>' . $product_data['PRODUTO_DESCONTO'] . '</td>';
                                echo '<td>' . $product_data['CATEGORIA_NOME'] .'</td>'; 
                                echo '<td>' .$product_data['PRODUTO_QTD'] . '</td>';
                                echo '<td>' . $product_data['PRODUTO_DESC'] . '</td>';
                                echo '<td>' . $product_data['PRODUTO_ATIVO'] . '</td>';
                                echo '<td>' .
                                    '<a class="text-decoration-none pe-2" href="#">' .
                                    '<img src="../images\pencilIcon.png" alt="Icone de lápis para edição" style="width: 17px;">' .
                                    '</a>' .
                                    '<a class="ms-2" href="#">' .
                                    '<img src="../images\trashCanIcon.png" alt="Icone de lixeira para exclusão" style="width: 17px;">' .
                                    '</a>' .
                                    '</td>';
                                echo '</tr>';
                            }
                        }

                            if ($p->deletarProduto()) {
                                header("location: listarProdutos.php");  
                            }

                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div> <!--Fecha a div do menu lateral-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>