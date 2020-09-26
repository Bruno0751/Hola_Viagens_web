<?php
    session_start();
    ob_start();

    require_once '../model/usuario.php';
    require_once '../dao/dao-usuario.php';
    include '../utl/validacao.php';
                
    $user = new Usuario();

    $user->login = Validacao::antiXSS($_POST['textLogin']);
    $user->senha = Validacao::antiXSS($_POST['passSenha']);
                
    $uDAO = new DAOUsuario();
    $usuario = $uDAO->verificarUsuario($user);

    if($usuario != null){
        $_SESSION['msg'] = "Usuario Inválido";
        header("location:../login-de-usuario.php.");

    }else{
        $_SESSION['privateUser'] = serialize($usuario);

        header("location:../login-de-usuario.php.");

    }