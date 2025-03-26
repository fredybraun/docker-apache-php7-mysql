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
			<div class="list_user">
				<a onclick="window.print();"><h1>Ordem de serviços abertas</h1></a>
				<div class="horizontal">
					 <table class="tabela">
					    <tr>
					      <td>Num OS</td> 		
					      <td>Cliente</td>
					      <td>Serviço</td>
					      <td>Data de abertura</td>
					      <td>Status</td>
					    </tr>

						<?php
							if ($stmt = $con->prepare('SELECT id_os, id_cli, id_func, id_serv, id_status, data_os, obs_os, valor_os, semana_os FROM ordem_serv WHERE id_status = "1" OR id_status = "2" OR id_status = "3" ORDER BY id_os DESC ')) {
								$stmt->execute();
								$stmt->store_result();
								$num_of_rows = $stmt->num_rows;
								if ($stmt->num_rows > 0) {
									$stmt->bind_result($id_os, $id_cli, $id_func, $id_serv, $id_status, $data_os, $obs_os, $valor_os, $semana);
									while ($stmt->fetch()) {
										$datetime1 = date_create($data_os);
										$datetime2 = date_create(date('Y-m-d'));
										$interval = date_diff($datetime1, $datetime2);
										//echo $interval->format('%a ');

										if ($interval->format('%a ') < 15){
											$cor = '#66ff66'; //verde
										}
										if (($interval->format('%a ') >= 15) && ($interval->format('%a ') < 30)){
											$cor = '#ffff66'; //amarelo
										}
										if ($interval->format('%a ') >= 30){
											$cor = '#ff6666';//vermelho
										}
										
										if(($semana == NULL) || ($semana == 0)){
											$agenda = '#ffff66';
										}
										else {$agenda = '#66ff66';}


						?>	
								    	<tr style="background:<?php echo $cor;?>">
										    <td style="background:<?php echo $agenda;?>"><?php echo $id_os; ?></td>
										    <?php
										    if ($stmt2 = $con->prepare("SELECT id_cli, nome_cli FROM clientes WHERE id_cli ='$id_cli'")) {
										    	$stmt2->execute();
												$stmt2->store_result();
												$num_of_rows2 = $stmt2->num_rows;
												if ($stmt2->num_rows > 0) {
													$stmt2->bind_result($id_cli, $nome_cli);
													while ($stmt2->fetch()) {
														echo "<td>".$nome_cli."</td>";
													}
												}
										    
										    }	
										    ?>
										    <?php
										    if ($stmt3 = $con->prepare("SELECT $id_serv, descricao_serv FROM tipo_servico WHERE id_serv ='$id_serv'")) {
										    	$stmt3->execute();
												$stmt3->store_result();
												$num_of_rows3 = $stmt3->num_rows;
												if ($stmt3->num_rows > 0) {
													$stmt3->bind_result($id_serv, $descricao_serv);
													while ($stmt3->fetch()) {
														echo "<td>".$descricao_serv."</td>";
													}
												}
										    
										    }	
										    ?>
										    <td><?php echo trocadatabarra($data_os); ?></td>
										    <?php
										    if ($stmt5 = $con->prepare("SELECT id_status, nome_status FROM status WHERE id_status ='$id_status'")) {
										    	$stmt5->execute();
												$stmt5->store_result();
												$num_of_rows5 = $stmt5->num_rows;
												if ($stmt5->num_rows > 0) {
													$stmt5->bind_result($id_status, $nome_status);
													while ($stmt5->fetch()) {
														echo "<td>".$nome_status."</td>";
													}
												}
										    
										    }	
										    ?>
											
										    <?php
										    		if($_SESSION['nivel'] == 1){

										    		
										    	?>	
										    	<td>
										        <a href="insert_os.php?deletar=<?php echo $id_os; ?>" onclick="return confirm('Tem certeza que deseja deletar esse registro?');">Excluir</a>
										    	</td>
										        <?php
										        }
										 		?>
										</tr>
										<?php    
								    }
								}
								$stmt->free_result();
							}
						?>


					</table>
				</div>
			</div>