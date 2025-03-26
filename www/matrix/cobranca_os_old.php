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
		 <table class="table table-sm">
		    <thead>
		    	<tr>		
		      		<td>Cliente com serviço em andamento. (Cobrança + outras OS)</td>
		    	</tr>
		    </thead>	
			<?php
				if ($stmt = $con->prepare('SELECT DISTINCT id_cli, nome_cli FROM clientes WHERE id_cli IN (SELECT id_cli FROM `ordem_serv` WHERE id_status = 4) AND id_cli IN (SELECT id_cli FROM `ordem_serv` WHERE id_status BETWEEN 1 AND 3)')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
						$stmt->bind_result($id_cli, $nome_cli);
						while ($stmt->fetch()) {
			?>
					    	<tr>
							    <td><a href="dados_cliente.php?id_cliente=<?php echo $id_cli; ?>"><?php echo $nome_cli; ?></a></td>
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
<div class="container-fluid mt-2 col-md-12">
	<h3>Cobranças</h3>
					 <table class="table table-sm">
					 	<thead>
						    <tr>
						      <th scope="col">Num OS</th> 		
						      <th scope="col">Cliente</th>
						      <th scope="col">Serviço</th>
						      <th scope="col">Responsável</th>
						      <th scope="col">Instalação</th>
						      <th scope="col">Observações</th>
						      <th scope="col">Status</th>
						      <th scope="col">Editar</th>
						      <?php
						    	if($_SESSION['nivel'] == 1){
							  ?>	
						      <th scope="col">Excluir</th>
						      <?php
						        }
							  ?>
						     
						    </tr>
						</thead>
						<?php
							if ($stmt = $con->prepare('SELECT o.id_os, o.id_cli, c.nome_cli ,o.id_func, o.id_serv, o.id_status, o.data_os_instalacao, o.obs_os FROM ordem_serv o, clientes c WHERE o.id_status = "4" AND o.id_cli = c.id_cli ORDER BY c.nome_cli ASC')) {
								$stmt->execute();
								$stmt->store_result();
								$num_of_rows = $stmt->num_rows;
								if ($stmt->num_rows > 0) {
									$stmt->bind_result($id_os, $id_cli, $nome_cli, $id_func, $id_serv, $id_status, $data_os_instalacao, $obs_os);
									while ($stmt->fetch()) {
										$datetime1 = date_create($data_os_instalacao);
										$datetime2 = date_create(date('Y-m-d'));
										$interval = date_diff($datetime1, $datetime2);
										$diferenca = $interval->format('%a ');

										if ($interval->format('%a ') < 7){
											$cor = '#66ff66'; //verde
										}
										if (($interval->format('%a ') >= 7) && ($interval->format('%a ') < 15)){
											$cor = '#ffff66'; //amarelo
										}
										if ($interval->format('%a ') >= 15){
											$cor = '#ff6666';//vermelho
										}
						?>
								    	<tr style="background:<?php echo $cor;?>">
										    <th scope="row" ><a class="text-dark href="dados_os.php?id_os=<?php echo $id_os; ?>"><?php echo $id_os; ?></a></th>
										    <?php
										    if ($stmt2 = $con->prepare("SELECT id_cli, nome_cli FROM clientes WHERE id_cli ='$id_cli'")) {
										    	$stmt2->execute();
												$stmt2->store_result();
												$num_of_rows2 = $stmt2->num_rows;
												if ($stmt2->num_rows > 0) {
													$stmt2->bind_result($id_cli, $nome_cli);
													while ($stmt2->fetch()) {
														echo '<td><a class="text-dark" href="dados_cliente.php?id_cliente='.$id_cli.'">'.$nome_cli.'</a></td>';
													}
												}
										    
										    }	
										    ?>
										    <?php
										    if ($stmt3 = $con->prepare("SELECT id_serv, descricao_serv FROM tipo_servico WHERE id_serv ='$id_serv'")) {
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
										    
										    <?php
										    if ($stmt3 = $con->prepare("SELECT valor_os FROM ordem_serv WHERE id_os ='$id_os'")) {
										    	$stmt3->execute();
												$stmt3->store_result();
												$num_of_rows3 = $stmt3->num_rows;
												if ($stmt3->num_rows > 0) {
													$stmt3->bind_result($valor_os);
													while ($stmt3->fetch()) {
														echo "<td> R$ ".moeda_formato($valor_os)."</td>";
													}
												}
										    
										    }	
										    ?>
										    <td><?php echo trocadatabarra($data_os_instalacao)." -".$diferenca; ?></td>


										   	<td><?php echo $obs_os; ?></td>
										   	 <td>
										    	<a target=”_blank” href="relacao.php?relacao=<?php echo $id_os; ?>">Relação</a>
											</td>
										    <td>
										    	<a href="insert_os.php?editar=<?php echo $id_os; ?>">Editar</a>
											</td>
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
		</body>
</html>