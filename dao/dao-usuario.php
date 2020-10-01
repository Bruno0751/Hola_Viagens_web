<?php
  require 'conexao.php';

  class DAOCliente { //DATA ACCESS OBJECT

    private $conexao = null;

    public function __construct(){
      $this->conexao = Conexao::getInstance();
    }

    public function __destruct(){}

    public function cadastrarCliente($cliente){
      try{

        $stat = $this->conexao->prepare("INSERT INTO cliente(id_cliente, nome_completo, email, lgin, senha, foto, data_de_nascimento)VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stat->bindValue(1, $cliente->idCliente);
        $stat->bindValue(2, $cliente->nomeCompleto);
        $stat->bindValue(3, $cliente->email);
        $stat->bindValue(4, $cliente->login); //CLASSE
        $stat->bindValue(5, $cliente->senha);
        $stat->bindValue(6, $cliente->img);
        $stat->bindValue(7, $cliente->data);

        $stat->execute();
        
      }catch(PDOException $erro){
        echo "Erro ao Cadastrar Cliente: ".$erro;
        
      }
    }

    public function buscarCliente(){
      try{

        $stat = $this->conexao->query("SELECT * FROM cliente");
        $array = $stat->fetchAll(PDO::FETCH_CLASS,"Cliente");
        return $array;
        
      }catch(PDOException $erro){
        echo "Erro ao Buscar Usuarios: ".$erro;
      }
    }

    public function deletarCliente($id){
      try{
        $stat = $this->conexao->prepare("DELETE FROM cliente WHERE id_cliente = ?");
        $stat->bindValue(1,$id);
        $stat->execute();
      }catch(PDOException $erro){
        echo "Erro ao deletar cliente: ".$erro;
      }
    }
    
    public function verificarLoginCliente($cliente){
      try{
        $stat = $this->conexao->prepare("SELECT * FROM cliente WHERE lgin = ? AND senha = ?");

        $stat->bindValue(1, $cliente->login);
        $stat->bindValue(2, $cliente->senha);

        $stat->execute();

        $cliente = null;
        $cliente = $stat->fetchObject('Cliente');
        return $cliente;
      }catch(PDOException $erro){
        echo "Erro ao Verificar Cliente: ".$erro;
      }
    }

    public function verificarIDDOCliente($id){
      try{
        $stat = $this->conexao->prepare("SELECT id_cliente FROM cliente WHERE id_cliente = ?");

        $stat->bindValue(1, $id);

        $stat->execute();

        $id = null;
        $id = $stat->fetchALL(PDO::FETCH_CLASS,'Cliente');
        //$id = $stat->fetchObject('Cliente');
        return $id;

      }catch(PDOException $erro){
        echo "Erro ao Verificar ID Cliente: ".$erro;
      }
    }

    public function verificarImagemDOCliente($image){
      try{
        $stat = $this->conexao->prepare("SELECT foto FROM cliente WHERE foto = ?");

        $stat->bindValue(1, $image);

        $stat->execute();

        $image = null;
        $image = $stat->fetchALL(PDO::FETCH_CLASS,'Cliente');
        return $image;

      }catch(PDOException $erro){
        echo "Erro ao Verificar Imagem Cliente: ".$erro;
      }
    }

    public function filtrarCliente($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos" : $query = "";
         break;
         case "codigo" : $query = "WHERE id_cliente = ".$pesquisa;
         break;
         case "nome" : $query = "WHERE nome_completo LIKE '%".$pesquisa."%'";
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
       $stat = $this->conexao->query("SELECT * FROM cliente {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS,"Cliente");
       return $array;
     }catch(PDOException $erro){
       echo "Erro ao Filtrar Cliente: ".$erro;
     }
   }

   public function alterarCliente($cliente){
    try{
      $stat = $this->conexao->prepare("UPDATE cliente SET nome_completo=?, email=?, lgin=? WHERE id_cliente=?");

      $stat->bindValue(1, $cliente->nomeCompleto);
      $stat->bindValue(2, $cliente->email);
      $stat->bindValue(3, $cliente->login);
      $stat->bindValue(4, $cliente->idCliente);

      $stat->execute();
    }catch(PDOException $erro){
      echo "Erro ao Alterar Cliente: ".$erro;
    }
   }
 }
