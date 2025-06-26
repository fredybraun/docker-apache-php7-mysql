<?php
	session_start();
	require('db.php');
    require ('funcoes.php');

    

	// insere OS nova
	if(isset($_POST['status'])){
        $status = $_POST['status'];
		$cliente = '';
		$servico = '';
        $funcionario = '';
        $status = '';
        $data = '';
        $observacoes ='';
        $valor = '';
        $tempo = '';
        $semana = '';
        $agendamento = '';
        $id = '';
        $obs_cobranca = '';

        if($status = "create") {
        	if(isset($_POST['cli_os'], $_POST['serv_os'], $_POST['status_os'], $_POST['os_data_inicio'])){
                list($cliente, $obra) = explode("-", $_POST['cli_os'], 2);
                //$cliente = $_POST['cli_os'];
                $servico = $_POST['serv_os'];
                $funcionario = $_POST['func_os'];
                $status_os = $_POST['status_os'];
                $data = trocadatatraco($_POST['os_data_inicio']);
                $observacoes = $_POST['serv_obs'];
                $valor = moeda($_POST['os_valor']);
                if(!$valor){
                    $valor = '0.0';
                }
                $tempo = $_POST['os_tempo'];
                $semana = $_POST['os_semana'];
                if(isset($_POST['os_agendamento'])){
                    $agendamento = trocadatatraco($_POST['os_agendamento']);
                }else{$agendamento = NULL;}
                $obs_cobranca = $_POST['obs_cobranca'];
                
                
                
                $stmt = $con->prepare("INSERT INTO ordem_serv (id_cli, id_obra, id_func, id_serv, id_status, data_os, obs_os, valor_os, tempo_os, semana_os, agendamento_os, obs_cobranca) VALUES ('$cliente', '$obra', '$funcionario', '$servico', '$status_os', '$data', '$observacoes', '$valor', '$tempo', '$semana', '$agendamento', '$obs_cobranca')");
                $stmt->execute();
                $_SESSION['message'] = "Dados adicionados"; 
                sleep(2);
                
                header('location: create_os.php');
            }   
            
        }

	}
//edita usuário 
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $stmt = $con->prepare("SELECT id_os, id_cli, id_obra, id_func, id_serv, id_status, data_os, obs_os, valor_os, tempo_os, semana_os, agendamento_os, obs_cobranca FROM ordem_serv WHERE id_os='$id'");
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_os, $id_cli_os,  $id_obra_os, $id_func_os, $id_serv_os, $id_status_os, $data_os, $obs_os, $valor, $tempo, $semana, $agendamento, $obs_cobranca);
        $stmt->fetch();          
    }
} 
//deleta usuário    
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $stmt = $con->prepare("DELETE FROM ordem_serv WHERE id_os='$id'");
    $stmt->execute();
    header('location: create_os.php');
}   
?>	

<?php
//valida usuário esta logado, caso não, redireciona para loguin.
if(!isset($_SESSION["name"])){
header("Location: login.php");
exit(); }
?>

<?php
    $_SESSION['active'] = 'os';
    require ('./topo2.php');
    require('menu2.php');
