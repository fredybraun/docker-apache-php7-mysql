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

$_SESSION['active'] = 'Obra';
require('menu2.php');

//edita usuário 
if (isset($_GET['id_obra'])) {
    $id = $_GET['id_obra'];
    $stmt = $con->prepare("SELECT * FROM obra_clientes WHERE id_obra='$id'");
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_obra, $nome_obra, $endereco_obra, $id_cli_obra, $info_obra);
        $stmt->fetch();  
    }

} 
	if ($stmt2 = $con->prepare("SELECT nome_cli FROM clientes WHERE id_cli = '$id_cli_obra'")) {
        $stmt2->execute();  
        $stmt2->store_result();
        $num_of_rows = $stmt2->num_rows;
        if ($stmt2->num_rows > 0) {
            $stmt2->bind_result($nome_cli);
            $stmt2->fetch();
        }
	}

	?>

	<div class="container-fluid mt-2 col-md-12">
		<div class="row ">
			<div class="col-sm">
				<h4>Dados da Obra <?php echo $nome_obra;?></h4>
				<strong>Cliente: </strong><?php echo '<a href="dados_cliente.php?id_cliente='.$id_cli_obra.'">'.$nome_cli.'</a>';?><br>
				<strong>Endereço: </strong><?php echo $endereco_obra;?><br>
				<a href="https://maps.google.com/maps?q=<?php echo $endereco_obra; ?>" target="_blank"><button type="button"class="btn btn-primary">Google Maps</button></a></br>
                <?php
                if (isset($info_obra) && !empty($info_obra)) {
                    echo '<br><strong>Informações: </strong><br><textarea style="margin-top: 6px;" class="form-control" rows="10" readonly>' . $info_obra . '</textarea>';
                }
                ?>
            </div>  
		</div>
		<div class="row mt-5">
			<div class="col-sm">			
				<?php
					if ($stmt3 = $con->prepare("SELECT id_os, id_obra, id_status, valor_os FROM ordem_serv WHERE id_cli = ? AND id_obra = ? ORDER BY COALESCE(id_obra, 'sem obra'), id_os DESC")) {
						$stmt3->bind_param("ii", $id_cli_obra, $id_obra);
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
								echo '<a href="relatorio_obra.php?id_cli='.$id_cli_obra.'&id_obra='.$obra_atual.'" target="_blank"><button type="button"class="btn btn-primary">Relatório de itens</button></a>';
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