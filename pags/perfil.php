<?php
session_start();

if (!isset($_SESSION['ADM_ID'])) {
  header("location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Charlie StreetWear</title>
  <link rel="icon" href="../images\Charlie.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">

</head>

<body class="overflow-y-hidden" style="background-color:#e5e3e3;">

  <?php
  require_once('../sistema/usuario.php');
  $u = new Usuario("Charlie", "144.22.157.228:3306", "Charlie", "Charlie");

  //adicionar imagem de adm
  if (isset($_POST['submit']) && (isset($_FILES['upload']))) {
    $upload = $_FILES['upload'];
    $admId = $_SESSION['ADM_ID'];

    if ($upload['error'] > 0) {
      echo "falha ao enviar imagem";
    }

    if ($upload['size'] > 5242880) {
      echo '<div class="fs-5 alert alert-danger" style="position: absolute; top: 20%; left: 58%; transform: translate(-50%, -50%);">
      Não foi possivel carregar a imagem pois o arquivo é muito grande!! MAX 5MB
    </div>';
    } else {
      $u->atualizarImagem($upload, $admId);
      echo '<script>setTimeout(function(){ window.location.href = "perfil.php"; }, 0010);</script>';
    }
  }

  ?>

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

      <!--Tela central-->
    <div class=" d-flex align-items-center col col-10 mt-4" style="height: 90vh;">
      <div class="container d-flex flex-column align-items-center justify-content-center border rounded-4 mb-5" style="background:#f0f0f0; height: 80%;">

        <div class="imagem-perfil-container">
          <?php
          $admId = $_SESSION["ADM_ID"];
          $imagemDefault = "images/userIcon.png";
          $imagem = $u->mostrarImagemAdmin($admId);

          if ($imagem) {
            echo '<img id="profile-picture" class="imgPerfil rounded-circle object-fit-cover mb-3"
            src="' . $imagem . '" width="250px" height="250px">';
            echo '<span class="remove-image-text">Remover imagem</span>';
          } else {
            echo '<svg xmlns="http://www.w3.org/2000/svg" fill="dark" viewBox="0 0 16 16" class="mb-3" style="cursor: pointer;" width="250px">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>';
          }
          ?>
        </div>

        <style>
          .imagem-perfil-container {
            position: relative;
            display: inline-block;
          }

          #profile-picture:hover {
            height: 220px;
            width: 220px;
            transition: ease-in-out 0.1s;
            opacity: 0.7;
          }

          #profile-picture {
            transition: ease-in-out 0.1s;
          }

          .remove-image-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            padding: 0px 1em;
            border-radius: 5px;
            display: none;
          }

          .imagem-perfil-container:hover .remove-image-text {
            display: block;
            color: white;
            text-wrap: nowrap;
            pointer-events: none;
          }
        </style>

        <script>
          document.getElementById('profile-picture').addEventListener('click', function() {
            removerImagem();
          });

          function removerImagem() {
            // Confirmação usando confirm
            if (confirm("Tem certeza de que deseja remover a imagem do perfil?")) {
              // Executar a solicitação AJAX para remover a imagem
              $.ajax({
                url: "remover_imagem_ajax.php",
                method: "POST",
                dataType: "json",
                success: function(data) {
                  if (data.success) {
                    console.log("Imagem removida com sucesso");
                    location.reload(); // Recarregue a página como exemplo
                  } else {
                    console.error("Erro ao remover imagem:", data.error);
                    location.reload(); // Recarregue a página como exemplo
                  }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  console.error("Erro na solicitação Ajax:", textStatus, errorThrown);
                  console.log("Resposta do servidor:", jqXHR.responseText);
                }
              });
            }
          }
        </script>

        <!-- formulario de imagem -->
        <div class="row mb-3">
          <form action="perfil.php" enctype="multipart/form-data" method="POST">
            <input type="file" class="form-control" name="upload" id="inputGroupFile04">
            <input class="btn btn-dark" type="submit" name="submit" value="Salvar" style="width: 380px;">
          </form>
        </div>

        <!-- formulario dados perfil -->
        <form action="" method="POST">

          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
              <input required type="text" name="nome" class="form-control" id="inputEmail3" style="width: 500px;" value="<?php
                                                                                                                          $admId = $_SESSION['ADM_ID'];
                                                                                                                          echo $u->mostrarDadosAdmin($admId)['ADM_NOME'];
                                                                                                                          ?> ">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input required type="email" name="email" class="form-control" id="inputEmail3" style="width: 500px;" value="<?php
                                                                                                                            $admId = $_SESSION['ADM_ID'];
                                                                                                                            echo $u->mostrarDadosAdmin($admId)['ADM_EMAIL'];
                                                                                                                            ?>">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input required type="password" name="senha" class="form-control" id="inputPassword3" style="width: 500px;">
            </div>
          </div>

          <input type="submit" name="enviarDados" class="btn btn-dark" style="width: 100px;">

        </form>
      </div>
    </div>


    <?php

    if (isset($_POST['enviarDados'])) {

      $admId = $_SESSION['ADM_ID'];
      $novoNome = $_POST['nome'];
      $novoEmail = $_POST['email'];
      $novaSenha = $_POST['senha'];

      if ($u->atualizarDadosAdmin($admId, $novoNome, $novoEmail, $novaSenha)) {
        echo '<script>setTimeout(function(){ window.location.href = "perfil.php"; }, 0010);</script>';
      } else {
        echo '<div class="alert alert-danger" role="alert">
        Não foi possível atualizar pois este e-mail já está em uso
        </div>';
      }
    }
    ?>

    </div>
  </div> <!--Fecha a div do menu lateral-->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="../script/script.js"></script>
</body>

</html>