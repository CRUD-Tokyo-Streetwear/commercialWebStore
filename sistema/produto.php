<?php

class Produto{ //Cria o objeto produto

    private $pdo; //variavel declarada do lado de fora pois sera utilizada em varios metodos

    public function __construct($nome, $host, $usuario, $senha){
        try {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha); //conexao com banco de dados

        } catch (PDOException $e) {
            echo "ERRO NO BANCO DE DADOS ". $e->getMessage(); //caso tenha algum erro ao se conectar aparece aqui
        }
    }

    public function listar_produtos() {

        $sql = $this->pdo->prepare("SELECT PRODUTO_ID, PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, CATEGORIA_ID, PRODUTO_ATIVO 
        FROM PRODUTO");
        $sql->execute(); 
        
        if($sql->rowCount() > 0 ){ 

            return $sql;  

        }else{
            echo"Nenhum produto encontrado!";
        }

    }



 }

?>