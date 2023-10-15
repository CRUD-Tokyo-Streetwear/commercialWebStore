<?php
session_start();
ob_start(); //Limpa o buffer de saída evitando erro de redirecionamento de página usando "header()"
unset($_SESSION['id'], $_SESSION['user']);
include('conexao.php');
?>

<!DOCTYPE html> <!--PÁGINA PRINCIPAL - TELA DE LOGIN-->
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Charlie StreetWear</title>
  <link rel="icon" href="images\Charlie.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body class="bg-black">

  <?php
  //Recebe a lista enviada pelo formulário
  $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  //Define o comando SQL após confirmar que o usuário enviou o formulário
  if (!empty($data['submit'])) {
    $sql = "SELECT id, admin_user, admin_password
    FROM adm
    WHERE admin_user =:user AND admin_password =:pass
    LIMIT 1";

    //Prepara e executa o comando SQL
    $result_user = $conn->prepare($sql);
    $result_user->bindParam(':user', $data['user'], PDO::PARAM_STR);
    $result_user->bindParam(':pass', $data['pass'], PDO::PARAM_STR);
    $result_user->execute();

    //Verifica se existe uma linha no banco de dados e pega a linha
    if (($result_user) && ($result_user->rowCount() != 0)) {
      $row_user = $result_user->fetch(PDO::FETCH_ASSOC);

      //Faz a verificação de senha
      if (password_verify($data['pass'], $row_user['admin_password'])) {
        $_SESSION['id'] = $row_user['id'];
        $_SESSION['user'] = $row_user['admin_user'];
        header("Location: pagInicio.php");
      } else {
        message("Erro: Usuário ou senha inválidos!", 'danger');
      }
    }
  }
  ?>

  <!--Imagem da Logo Principal-->
  <div class="d-flex justify-content-center mt-5">
    <img src="images\logoCharlieBranco.svg" class="img-fluid object-fit-cover" alt="logo Charlie" width="250px">
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
          <form method="POST"> <!--Início do formulário de Login-->
            <div class="mb-4">
              <input type="text" name="user" placeholder="Usuário" class="form-control" required value="<?php if (isset($data['user'])) {
                                                                                                          echo $data['user'];
                                                                                                        }g ?>">
            </div>
            <div class="mb-4">
              <input type="password" name="pass" placeholder="Senha" class="form-control" value="<?php if (isset($data['password'])) {
                                                                                                        echo $data['password'];
                                                                                                      } ?>">
            </div>
            <div class="text-center">
              <input type="submit" class="btn btn-primary col-6" required value="Entrar" name="submit" style="border-radius: 20px;">
              <a href="cadastro.php" class="nav-link mt-3 text-light">
                Cadastrar-se
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>