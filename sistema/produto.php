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
        FROM PRODUTO P INNER JOIN CATEGORIA C ON P.CATEGORIA_ID = C.CATEGORIA_ID
        INNER JOIN PRODUTO_ESTOQUE E ON P.PRODUTO_ID = E.PRODUTO_ID
        INNER JOIN PRODUTO_IMAGEM I ON P.PRODUTO_ID = I.PRODUTO_ID
        ORDER BY P.PRODUTO_ID ASC");
        $sql->execute();

        if ($sql->rowCount() > 0) { //Verifica se está retornando alguma linha do banco
            return $sql;
        } else {                    //Aviso caso nenhum produto esteja cadastrado
            echo '<div class="fs-5" style="position: absolute; top: 53%; left: 58%; transform: translate(-50%, -50%);">Nenhum produto cadastrado...</div>';
        }
    }

    public function mostrarDadosProduto($produtoId)
    {
        $sql = $this->pdo->prepare("SELECT P.PRODUTO_NOME, I.IMAGEM_URL, P.PRODUTO_DESC, P.PRODUTO_PRECO,
         P.PRODUTO_DESCONTO, P.PRODUTO_ATIVO, C.CATEGORIA_NOME, E.PRODUTO_QTD
        FROM PRODUTO P 
        INNER JOIN CATEGORIA C ON P.CATEGORIA_ID = C.CATEGORIA_ID
        INNER JOIN PRODUTO_ESTOQUE E ON P.PRODUTO_ID = E.PRODUTO_ID
        INNER JOIN PRODUTO_IMAGEM I ON P.PRODUTO_ID = I.PRODUTO_ID
        WHERE P.PRODUTO_ID = :id");

        $sql->bindValue(":id", $produtoId);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $result = $sql->fetch(PDO::FETCH_ASSOC);

            // Inicializa um array para armazenar as URLs de imagem
            $imagens = [];

            // Adiciona a primeira URL de imagem
            $imagens[] = $result['IMAGEM_URL'];

            // Continua adicionando URLs de imagem enquanto houver mais resultados
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $imagens[] = $row['IMAGEM_URL'];
            }

            // Adiciona o array de URLs de imagem ao resultado final
            $result['IMAGENS'] = $imagens;

            return $result;
        }

        return false;
    }


    public function atualizarProdutoModal($produtoId, $novoNome, $novaDesc, $novoPreco, $novoDesconto, $novaCategoria, $novoEstoque, $imgURLs, $novoStatus)
    {

        // Atualiza os dados do Produto na tabela PRODUTO
        $sqlProduto = $this->pdo->prepare("UPDATE PRODUTO
         SET PRODUTO_NOME = :novoNome, PRODUTO_DESC = :novaDesc, PRODUTO_PRECO = :novoPreco,
          PRODUTO_ATIVO = :novoStatus, PRODUTO_DESCONTO = :novoDesconto, CATEGORIA_ID = :novaCategoria
         WHERE PRODUTO_ID = :id");
        $sqlProduto->bindValue(":novoNome", $novoNome);
        $sqlProduto->bindValue(":novaDesc", $novaDesc);
        $sqlProduto->bindValue(":novoPreco", $novoPreco);
        $sqlProduto->bindValue(":novoDesconto", $novoDesconto);
        $sqlProduto->bindValue(":novaCategoria", $novaCategoria);
        $sqlProduto->bindValue(":novoStatus", $novoStatus, PDO::PARAM_INT);
        $sqlProduto->bindValue(":id", $produtoId);
        $sqlProduto->execute();

        $sqlEstoque = $this->pdo->prepare("UPDATE PRODUTO_ESTOQUE
        SET PRODUTO_QTD = :novoEstoque
        WHERE PRODUTO_ID = :id");
        $sqlEstoque->bindValue(":novoEstoque", $novoEstoque);
        $sqlEstoque->bindValue(":id", $produtoId);
        $sqlEstoque->execute();

        //Verifica quantos campos de imagem_url tem um determinado produto
        $sqlImagemSelect = $this->pdo->prepare("SELECT *
        FROM PRODUTO_IMAGEM 
        WHERE PRODUTO_ID = :id");
        $sqlImagemSelect->bindValue(":id", $produtoId);
        $sqlImagemSelect->execute();

        $numeroDeLinhas = $sqlImagemSelect->rowCount();


        // Atualiza as imagens na tabela PRODUTO_IMAGEM
        $sqlImagemUpdate = $this->pdo->prepare("UPDATE PRODUTO_IMAGEM
        SET IMAGEM_URL = :imgURL
        WHERE PRODUTO_ID = :id AND IMAGEM_ORDEM = :ordem");

        $ordem = 0;
        $limiteURLs = 3;

        for ($ordem; $ordem < $numeroDeLinhas; $ordem++) {
            $sqlImagemUpdate->bindValue(":ordem", $ordem);
            $sqlImagemUpdate->bindValue(":imgURL", $imgURLs[$ordem]);
            $sqlImagemUpdate->bindValue(":id", $produtoId);
            $sqlImagemUpdate->execute();
        }

        //Insere as imagens na tabela PRODUTO_IMAGEM
        $sqlImagemInsert = $this->pdo->prepare("INSERT INTO PRODUTO_IMAGEM
        (IMAGEM_ORDEM, PRODUTO_ID, IMAGEM_URL)
        VALUES (:ordem, :id, :imgURL)");

        for ($ordem; $ordem < $limiteURLs; $ordem++) {
            $sqlImagemInsert->bindValue(":ordem", $ordem);
            $sqlImagemInsert->bindValue(":imgURL", $imgURLs[$ordem]);
            $sqlImagemInsert->bindValue(":id", $produtoId);
            $sqlImagemInsert->execute();
        }

        return true; // Dados atualizados com sucesso
    }


    public function pesquisarProduto() //Pesquisa instâncias de produto do BD
    {
        $pesquisa = $_GET['search'];

        $sql = $this->pdo->prepare("SELECT P.PRODUTO_ID, I.IMAGEM_URL, P.PRODUTO_NOME, P.PRODUTO_DESC, P.PRODUTO_PRECO, P.PRODUTO_DESCONTO, C.CATEGORIA_NOME, E.PRODUTO_QTD, P.PRODUTO_ATIVO  
    FROM PRODUTO P 
    INNER JOIN CATEGORIA C ON P.CATEGORIA_ID = C.CATEGORIA_ID
    INNER JOIN PRODUTO_ESTOQUE E ON P.PRODUTO_ID = E.PRODUTO_ID
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

        $sqlEstoque = $this->pdo->prepare("DELETE FROM PRODUTO_ESTOQUE WHERE PRODUTO_ID = :id");
        $sqlEstoque->bindValue(":id", $produtoId);
        $sqlEstoque->execute();

        return true;
    }

    public function cadastrarProduto($nome, $descricao, $preco, $precoDesconto, $categoria, $produtoAtivo)
    {
        $sqlSelect = $this->pdo->prepare("SELECT PRODUTO_NOME, PRODUTO_DESC
        FROM PRODUTO
        WHERE PRODUTO_NOME = :nome AND PRODUTO_DESC = :descricao");
        $sqlSelect->bindParam(':nome', $nome);
        $sqlSelect->bindParam(':descricao', $descricao);
        $sqlSelect->execute();
    
        if ($sqlSelect->rowCount() > 0) {
            echo '<div class="alert alert-danger" role="alert">
        Produto já cadastrado!
        </div>';
        } else {
            $sqlInsert = $this->pdo->prepare("INSERT INTO PRODUTO (PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, CATEGORIA_ID, PRODUTO_ATIVO)
            VALUES (:nome, :descricao, :preco, :precoDesconto, :categoria, :produtoAtivo)");
            $sqlInsert->bindParam(':nome', $nome);
            $sqlInsert->bindParam(':descricao', $descricao);
            $sqlInsert->bindParam(':preco', $preco);
            $sqlInsert->bindParam(':precoDesconto', $precoDesconto);
            $sqlInsert->bindParam(':categoria', $categoria);
            $sqlInsert->bindParam(':produtoAtivo', $produtoAtivo, PDO::PARAM_INT);
            $sqlInsert->execute();
            return true;
        }
    }

    public function cadastrarEstoque($produtoId) //Cadastra o estoque do produto na tabela de estoque
    {
        $produtoQtd = $_POST['produtoQtd'];

        $sql = $this->pdo->prepare("INSERT INTO PRODUTO_ESTOQUE
        (PRODUTO_ID, PRODUTO_QTD)
        VALUES ('$produtoId', '$produtoQtd')");
        $sql->execute();
    }

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

    public function pegaIdCategoria($nomeCategoria) // Pega o ID da tabela categoria para inserir na tabela produto
    {
        if (isset($_POST['categoria'])) {
            $categoria = $nomeCategoria;
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
        $sql = $this->pdo->prepare("SELECT CATEGORIA_ID, CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO 
        FROM CATEGORIA");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            echo '<div class="fs-5" style="position: absolute; top: 53%; left: 58%; transform: translate(-50%, -50%);">Nenhuma categoria cadastrada...</div>';
        }
    }

    public function adicionarCategoria($nome_categoria, $descricao_categoria, $produto_ativo_categoria) //Inserindo nova categoria no banco de dados
    {
        $sqlSelect = $this->pdo->prepare("SELECT CATEGORIA_NOME, CATEGORIA_DESC
        FROM CATEGORIA
        WHERE CATEGORIA_NOME = '$nome_categoria' AND CATEGORIA_DESC = '$descricao_categoria'");
        $sqlSelect->execute();

        if ($sqlSelect->rowCount() > 0) {
            echo '<div class="alert alert-danger" role="alert">
        Categoria já cadastrada!
        </div>';
        } else {
            $sql = $this->pdo->prepare("INSERT INTO CATEGORIA (CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO)
            VALUES (:n, :c, :a)");
            $sql->bindValue(":n", $nome_categoria);
            $sql->bindValue(":c", $descricao_categoria);
            $sql->bindValue(":a", $produto_ativo_categoria, PDO::PARAM_INT); 
            $sql->execute();
            return true;
        }
    }

    public function excluirCategoria($categoriaId)  //Exclui uma instância de produto do BD
    {
        $sqlProduto = $this->pdo->prepare("DELETE FROM CATEGORIA WHERE CATEGORIA_ID = :id");
        $sqlProduto->bindValue(":id", $categoriaId);
        $sqlProduto->execute();

        return true;
    }


    public function pesquisarCategoria() //Pesquisa instâncias de categoria do BD
    {
        $pesquisa = $_GET['search'];

        $sql = $this->pdo->prepare("SELECT CATEGORIA_ID, CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO 
        FROM CATEGORIA
        WHERE CATEGORIA_NOME LIKE :pesquisa OR CATEGORIA_DESC LIKE :pesquisa
        ORDER BY CATEGORIA_ID ASC"); //Pesquisa baseada no nome e na descrição da categoria

        $pesquisa = "%$pesquisa%";
        $sql->bindParam(':pesquisa', $pesquisa, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) { //retorna o SQL somente se achar alguma instância no banco
            return $sql;
        } else  //Aviso de nenhuma instância encontrada no BD 
        {
            echo '<div class="fs-5" style="position: absolute; top: 53%; left: 58%; transform: translate(-50%, -50%);">Nenhuma categoria encontrada...</div>';
        }
    }

    public function mostrarDadosCategoria($categoriaId)
    {
        $sql = $this->pdo->prepare("SELECT CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO 
            FROM CATEGORIA 
            WHERE CATEGORIA_ID = :id");
        $sql->bindValue(":id", $categoriaId);
        $sql->execute();

        if ($sql->rowCount() > 0) { // Verifique se a categoria existe no banco
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);
            return $resultado; // Retorna um array associativo com todos os dados da categoria
        }
        return false; // Retorna falso se não encontrar a categoria
    }

    public function atualizarCategoriaModal($categoriaId, $novoNome, $novaDesc, $novoStatus)
    {
        // Atualizar os dados da categoria
        $sql = $this->pdo->prepare("UPDATE CATEGORIA SET CATEGORIA_NOME = :novoNome, CATEGORIA_DESC = :novaDesc, CATEGORIA_ATIVO = :novoStatus WHERE CATEGORIA_ID = :id");
        $sql->bindValue(":novoNome", $novoNome);
        $sql->bindValue(":novaDesc", $novaDesc);
        $sql->bindValue(":novoStatus", $novoStatus, PDO::PARAM_INT);
        $sql->bindValue(":id", $categoriaId);
        $sql->execute();

        return true; // Dados atualizados com sucesso

    }

    public function cadastrarImagens($produtoId){
        $imagemUrls = $_POST['imagem_url'];
    
        $sql = $this->pdo->prepare("INSERT INTO PRODUTO_IMAGEM (IMAGEM_ORDEM, PRODUTO_ID, IMAGEM_URL) VALUES (:imagemOrdem, :produtoId, :imagemUrl)");
    
        $urlValida = false;
    
        foreach ($imagemUrls as $ordem => $imagemUrl) {
            if (!empty($imagemUrl) && filter_var($imagemUrl, FILTER_VALIDATE_URL)) {
                $sql->bindValue(':imagemOrdem', $ordem, PDO::PARAM_INT);
                $sql->bindValue(':produtoId', $produtoId, PDO::PARAM_INT);
                $sql->bindValue(':imagemUrl', $imagemUrl, PDO::PARAM_STR);
                $sql->execute();
    
                $urlValida = true;
            } else {
                // Se uma URL não válida ou vazia for encontrada, apenas ignore e continue para a próxima iteração
                continue;
            }
        }
    
        // Se nenhuma URL válida foi encontrada, insira uma string vazia
        if (!$urlValida) {
            $sqlVazio = $this->pdo->prepare("INSERT INTO PRODUTO_IMAGEM (IMAGEM_ORDEM, PRODUTO_ID, IMAGEM_URL) VALUES (:imagemOrdem, :produtoId, '')");
            $sqlVazio->bindValue(':imagemOrdem', 0, PDO::PARAM_INT); // Defina o valor desejado para IMAGEM_ORDEM
            $sqlVazio->bindValue(':produtoId', $produtoId, PDO::PARAM_INT);
            $sqlVazio->execute();
        }
    }


public function getImagensProduto($produtoId) {
    $sql = $this->pdo->prepare("SELECT IMAGEM_URL FROM PRODUTO_IMAGEM WHERE PRODUTO_ID = :produto_id");
    try {
        $sql->bindParam(':produto_id', $produtoId, PDO::PARAM_INT);
        $sql->execute();

        // Obter todas as URLs das imagens em um array
        $imagens = $sql->fetchAll(PDO::FETCH_COLUMN);

        return $imagens;
    } catch (PDOException $e) {
        die("Erro ao obter imagens do produto: " . $e->getMessage());
    }
}

}



