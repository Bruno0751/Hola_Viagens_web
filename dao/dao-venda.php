<?php
  require 'conexao.php';

  class DAOVenda { //DATA ACCESS OBJECT

    private $conexao = null;

    public function __construct(){
      $this->conexao = Conexao::getInstance();
    }

    public function __destruct(){}

    public function cadastrarVenda($venda){
      try{

        $stat = $this->conexao->prepare("INSERT INTO venda(id_venda, data_da_venda, nome_do_vendedor, cliente)VALUES(?, ?, ?, ?)");
        $stat->bindValue(1, $venda->idVenda);
        $stat->bindValue(2, $venda->dataDAVenda);
        $stat->bindValue(3, $venda->nomeDOVendedor);
        $stat->bindValue(4, $venda->cliente); //CLASSE

        $stat->execute();
        
      }catch(PDOException $erro){
        echo "Erro ao Cadastrar Venda: ".$erro;
        
      }
    }

    public function buscarVenda(){
      try{

        $stat = $this->conexao->query("SELECT * FROM venda");
        $array = $stat->fetchAll(PDO::FETCH_CLASS,"Venda");
        return $array;
        
      }catch(PDOException $erro){
        echo "Erro ao Buscar Vendas: ".$erro;
      }
    }

    public function deletarVenda($id){
      try{
        $stat = $this->conexao->prepare("DELETE FROM venda WHERE id_venda = ?");
        $stat->bindValue(1,$id);
        $stat->execute();
      }catch(PDOException $erro){
        echo "Erro ao Deletar Venda: ".$erro;
      }
    }
    

    public function verificarIDDAVenda($id){
      try{
        $stat = $this->conexao->prepare("SELECT id_venda FROM venda WHERE id_venda = ?");

        $stat->bindValue(1, $id);

        $stat->execute();

        $id = null;
        $id = $stat->fetchALL(PDO::FETCH_CLASS,'Venda');
        //$id = $stat->fetchObject('Cliente');
        return $id;

      }catch(PDOException $erro){
        echo "Erro ao Verificar ID Venda: ".$erro;
      }
    }


    public function filtrarVenda($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos" : $query = "";
         break;
         case "codigo" : $query = "WHERE id_Venda = ".$pesquisa;
         break;
         case "nome" : $query = "WHERE data_da_venda LIKE '%".$pesquisa."%'";
         break;
         case "email" : $query = "WHERE nome_do_vendedor LIKE '%".$pesquisa."%'";
         break;
         case "login" : $query = "WHERE cliente LIKE '%".$pesquisa."%'";
         break;
       }

       //echo "query: ".$query;
       $stat = $this->conexao->query("SELECT * FROM venda {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS,"Venda");
       return $array;
     }catch(PDOException $erro){
       echo "Erro ao Filtrar Venda: ".$erro;
     }
   }

   public function alterarVenda($venda){
    try{
      $stat = $this->conexao->prepare("UPDATE venda SET nome_do_vendedor=?, email=?, lgin=? WHERE id_Venda=?");

      $stat->bindValue(1, $venda->nomeDOVendedor);
      $stat->bindValue(2, $venda->idVenda);

      $stat->execute();
    }catch(PDOException $erro){
      echo "Erro ao Alterar Venda: ".$erro;
    }
   }
 }
