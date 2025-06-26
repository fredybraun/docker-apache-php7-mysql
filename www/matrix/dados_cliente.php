<?php
session_start();
require ('./topo2.php');
require ('./funcoes.php');
?>

<?php
//valida usuário esta logado, caso não, redireciona para loguin.
require('./db.php');
if(!isset($_SESSION["name"])){
	header("Location: login.php");
exit(); }

$_SESSION['active'] = 'cliente';
require('menu2.php');

//edita usuário 
if (isset($_GET['id_cliente'])) {
    $id = $_GET['id_cliente'];
    $stmt = $con->prepare("SELECT * FROM clientes WHERE id_cli='$id'");
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_cli, $nome_cli, $cpf_cli, $end_cli, $num_cli, $cid_cli, $tel_cli, $tel2_cli, $obs_cli, $contato_cli, $bairro_cli );
        $stmt->fetch(); 
		$tel_cli = str_replace(' ', '', $tel_cli);    
		$tel_cli = str_replace('-', '', $tel_cli); 
    }

} 
	if ($stmt2 = $con->prepare("SELECT nome_cidade FROM cidade WHERE id_cidade = '$cid_cli'")) {
		$stmt2->execute();
		$stmt2->store_result();
		$num_of_rows = $stmt2->num_rows;
		if ($stmt2->num_rows > 0) {
		$stmt2->bind_result($nome_cidade);
			$stmt2->fetch();
		}
	}
	
	?>

	<div class="container-fluid mt-2 col-md-12">
		<div class="row ">
			<div class="col-sm">
				<h4>Dados do cliente <?php echo $nome_cli;?></h4>
				<strong>Cliente: </strong><?php echo '<a href="dados_cliente.php?id_cliente='.$id_cli.'">'.$nome_cli.'</a>';?><br>
				<strong>CPF/CNPJ: </strong><?php echo $cpf_cli;?><br>			
				<strong>Endereço: </strong><?php echo $end_cli.', '.$num_cli.' - '.$bairro_cli.' - '.$nome_cidade;?><br>
				<a class="text-white" href="https://api.whatsapp.com/send?phone=55<?php echo $tel_cli;?>" target="_blank"><button type="button"class="btn btn-success">Whatsapp</button></a>
				<a href="https://maps.google.com/maps?q=<?php echo $end_cli.', '.$num_cli.','.$nome_cidade; ?>" target="_blank"><button type="button"class="btn btn-primary">Google Maps</button></a>
			</div>
			<div class="col-sm" style="margin-top: 40px;">
				<strong>Telefone: </strong><?php echo $tel_cli;?><br>
				<strong>Telefone: </strong><?php echo $tel2_cli;?><br>
				<strong>Contato: </strong><?php echo $contato_cli;?><br>	
				<strong>Observações: </strong><?php echo $obs_cli;?><br>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-sm">			
				<?php
					if ($stmt3 = $con->prepare("SELECT id_os, id_obra, id_status, valor_os FROM ordem_serv WHERE id_cli = ? ORDER BY COALESCE(id_obra, 'sem obra'), id_os DESC")) {
						$stmt3->bind_param("i", $id_cli);
						$stmt3->execute();
						$result = $stmt3->get_result();
						$num_of_rows = $result->num_rows;
					
						$current_obra = null;
						$total_por_obra = 0;
						$total_sem_obra = 0;
						$valor_total_cobranca = 0;
						
						while($row = $result->fetch_assoc()) {
						if (($row['id_obra'] === 0) || ($row['id_obra'] === null)) {
							$obra_atual = 'sem obra';
						} else {
							$obra_atual = $row['id_obra'];
						}

							//$obra_atual = $row['id_obra'] ?? 'sem obra';
							
							
							if ($current_obra !== $obra_atual) {
								if ($current_obra !== null) {
									echo '</tbody></table>';
									echo '<h5>Total para esta obra: R$ ' . number_format($total_por_obra, 2, ',', '.') . '</h5></br>';
									// if ($obra_atual === 'sem obra') {
									// 	echo '<p>Total das OS sem obra em aberto: R$ ' . number_format($total_sem_obra, 2, ',', '.') . '</p>';
									// }
								}
								$current_obra = $obra_atual;
								$total_por_obra = 0;

								if ($stmt2 = $con->prepare("SELECT nome_obra FROM obra_clientes WHERE id_obra = '$obra_atual'")) {
									$stmt2->execute();
									$stmt2->store_result();
									$num_of_rows = $stmt2->num_rows;
									if ($stmt2->num_rows > 0) {
									$stmt2->bind_result($nome_obra);
									$stmt2->fetch();
									}
								}
								
								echo '<h5>' . ($obra_atual === 'sem obra' ? 'Sem Obra' : 'Obra: ' . $nome_obra) . '</h5>';
								echo '<table class="table table-sm table-hover">';
								echo '<thead><tr>';
								echo '<th scope="col">OS</th>';
								echo '<th scope="col">Status</th>';
								echo '<th scope="col">Relação</th>';
								echo '<th scope="col">Valor</th>';
								echo '</tr></thead>';
								echo '<tbody>';
							}
							
							// Get status name
							$nome_status = '';
							if ($stmt4 = $con->prepare("SELECT nome_status FROM status WHERE id_status = ?")) {
								$stmt4->bind_param("i", $row['id_status']);
								$stmt4->execute();
								$stmt4->bind_result($nome_status);
								$stmt4->fetch();
								$stmt4->close();
							}
							
							// Add to total if status is 4
							if($row['id_status'] == 4) {
								$valor_total_cobranca += $row['valor_os'];
								$total_por_obra += $row['valor_os'];
								if ($obra_atual === 'sem obra') {
									$total_sem_obra += $row['valor_os'];
								}
							}
							
							echo '<tr>';
							echo '<td><a href="dados_os.php?id_os=' . $row['id_os'] . '">' . $row['id_os'] . '</a></td>';
							echo '<td>' . $nome_status . '</td>';
							echo '<td><a target="_blank" href="relacao.php?relacao=' . $row['id_os'] . '">Relação</a></td>';
							echo '<td>R$ ' . number_format($row['valor_os'], 2, ',', '.') . '</td>';
							echo '</tr>';
						}
						
						if ($current_obra !== null) {
							echo '</tbody></table>';
							echo '<h5>Total para esta obra: R$ ' . number_format($total_por_obra, 2, ',', '.') . '</h5></br>';
						}
						echo '</div>';
						echo '<div class="col-sm">';
						
						echo '<h5>Total geral das OS em COBRANÇA: R$ ' . number_format($valor_total_cobranca, 2, ',', '.') . '</h5>';
						echo '<a href="fechamento.php?id_cliente='.$id.'"><button class="btn btn-primary">Fechamento</button></a>';
						echo '<button class="btn btn-primary ml-1" onClick="history.go(-1)">Voltar</button>';
					}
		
				?>
			</div>
		</div>
	</div>
	</div>
	</body>
</html>