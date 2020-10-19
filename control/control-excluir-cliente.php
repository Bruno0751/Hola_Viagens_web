<?php
    ob_start();
    session_start();

    include '../dao/dao-cliente.php';

    $daoCliente = new DAOCliente();
    $daoCliente->deletarCliente($_GET['id']);

    $_SESSION['msg'] = "Cliente Excluido";

    header("location:../load-cadastro-de-cliente.html");

    ob_end_flush();