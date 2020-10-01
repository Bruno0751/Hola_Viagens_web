<?php
    ob_start();
    session_start();

    include '../dao/dao-cliente.php';

    $daoCliente = new DAOCliente();
    $daoCliente->deletarCliente($_GET['id']);

    $_SESSION['msg'] = "Cliente Excluido";

    header("location:../clientes-cadastrados.php");

    ob_end_flush();