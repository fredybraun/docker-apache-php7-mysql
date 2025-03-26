<?php
    session_start();
    require('db.php');
    require ('funcoes.php');

    if(isset($_POST['status'])){
        $status = $_POST['status'];
        $cliente = '';
        $end_entrega = '';
        $data_solicitação = '';
        $quant_andaime = '';
        $quant_plataforma = '';
        $quant_travessa = '';
        $quant_rodas = '';
        $quant_sapata = '';
        $quant_escada_longa = '';
        $quant_escada_curta = '';
        $frete_entrega = '';
        $frete_retorno = '';
        $data_retirada = '';
        $data_retorno = '';
        $status_andaime = '';
        $dias_locados = '';
        $id_andaime = '';
        if($status = 'update') {
            if(isset($_POST['id'])){
                $id_andaime = $_POST['id'];
                $cliente = $_POST['cli_andaime'];
                $end_entrega = $_POST['end_entrega'];
                $quant_andaime = $_POST['quant_andaime'];
                if(!$quant_andaime){$quant_andaime = 0;}

                $quant_plataforma = $_POST['quant_plataforma'];
                if(!$quant_plataforma){$quant_plataforma = 0;}

                $quant_travessa = $_POST['quant_travessa'];
                if(!$quant_travessa){$quant_travessa = 0;}

                $quant_rodas = $_POST['quant_rodas'];
                if(!$quant_rodas){$quant_rodas = 0;}

                $quant_sapata = $_POST['quant_sapata'];
                if(!$quant_sapata){$quant_sapata = 0;}

                $quant_escada_longa = $_POST['quant_escada_longa'];
                if(!$quant_escada_longa){$quant_escada_longa = 0;}

                $quant_escada_curta = $_POST['quant_escada_curta'];
                if(!$quant_escada_curta){$quant_escada_curta = 0;}

                $frete_entrega = $_POST['frete_entrega'];
                if (!$frete_entrega){$frete_entrega = 0;}

                $frete_retorno = $_POST['frete_retorno'];
                if (!$frete_retorno){$frete_retorno = 0;}
                
                $data_retirada = trocadatatraco($_POST['data_retirada']);
                $data_retorno = trocadatatraco($_POST['data_retorno']);
                $status_andaime = $_POST['status_andaime'];
                if($_POST['dias_locados'] == NULL){$dias_locados = 0;}
                else {$dias_locados = $_POST['dias_locados'];}



                
                
                if ($stmt = $con->prepare("SELECT valor_itens_locacoes FROM itens_locacoes WHERE id_itens_locacoes = '$frete_entrega'")) {
                    $stmt->execute();
                    $stmt->store_result();
                    $num_of_rows = $stmt->num_rows;
                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($valor_frete_entrega);
                        $stmt->fetch();
                    }
                    $stmt->free_result();
                }
                if ($stmt = $con->prepare("SELECT valor_itens_locacoes FROM itens_locacoes WHERE id_itens_locacoes = '$frete_retorno'")) {
                    $stmt->execute();
                    $stmt->store_result();
                    $num_of_rows = $stmt->num_rows;
                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($valor_frete_retorno);
                        $stmt->fetch();
                    }
                    $stmt->free_result();
                }


                if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 1 ')) {
                    $stmt->execute();
                    $stmt->store_result();
                    $num_of_rows = $stmt->num_rows;
                    if ($stmt->num_rows > 0) {
                    $stmt->bind_result($valor_andaime);
                    $stmt->fetch();
                    }
                    $stmt->free_result();

                }
                $valor_total_andaime = $quant_andaime * $valor_andaime;
                
                if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 2 ')) {
                    $stmt->execute();
                    $stmt->store_result();
                    $num_of_rows = $stmt->num_rows;
                    if ($stmt->num_rows > 0) {
                    $stmt->bind_result($valor_plataforma);
                    $stmt->fetch();
                    }
                    $stmt->free_result();

                }
                $valor_total_plataforma = $quant_plataforma * $valor_plataforma;
                
                if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 3 ')) {
                    $stmt->execute();
                    $stmt->store_result();
                    $num_of_rows = $stmt->num_rows;
                    if ($stmt->num_rows > 0) {
                    $stmt->bind_result($valor_travessa);
                    $stmt->fetch();
                    }
                    $stmt->free_result();

                }
                $valor_total_travessa = $quant_travessa * $valor_travessa;

                if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 4 ')) {
                    $stmt->execute();
                    $stmt->store_result();
                    $num_of_rows = $stmt->num_rows;
                    if ($stmt->num_rows > 0) {
                    $stmt->bind_result($valor_rodas);
                    $stmt->fetch();
                    }
                    $stmt->free_result();

                }
                $valor_total_rodas = $quant_rodas * $valor_rodas;

                if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 5 ')) {
                    $stmt->execute();
                    $stmt->store_result();
                    $num_of_rows = $stmt->num_rows;
                    if ($stmt->num_rows > 0) {
                    $stmt->bind_result($valor_sapata);
                    $stmt->fetch();
                    }
                    $stmt->free_result();

                }
                $valor_total_sapata = $quant_sapata * $valor_sapata;

                if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 6 ')) {
                    $stmt->execute();
                    $stmt->store_result();
                    $num_of_rows = $stmt->num_rows;
                    if ($stmt->num_rows > 0) {
                    $stmt->bind_result($valor_escada_longa);
                    $stmt->fetch();
                    }
                    $stmt->free_result();

                }
                $valor_total_escada_longa = $quant_escada_longa * $valor_escada_longa;

                if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 7 ')) {
                    $stmt->execute();
                    $stmt->store_result();
                    $num_of_rows = $stmt->num_rows;
                    if ($stmt->num_rows > 0) {
                    $stmt->bind_result($valor_escada_curta);
                    $stmt->fetch();
                    }
                    $stmt->free_result();

                }
                $valor_total_escada_curta = $quant_escada_curta * $valor_escada_curta;

                $valor_tota_pecas = $valor_total_andaime + $valor_total_plataforma + $valor_total_travessa + $valor_total_rodas + $valor_total_sapata + $valor_total_escada_longa + $valor_total_escada_curta;
                $valor_final_peças = $dias_locados * $valor_tota_pecas;
                $valor_total = $valor_frete_entrega + $valor_frete_retorno + $valor_final_peças;


                
                
                $stmt = $con->prepare("UPDATE andaimes SET id_cli='$cliente',end_entrega='$end_entrega' ,quant_andaime='$quant_andaime',quant_plataforma='$quant_plataforma', quant_travessa ='$quant_travessa', quant_rodas='$quant_rodas', quant_sapata = '$quant_sapata' , quant_escada_longa = '$quant_escada_longa' ,quant_escada_curta = '$quant_escada_curta' ,frete_entrega = '$frete_entrega' , frete_retorno = '$frete_retorno', data_retirada = '$data_retirada' , data_retorno = '$data_retorno' , status = '$status_andaime', dias_locados = '$dias_locados', valor = '$valor_total'  WHERE id_andaime='$id_andaime'");

                
                $stmt->execute();

                
                //if(isset($_SESSION["onde_estou"])){
                //    header('location:'.$_SESSION["onde_estou"].'.php');
                //    die();
                //}
                //else {
                    header('location: create_andaime.php');
                 //   die();
               // }
                
                //header('location:'.$_SERVER["HTTP_REFERER"]);
               //echo $_SERVER["HTTP_REFERER"];
            }    
        }
    }
?> 