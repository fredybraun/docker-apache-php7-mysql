<?php
session_start();
$_SESSION["onde_estou"] = 'instalacao_os';
require ('./topo2.php');
require ('./funcoes.php');
?>

<?php
//valida usuário esta logado, caso não, redireciona para loguin.
require('./db.php');
if(!isset($_SESSION["name"])){
header("Location: login.php");
exit(); }
?>
<?php
	$_SESSION['active'] = 'instalacao';
	require('menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
	<h3>Instalação</h3>
					 <table class="table table-sm">
					 	<thead>
						    <tr>
						      <th scope="col">Num OS</th> 		
						      <th scope="col">Cliente</th>
						      <th scope="col">Serviço</th>
						      <th scope="col">Responsável</th>
						      <th scope="col">Abertura</th>
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
							if ($stmt = $con->prepare('SELECT o.id_os, o.id_cli, c.nome_cli ,o.id_func, o.id_serv, o.id_status, o.data_os, o.obs_os, o.semana_os FROM ordem_serv o, clientes c WHERE o.id_status = "3" AND o.id_cli = c.id_cli ORDER BY o.id_os ASC' )) {
								$stmt->execute();
								$stmt->store_result();
								$num_of_rows = $stmt->num_rows;
								if ($stmt->num_rows > 0) {
									$stmt->bind_result($id_os, $id_cli, $nome_cli , $id_func, $id_serv, $id_status, $data_os, $obs_os, $semana);
									while ($stmt->fetch()) {
										$datetime1 = date_create($data_os);
										$datetime2 = date_create(date('Y-m-d'));
										$interval = date_diff($datetime1, $datetime2);
										$diferenca = $interval->format('%a ');

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
										    <th scope="row"  style="background:<?php echo $agenda;?>"><a href="dados_os.php?id_os=<?php echo $id_os; ?>"><?php echo $id_os; ?></a></th>
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
										    <?php
										    if ($stmt4 = $con->prepare("SELECT id_func, nome_func FROM funcionario WHERE id_func ='$id_func'")) {
										    	$stmt4->execute();
												$stmt4->store_result();
												$num_of_rows4 = $stmt4->num_rows;
												if ($stmt4->num_rows > 0) {
													$stmt4->bind_result($id_func, $nome_func);
													while ($stmt4->fetch()) {
														echo "<td>".$nome_func."</td>";
													}
												}
										    
										    }	
										    ?>
										    <td><?php echo trocadatabarra($data_os)." [".$diferenca."]"; ?></td>
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