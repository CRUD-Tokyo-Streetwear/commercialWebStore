<?php

class Produto 
{ //Cria o objeto produto

    private $pdo; //variavel declarada do lado de fora pois sera utilizada em varios metodos

    public function __construct($nome, $host, $usuario, $senha)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=" . $nome . ";host=" . $host, $usuario, $senha); //conexao com banco de dados

        } catch (PDOException $e) {
            echo "ERRO NO BANCO DE DADOS " . $e->getMessage(); //caso tenha algum erro ao se conectar aparece aqui
        }
    }

    public function listarProdutos()
    {

        $sql = $this->pdo->prepare("SELECT PRODUTO_ID, PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, CATEGORIA_ID, PRODUTO_ATIVO 
        FROM PRODUTO");
        $sql->execute();

        if ($sql->rowCount() > 0) {

            return $sql;
        } else {
            echo "Nenhum produto encontrado!";
        }
    }


    public function deletarProduto()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if (!empty($id)) {
                $sql = $this->pdo->prepare("DELETE FROM PRODUTO
            WHERE PRODUTO_ID = $id");
                $sql->execute();
            }
        }
    }

    //------------------------------------------------------------------------------------------------------------------------------







    public function cadastrarProduto($nome, $descricao, $preco, $precoDesconto, $produtoAtivo) { 

        $sql = $this->pdo->prepare("INSERT INTO PRODUTO (PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, PRODUTO_ATIVO)
        VALUES ('$nome', '$descricao', '$preco', '$precoDesconto', '$produtoAtivo')");
        $sql->execute();
        return true;
    }



    public function listarCategorias()
    {

        $sql = $this->pdo->prepare("SELECT CATEGORIA_NOME 
        FROM CATEGORIA");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            echo "Nenhuma categoria encontrada!";

        }
    }
}
/*
public function cadastrarCategorias()

    $sql = $this->pdo->prepare("INSERT INTO ")
    VALUS ();
    $SQL->execute();
    return true;
    }
*/

   // Inserindo imagens no banco.
