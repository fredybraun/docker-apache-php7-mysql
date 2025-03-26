<?php
session_start();
require ('./topo2.php');
require ('./funcoes.php');
$_SESSION["onde_estou"] = 'cobranca_os';
?>

<?php
//valida usuário esta logado, caso não, redireciona para loguin.
require('./db.php');
if(!isset($_SESSION["name"])){
header("Location: login.php");
die();
exit(); }
?>
<?php
	$_SESSION['active'] = 'cobranca';
	require('menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
	<h3>Cobranças</h3>
		 <div class="container-fluid">
		    <div class="row bg-secondary text-white  w-100">	
		      	<div class="col">Cliente com serviço em andamento. (Cobrança + OS aberta)</div>
		    </div>	
			<?php
				if ($stmt = $con->prepare('SELECT DISTINCT id_cli, nome_cli FROM clientes WHERE id_cli IN (SELECT id_cli FROM `ordem_serv` WHERE id_status = 4) AND id_cli IN (SELECT id_cli FROM `ordem_serv` WHERE id_status BETWEEN 1 AND 3)')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
						$stmt->bind_result($id_cli, $nome_cli);
						while ($stmt->fetch()) {
			?>
					    	<div class="">
							    <div class=""><a href="dados_cliente.php?id_cliente=<?php echo $id_cli; ?>"><?php echo $nome_cli; ?></a></div>
							</div>
							<?php    
					    }
					}
					$stmt->free_result();
				}
			?>


		</div>
</div>	
<div class="container-fluid mt-2 col-md-12">
	<table class="table">
	 	<tread>
	 		<tr>
		      <th class="col-1">OS</th> 
			  <th class="col-1"></th> 
		      <th class="col-4">Cliente</th>
		      <th class="col-2">Valor</th>
		      <th class="col-3">Instalação - Dias</th>
		      <th class="col-1">Status</th>
		      <th class="col-1">Editar</th>
		      <?php
		    	if($_SESSION['nivel'] == 1){
			  ?>	
		      <th class="col">Excluir</th>
		      <?php
		        }
			  ?>
		    </tr> 
		</tread>
		<tbody>
						<?php
							if ($stmt = $con->prepare('SELECT o.id_os, o.id_cli, c.nome_cli ,o.id_func, o.id_serv, o.id_status, o.data_os_instalacao, o.obs_os, o.obs_cobranca FROM ordem_serv o, clientes c WHERE o.id_status = "4" AND o.id_cli = c.id_cli ORDER BY c.nome_cli ASC')) {
								$stmt->execute();
								$stmt->store_result();
								$num_of_rows = $stmt->num_rows;
								if ($stmt->num_rows > 0) {
									$stmt->bind_result($id_os, $id_cli, $nome_cli, $id_func, $id_serv, $id_status, $data_os_instalacao, $obs_os, $obs_cobranca);
									while ($stmt->fetch()) {
										$datetime1 = date_create($data_os_instalacao);
										$datetime2 = date_create(date('Y-m-d'));
										$interval = date_diff($datetime1, $datetime2);
										$diferenca = $interval->format('%a ');

										if ($interval->format('%a ') < 15){
											$status = 'Em dia';
											$badge = 'badge-success';
										}
										if (($interval->format('%a ') >= 15) && ($interval->format('%a ') < 30)){
											
											$status = 'Alerta';
											$badge = 'badge-warning';
										}
										if ($interval->format('%a ') >= 30){
											$status = 'Atrasado';
											$badge = 'badge-danger';
										}
						?>
								    	<tr>
										    <td class="col-1">
												<a href="dados_os.php?id_os=<?php echo $id_os; ?>">
													<?php 
														echo '<span style= "width: 60px;  background-color: #dbdbdb" class=" w-110 badge badge-light">';
														echo $id_os ; 
														if ($obs_cobranca){echo ' <span class="badge badge-info">OBS</span>';};
														echo '</span>'; 
														
													?>
													
												</a>
											</td>
											<td scope="row">
												<span style= "width: 80px" class="badge <?php echo $badge; ?> w-110 "><?php echo $status; ?></span>
											</td>			
										    <?php
										    if ($stmt2 = $con->prepare("SELECT id_cli, nome_cli FROM clientes WHERE id_cli ='$id_cli'")) {
										    	$stmt2->execute();
												$stmt2->store_result();
												$num_of_rows2 = $stmt2->num_rows;
												if ($stmt2->num_rows > 0) {
													$stmt2->bind_result($id_cli, $nome_cli);
													while ($stmt2->fetch()) {
														echo '<td class="col-4"><a href="dados_cliente.php?id_cliente='.$id_cli.'">'.$nome_cli.'</a></td>';
													}
												}
										    
										    }	
										    ?>
										    <?php
										    if ($stmt3 = $con->prepare("SELECT valor_os FROM ordem_serv WHERE id_os ='$id_os'")) {
										    	$stmt3->execute();
												$stmt3->store_result();
												$num_of_rows3 = $stmt3->num_rows;
												if ($stmt3->num_rows > 0) {
													$stmt3->bind_result($valor_os);
													while ($stmt3->fetch()) {
														echo '<td> R$ '.moeda_formato($valor_os).'</td>';
													}
												}
										    
										    }	
										    ?>
										    <td class="col-3"><?php echo trocadatabarra($data_os_instalacao)." -".$diferenca; ?></td>


										   	 <td class="col-1">
										    	<spam class="badge badge-primary"><a class="text-white" target=”_blank” href="relacao.php?relacao=<?php echo $id_os; ?>">Relação</a></spam>
											</td>
										    <td class="col-1">
										    	<spam class="badge badge-primary"><a class="text-white" href="insert_os.php?editar=<?php echo $id_os; ?>">Editar</a></spam>
											</td>
										    <?php
										    		if($_SESSION['nivel'] == 1){

										    		
										    	?>	
										    	<td class="col-1">
										        <spam class="badge badge-primary"><a class="text-white" href="insert_os.php?deletar=<?php echo $id_os; ?>" onclick="return confirm('Tem certeza que deseja deletar esse registro?');">Excluir</a></spam>
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

		</tbody>				
	</table>
</div>	
</body>
</html>