?>

        <div class="container-fluid mt-2 col-md-12">
        <h3>Editar de Ordem de Serviço N°: <?php echo $id_os;?></h3>
            <div class="row">
                <div class="col-sm">
                    <form action="atualiza_os.php" method="post">
                        <div class="form-group">
                            <label for="fos" class="row pl-3">Cliente</label>
                            <select required class="row select2" id="cli_os" name="cli_os" style="width: 75%;">
                                <option value=""></option>
                                <?php
                                    if ($stmt = $con->prepare('SELECT clientes.id_cli, clientes.nome_cli, obra_clientes.nome_obra, obra_clientes.id_obra 
												   FROM `clientes` 
												   LEFT JOIN obra_clientes ON clientes.id_cli = obra_clientes.id_cli 
												   ORDER BY clientes.nome_cli ASC')) {
                                        $stmt->execute();
                                        $stmt->store_result();
                                        $num_of_rows = $stmt->num_rows;
                                        if ($stmt->num_rows > 0) {
                                        $stmt->bind_result($id_cli, $nome_cli, $nome_obra, $id_obra);
                                            while ($stmt->fetch()) {
                                                if ($id_cli == $id_cli_os) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                                if ($id_obra == NULL) {
                                                    echo '<option '.$selected.' value="'.$id_cli.'-0">'.$nome_cli.'</option>';
                                                }else{
                                                    echo '<option  '.$selected.' value="'.$id_cli.'-'.$id_obra.'">'.$nome_cli.' | OBRA: '.$nome_obra.'</option>';
                                                }
                                                
                                            }
                                        }
                                        $stmt->free_result();
                                    }
                                ?>
                            </select>
                        </div> 
                        <div class="form-group">   
                            <label for="fos">Serviço</label>
                            <select required class="form-control w-75" id="serv_os" name="serv_os">
                                <option value=""></option>
                            <?php
                                if ($stmt = $con->prepare('SELECT id_serv, descricao_serv FROM tipo_servico ')) {
                                    $stmt->execute();
                                    $stmt->store_result();
                                    $num_of_rows = $stmt->num_rows;
                                    if ($stmt->num_rows > 0) {
                                    $stmt->bind_result($id_serv, $nome_serv);
                                        while ($stmt->fetch()) {
                                            if($id_serv == $id_serv_os){
                                                echo '<option selected value="'.$id_serv.'">'.$nome_serv.'</option>';
                                            }
                                            else {
                                                echo '<option value="'.$id_serv.'">'.$nome_serv.'</option>';
                                            }
                                            
                                        }
                                    }
                                    $stmt->free_result();
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fos">Responsável</label>
                            <select required class="form-control w-75" id="func_os" name="func_os">
                                <option value=""></option>
                                <?php
                                    if ($stmt = $con->prepare('SELECT id_func, nome_func FROM funcionario WHERE status = 1 ORDER BY nome_func')) {
                                        $stmt->execute();
                                        $stmt->store_result();
                                        $num_of_rows = $stmt->num_rows;
                                        if ($stmt->num_rows > 0) {
                                        $stmt->bind_result($id_func, $nome_func);
                                            while ($stmt->fetch()) {
                                                if($id_func == $id_func_os){
                                                    echo '<option selected value="'.$id_func.'">'.$nome_func.'</option>';
                                                }
                                                else {
                                                    echo '<option value="'.$id_func.'">'.$nome_func.'</option>';
                                                }
                                            }
                                        }
                                        $stmt->free_result();
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fos">Status</label>
                            <select required class="form-control w-75" id="status_os" name="status_os">
                                <option value=""></option>
                                <?php
                                    if ($stmt = $con->prepare('SELECT id_status, nome_status FROM status WHERE id_status <> 5')) {
                                        $stmt->execute();
                                        $stmt->store_result();
                                        $num_of_rows = $stmt->num_rows;
                                        if ($stmt->num_rows > 0) {
                                        $stmt->bind_result($id_status, $nome_status);
                                            while ($stmt->fetch()) {
                                                if($id_status == $id_status_os){
                                                    echo '<option selected value="'.$id_status.'">'.$nome_status.'</option>';
                                                }
                                                else {
                                                    echo '<option value="'.$id_status.'">'.$nome_status.'</option>';
                                                }
                                                
                                            }
                                        }
                                        $stmt->free_result();
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fos">Data</label>
                            <input required class="form-control w-75" type="text" id="os_data_inicio"  name="os_data_inicio" value="<?php echo trocadatabarra($data_os);?>">
                            <script type="text/javascript">
                                            $('#status_os').change(function() {$('#os_data_inicio').val('')});
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="fos">Valor: </label>
                            <input type="text" class="form-control w-75" id="os_valor"  name="os_valor" onkeypress='$(this).mask("###0,00", {reverse: true});' value="<?php $valor_virgula = $valor = str_replace('.', ',',$valor);echo $valor_virgula;?>">
                        </div>
                        <div class="form-group">
                            <label for="fos">Observações</label>
                            <textarea id="serv_obs" class="form-control w-75" name="serv_obs" placeholder="Observações..."><?php echo $obs_os;?></textarea>
                        </div>                    
                        <input type="hidden" name="status" value="update">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                </div>    
                <div class="col-sm">
                    <h3>Tempo e agendamento</h3>
                    <div class="form-group">
                        <label for="fos">Tempo estimado</label>
                        <input type="range" class="form-control w-75" min="0" max="5" step="0.25" value="<?php echo $tempo;?>" class="slider" id="os_tempo" name="os_tempo"><br>
                          Pontos: <span id="show_tempo"></span>
                    </div>
                    <script>
                        var slider = document.getElementById("os_tempo");
                        var output = document.getElementById("show_tempo");
                        output.innerHTML = slider.value;

                        slider.oninput = function() {
                          output.innerHTML = this.value;
                        }

                    </script>
                    <div class="form-group">
                        <label for="fos">Semana</label>
                        <select class="form-control w-75" id="os_semana" name="os_semana">
                            <option value="0">Selecione a semana</option>
                            <?php

                            if ($stmt = $con->prepare('SELECT ano_vigente FROM configuracoes')) {
                                $stmt->execute();
                                $stmt->store_result();
                                $num_of_rows = $stmt->num_rows;
                                if ($stmt->num_rows > 0) {
                                $stmt->bind_result($ano_vigente);
                                $stmt->fetch();
                                }
                                $stmt->free_result();
                            }

                                $ano = $ano_vigente;
                                $data_hoje = date('Y-m-d');
                                $semana_select = getWeekNumber($data_hoje) - 2;
                               for ($i=$semana_select; $i <= 52 ; $i++) { 
                                    //$week_array = getStartAndEndDate($ano,$i);
                                    $semana_loop = $i.'-'.$ano;
                                    if($semana_loop == $semana){
                                        echo '<option selected value="'.$i.'-'.$ano.'">'.$i.'-'.$ano.'</option>';
                                    }
                                    else {echo '<option value="'.$i.'-'.$ano.'">'.$i.'-'.$ano.'</option>';}
                                    
                                }
                               for ($i=1; $i < $semana_select ; $i++) { 
                                    //$week_array = getStartAndEndDate($ano,$i);
                                    $semana_loop = $i.'-'.$ano;
                                    if($semana_loop == $semana){
                                        echo '<option selected value="'.$i.'-'.$ano.'">'.$i.'-'.$ano.'</option>';
                                    }
                                    else {echo '<option value="'.$i.'-'.$ano.'">'.$i.'-'.$ano.'</option>';}
                                    
                                }

                            ?>

                        </select>
                        <a id="result"></a>
                    </div>    
                     <div class="form-group">    
                        <label for="fos">Agendamento</label>
                        <input type="text" class="form-control w-75" id="os_agendamento"  name="os_agendamento" value="<?php echo trocadatabarra($agendamento);?>">
                    </div>  
                    <div class="form-group">
                        <label for="fobs">Observações de cobrança</label>
                        <textarea class="form-control w-75" id="obs_cobranca" name="obs_cobranca" placeholder="Observações de cobrança..."><?php echo $obs_cobranca;?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"name="insert" >Atualizar</button>
                        <button type="button" class="btn btn-primary"onClick="history.go(-1)">Voltar</butto>
                    </div>  
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>	
			<script>
				$(document).ready(function() {
   					 $('.select2').select2();
				});
			</script>	
    </body>
</html>
           