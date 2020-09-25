<?php
    $pesquisa = $_POST['txtfiltro'];
    $filtro = $_POST['selfilter'];

    if(!empty($pesquisa)){

        $daoUsuario = new DAOUsuario();
        $array = $daoUsuario->filtrarCliente($pesquisa, $filtro);

          if(count($array) == 0){
          echo "<h2 style='color: #FF4500; text-align: center; font-size: 30px;'>Pesquisa Não Encontrada</h2>
          <br>
          <p style='color: green; text-align: center; font-size: 30px;'>Tente Novamente</h2>";
          return;
        }
    }