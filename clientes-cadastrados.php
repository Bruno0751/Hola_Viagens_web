<?php
  session_start();
  ob_start();

  include 'model/cliente.php';
  include 'dao/dao-usuario.php';
  include 'utl/helper.php';

  $daoCliente = new DAOCliente();
  $array = $daoCliente->buscarCliente();
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
        
        <link rel="stylesheet" type="text/css" href="style/styles.css">
        <link rel="stylesheet" type="text/css" href="css/lightbox.min.css">
        <link rel="shortcut icon" href="#">
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/lightbox-plus-jquery.min.js"></script>
    </head>
    <body>
        <time datetime="2012-02-15"></time>

        <?php
        echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
        unset($_SESSION['msg']);
            /*if(isset($_SESSION['msg'])){
                Helper::alert($_SESSION['msg']);
                unset($_SESSION['msg']);
            }*/

        ?>

        <header>
            <a href="index.html"><img src="images/logo.png" alt="Voltar ao Inicio" title="Voltar ao Inicio"></a>

            <!--
                trecho PHP
            -->

            <ul class="lado">

                <li><a href="cadastro-de-cliente.html" id="link-cadastro">Cadastrar</a></li>
                <li><a href="login-de-cliente.php" id="link-login">Login</a></li>
            
            </ul>
        </header>
        <section>
            <h2 style="display: none;">HolaViagens</h2>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="clientes-cadastrados.php">Buscar Usuários</a></li>
                    <li><a href="#">Pagina3</a></li>
                </ul>
            </nav>

            <?php
                if(count($array) == 0){
                    echo "<h1 id='vaziio'>Não Há Clientes Cadastrados</h1>";
                    return;
                }
            ?>
            
            <fieldset id="field-search">
                <legend style="text-align: center;">Digite Sua Pesquisa</legend>

                <form method="post" action="#">
                    <input type="text" placeholder="Digite o Que Deseja!" name="textPesquisa" class="entradas-de-filtro">
                    
                    <select name="selecionarFiltro" class="entradas-de-filtro">
                        <option value="todos">Todos</option>
                        <option value="codigo">ID</option>
                        <option value="email">Email</option>
                        <option value="nome">Nome</option>
                        <option value="login">Login</option>
                        <option value="senha">Senha</option>
                    </select>
                    <div>
                        <input type="submit" value="Procurar" name="filtrar" class="entradas-de-filtro" style="width: 99%;">
                    </div>

                </form>
                
                <?php
                    if(isset($_POST['filtrar'])){
                        $pesquisa = $_POST['textPesquisa'];
                        $filtro = $_POST['selecionarFiltro'];

                        if(!empty($pesquisa)){
                            $daoCliente = new DAOCliente();
                            $array = $daoCliente->filtrarCliente($pesquisa,$filtro);
                            if(count($array) == 0){
                                echo "<h2 style='color: #FF4500; text-align: center; font-size: 30px;'>Pesquisa Não Encontrada</h2>
                                <br>
                                <p style='color: green; text-align: center; font-size: 30px;'>Tente Novamente</h2>";
                                return;
                            }
                        }
                    }
                    
                ?>

            </fieldset>

            <div class="tabela-de-usuarios">
                <table>
                    <thead>
                        <tr>
                            <th>Identificação</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Login</th>
                            <th>Senha</th>
                            <th>Imagem</th>
                            <th>Data</th>
                            <th>Excluir</th>
                            <th>Alterar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($array as $linhas){
                                echo "<tr>";
                                    echo "<td>$linhas->id_cliente</td>";
                                    echo "<td>$linhas->nomeCompleto</td>";
                                    echo "<td>$linhas->email</td>";
                                    echo "<td>$linhas->lgin</td>";
                                    echo "<td>$linhas->senha</td>";
                                    echo "<td><a href='files/$linhas->foto' data-lightbox='mygallery'><img src='files/$linhas->foto' alt='Minha Foto' class='u-photo'></a></td>";
                                    echo "<td>$linhas->data_de_nascimento</td>";
                                    echo "<td><a href='control/control-excluir-usuario.php?id=$linhas->id_cliente'>Excluir</a></td>";
                                    echo "<td><a href='alterar-cliente.php?id=$linhas->id_cliente'>Alterar</a></td>";
                                echo "</tr>";
                            }
                            $cliente = new Cliente();
                            echo $cliente->img;
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Identificação</th>
                            <th>Email</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Senha</th>
                            <th>Imagem</th>
                            <th>Data</th>
                            <th>Excluir</th>
                            <th>Alterar</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </section>
        <footer>
            
        </footer>
    </body>
</html>