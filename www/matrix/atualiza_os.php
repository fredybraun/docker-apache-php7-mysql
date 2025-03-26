<?php
    session_start();
    require('db.php');
    require ('funcoes.php');

    if(isset($_POST['status'])){
        $status = $_POST['status'];
        
        $cliente = '';
        $servico = '';
        $funcionario = '';
        $status = '';
        $data = '';
        $observacoes ='';
        $tempo = '';
        $semana = '';
        $agendamento = '';
        $id = '';
        $obs_cobranca = '';
        if($status = 'update') {
            if(isset($_POST['id'], $_POST['cli_os'], $_POST['serv_os'], $_POST['func_os'], $_POST['status_os'], $_POST['os_data_inicio'], $_POST['serv_obs'])){
                list($cliente, $obra) = explode("-", $_POST['cli_os'], 2);
                //$cliente = $_POST['cli_os'];
                $servico = $_POST['serv_os'];
                $funcionario = $_POST['func_os'];
                $data = trocadatatraco($_POST['os_data_inicio']);
                $observacoes = $_POST['serv_obs'];
                $id = $_POST['id'];
                $status = $_POST['status_os'];
                $valor = moeda($_POST['os_valor']);
                $tempo = $_POST['os_tempo'];
                $semana = $_POST['os_semana'];
                if(isset($_POST['os_agendamento'])){
                    $agendamento = trocadatatraco($_POST['os_agendamento']);
                }else{$agendamento = null;}
                
                $obs_cobranca = $_POST['obs_cobranca'];

                if($status == 6){
                    $stmt = $con->prepare("UPDATE ordem_serv SET id_cli='$cliente', id_obra='$obra', id_func='$funcionario',id_serv='$servico',id_status='$status', obs_os='$observacoes', valor_os = '$valor' , tempo_os = '$tempo', semana_os = '$semana', agendamento_os = '$agendamento' , obs_cobranca = '$obs_cobranca' WHERE id_os='$id'");
                }
                if($status == 1){
                    $stmt = $con->prepare("UPDATE ordem_serv SET id_cli='$cliente', id_obra='$obra', id_func='$funcionario',id_serv='$servico',id_status='$status', data_os ='$data', obs_os='$observacoes', valor_os = '$valor' , tempo_os = '$tempo' , semana_os = '$semana', agendamento_os = '$agendamento' , obs_cobranca = '$obs_cobranca' WHERE id_os='$id'");
                }
                if($status == 2){
                    $stmt = $con->prepare("UPDATE ordem_serv SET id_cli='$cliente', id_obra='$obra', id_func='$funcionario',id_serv='$servico',id_status='$status', data_os_medida ='$data', obs_os='$observacoes', valor_os = '$valor' , tempo_os = '$tempo' , semana_os = '$semana', agendamento_os = '$agendamento' , obs_cobranca = '$obs_cobranca' WHERE id_os='$id'");
                }
                if($status == 3){
                    $stmt = $con->prepare("UPDATE ordem_serv SET id_cli='$cliente', id_obra='$obra', id_func='$funcionario',id_serv='$servico',id_status='$status', data_os_montagem ='$data', obs_os='$observacoes', valor_os = '$valor' , tempo_os = '$tempo' , semana_os = '$semana', agendamento_os = '$agendamento' , obs_cobranca = '$obs_cobranca' WHERE id_os='$id'");
                }
                if($status == 4){
                    $stmt = $con->prepare("UPDATE ordem_serv SET id_cli='$cliente', id_obra='$obra', id_func='$funcionario',id_serv='$servico',id_status='$status', data_os_instalacao ='$data', obs_os='$observacoes', valor_os = '$valor' , tempo_os = '$tempo' , semana_os = '$semana', agendamento_os = '$agendamento' , obs_cobranca = '$obs_cobranca' WHERE id_os='$id'");
                }
                if($status == 5){
                    $stmt = $con->prepare("UPDATE ordem_serv SET id_cli='$cliente', id_obra='$obra', id_func='$funcionario',id_serv='$servico',id_status='$status', data_os_cobranca ='$data', obs_os='$observacoes', valor_os = '$valor' , tempo_os = '$tempo' , semana_os = '$semana', agendamento_os = '$agendamento' , obs_cobranca = '$obs_cobranca' WHERE id_os='$id'");
                }
                if($status == 7){
                    $stmt = $con->prepare("UPDATE ordem_serv SET id_cli='$cliente', id_obra='$obra', id_func='$funcionario',id_serv='$servico',id_status='$status', obs_os='$observacoes', valor_os = '$valor' , tempo_os = '$tempo', semana_os = '$semana', agendamento_os = '$agendamento' , obs_cobranca = '$obs_cobranca' WHERE id_os='$id'");
                }
    
                $stmt->execute();

                
                if(isset($_SESSION["onde_estou"])){
                    header('location:'.$_SESSION["onde_estou"].'.php');
                    die();
                }
                else {
                    header('location: create_os.php');
                    die();
                }
                
                //header('location:'.$_SERVER["HTTP_REFERER"]);
               //echo $_SERVER["HTTP_REFERER"];
            }    
        }
    }
?> 