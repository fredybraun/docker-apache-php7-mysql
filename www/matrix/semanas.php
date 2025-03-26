<?php
session_start();
$_SESSION["onde_estou"] = 'semanas';
require ('./topo2.php');
require ('./funcoes.php');

//CORES
$laranja = '#ff6600';
$verde = '#80ff00';
$branco = 'white';


?>


<?php
//valida usuário esta logado, caso não, redireciona para loguin.
require('./db.php');
if(!isset($_SESSION["name"])){
header("Location: login.php");
exit(); }
?>
<?php
	$_SESSION['active'] = 'agendamento';
	require('menu2.php');
	$data_agendamento = date("Y-m-d");


	$stmt = $con->prepare("SELECT ano_vigente FROM configuracoes");
				    $stmt->execute();
				    $stmt->store_result();
				    $num_of_rows = $stmt->num_rows;
				    if ($stmt->num_rows > 0) {
				    	$stmt->bind_result($ano_vigente);
				    	while ($stmt->fetch()) {
				    		$ano = $ano_vigente;
				    	}
				    }
	
	//$ano = '2021';
	$tempo_total_marni = 0;
	$tempo_total_daian = 0;
	$tempo_total_luis = 0;
	$tempo_total_joao = 0;
	$tempo = 0;

	if (isset($_GET['semana'])) {
		$semana_get = $_GET['semana'];
	}
	else {
		$data_hoje2 = time();
		$semana_atual= idate('W', $data_hoje2);
		$semana_get = $semana_atual.'-'.$ano;
	}
	

?>
		
<div class="container-fluid mt-2 col-md-12">
	<h3><span class="badge badge-info">Ano Vigente: <?php  echo $ano;?></span></h3>
    <div class="btn-group" role="group">
    	<?php
    		for ($i=01; $i <= 27 ; $i++) { 
    			$semana_loop = $i.'-'.$ano;
    			if($semana_get == $semana_loop){
    				echo '<a href="semanas.php?semana='.$i.'-'.$ano.'"><button type="button" class="btn btn-primary" >'.$i.'</button></a>';	
    			}
    			else{
    				echo '<a href="semanas.php?semana='.$i.'-'.$ano.'"><button type="button" class="btn btn-secundary" >'.$i.'</button></a>';
    			}
    			
    		}
    	?> 
	</div> 
	<div class="btn-group" role="group">
    	<?php
    		for ($i=28; $i <= 52 ; $i++) { 
    			$semana_loop = $i.'-'.$ano;
    			if($semana_get == $semana_loop){
    				echo '<a href="semanas.php?semana='.$i.'-'.$ano.'"><button type="button" class="btn btn-primary" >'.$i.'</button></a>';	
    			}
    			else{
    				echo '<a href="semanas.php?semana='.$i.'-'.$ano.'"><button type="button" class="btn btn-secundary" >'.$i.'</button></a>';
    			}
    			
    		}
    	?> 
	</div> 
