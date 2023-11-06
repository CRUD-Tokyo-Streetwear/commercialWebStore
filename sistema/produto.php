


<?php

class Produto{

    private $pdo; //variavel declarada do lado de fora pois sera utilizada em varios metodos

    public function __construct($nome, $host, $usuario, $senha){
        try {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha); //conexao com banco de dados

        } catch (PDOException $e) {
            echo "ERRO NO BANCO DE DADOS ". $e->getMessage(); //caso temha algum erro ao se conectar aparece aqui
        }
    }

    public function cadastrarProduto($nome, $descricao, $preco, $preco_desconto){ //metodo para cadastrar usuario ao banco

        $sql = $this->pdo->prepare("SELECT PRODUTO_ID FROM PRODUTO"); //verificando se ja existe o email digitado
        $sql->execute(); 

        if($sql -> rowCount() > 0 ){ //verificando se apos executar o SELECT retornou algum usuario no banco
            return false; //ja esta cadastrado
        }else{
            $sql = $this->pdo->prepare("INSERT INTO PRODUTO (PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, PRODUTO_ATIVO)
            values (:p, :d, :c, :t, 1) ");
             $sql->bindValue(":p",$nome);
             $sql->bindValue(":d",$descricao);
             $sql->bindValue(":c",$preco);
             $sql->bindValue(":t",$preco_desconto);
             $sql->execute();
             return true; // usuario nao existia e foi cadastrado
        }
    }
}

?>
