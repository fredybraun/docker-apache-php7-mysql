<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sistema Funipel</title>
	<link href="style2.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		@media print 
		{
		    @page {

		      size: A4 landscape; /* DIN A4 standard, Europe */
		      margin:0;
		    }
		    html, body {
		        width: 296mm;
		        /* height: 297mm; */
		        height: 200mm;
		        font-size: 11px;
		        font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
		        overflow:visible;
		    }
		    body {
		        padding-top:5mm;
		        padding-left: 5mm;
		    }
		}
	</style>
</head>
<body>
	<?php
		require('./db.php');
		require('./funcoes.php');
		if (isset($_GET['imprimir'])) {
		    $id = $_GET['imprimir'];
		    $stmt = $con->prepare("SELECT id_os, id_cli, id_obra, id_func, id_serv, id_status, data_os, obs_os, valor_os, data_os FROM ordem_serv WHERE id_os='$id'");
		    $stmt->execute();
		    $stmt->store_result();
		    $num_of_rows = $stmt->num_rows;
		    if ($stmt->num_rows > 0) {
		        $stmt->bind_result($id_os, $id_cli_os, $id_obra_os, $id_func_os, $id_serv_os, $id_status_os, $data_os, $obs_os, $valor, $data_os);
		        	while ($stmt->fetch()) {
		        	if ($stmt2 = $con->prepare("SELECT nome_cli, end_cli, num_cli, cid_cli, tel_cli, tel2_cli, contato_cli, bairro_cli FROM clientes WHERE id_cli ='$id_cli_os'")) {
				    	$stmt2->execute();
						$stmt2->store_result();
						$num_of_rows2 = $stmt2->num_rows;
						if ($stmt2->num_rows > 0) {
							$stmt2->bind_result($nome_cli, $end_cli, $num_cli, $cid_cli, $tel_cli, $tel2_cli, $contato_cli, $bairro_cli);
							$stmt2->fetch();
							if ($stmt3 = $con->prepare("SELECT nome_cidade FROM cidade WHERE id_cidade ='$cid_cli'")) {
						    	$stmt3->execute();
								$stmt3->store_result();
								$num_of_rows3 = $stmt3->num_rows;
								if ($stmt3->num_rows > 0) {
									$stmt3->bind_result($nome_cid);
									$stmt3->fetch();
									
								}

							}
							if ($stmt4 = $con->prepare("SELECT descricao_serv FROM tipo_servico WHERE id_serv ='$id_serv_os'")) {
						    	$stmt4->execute();
								$stmt4->store_result();
								$num_of_rows4 = $stmt4->num_rows;
								if ($stmt4->num_rows > 0) {
									$stmt4->bind_result($nome_servico);
									$stmt4->fetch();
									
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
		}
	?>



<div class="ficha">
	<table>
		<tbody>
			<tr>
				<td>
					<div style="padding-left: 9px; padding-right: 8px;">
						<img src="img/logo.png" width="160px" height="130px" ; onclick="window.print();">
						
					</div>
				</td>
				<td style="width:420px;">
					<div class="ficha_conteudo">
						Cliente: <a class="text-bold"><?php echo $nome_cli?></a><br>
						Telefone: <?php echo $tel_cli;?><br>	
						<?php
						if (!(isset($nome_obra) && isset($end_obra))) {
							echo 'Endereço: '.$end_cli.', '.$num_cli.'<br>';
							echo 'Cidade: '.$nome_cid.'  - Bairro: '.$bairro_cli.'<br>';
						}
						?>
						<?php 
							if($tel2_cli) {echo "Telefone 2: ". $tel2_cli. "<br>";}
							if($contato_cli){ echo "Contato: ". $contato_cli. "<br>";}
						?>
						<?php
							if (isset($nome_obra) && isset($end_obra)) {
								echo '<br><strong>OBRA: </strong>' . $nome_obra . '<br>';
								echo '<strong>Endereço: </strong>' . $end_obra . '<br>';
							}
						?>
						
						
					</div>
			    </td>
			    <td style="width:360px" >
			    	<div class="ficha_conteudo" style="margin-top:-65px" >
			    		<div class="text-bold">Observações:</div><div><?php echo $obs_os;?></div>
			    	</div>
			    </td>
				<td style="width:120px">
					<div class="ficha_conteudo" style="margin-top:-35px">
						<a class="text-bold">OS N°: <?php echo $id_os?></a><br><br>
							Abertura:<br>
						<?php echo trocadatabarra($data_os)?><br>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<table>
		<tbody>
			<tr>
				<td><div class="text-bold">Calhas</div></td>
				<td style="padding-top: 5px; padding-bottom: 5px">				
					<input type="checkbox" name="">Corte 30<br>
					<input type="checkbox" name="">Corte 40<br>
				</td>
			</tr>
			<tr>
			<td><div class="text-bold">Canos</div></td>
				<td style="padding-top: 5px; padding-bottom: 5px">
				
					<input type="checkbox" name="">Retangular<br>
					<input type="checkbox" name="">Redondo<br>
				</td>
			</tr>
			<tr>
			<td><div class="text-bold">Cortes<br>Canos</div></td>		
				<td style="padding-top: 5px; padding-bottom: 5px">
					
					LG:___________<br>
					LP:___________<br>
				</td>
			</tr>
			<tr>
			<td><div class="text-bold">Beiral</div></td>		
				<td style="padding-top: 5px; padding-bottom: 5px">
				
					<input type="checkbox" name="">Madeira<br>
					<input type="checkbox" name="">Concreto<br>
				</td>
			</tr>
			<tr>
				<td><div class="text-bold">Pintura</div></td>
				<td style="padding-top: 5px; padding-bottom: 5px">
					
					<input type="checkbox" name="">S/ Pintura<br>
					<input type="checkbox" name="">Cinza<br>
					<input type="checkbox" name="">Preto <input type="checkbox" name="">600°<br>
					<input type="checkbox" name="">Branco<br>
					<input type="checkbox" name="">Tabaco<br>
					<input type="checkbox" name="">Marrom<br>
					<input type="checkbox" name="">Telha<br>
					<input type="checkbox" name="">Tinta Cliente<br>
					Cod.: __________
				</td>
			</tr>
			<tr>
			<td><div class="text-bold">Material</div></td>
				<td style="padding-top: 5px; padding-bottom: 5px">					
					<input type="checkbox" name="">Aluzinco<br>
					<input type="checkbox" name="">Inox 304<br>
					<input type="checkbox" name="">Chapa Preta<br>
					<input type="checkbox" name="">Alumínio<br>
					<input type="checkbox" name="">Xadrez<br>
				</td>
			</tr>
		</tbody>
	</table>
	<table>
		<tbody>
			<td style="height: 50px; width:180px;" >
				<div class="ficha_conteudo">
					<div class="text-bold" style="float: left; margin-left: -10px; margin-top:-20px;">Montagem:</div>
				</div>	
			</td>
			<td style="height: 50px; width:450px" >
				<div class="ficha_conteudo">
					<div class="text-bold" style="float: left; margin-left: -10px; margin-top:-20px;">Horas:</div>
				</div>	
			</td>
			<td style="height: 50px; width:450px" >
				<div class="ficha_conteudo">
					<div class="text-bold" style="float: left; margin-left: -10px; margin-top:-20px;">PU:</div>
				</div>
			</td>
		</tbody>
	</table>		
	</div>		
</body>
</html>
