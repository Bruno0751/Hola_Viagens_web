<?php
    session_start();
    ob_start();

    include '../dao/dao-usuario.php';
    include '../model/usuario.php';
    include '../utl/padronizacao.php';
    include '../utl/validacao.php';

    $usuario = new Usuario();

    $usuario->idUsuario = Validacao::antiXSS($_POST['textID']);
    $usuario->nomeCompleto = $_POST['textNomeCompleto'];
    $usuario->email = Validacao::antiXSS($_POST['emMail']);
    $usuario->login = Validacao::antiXSS($_POST['textLogin']);
    $usuario->senha = Validacao::antiXSS(Padronizacao::criptografarSenhas($_POST['passSenha']));
    $usuario->img = $_FILES["imagem"]["name"];
    $usuario->data = $_POST['dateData'];
    
    $daoUsuario = new DAOUsuario();
    if($daoUsuario->verificarIDDOUsuario($usuario) != null){

        $_SESSION['msg'] = "ID Inválida";
        header('location:../load.html');
        ob_end_flush();

    }else if($daoUsuario->verificarImagemDOUsuario($usuario) != null){

        $_SESSION['msg'] = "Esta Imagem não é Permitida";
        header('location:../load.html');
        ob_end_flush();
        

    }else{

        $folder = '../files/'; 
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
            chmod($folder, 0755);
        }
        $fileToUpload = $folder.$usuario->img;

        move_uploaded_file($_FILES['imagem']['tmp_name'], $folder.$usuario->img);
        $daoUsuario->cadastrarUsuario($usuario);

        $_SESSION['msg'] = "Usuario Cadastrado";
        header('location:../load.html');
        ob_end_flush();

    }
    //$validacaoEmail = new Validacao();
              