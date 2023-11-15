# commercialWebStore

Tafinha:

FRONT E BACK

-> LISTA DE PRODUTOS

-> CADASTRO DE PRODUTOS

------------------------------

Ricardo:

FRONT

-> TELA DE PERFIL

-> LOGIN ADMIN

-> CADASTRO ADMIN

-> PAG PRINCIPAL

BACK

-> LOGIN ADMIN

------------------------------

LUCAS:

FRONT

-> LISTA DE ADMINS

-> CADASTAR ADMIN

BACK

-> LOGIN ADMIN

-> CADASTRO ADMIN






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
                                <img src="images\homeIcon.png" alt="Icone de Início" style="width: 20px;"><span class="ms-2 d-none d-sm-inline">Início</span>
                            </a>
                        </li>
                        <li>
                            <a href="perfil.php" class="d-flex align-items-center nav-link px-0 text-light">
                                <img src="images\userIcon.png" alt="Icone de Administradores" style="width: 19px;"><span class="ms-2 d-none d-sm-inline">Perfil</span>
                            </a>
                        </li>
                        <li>
                            <a href="listarAdmins.php" class="d-flex align-items-center nav-link px-0 text-light">
                                <img src="images\groupUserIcon.png" alt="Icone de Administradores" style="width: 27px;"><span class="ms-2 d-none d-sm-inline">Administradores</span>
                            </a>
                        </li>
                        <li>
                            <a href="listarProdutos.php" class="d-flex align-items-center nav-link px-0 text-light">
                                <img src="images\shirtIcon.png" alt="Icone de Administradores" style="width: 27px;"><span class="ms-2 d-none d-sm-inline">Listar Produtos</span>
                            </a>
                        </li>
                        <li>
                            <a href="cadastroProdutos.php" class="d-flex align-items-center nav-link px-0 text-light">
                                <img src="images\addIcon.png" alt="Icone de Administradores" style="width: 25px;filter:invert(1);"><span class="ms-2 d-none d-sm-inline">Cadastrar Produtos</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--Tela central-->

            <div class="container justify-content-center align-items-center mt-5" style="height: 100%; max-width: 40vw;">
                <div class="text-end mb-5" >
                    <button type="button" class="btn" style="background-color:#88d02c">adicionar categoria</button>
                </div>
                <div class="container d-flex flex-column align-items-start justify-content-center border rounded-4 mt-5">


                    <!--Cadastro Produto-->
                    <div class="d-flex justify-content-between ms-2 me-2 mt-3 mb-3">
                        <form id="produtoForm" method="POST " class="row g-3">
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
                                <input type="text" class="form-control" name="Estoque">
                            </div>

                            <div class="col-md-6 mt-5"> <!--Div da categoria-->
                                <select class="form-select" aria-label="Default select example">

                                    <option selected>Categoria</option>

                                    <?php
                                    $result = $p->listarCategorias();
                                    while ($categoria_data = $result->fetch()) {
                                        echo '<option> ' . $categoria_data['CATEGORIA_NOME'] . '</option>';
                                    }
                                    ?>

                                </select>

                            </div><!--fecha a segunda div categoria-->
                            <div class="col-md-6">
                                <label for="precoDesconto" class="form-label">Imagem URL</label>
                                <input type="text" class="form-control" id="imagemUrl" name="imagem_url">
                                <button type="submit" class="btn btn-secondary" name="botaoImagem" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Adicionar mais imagens</button>
                            </div>
                            <div class="col-md-6">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                            </div>
                            <div class="d-flex mb-5 ms-3 mt-5 form-check">
                                <input type="checkbox" class="form-check-input" value="0" id="produtoAtivo" name="produto_ativo" checked>
                                <label class="form-check-label ms-2" for="produtoAtivo">Produto Ativo</label>
                            </div>
                            <div class="col-md-6 ms-2">
                                <button type="submit" class="btn btn-dark" name="botao">Cadastrar</button>
                            </div>


                            <?php

                            if (isset($_POST['botao'])) {

                                $nome = $_POST['nome'];
                                $preco = floatval($_POST['preco']);
                                $precoDesconto = floatval($_POST['preco_desconto']);
                                $descricao = $_POST['descricao'];
                                $produtoAtivo = $_POST['produto_ativo'];
                                $urlImagem = $_POST['imagem_url'];

                                if ($p->cadastrarProduto($nome, $descricao, $preco, $precoDesconto, $produtoAtivo)) {
                                    echo "Produto cadastrado com sucesso!";
                                } else {
                                    echo "Produto já cadastrado!";
                                }
                            }


                            //cadastro categoria


                            if (isset($_POST['botao'])) {
                            }
                            ?>

                        </form>

                    </div><!--fecha a segunda div do formulario-->
                </div><!--fecha a segunda div da tela central-->
            </div><!--fecha a primeira div da tela central-->