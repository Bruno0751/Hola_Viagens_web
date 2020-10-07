<?php
    session_start();
    ob_start();

    include '../dao/dao-venda.php';
    include '../model/venda.php';
    include '../utl/padronizacao.php';
    include '../utl/validacao.php';

    $venda = new Venda();

    $venda->idVenda = Validacao::antiXSS($_POST['textID']);
    $venda->dataDAVenda = $_POST['dataDataDAVenda'];
    $venda->nomeDOVendedor = Validacao::antiXSS($_POST['textNomeDOVendedor']);
    $venda->cliente = Validacao::antiXSS($_POST['textCliente']);
    
    $daoVenda = new DAOVenda();

    if($daoVenda->verificarIDDAVenda($venda->idVenda) != null){

        $_SESSION['msg'] = "ID Inválida";
        header('location:../load-cadastro-de-venda.html');
        ob_end_flush();

        

    }else if($daoVenda->verificarIDClienteFK($venda->cliente) == null){

        $_SESSION['msg'] = "ID do Cliente Inválida/Cliente não Existe";
        header('location:../load-cadastro-de-venda.html');
        ob_end_flush();

    }else{

        $daoVenda->cadastrarVenda($venda);
        $_SESSION['msg'] = "Venda Cadastrada";
        header('location:../load-cadastro-de-venda.html');
        ob_end_flush();

    }
    //$validacaoEmail = new Validacao();
              