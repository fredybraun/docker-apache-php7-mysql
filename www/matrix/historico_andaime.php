<?php
session_start();
$_SESSION["onde_estou"] = 'historico_andaime';
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
	$_SESSION['active'] = 'historico';
	require('menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
	<h3>Histórico de Locação de Equipamentos</h3>
		<table class="table table-striped">
		    <tread>
			    <tr>
			      <th scope="col">Num Locação</th> 		
			      <th scope="col">Cliente</th>
			      <th scope="col">Data da retirada</th>
			      <th scope="col">Data da retorno</th>
			      <th scope="col">Dias locados</th>
			      <th scope="col">Valor total</th>
			      <th scope="col">Imprimir</th>
			      <th scope="col">Editar</th>
			      <?php
			    	if($_SESSION['nivel'] == 1){
				  ?>	
			      <th scope="col">Excluir</th>
			      <?php
			        }
				  ?>
			    </tr>
			</tread>    

			<?php
				$valor_total = 0;
				if ($stmt = $con->prepare('SELECT id_andaime, id_cli, data_retirada, data_retorno, status, dias_locados, valor FROM andaimes WHERE status = "2" ORDER BY id_andaime DESC ')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
						$stmt->bind_result($id_andaime, $id_cli, $data_retirada, $data_retorno, $status, $dias_locados, $valor);
						while ($stmt->fetch()) {
							$valor_total = $valor_total + $valor;
							$datetime1 = date_create($data_retirada);
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
							
			
			?>	
					    	<tr>
							    <th scope="col"><a href="dados_andaime.php?id_andaime=<?php echo $id_andaime; ?>"><?php echo $id_andaime; ?></a></th>
							    <?php
							    if ($stmt2 = $con->prepare("SELECT id_cli, nome_cli FROM clientes WHERE id_cli ='$id_cli'")) {
							    	$stmt2->execute();
									$stmt2->store_result();
									$num_of_rows2 = $stmt2->num_rows;
									if ($stmt2->num_rows > 0) {
										$stmt2->bind_result($id_cli, $nome_cli);
										while ($stmt2->fetch()) {
											echo '<th scope="col">'.$nome_cli.'</th>';
										}
									}
							    
							    }	
							    ?>
							    <th scope="col"><?php echo trocadatabarra($data_retirada);?></th>
								<th scope="col"><?php echo trocadatabarra($data_retorno);?></th>
								<th scope="col"><?php echo $dias_locados;?></th>
								<th scope="col"><?php echo moeda_formato($valor);?></th>
								<th scope="col">
							    	<a target=”_blank” href="contrato_andaime.php?imprimir=<?php echo $id_andaime; ?>">Imprimir</a>
								</th>
							    <th scope="col">
							    	<a href="insert_andaime.php?editar=<?php echo $id_andaime; ?>">Editar</a>
								</th>
							    <?php
							    		if($_SESSION['nivel'] == 1){

							    		
							    	?>	
							    	<th scope="col">
							        <a href="insert_os.php?deletar=<?php echo $id_os; ?>" onclick="return confirm('Tem certeza que deseja deletar esse registro?');">Excluir</a>
							    	</th>
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
			<?php
				echo "Valor total: R$ " .moeda_formato($valor_total);
			?>
		</div>	
		</body>
</html>