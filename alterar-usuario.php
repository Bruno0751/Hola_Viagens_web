<?php
  session_start();
  ob_start();
  include_once 'utl/helper.php';

  if(isset($_GET['id'])){
    include 'dao/dao-usuario.php';
    include 'model/usuario.php';

   $daoUsuario = new DAOUsuario();
   $array = $daoUsuario->filtrarUsuario($_GET['id'],"codigo");

   $usuario = $array[0];

  }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!--
            50 caracteres
        -->
        <title>HolaViagens</title>

        
        <meta charset="UTF-8">
		<!--
            <meta http-equiv="default-style" content="">
            <meta http-equiv="Refresh" content="">
        -->
		<meta name="author" content="Bruno Gressler da Silveira">
		<!--
            caracters 150
        -->
		<meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1">
        <meta name="robots" content="index,nofolow">
        
        <link rel="stylesheet" type="text/css" href="style/estilos.css">
        <link rel="shortcut icon" href="#">
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <time datetime="2012-02-15"></time>

        <header>
            <a href="index.html"><img src="images/logo.png" alt="Voltar ao Inicio" title="Voltar ao Inicio"></a>
            <ul class="lado">
                <li><a href="cadastro-de-usuario.html" id="link-cadastro">Cadastrar</a></li>
                <li><a href="login-de-usuario.php" id="link-login">Login</a></li>
            </ul>
        </header>

        <section>

            <h2 style="display: none;">HolaViagens</h2>

            <nav>

                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="usuarios-cadastrados.php">Buscar Usuários</a></li>
                    <li><a href="#">Pagina3</a></li>
                </ul>

            </nav>

            <fieldset>
                <legend>Alterar Usuário</legend>

                <form method="post" action="control/control-alteracao-de-usuario.php">

                    <input type="text" class="cadastrar-input-margem" name="textNomeCompleto" value="<?php if(isset($usuario)){echo $usuario->nomeCompleto;}?>">
                    <input type="email" class="cadastrar-input-margem" name="email" value="<?php if(isset($usuario)){echo $usuario->email;}?>">
                    <input type="text" class="cadastrar-input-margem" name="textLogin"value="<?php if(isset($usuario)){echo $usuario->lgin;}?>">
                    <input type="text"  class="cadastrar-input-margem" name="passSenha"value="<?php if(isset($usuario)){echo $usuario->senha;}?>">
                    <input type="file" value="Foto" name="fileIMG">
                    

                    <div class="bt-cadastrar-bt-limpar">
                        <li>
                            <input type="submit" value="Alterar" name="alterar" class="cadastrar-entrar-bt-margem-tb">
                        </li>
                    </div>

                </form>
            </fieldset>
        </section>

        <footer>
            
        </footer>
        <?php
            if(isset($_POST['alterar'])){
                include_once 'model/usuario.php';
                include_once 'dao/dao-usuario.php';
                include_once 'utl/helper.php';
                //include 'util/padronizacao.php';

                $usuario = new Usuario();

                $usuario->idUsuario = $_GET['id'];
                $usuario->nomeCompleto = Validacao::antiXSS($_POST['textNomeCompleto']);
                $usuario->email = Validacao::antiXSS($_POST['email']);
                $usuario->login = Validacao::antiXSS($_POST['textLogin']);
                $usuario->senha = Validacao::antiXSS($_POST['passSenha']);
                $usuario->img = Validacao::antiXSS($_POST['fileIMG']);

                //echo $cliente;
                $daoUsuario = new DAOUsuario();
                $daoUsuario->alterarUsuario($usuario);

                $_SESSION['msg'] = "Usuario Alterado";
                header("location:usuarios-cadastrados.php");

                ob_end_flush();
            }
        ?>
    </body>
</html>