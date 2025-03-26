<?php
session_start();
require ('./funcoes.php');
require('./db.php');

if(isset($_POST['contador_id'])){
	$id_os = $_POST['id_os'];
	$id_cli_os = $_POST['id_cli_os'];
	$contador_id = $_POST['contador_id'];
	$valor_total_os = $_POST['valor_total_os'];
	$id_prod = array();
	$quantidade_prod = array();
	$valor_unit = array();
	$fator = array();
	$valor_total_item = array();
	$valor_total_os_acumulado = 0;
	$status_os = $_POST['status_os'];

	$stmt_a = $con->prepare("SELECT id_os, id_cli, id_obra, id_func, id_serv, id_status, data_os, obs_os, valor_os, data_os FROM ordem_serv WHERE id_os='$id_os'");
			    $stmt_a->execute();
			    $stmt_a->store_result();
			    $num_of_rows = $stmt_a->num_rows;
			    if ($stmt_a->num_rows > 0) {
			        $stmt_a->bind_result($id_os, $id_cli_os, $id_obra_os, $id_func_os, $id_serv_os, $id_status_os, $data_os, $obs_os, $valor, $data_os);
					while ($stmt_a->fetch()) {
						if ($stmt_b = $con->prepare("SELECT nome_cli, end_cli, num_cli, cid_cli, tel_cli, tel2_cli, contato_cli, bairro_cli FROM clientes WHERE id_cli ='$id_cli_os'")) {
							$stmt_b->execute();
							$stmt_b->store_result();
							$num_of_rows2 = $stmt_b->num_rows;
							if ($stmt_b->num_rows > 0) {
								$stmt_b->bind_result($nome_cli, $end_cli, $num_cli, $cid_cli, $tel_cli, $tel2_cli, $contato_cli, $bairro_cli);
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
				<div class="column" style="padding-left: 9px; padding-right: 8px;">
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
	for($i=1; $i <= $contador_id; $i++){

		if(isset($_POST['id_prod_'.$i])){
			$id_prod[$i] = $_POST['id_prod_'.$i];
			$id_prod1 = 0;
			$id_prod1 = $id_prod[$i];
			//echo "id:".$id_prod1."<br>";
		}

		if(isset($_POST['quantidade_prod_'.$i])){
			$quantidade_prod[$i] = $_POST['quantidade_prod_'.$i];
			$quantidade_prod1 = 0;
			$quantidade_prod1 = $quantidade_prod[$i];
			//echo "qtd:".$quantidade_prod1."<br>";
		}

		if(isset($_POST['valor_unit_'.$i])){
			$valor_unit[$i] = $_POST['valor_unit_'.$i];
			$valor_unit1 = 0;
			$valor_unit1 = $valor_unit[$i];
			//echo "valor_unit:".$valor_unit[$i]."<br>";
		}

		if(isset($_POST['fator_'.$i])){
			$fator[$i] = $_POST['fator_'.$i];
			$fator1 = 0;
			$fator1 = $fator[$i];
			//echo "fator:".$fator[$i]."<br>";
		}

		if(isset($_POST['valor_total_item_'.$i])){
			$valor_total_item[$i] = $_POST['valor_total_item_'.$i];
			$valor_total_item1 = 0;
			$valor_total_item1 = $valor_total_item[$i];
			//echo "valor_total_item:".$valor_total_item[$i]."<br>";
		}

		if ($stmt_d = $con->prepare("SELECT nome_prod FROM produtos WHERE id_prod = '$id_prod1'")) {
			$stmt_d->execute();
			$stmt_d->store_result();
			$num_of_rows = $stmt_d->num_rows;
			
			if ($stmt_d->num_rows > 0) {
			$stmt_d->bind_result($nome_prod);
				while ($stmt_d->fetch()) {
					//echo "Nome do produto: ".$nome_prod;
				}
			}

			echo 	'<tr>
				<td width="100px"><div style="float: right; padding-right: 5px;">'.sprintf("%.2f", $quantidade_prod1).'</div></td>
				<td width="350px"><div>'.$nome_prod.'</div></td>
				<td width="80px"><div style="float: right; padding-right: 5px;">'.moeda_formato($valor_unit1).'</div></td>
				<td width="80px"><div style="float: right; padding-right: 5px;">'.moeda_formato($valor_total_item1).'</div></td>
				</tr>';

	    
		$stmt = $con->prepare("INSERT INTO relacao_itens (id_prod, quant_prod, valor_unit_prod, base_calculo_os, valor_total_prod, id_os) VALUES ('$id_prod1', '$quantidade_prod1', '$valor_unit1', '$fator1', '$valor_total_item1' , '$id_os')");
		$stmt->execute();

	
		$stmt2 = $con->prepare("INSERT INTO relacao (id_os, id_rel_itens, id_cliente) VALUES ('$id_os', (SELECT MAX(id_rel_itens) FROM relacao_itens), '$id_cli_os')");
		$stmt2->execute();
		}			

	}
	$stmt3 = $con->prepare("INSERT INTO relacao_cobranca (id_os, id_cliente, valor_total_rel) VALUES ('$id_os', '$id_cli_os', '$valor_total_os')");
	$stmt3->execute();

	$data = date("Y-m-d");

	$stmt4 = $con->prepare("SELECT valor_total_prod FROM relacao_itens WHERE id_os='$id_os'");
	$stmt4->execute();
	$stmt4->store_result();
	$num_of_rows = $stmt4->num_rows;
			
	if ($stmt4->num_rows > 0) {
	$stmt4->bind_result($valor_total_prod_base);
		while ($stmt4->fetch()) {
			$valor_total_os_acumulado = $valor_total_os_acumulado + $valor_total_prod_base;
		}
	}




	$stmt5 = $con->prepare("UPDATE ordem_serv SET id_status = '$status_os', valor_os = '$valor_total_os_acumulado', data_os_instalacao = '$data' WHERE id_os='$id_os'");
	$stmt5->execute();

}



?>
				</tbody>
			</table>
			<table style="margin-top: 5px;">
				<tbody>
					<tr style="height: 25px;">
					<td width= "100px"><div class="text-bold">TOTAL (R$)</div></td>
					<td width= "120px">
						<div style="float: right; padding-right: 5px;" class="text-bold">
							<?php echo moeda_formato($valor_total_os);?>
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