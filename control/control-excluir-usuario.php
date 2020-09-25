<?php
    ob_start();
    session_start();

    include '../dao/dao-usuario.php';

    $daoUsuario = new DAOUsuario();
    $daoUsuario->deletarUsuario($_GET['id']);

    $_SESSION['msg'] = "Usuario Excluido";

    header("location:../usuarios-cadastrados.php");

    ob_end_flush();