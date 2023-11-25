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

    public function listarProdutos() //Lista os produtos cadastrados no banco
    {

        $sql = $this->pdo->prepare("SELECT P.PRODUTO_ID, I.IMAGEM_URL, P.PRODUTO_NOME, P.PRODUTO_DESC, P.PRODUTO_PRECO, P.PRODUTO_DESCONTO, C.CATEGORIA_NOME, E.PRODUTO_QTD, P.PRODUTO_ATIVO  
        FROM PRODUTO P INNER JOIN CATEGORIA C
        ON P.CATEGORIA_ID = C.CATEGORIA_ID
        INNER JOIN ESTOQUE E
        ON P.PRODUTO_ID = E.PRODUTO_ID
        INNER JOIN PRODUTO_IMAGEM I
        ON P.PRODUTO_ID = I.PRODUTO_ID
        ORDER BY P.PRODUTO_ID ASC");
        $sql->execute();

        if ($sql->rowCount() > 0) { //Verifica se está retornando alguma linha do banco
            return $sql;
        } else {                    //Aviso caso nenhum produto esteja cadastrado
            echo '<div class="fs-5" style="position: absolute; top: 53%; left: 58%; transform: translate(-50%, -50%);">Nenhum produto cadastrado...</div>';
        }
    }

    public function pesquisarProduto() //Pesquisa instâncias de produto do BD
    {
        $pesquisa = $_GET['search'];

        $sql = $this->pdo->prepare("SELECT P.PRODUTO_ID, I.IMAGEM_URL, P.PRODUTO_NOME, P.PRODUTO_DESC, P.PRODUTO_PRECO, P.PRODUTO_DESCONTO, C.CATEGORIA_NOME, E.PRODUTO_QTD, P.PRODUTO_ATIVO  
    FROM PRODUTO P 
    INNER JOIN CATEGORIA C ON P.CATEGORIA_ID = C.CATEGORIA_ID
    INNER JOIN ESTOQUE E ON P.PRODUTO_ID = E.PRODUTO_ID
    INNER JOIN PRODUTO_IMAGEM I ON P.PRODUTO_ID = I.PRODUTO_ID
    WHERE P.PRODUTO_NOME LIKE :pesquisa OR P.PRODUTO_DESC LIKE :pesquisa
    ORDER BY P.PRODUTO_ID ASC"); //Pesquisa baseada no nome e na descrição do produto

        $pesquisa = "%$pesquisa%";
        $sql->bindParam(':pesquisa', $pesquisa, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql;
        } else  //Aviso de nenhuma instância encontrada no BD 
        {
            echo '<div class="fs-5" style="position: absolute; top: 53%; left: 58%; transform: translate(-50%, -50%);">Nenhum produto encontrado...</div>';
        }
    }

    public function excluirProduto($produtoId)  //Exclui uma instância de produto do BD
    {
        $sqlProduto = $this->pdo->prepare("DELETE FROM PRODUTO WHERE PRODUTO_ID = :id");
        $sqlProduto->bindValue(":id", $produtoId);
        $sqlProduto->execute();

        $sqlProdutoImagem = $this->pdo->prepare("DELETE FROM PRODUTO_IMAGEM WHERE PRODUTO_ID = :id");
        $sqlProdutoImagem->bindValue(":id", $produtoId);
        $sqlProdutoImagem->execute();

        $sqlEstoque = $this->pdo->prepare("DELETE FROM ESTOQUE WHERE PRODUTO_ID = :id");
        $sqlEstoque->bindValue(":id", $produtoId);
        $sqlEstoque->execute();

        return true;
    }

    public function cadastrarProduto($nome, $descricao, $preco, $precoDesconto, $categoria, $produtoAtivo) //Cadastra o produto na tabela de produto
    {
        $sqlSelect = $this->pdo->prepare("SELECT PRODUTO_NOME, PRODUTO_DESC
        FROM PRODUTO
        WHERE PRODUTO_NOME = '$nome' AND PRODUTO_DESC = '$descricao'");
        $sqlSelect->execute();

        if ($sqlSelect->rowCount() > 0) {
            echo '<div class="alert alert-danger" role="alert">
        Produto já cadastrado!
        </div>';
        } else {
            $sqlInsert = $this->pdo->prepare("INSERT INTO PRODUTO (PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, CATEGORIA_ID, PRODUTO_ATIVO)
            VALUES ('$nome', '$descricao', '$preco', '$precoDesconto', '$categoria', '$produtoAtivo')");
            $sqlInsert->execute();
            return true;
        }
    }

    public function cadastrarEstoque($produtoId) //Cadastra o estoque do produto na tabela de estoque
    {
        $produtoQtd = $_POST['produtoQtd'];

        $sql = $this->pdo->prepare("INSERT INTO ESTOQUE
        (PRODUTO_ID, PRODUTO_QTD)
        VALUES ('$produtoId', '$produtoQtd')");
        $sql->execute();
    }

    // public function cadastrarImagem() //Cadastra a imagem do produto na tabela de imagens do produto
    // {
    //     $imagemUrl = $_POST['imagem_url'];
    //     $produtoId = $GLOBALS['produto_id'];
    //     $imagemOrdem = 0;

    //     $sql = $this->pdo->prepare("INSERT INTO PRODUTO_IMAGEM (IMAGEM_ORDEM, PRODUTO_ID, IMAGEM_URL)
    //     VALUES ('$imagemOrdem,', '$produtoId', '$imagemUrl')");
    //     $sql->execute();
    // }

    public function pegaIdProduto($nome, $descricao)   //Pega o ID do produto de acordo com o nome e descrição dele
    {
        $sql = $this->pdo->prepare("SELECT PRODUTO_ID
        FROM PRODUTO
        WHERE PRODUTO_NOME = '$nome' AND PRODUTO_DESC = '$descricao'");
        $sql->execute();

        if ($sql->rowCount() > 0) { //Verifica se está retornando alguma linha do banco
            $produto_id = $sql->fetch();
            return $produto_id['PRODUTO_ID'];
        }
    }

    public function pegaIdCategoria() // Pega o ID da tabela categoria para inserir na tabela produto
    {
        if (isset($_POST['categoria'])) {
            $categoria = $_POST['categoria'];
        }

        //SELECT compara a string da categoria selecionada no BD para achar o ID
        $sql = $this->pdo->prepare("SELECT CATEGORIA_ID 
        FROM CATEGORIA
        WHERE CATEGORIA_NOME = '$categoria'");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $result = $sql->fetch();
            return $result['CATEGORIA_ID'];
        }
    }

    public function listarCategorias() //Lista as categorias dos produtos
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
    
    public function adicionarCategoria($nome_categoria, $descricao_categoria, $produto_ativo_categoria) //Inserindo nova categoria no banco de dados
    {
        $sql = $this ->pdo->prepare ("INSERT INTO categoria (categoria_nome, categoria_desc, categoria_ativo)
        VALUES (:n, :c, :a)");
    
        $sql-> bindValue (":n", $nome_categoria);
        $sql-> bindValue (":c", $descricao_categoria);
        $sql-> bindValue (":a", $produto_ativo_categoria);
        $sql-> execute ();
        return true; 
            
    }

    public function cadastrarImagens($produtoId){
    $imagemUrls = $_POST['imagem_url']; //imagens do formulario foram colocadas em um array

    $sql = $this->pdo->prepare("INSERT INTO PRODUTO_IMAGEM (IMAGEM_ORDEM, PRODUTO_ID, IMAGEM_URL) VALUES (:imagemOrdem, :produtoId, :imagemUrl)");

    foreach ($imagemUrls as $ordem => $imagemUrl) { //$imagemUrls é o array completo, $ordem é o indice do array, $imagemUrl é o conteudo da url
        $sql->bindValue(':imagemOrdem', $ordem, PDO::PARAM_INT);
        $sql->bindValue(':produtoId', $produtoId, PDO::PARAM_INT);
        $sql->bindValue(':imagemUrl', $imagemUrl, PDO::PARAM_STR);
        $sql->execute();
    }
}
    



}



