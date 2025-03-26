<?php
session_start();
require ('./funcoes.php');
require('./db.php');


if (isset($_GET['relacao'])) {
	$id_os = $_GET['relacao'];
	$stmt_a = $con->prepare("SELECT id_os, id_cli, id_obra, id_func, id_serv, id_status, data_os, obs_os, valor_os, data_os FROM ordem_serv WHERE id_os='$id_os'");
			    $stmt_a->execute();
			    $stmt_a->store_result();
			    $num_of_rows = $stmt_a->num_rows;
			    if ($stmt_a->num_rows > 0) {
			        $stmt_a->bind_result($id_os, $id_cli_os, $id_obra_os, $id_func_os, $id_serv_os, $id_status_os, $data_os, $obs_os, $valor, $data_os);
			        	while ($stmt_a->fetch()) {
			        	if ($stmt_b = $con->prepare("SELECT nome_cli, end_cli, num_cli, cid_cli, tel_cli, tel2_cli, contato_cli, bairro_cli, obs_cli FROM clientes WHERE id_cli ='$id_cli_os'")) {
					    	$stmt_b->execute();
							$stmt_b->store_result();
							$num_of_rows2 = $stmt_b->num_rows;
							if ($stmt_b->num_rows > 0) {
								$stmt_b->bind_result($nome_cli, $end_cli, $num_cli, $cid_cli, $tel_cli, $tel2_cli, $contato_cli, $bairro_cli, $obs_cli);
								$stmt_b->fetch();
								if ($stmt_c = $con->prepare("SELECT nome_cidade FROM cidade WHERE id_cidade ='$cid_cli'")) {
							    	$stmt_c->execute();
									$stmt_c->store_result();
									$num_of_rows3 = $stmt_c->num_rows;
									if ($stmt_c->num_rows > 0) {
										$stmt_c->bind_result($nome_cid);
										$stmt_c->fetch();
										
									}

								}
								if ($stmt2 = $con->prepare("SELECT nome_obra, endereco_obra FROM obra_clientes WHERE id_obra = '$id_obra_os'")) {
									$stmt2->execute();
									$stmt2->store_result();
									$num_of_rows = $stmt2->num_rows;
									if ($stmt2->num_rows > 0) {
									$stmt2->bind_result($nome_obra, $end_obra);
									$stmt2->fetch();
									}
								}
					    
					    	}	
			        	}          
			    	}
				}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sistema Funipel</title>
		<link href="style2.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="relacao">
			<div class="row" style="margin-bottom:10px;">
				<div class="column">
					<img src="./img/logo.png" width="160px" height="130px" onclick="window.print();">
				</div>
				<div class="column">
					<div class="relacao_conteudo" style="width: 390px; margin-top: 10px;">
					Cliente: <a class="text-bold"><?php echo $nome_cli?></a><br>
					Endereço: <?php echo $end_cli.', '.$num_cli ?><br>
					Cidade: <?php echo $nome_cid;?>  - Bairro: <?php echo $bairro_cli;?><br>
					Telefone: <?php echo $tel_cli;?><br>
					
					<?php 
						if($tel2_cli) {echo "Telefone 2: ". $tel2_cli. "<br>";}
						if($contato_cli){ echo "Contato: ". $contato_cli. "<br>";}
					?>

					
					</div>
				</div>
				<div class="column">
					<div class="ficha_conteudo" style=" margin-top:10px;">	
						<a class="text-bold">OS N°: <?php echo $id_os?></a><br><br>
						Abertura:<br>
						<?php echo trocadatabarra($data_os)?><br>	
					</div>
				</div>
				
			</div>	
			<div class="row">
				<div class="column">
					<?php
						if (isset($nome_obra) && isset($end_obra)) {
							echo '<br><strong>OBRA: </strong>' . $nome_obra . '<br>';
							echo '<strong>Endereço: </strong>' . $end_obra . '<br><br>';
						}
					?>
				</div>
			</div>
		<table border="1px";>
			<tbody>
				<tr>
					<td width= "80px"><div style=" margin: auto; width: 70%;">Quant.</div></td>
					<td width= "350px"><div>Descrição</div></td>
					<td width= "105px"><div>Unitário (R$)</div></td>
					<td width= "95px"><div style="float: right; padding-right: 2px;">Total (R$)</div></td>
				</tr>
<?php
	$valor_total_rel_somado = 0;
	if ($stmt_d = $con->prepare("SELECT id_rel_itens FROM relacao WHERE id_os = '$id_os'")) {
		$stmt_d->execute();
		$stmt_d->store_result();
		$num_of_rows = $stmt_d->num_rows;
		
		if ($stmt_d->num_rows > 0) {
		$stmt_d->bind_result($id_rel_itens);
			while ($stmt_d->fetch()) {
				$stmt_e = $con->prepare("SELECT id_prod, quant_prod, valor_unit_prod, base_calculo_os, valor_total_prod  FROM relacao_itens WHERE id_rel_itens = '$id_rel_itens'");
				$stmt_e->execute();
				$stmt_e->store_result();
				$num_of_rows = $stmt_e->num_rows;
				
				if ($stmt_e->num_rows > 0) {
				$stmt_e->bind_result($id_prod, $quant_prod, $valor_unit_prod, $base_calculo_os, $valor_total_prod);
					while ($stmt_e->fetch()) {
						$stmt_f = $con->prepare("SELECT nome_prod FROM produtos WHERE id_prod = '$id_prod'");
						$stmt_f->execute();
						$stmt_f->store_result();
						$num_of_rows = $stmt_f->num_rows;

						if ($stmt_f->num_rows > 0) {
						$stmt_f->bind_result($nome_prod);
						$stmt_f->fetch();
						echo '<tr>
								<td width="100px"><div style="float: right; padding-right: 5px;">'.$quant_prod.'</div></td>
								<td width="350px"><div>'.$nome_prod.'</div></td>
								<td width="80px"><div style="float: right; padding-right: 5px;">'.moeda_formato($valor_unit_prod).'</div></td>
								<td width="80px"><div style="float: right; padding-right: 5px;">'.moeda_formato($valor_total_prod).'</div></td>
							</tr>';
						$valor_total_rel_somado = $valor_total_rel_somado + $valor_total_prod;	
						}
					}
				}
			}
		}
	}			
}
?>
		</tbody>
			</table>
			<table style="margin-top: 5px;">
				<tbody>
					<tr style="height: 25px; ">
						<td width= "100px"><div class="text-bold">TOTAL (R$)</div></td>
						<td width= "120px">
							<div style="float: right; padding-right: 5px;" class="text-bold">
							<?php
								echo moeda_formato($valor_total_rel_somado); ?>
							</div>	
							</td>

						</tr>
				</tbody>
			</table>
			<br>
			<spam><?php if(isset($obs_os)){echo 'Obs.: '.$obs_os;}?></spam>
		</div>
		
	</body>
</html>	