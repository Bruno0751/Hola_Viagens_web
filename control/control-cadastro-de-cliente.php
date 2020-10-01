<?php
    session_start();
    ob_start();

    include '../dao/dao-usuario.php';
    include '../model/cliente.php';
    include '../utl/padronizacao.php';
    include '../utl/validacao.php';

    $cliente = new Cliente();

    $cliente->idCliente = Validacao::antiXSS($_POST['textID']);
    $cliente->nomeCompleto = Validacao::antiXSS(Padronizacao::padronizandoNome($_POST['textNomeCompleto']));
    $cliente->email = Validacao::antiXSS($_POST['emMail']);
    $cliente->login = Validacao::antiXSS($_POST['textLogin']);
    $cliente->senha = Validacao::antiXSS(Padronizacao::criptografarSenhas($_POST['passSenha']));
    $cliente->img = $_FILES["imagem"]["name"];
    $cliente->data = $_POST['dateData'];
    
    $daoCliente = new DAOCliente();

    //$verificarIDCliente =

    if($daoCliente->verificarIDDOCliente($cliente->idCliente) != null){

        $_SESSION['msg'] = "ID Inválida";
        header('location:../load-cadastro-de-cliente.html');
        ob_end_flush();

        

    }else if($cliente->img == null){

        $cliente->img = "Sem Foto";
        $daoCliente->cadastrarCliente($cliente);
        $_SESSION['msg'] = "Cliente Cadastrado";
        header('location:../load-cadastro-de-cliente.html');
        ob_end_flush();

    }else if($daoCliente->verificarImagemDOCliente($cliente->img) != null){

        $_SESSION['msg'] = "Imagem Inválida";
        header('location:../load-cadastro-de-cliente.html');
        ob_end_flush();

    }else{

        $folder = '../files/'; 
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
            chmod($folder, 0755);
        }
        $fileToUpload = $folder.$cliente->img;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $folder.$cliente->img);

        $daoCliente->cadastrarCliente($cliente);
        $_SESSION['msg'] = "Cliente Cadastrado";
        header('location:../load-cadastro-de-cliente.html');
        ob_end_flush();

    }
    //$validacaoEmail = new Validacao();
              