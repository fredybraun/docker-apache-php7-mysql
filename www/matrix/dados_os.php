<?php
session_start();
require ('./topo2.php');
require ('./funcoes.php');
$_SESSION["onde_estou"] = 'create_os';
?>

<?php
//valida usuário esta logado, caso não, redireciona para loguin.
require('./db.php');
if(!isset($_SESSION["name"])){
	header("Location: login.php");
exit(); }

$_SESSION['active'] = 'os';
require('menu2.php');


if (isset($_GET['id_os'])) {
    $id = $_GET['id_os'];
    $stmt = $con->prepare("SELECT id_os, id_cli, id_obra, id_func, id_serv, id_status, data_os, data_os_medida, data_os_montagem, data_os_instalacao, data_os_cobranca, obs_os, valor_os, condicao_pagamento, nf, oc, data_os_fechamento, obs_cobranca, agendamento_os FROM ordem_serv WHERE id_os='$id'");
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_os, $id_cli_os, $id_obra_os, $id_func_os, $id_serv_os, $id_status_os, $data_os, $data_os_medida, $data_os_montagem, $data_os_instalcao, $data_os_cobranca, $obs_os, $valor_os, $condicao_pagamento, $nf, $oc, $data_os_fechamento, $obs_cobranca, $agendamento);
        $stmt->fetch();     
    }

} 
	if ($stmt3 = $con->prepare("SELECT nome_status FROM status WHERE id_status = '$id_status_os'")) {
		$stmt3->execute();
		$stmt3->store_result();
		$num_of_rows = $stmt3->num_rows;
		if ($stmt3->num_rows > 0) {
		$stmt3->bind_result($nome_status_os);
			$stmt3->fetch();
		}
	}
	?>


