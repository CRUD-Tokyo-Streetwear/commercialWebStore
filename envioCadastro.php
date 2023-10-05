<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Administrador</title>
    <link rel="icon" href="images\Charlie.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-black">

    <!--Envio de informações com sql pro BD-->
    <div class="container mt-5">
        <div class="row">
            <?php
            include "conexao.php";

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "INSERT INTO `admin` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";

            if (mysqli_query($connection, $sql)) {
                message("$name cadastrado com sucesso", "success");
            } else {
                message("Erro ao cadastrar administrador!", "danger");
            }
            ?>
        </div>
        <div class="container">
            <a href="index.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>