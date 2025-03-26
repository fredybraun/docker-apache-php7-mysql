<?php
	session_start();
	require('db.php');
	require ('./funcoes.php');
?>
<style type="text/css">
	table, th, td {
  border: 1px solid gray;
}
</style>

<?php
	if (isset($_POST['semana'])) {
		$semana_get = $_POST['semana'];
	}
	if (isset($_POST['func'])) {
		$func_get = $_POST['func'];
	}	


	if ($stmt = $con->prepare("SELECT id_func, nome_func FROM funcionario WHERE id_func = '$func_get'")) {
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
		$stmt->bind_result($id_fun, $nome_fun);
			while ($stmt->fetch()) {
				$nome_funcionario = $nome_fun;		
			}
		}
		$stmt->free_result();
	}
?>


<div class="list_user">
	<a onclick="window.print();"><h1>Agenda de Serviços da semana <?php echo $semana_get;?></h1></a>
		<div class="horizontal">
			<h1><?php echo $nome_funcionario;?></h1>
			<table class="tabela">
				<tr>
			      <td>Num OS</td> 		
			      <td>Cliente</td>
			      <td>Status</td>
			      <td>Serviço</td>
			      <td>Agendamento</td>
			    </tr>

					<?php
								if ($semana_get) {
								    $stmt = $con->prepare("SELECT id_os, id_cli, id_status, id_serv, tempo_os, agendamento_os FROM ordem_serv WHERE semana_os='$semana_get' AND id_func = '$func_get' ORDER BY id_status");
								    $stmt->execute();
								    $stmt->store_result();
								    $num_of_rows = $stmt->num_rows;
								    if ($stmt->num_rows > 0) {
								        $stmt->bind_result($id_os, $id_cli_os, $id_status, $id_serv, $tempo, $agendamento);
								        while ($stmt->fetch()) {
								        	echo ' <tr>';
	                                 		echo '<td>'.$id_os.'</td>';
	                                 		
	                                 		if ($stmt2 = $con->prepare("SELECT id_cli, nome_cli FROM clientes WHERE id_cli = '$id_cli_os'")) {
					                            $stmt2->execute();
					                            $stmt2->store_result();
					                            $num_of_rows = $stmt2->num_rows;
					                            if ($stmt2->num_rows > 0) {
					                            	$stmt2->bind_result($id_cliente, $nome_cliente);
					                                while ($stmt2->fetch()) {
															echo '<td>'.$nome_cliente.'</td>';
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
															 echo '<td>'.$nome_status.'</td>';
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
															 echo '<td>'.$descricao_serv.'</td>';
														}
												}				                          
					                            $stmt2->free_result();
					                        }
					                        if(!($agendamento == NULL) && !($agendamento == '1970-01-01')){		 
												echo'<td>'.trocadatabarra($agendamento).'</td>';
											}
										echo ' </tr>';	
	                               		}        
								    }
								} 
								
							?>
					</div>
		</div>	
</div>			