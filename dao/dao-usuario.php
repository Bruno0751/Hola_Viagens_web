<?php
  require 'conexao.php';

  class DAOUsuario { //DATA ACCESS OBJECT

    private $conexao = null;

    public function __construct(){
      $this->conexao = Conexao::getInstance();
    }

    public function __destruct(){}

    public function cadastrarUsuario($usuario){
      try{

        $stat = $this->conexao->prepare("INSERT INTO usuario(id_usuario, nomeCompleto, email, lgin, senha, img, data)VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stat->bindValue(1, $usuario->idUsuario);
        $stat->bindValue(2, $usuario->nomeCompleto);
        $stat->bindValue(3, $usuario->email);
        $stat->bindValue(4, $usuario->login); //CLASSE
        $stat->bindValue(5, $usuario->senha);
        $stat->bindValue(6, $usuario->img);
        $stat->bindValue(7, $usuario->data);

        $stat->execute();
        
      }catch(PDOException $erro){
        echo "Erro ao Cadastrar Usuario: ".$erro;
        
      }
    }

    public function buscarUsuarios(){
      try{

        $stat = $this->conexao->query("SELECT * FROM usuario");
        $array = $stat->fetchAll(PDO::FETCH_CLASS,"Usuario");
        return $array;
        
      }catch(PDOException $erro){
        echo "Erro ao Buscar Usuarios: ".$erro;
      }
    }

    public function deletarUsuario($id){
      try{
        $stat = $this->conexao->prepare("DELETE FROM usuario WHERE id_usuario = ?");
        $stat->bindValue(1,$id);
        $stat->execute();
      }catch(PDOException $erro){
        echo "Erro ao Deletar Usuario: ".$erro;
      }
    }
    
    public function verificarUsuario($user){
      try{
        $stat = $this->conexao->prepare("SELECT * FROM usuario WHERE lgin = ? AND senha = ?");

        $stat->bindValue(1, $user->login);
        $stat->bindValue(2, $user->senha);

        $stat->execute();

        $usuario = null;
        $usuario = $stat->fetchObject('Usuario');
        return $usuario;
      }catch(PDOException $erro){
        echo "Erro ao Verificar Usuarios: ".$erro;
      }
    }

    public function verificarIDDOUsuario($id){
      try{
        $stat = $this->conexao->prepare("SELECT * FROM usuario WHERE id_usuario = ?");

        $stat->bindValue(1, $id->idUsuario);

        $stat->execute();

        $usuario = null;
        $usuario = $stat->fetchObject('Usuario');
        return $usuario;
      }catch(PDOException $erro){
        echo "Erro ao Verificar Usuarios: ".$erro;
      }
    }

    public function verificarImagemDOUsuario($image){
      try{
        $stat = $this->conexao->prepare("SELECT * FROM usuario WHERE img = ?");

        $stat->bindValue(1, $image->img);

        $stat->execute();

        $usuario = null;
        $usuario = $stat->fetchObject('Usuario');
        return $usuario;
      }catch(PDOException $erro){
        echo "Erro ao Verificar Usuarios: ".$erro;
      }
    }

    public function filtrarUsuario($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos" : $query = "";
         break;
         case "codigo" : $query = "WHERE id_usuario = ".$pesquisa;
         break;
         case "nome" : $query = "WHERE nomeCompleto LIKE '%".$pesquisa."%'";
         break;
         case "email" : $query = "WHERE email LIKE '%".$pesquisa."%'";
         break;
         case "login" : $query = "WHERE lgin LIKE '%".$pesquisa."%'";
         break;
         case "senha" : $query = "WHERE senha LIKE '%".$pesquisa."%'";
         break;
         case "img" : $query = "WHERE img LIKE '%".$pesquisa."%'";
         break;
       }

       //echo "query: ".$query;
       $stat = $this->conexao->query("SELECT * FROM usuario {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS,"Usuario");
       return $array;
     }catch(PDOException $erro){
       echo "Erro ao Filtrar Usuario: ".$erro;
     }
   }

   public function alterarUsuario($usuario){
    try{
      $stat = $this->conexao->prepare("UPDATE usuario SET nomeCompleto=?, email=?, lgin=?, senha=?, img=? WHERE id_usuario=?");

      $stat->bindValue(1, $usuario->nomeCompleto);
      $stat->bindValue(2, $usuario->email);
      $stat->bindValue(3, $usuario->login);
      $stat->bindValue(4, $usuario->senha);
      $stat->bindValue(5, $usuario->img);
      $stat->bindValue(6, $usuario->idUsuario);

      $stat->execute();
    }catch(PDOException $erro){
      echo "Erro ao Alterar Usuario: ".$erro;
    }
   }
 }