<div class="container-fluid mt-2 col-md-12">
	<h3>Dados da Ordem de Serviço N°: <?php echo $id_os." | ";?>Status: <?php echo $nome_status_os;?></h3>
				<?php

						if ($stmt = $con->prepare("SELECT * FROM clientes WHERE id_cli = '$id_cli_os'")) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($id_cli, $nome_cli, $cpf_cli, $end_cli, $num_cli, $cid_cli, $tel_cli, $tel2_cli, $obs_cli, $contato_cli, $bairro_cli);
								$stmt->fetch();
								$tel_cli = str_replace(' ', '', $tel_cli);    
								$tel_cli = str_replace('-', '', $tel_cli); 
								?>
								<?php
								if ($stmt2 = $con->prepare("SELECT nome_cidade FROM cidade WHERE id_cidade = '$cid_cli'")) {
									$stmt2->execute();
									$stmt2->store_result();
									$num_of_rows = $stmt2->num_rows;
									if ($stmt2->num_rows > 0) {
									$stmt2->bind_result($nome_cidade);
										$stmt2->fetch();
									}
								}
								if ($stmt3 = $con->prepare("SELECT nome_obra, endereco_obra FROM obra_clientes WHERE id_obra = '$id_obra_os'")) {
									$stmt3->execute();
									$stmt3->store_result();
									$num_of_rows = $stmt3->num_rows;
									if ($stmt3->num_rows > 0) {
									$stmt3->bind_result($nome_obra, $end_obra);
									$stmt3->fetch();
									}
								}
								?>
								<strong>Cliente: </strong><?php echo '<a href="dados_cliente.php?id_cliente='.$id_cli.'">'.$nome_cli.'</a>'?><br>
								<strong>Endereço do cliente: </strong><?php echo $end_cli.', '.$num_cli.' - '.$bairro_cli.' - '.$nome_cidade;?><br>
								<strong>CPF/CNPJ: </strong><?php echo $cpf_cli;?><br>
								<strong>Telefone: </strong><?php echo $tel_cli;?><br>
								<strong>Telefone: </strong><?php echo $tel2_cli;?><br>
								<strong>Contato: </strong><?php echo $contato_cli;?><br>	
								<strong>Observações: </strong><?php echo $obs_cli;?><br>
								<?php
									if (isset($nome_obra) && isset($end_obra)) {
										echo '<br><strong>OBRA: </strong>' . $nome_obra . '<br>';
										echo '<strong>Endereço: </strong>' . $end_obra . '<br>';
									}
								?>
								<a class="text-white" href="https://api.whatsapp.com/send?phone=55<?php echo $tel_cli;?>" target="_blank"><button type="button"class="btn btn-success">Whatsapp</button></a>
								<a href="https://maps.google.it/maps?q=<?php echo $end_cli.', '.$num_cli.','.$nome_cidade; ?>" target="_blank"><button type="button"class="btn btn-primary mt-2 mb-2">Google Maps</button></a><br>
								<?php
							}
							$stmt->free_result();
						}
						if ($stmt4 = $con->prepare("SELECT nome_func FROM funcionario WHERE id_func = '$id_func_os'")) {
							$stmt4->execute();
							$stmt4->store_result();
							$num_of_rows = $stmt4->num_rows;
							if ($stmt4->num_rows > 0) {
							$stmt4->bind_result($nome_func);
								$stmt4->fetch();
							?>
							<div class="form-group row">
								<div class="col-sm">
								<hr class="mt-2 mb-2"/>
									<strong>Funcionário responsável: </strong><?php echo $nome_func;?><br>
							<?php	
							}
						}

					?>
				<strong>Agendamento: </strong><?php echo trocadatabarra($agendamento);?><br>
				<strong>Observações: </strong><?php echo $obs_os;?><br>
				<strong>Data de abertura: </strong><?php echo trocadatabarra($data_os);?><br>
				<strong>Data de medida: </strong><?php echo trocadatabarra($data_os_medida);?><br>
				<strong>Data de montagem: </strong><?php echo trocadatabarra($data_os_montagem);?><br>
				<strong>Data de instalação: </strong><?php echo trocadatabarra($data_os_instalcao);?><br>
				<strong>Data de Fechamento: </strong><?php echo trocadatabarra($data_os_fechamento);?><br>
				<hr class="mt-2 mb-2"/>
				<strong>Valor: </strong><?php if($valor_os){echo 'R$ '.moeda_formato($valor_os);}?><br>
				<?php
					if ($stmt5 = $con->prepare("SELECT nome_cond_pag FROM condicoes_pagamento WHERE id_cond_pag = '$condicao_pagamento'")) {
							$stmt5->execute();
							$stmt5->store_result();
							$num_of_rows = $stmt5->num_rows;
							if ($stmt5->num_rows > 0) {
								$stmt5->bind_result($nome_cond_pag);
								$stmt5->fetch();
				?>
				<strong>Condição de pagamento: </strong><?php echo $nome_cond_pag;?><br>
				<?php	
							}
							else {
								echo "<strong>Condição de pagamento: </strong><br>"	;
							}
						}
				?>
				<strong>Nota fiscal: </strong><?php echo $nf;?><br>	
				<strong>Ordem de compra: </strong><?php echo $oc;?><br>	
				<div class="form-group mt-2">
					<button type="button" class="btn btn-primary" onClick="history.go(-1)">Voltar</button>

					<?php
						$possui_relacao = 0;
						$stmt6 = $con->prepare("SELECT id_os FROM relacao WHERE id_os = '$id_os'");
						$stmt6->execute();
						$stmt6->store_result();
						$num_of_rows = $stmt6->num_rows;
						if ($stmt6->num_rows > 0) {
							$possui_relacao = 1;
						}
						else {$possui_relacao = 0;}
						echo '<a href="insert_os.php?editar='.$id_os.'"><button type="button" class="btn btn-primary">Editar</button></a>';
						if($possui_relacao == 0){
							echo '<a target="_blank" href="relacao2.php?relacao='.$id_os.'"><button type="button" class="btn btn-warning ml-1">Fazer Relação</button></a>';
						}
						if ($possui_relacao == 1){
							echo '<a target="_blank" href="relacao2.php?relacao='.$id_os.'"><button type="button" class="btn btn-warning ml-1">Adicionar Itens</button></a>';
							echo '<a target="_blank" href="relacao.php?relacao='.$id_os.'"><button type="button" class="btn btn-success	 ml-1">Exibir Relação</button></a>';
						}
						
						echo '<a target=”_blank” href="ficha.php?imprimir='.$id_os.'"><button type="button" class="btn btn-primary ml-1">OS</button></a>';
					
					?>				
				</div>	
							</div>
							<div class="col-sm">
								<hr class="mt-2 mb-2"/>
								<form action="atualiza_os_cobranca.php" method="post">
									<div class="form-group">
										<label for="fobs">Observações de cobrança</label>
										<textarea class="form-control w-75" style="height:182px;"id="obs_cobranca" name="obs_cobranca" placeholder="Observações de cobrança..."><?php echo $obs_cobranca;?></textarea>
									</div>
									<input type="hidden" name="id_os" value="<?php echo $id; ?>">
									<div class="mt-2">
										<button type="submit" class="btn btn-primary">Atualizar</button>
									</div>
								</form>	
							</div>


						
</div>
				



		</body>
</html>