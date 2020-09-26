<?php
    ob_start();
    session_start();

    include '../dao/dao-usuario.php';

    $daoCliente = new DAOCliente();
    $daoCliente->deletarCliente($_GET['id']);

    $_SESSION['msg'] = "Cliente Excluido";

    header("location:../usuarios-cadastrados.php");

    ob_end_flush();