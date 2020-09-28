<?php
    session_start();
    ob_start();

    unset($_SESSION['privateUser']);
    $_SESSION['msg'] = "Até Mais";
    header("location:../clientes-cadastrados.php");

    ob_end_flush();