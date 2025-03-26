<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sistema Funipel</title>
		<link href="style2.css" rel="stylesheet" type="text/css">
		
	</head>
	<body>
		<?php
			require('./db.php');
			require('./funcoes.php');
			if (isset($_GET['relacao'])) {
			    $id = $_GET['relacao'];
			    $stmt = $con->prepare("SELECT id_os, id_cli, id_func, id_serv, id_status, data_os, obs_os, valor_os, data_os FROM ordem_serv WHERE id_os='$id'");
			    $stmt->execute();
			    $stmt->store_result();
			    $num_of_rows = $stmt->num_rows;
			    if ($stmt->num_rows > 0) {
			        $stmt->bind_result($id_os, $id_cli_os, $id_func_os, $id_serv_os, $id_status_os, $data_os, $obs_os, $valor, $data_os);
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
									$num_of_rows3 = $stmt2->num_rows;
									if ($stmt3->num_rows > 0) {
										$stmt3->bind_result($nome_cid);
										$stmt3->fetch();
										
									}

								}
					    
					    	}	
			        	}          
			    	}
				}
			}
		?>
		<div class="relacao">
			<table class="table table-sm">
				<tbody>
					<tr style="height: 50px;">
						<th scope="col" style="height: 50px;">
							<img src="./img/logo.png" width="200px" height="100px" onclick="window.print();">
						</th>
						<td>
							<div class="relacao_conteudo">
							Cliente: <a style="font-weight: bold;"><?php echo $nome_cli?></a><br>
							Endereço: <?php echo $end_cli.', '.$num_cli ?><br>
							<?php
								if($contato_cli){
									echo 'Contato: '.$contato_cli.'<br>';
								}
							?>
							Cidade: <?php echo $nome_cid;?>  - Bairro: <?php echo $bairro_cli;?><br>
							Telefone: <?php echo $tel_cli;?><br>	
							Telefone2: <?php echo $tel2_cli;?><br>
							</div>
						</td>
						<td style="height: 50px;">
							<div class="ficha_conteudo">
								<a style="font-weight: bold;">OS N°: <?php echo $id_os?></a><br><br>
								Abertura:<br>
								<?php echo trocadatabarra($data_os)?><br>	
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<table border="1px";>
				<tbody>
					<tr>
						<td width= "80px">Quant.</td>
						<td width= "350px">Descrição</td>
						<td width= "80px">Unitário</td>
						<td width= "80px">Total</td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>
					<tr>
						<td width= "80px" ></td>
						<td width= "350px"></td>
						<td width= "80px"></td>
						<td width= "80px"></td>
					</tr>

				</tbody>
			</table>		
			<table border="1px;">
				<tbody>
					<tr style="height: 25px;">
						<td width= "80px">TOTAL</td>
						<td width= "150px"></td>
					</tr>
				</tbody>
			</table>
			<br>	
			<?php

				echo 'Observações: '. $obs_os;
			?>
		</div>	


	</body>
</html>	