<?php

session_start();
unset($_SESSION['ADM_ID']);

require_once '../sistema/usuario.php'; // importando a classe do outro arquivo

$u = new Usuario("Charlie", "144.22.157.228:3306", "Charlie", "Charlie");


if (isset($_POST['submit'])) { // Verifica se o formulário foi submetido
  if (!empty($_POST['email']) && !empty($_POST['password'])) { // Verifica se os campos estão preenchidos

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['password']);

    if ($u->logar($email, $senha)) {
      header("location: pagInicio.php");
    } else {
      echo '<div id="mensagemErro" class="alert alert-danger" role="alert">
            Email ou senha inválidos
            </div>';

      echo '<script>
            setTimeout(function() {
                document.getElementById("mensagemErro").style.display = "none";
            }, 3000);
            </script>';
    }
  } else {
    echo '<div class="alert alert-danger" role="alert">
      Preencha todos os campos!
      </div>';
  }
}

?>

<!DOCTYPE html> <!--PÁGINA PRINCIPAL - TELA DE LOGIN-->
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Charlie StreetWear</title>
  <link rel="icon" href="../images\Charlie.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-black overflow-hidden">

  <!--Imagem da Logo Principal-->
  <div class="d-flex justify-content-center mt-5">
    <img src="../images/logoCharlieBranco.svg" id="easter-egg" class="img-fluid object-fit-cover" alt="logo Charlie" width="210px">
  </div>

  <!--Formulário Login de Admin-->
  <section>
    <div class="container p-5 d-flex justify-content-center col-12 col-sm-7 col-md-3 m-auto text-light" style="height:400px; border-radius:1rem; position:absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #0d0d0d;">
      <div class="row">
        <div class="d-flex justify-content-center">
          <svg class="mx-auto my-3 bi bi-person-circle" xmlns="http://www.w3.org/2000/svg" width="50" fill="currentColor" viewBox="0 0 16 16" style="cursor: pointer; position: absolute;
         top: -48px;">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
          </svg>
        </div>
        <p class="text-light text-center fs-5">Logar no sistema</p>
        <div>
          <form method="POST">
            <div class="mb-4">
              <input type="text" name="email" placeholder="Email" class="form-control" value="<?php
                                                                                              if (isset($_POST['email'])) {
                                                                                                echo $_POST['email'];
                                                                                              } ?>">
            </div>
            <div class="mb-4">
              <input type="password" name="password" placeholder="Senha" class="form-control" value="<?php
                                                                                                      if (isset($_POST['password'])) {
                                                                                                        echo $_POST['password'];
                                                                                                      } ?>">
            </div>
            <div class="text-center">
              <button type="submit" name="submit" class="btn btn-primary col-6" style="border-radius: 20px;">Entrar</button>
              <a href="cadastro.php" class="nav-link mt-3 text-light">
                Cadastrar-se
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <img src="../images/lineuEasterEgg.png" id="lineu" style="width: 13%; position: absolute; right: -240px; bottom: -210px;">


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="../script/script.js"></script>
</body>

</html>