</div>
<div class="container-fluid mt-2 col-md-12 ">	
<?php
	$stmt1 = $con->prepare("SELECT id_func, nome_func FROM funcionario WHERE agenda = 1 ORDER BY nome_func ASC");
    $stmt1->execute();
    $stmt1->store_result();
    $num_of_rows = $stmt1->num_rows;
    if ($stmt1->num_rows > 0) {
    	$stmt1->bind_result($id_func, $nome_func);
    	while ($stmt1->fetch()) {
    	?>
 		<h3><?php echo $nome_func;?></h3>
 		<div class="container-fluid">
  		<div class="row bg-secondary text-white w-75">
		    <div class="col-1">OS</div>
    		<div class="col-5">Cliente</div>
    		<div class="col-2">Status</div>
    		<div class="col-2">Serviço</div>
    		<div class="col-1">Tempo</div>
  		</div></div>
    	<?php	
    		if ($semana_get) {
				    $stmt = $con->prepare("SELECT id_os, id_cli, id_status, id_serv, tempo_os, agendamento_os FROM ordem_serv WHERE semana_os='$semana_get' AND id_func = '$id_func' ORDER BY id_status");
				    $stmt->execute();
				    $stmt->store_result();
				    $num_of_rows = $stmt->num_rows;
				    if ($stmt->num_rows > 0) {
				        $stmt->bind_result($id_os, $id_cli_os, $id_status, $id_serv, $tempo, $agendamento);
				        while ($stmt->fetch()) {
                     		echo '<div class="row bg-light w-75"><div class="col-1"><a class="text-dark" href="dados_os.php?id_os='.$id_os.'">'.$id_os.'</a></div>';
                     		switch ($id_status){
                     			case 1 :
                     				$color  = "bg-warning";
                     				$text = "text-dark";
                     			break;
                     			
                     			case 2 :
                     				$color  = "bg-warning";
                     				$text = "text-dark";
                     			break;	

                     			case 3 :
                     				$color  = "bg-warning";
                     				$text = "text-dark";
                     			break;

                     			case 4 :
                     				$color  = "bg-success";
                     				$text = "text-white";
                     			break;

                     			case 5 :
                     				$color  = "bg-success";
                     				$text = "text-white";
                     			break;

                     			case 6 :
                     				$color  = "bg-secondary";
                     				$text = "text-white";
                     			break;
                     		}

                     		if ($stmt2 = $con->prepare("SELECT id_cli, nome_cli FROM clientes WHERE id_cli = '$id_cli_os'")) {
	                            $stmt2->execute();
	                            $stmt2->store_result();
	                            $num_of_rows = $stmt2->num_rows;
	                            if ($stmt2->num_rows > 0) {
	                            	$stmt2->bind_result($id_cliente, $nome_cliente);
	                                while ($stmt2->fetch()) {
											 
											 if(!($agendamento == NULL) && !($agendamento == '1970-01-01') && ($agendamento == $data_agendamento)){
											 	echo '<div class="col-5 bg-danger text-white"><a class="text-white" href="dados_cliente.php?id_cliente='.$id_cliente.'">'.$nome_cliente.'</a>';
												echo ' - '.trocadatabarra($agendamento).'</div>';
											}
											else {
												if(($id_status == 4) || ($id_status == 5)){
													$color2 = $verde;
												}
												else {$color2 = $branco;}

												echo '<div class="col-5 '.$color.'"><a class="'.$text.'" href="dados_cliente.php?id_cliente='.$id_cliente.'">'.$nome_cliente.'</a >';echo ' - '.trocadatabarra($agendamento).'</div>';
											}

										}
								}				                          
	                            $stmt2->free_result();
	                        }

	                        if ($stmt2 = $con->prepare("SELECT nome_status FROM status WHERE id_status = '$id_status'")) {
	                            $stmt2->execute();
	                            $stmt2->store_result();
	                            $num_of_rows = $stmt2->num_rows;
	                            if ($stmt2->num_rows > 0) {
	                            	$stmt2->bind_result($nome_status);
	                                while ($stmt2->fetch()) {
											 echo '<div class="col-2">'.$nome_status.'</div>';
										}
								}				                          
	                            $stmt2->free_result();
	                        }

	                        if ($stmt3 = $con->prepare("SELECT descricao_serv FROM tipo_servico WHERE id_serv = '$id_serv'")) {
	                            $stmt3->execute();
	                            $stmt3->store_result();
	                            $num_of_rows = $stmt3->num_rows;
	                            if ($stmt3->num_rows > 0) {
	                            	$stmt3->bind_result($descricao_serv);
	                                while ($stmt3->fetch()) {
											 echo '<div class="col-2">'.$descricao_serv.'</div>';
										}
								}				                          
	                            $stmt2->free_result();
	                        }
							echo '<div class="col-1">'.$tempo.'</div></div>';
							$tempo_total_luis = $tempo_total_daian + $tempo;
                   		}        
				    }
				} 
    	}
    }



?></div>	
	</body>
</html>
