<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Administrador</title>
  <link rel="icon" href="images\Charlie.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-black">

  <!--Imagem da Logo Principal-->
  <div class="d-flex justify-content-center mt-5">
    <img src="images\logoCharlie.png" class="img-fluid object-fit-cover" alt="logo Charlie" width="210px">
  </div>

  <!--Formulário Cadastro de Admin-->
  <section>
    <div class="container p-5 d-flex justify-content-center col-12 col-sm-7 col-md-3 m-auto text-light"
      style="height:500px; border-radius:1rem; position:absolute; top: 50%; left: 50%; transform: translate(-50%, -44%); background-color: #0d0d0d;">
      <div class="row">
        <div class="d-flex justify-content-center">
          <svg class="mx-auto my-3 bi bi-person-circle" xmlns="http://www.w3.org/2000/svg" width="50"
            fill="currentColor" viewBox="0 0 16 16" style="cursor: pointer; position: absolute;
         top: -48px;">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd"
              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
          </svg>
        </div>
        <div>
          <p class="text-center fs-5">Cadastrar Administrador</p>
        </div>
        <div>
          <form action="envioCadastro.php" method="POST">
            <div class="mb-4">
              <label class="form-label" for="name">Nome</label>
              <input type="text" name="name" placeholder="Usuário" class="form-control" required>
            </div>
            <div class="mb-4">
              <label class="form-label" for="email">Email</label>
              <input type="email" name="email" placeholder="E-mail" class="form-control" required>
            </div>
            <div class="mb-4">
              <label class="form-label" for="passowrd">Senha</label>
              <input type="password" name="password" placeholder="Senha" class="form-control" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary col-6" style="border-radius: 20px;">
                Cadastrar
              </button>
              <a href="index.php" class="nav-link mt-3 text-light">
                Login
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>