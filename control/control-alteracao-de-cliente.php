<?php
    session_start();
    ob_start();

    require '../model/cliente.php';
        require '../dao/dao-usuario.php';
        require '../utl/helper.php';
        //include 'util/padronizacao.php';

        $cliente = new Cliente();

        $cliente->idCliente = $_GET['id'];
        $cliente->nomeCompleto = $_POST['textNomeCompleto'];
        $cliente->email = $_POST['email'];
        $cliente->login = $_POST['textLogin'];

        $daoCliente = new DAOCliente();
        $daoCliente->alterarCliente($cliente);

        $_SESSION['msg'] = "Cliente Alterado";
        header("location:../clientes-cadastrados.php");

        ob_end_flush();
