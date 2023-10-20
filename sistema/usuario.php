<?php

class Usuario{

    private $pdo; //variavel declarada do lado de fora pois sera utilizada em varios metodos

    public function __construct($nome, $host, $usuario, $senha){
        try {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha); //conexao com banco de dados

        } catch (PDOException $e) {
            echo "ERRO NO BANCO DE DADOS ". $e->getMessage(); //caso temha algum erro ao se conectar aparece aqui
        }
    }

    public function cadastrar($nome, $email, $senha){ //metodo para cadastrar usuario ao banco

        $sql = $this->pdo->prepare("SELECT ADM_ID FROM ADMINISTRADOR WHERE ADM_EMAIL = :e"); //verificando se ja existe o email digitado
        $sql->bindValue(":e",$email); //:e será substituido pelo $email digitado pelo usuario
        $sql->execute(); 

        if($sql -> rowCount() > 0 ){ //verificando se apos executar o SELECT retornou algum usuario no banco
            return false; //ja esta cadastrado
        }else{
            $sql = $this->pdo->prepare("INSERT INTO ADMINISTRADOR (ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO)
            values (:n, :e, :s, 1) ");
             $sql->bindValue(":n",$nome);
             $sql->bindValue(":e",$email);
             $sql->bindValue(":s",md5($senha));
             $sql->execute();
             return true; // usuario nao existia e foi cadastrado
        }
    }


    public function logar($email, $senha){ //metodo para caso o usuario exista iniciar uma sessao/logar


        $sql =  $this->pdo->prepare("SELECT ADM_ID from ADMINISTRADOR WHERE ADM_EMAIL= :e AND ADM_SENHA = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s", md5($senha));
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


    public function mostrarNomeAdmin(){

        if(isset($_SESSION['ADM_ID'])){ // Verifique se a sessão está ativa
            $sessao = $_SESSION['ADM_ID'];
            $sql = $this->pdo->prepare("SELECT ADM_NOME FROM ADMINISTRADOR WHERE ADM_ID = :id");
            $sql->bindValue(":id", $sessao);
            $sql->execute();
            
            if($sql->rowCount() > 0) { // Verifique se o usuário existe no banco
                $resultado = $sql->fetch(PDO::FETCH_ASSOC);
                return $resultado['ADM_NOME']; // Retorna o nome do usuário
            }
        }
        return false; // Retorna falso se a sessão não estiver ativa ou o usuário não existir
    }

    public function atualizarImagem($upload, $admId){
        if(isset($_SESSION['ADM_ID'])){
                      $pastaImagem = 'imagemAdm/';
                      $nomeImagem = $upload['name'];
                      $novoNomeImagem = uniqid();
                      $extensaoImagem = strtolower(pathinfo($nomeImagem, PATHINFO_EXTENSION));
                  
                      if($extensaoImagem != "jpg" && $extensaoImagem != "jpeg" && $extensaoImagem != "png" && $extensaoImagem != "gif"){
                        echo "tipo de arquivo inválido";
                      }else{
                    $imagemAdicionada = move_uploaded_file($upload["tmp_name"], $pastaImagem . $novoNomeImagem . "." . $extensaoImagem);
                  
                    // Atualize o campo ADM_IMAGEM no banco de dados com o caminho do novo arquivo
                    if($imagemAdicionada){
                    $sql = $this->pdo->prepare("UPDATE ADMINISTRADOR SET ADM_IMAGEM = :imagem WHERE ADM_ID = :id");
                    $sql->bindValue(":imagem", $pastaImagem . $novoNomeImagem .".". $extensaoImagem);
                    $sql->bindValue(":id", $admId);
                    $sql->execute();
                    return true; // Imagem atualizada com sucesso
                } else {
                    return false; // Falha ao mover o arquivo
                        }
                      }
                }else{
                    return false;
                }
            }
   


    public function mostrarImagemAdmin($admId){
        if(isset($_SESSION["ADM_ID"])){
        $sql = $this->pdo->prepare("SELECT ADM_IMAGEM FROM ADMINISTRADOR WHERE ADM_ID = :id");
        $sql->bindValue(":id", $admId);
        $sql->execute();
    
        $res = $sql->fetch(PDO::FETCH_ASSOC);
        if ($res) {
            return $res['ADM_IMAGEM'];
        } else {
            return null; // Nenhuma imagem encontrada para o administrador
        }
      }else{
        echo 'você não está logado';
      }
    }
}

?>

