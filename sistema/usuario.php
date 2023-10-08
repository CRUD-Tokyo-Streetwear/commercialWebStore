<?php

class Usuario{
    private $pdo; //variavel declarada do lado de fora pois sera utilizada em varios metodos


    public function conectar($nome, $host, $usuario, $senha){ //metodo para se conectar ao banco de dados
        global $pdo;

        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha); //conexao com banco de dados
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar modo de exceção para relatar erros

        } catch (PDOException $e) {
            echo "ERRO NO BANCO DE DADOS ". $e->getMessage(); //caso temha algum erro ao se conectar aparece aqui
        }

    }

    public function cadastrar($nome, $email, $senha){ //metodo para cadastrar usuario ao banco

        global $pdo;

        $sql = $pdo->prepare("SELECT ADM_ID FROM ADMINISTRADOR WHERE ADM_EMAIL = :e"); //verificando se ja existe o email digitado
        $sql->bindValue(":e",$email); //:e será substituido pelo $email digitado pelo usuario
        $sql->execute();

        if($sql -> rowCount() > 0 ){ //verificando se apos executar o SELECT retornou algum usuario no banco
            return false; //ja esta cadastrado
        }else{
            $sql = $pdo->prepare("INSERT INTO ADMINISTRADOR (ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO)
            values (:n, :e, :s, 1) ");
             $sql->bindValue(":n",$nome);
             $sql->bindValue(":e",$email);
             $sql->bindValue(":s",md5($senha));
             $sql->execute();
             return true; // usuario nao existia e foi cadastrado
        }
    }


    public function logar($email, $senha){ //metodo para caso o usuario exista iniciar uma sessao/logar

        global $pdo;

        $sql =  $pdo->prepare("SELECT ADM_ID from ADMINISTRADOR WHERE email= :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s", $senha);
        $sql->execute();
        if($sql->rowCount() > 0 ){ //verificando se o usuario existe para logar

            $dado = $sql->fetch(); //pegando os dados no banco do usuario logado e transformando em array com fetch()
            session_start(); //iniciando sessao para acessar a area privada
            $_SESSION['ADM_ID'] = $dado['ADM_ID'];
            return true; //usuario esta logado e sessao foi iniciada

        }else{
            return false; //usuario nao esta logado 
        }
    }

}

?>
