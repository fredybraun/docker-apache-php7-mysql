<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sistema Funipel</title>
		<link href="style_andaime.css" rel="stylesheet" type="text/css">
		
	</head>
	<body>
		<?php
			require('./db.php');
			require('./funcoes.php');
			if (isset($_GET['imprimir'])) {
			    $id = $_GET['imprimir'];
			    $stmt = $con->prepare("SELECT id_andaime, data_solicitacao, id_cli, quant_andaime, quant_plataforma, quant_travessa, quant_rodas, quant_sapata, quant_escada_longa, quant_escada_curta, end_entrega, data_retirada, data_retorno FROM andaimes WHERE id_andaime='$id'");
			    $stmt->execute();
			    $stmt->store_result();
			    $num_of_rows = $stmt->num_rows;
			    if ($stmt->num_rows > 0) {
			        $stmt->bind_result($id_andaime, $data_solicitação, $id_cli, $quant_andaime, $quant_plataforma, $quant_travessa, $quant_rodas, $quant_sapata, $quant_escada_longa, $quant_escada_curta, $end_entrega, $data_retirada, $data_retorno);
			        	while ($stmt->fetch()) {
			        	if ($stmt2 = $con->prepare("SELECT nome_cli, end_cli, num_cli, cid_cli, tel_cli, tel2_cli, contato_cli, bairro_cli, cpf_cli FROM clientes WHERE id_cli ='$id_cli'")) {
					    	$stmt2->execute();
							$stmt2->store_result();
							$num_of_rows2 = $stmt2->num_rows;
							if ($stmt2->num_rows > 0) {
								$stmt2->bind_result($nome_cli, $end_cli, $num_cli, $cid_cli, $tel_cli, $tel2_cli, $contato_cli, $bairro_cli, $cpf_cli);
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
		<div class="contrato_andaime">
			<h3 style="text-align:center;">Contrato de locação de Equipamento - N°: <?php echo $id_andaime; ?></h3>
			<h3>Locador:</h3>
			<a style="font-size: 12px;">Nome: Funipel Funilaria LTDA <br>
			Endereço: Rua dos Ackermann, 144  Bairro: Vale VErde - Nova Petrópolis/RS <br>
			CEP: 95150-000  &nbsp &nbsp CNPJ: 06.191.774/0001-23 <br>
			</a>



			<h3>Locatário:</h3>
			<a style="font-size: 12px;">Nome: <?php echo $nome_cli?> <br>
			Endereço: <?php echo $end_cli .' - ' . $num_cli. ' - ' .$nome_cid?> <br>
			Telefone: <?php echo $tel_cli?>&nbsp &nbsp CPF ou RG: <?php echo $cpf_cli?> <br>
			<br>
			Endereço de entrega: <?php echo $end_entrega;?><br><br>

			1. OBJETO E VALOR<br>
			Pelo presente instrumento o locador aluga à locatária os equipamentos abaixo descriminados, e se obriga a locá-los nas condições estabelecidas neste contrato.<br>

			Andaimes: <?php echo $quant_andaime?>  &nbsp &nbsp| &nbsp &nbsp Plataformas: <?php echo $quant_plataforma?> &nbsp &nbsp| &nbsp &nbsp Travessas: <?php echo $quant_travessa?><br>
			Rodas: <?php echo $quant_rodas?> &nbsp &nbsp| &nbsp &nbsp Sapatas: <?php echo $quant_sapata?><br>
			Escada longa: <?php echo $quant_escada_longa?> &nbsp &nbsp| &nbsp &nbsp Escada Curta: <?php echo $quant_escada_curta?><br>
			<br>
			<?php
			if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 1 ')) {
				$stmt->execute();
				$stmt->store_result();
				$num_of_rows = $stmt->num_rows;
				if ($stmt->num_rows > 0) {
				$stmt->bind_result($valor_andaime);
				$stmt->fetch();
				}
				$stmt->free_result();

			}
			$valor_total_andaime = $quant_andaime * $valor_andaime;
			
			if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 2 ')) {
				$stmt->execute();
				$stmt->store_result();
				$num_of_rows = $stmt->num_rows;
				if ($stmt->num_rows > 0) {
				$stmt->bind_result($valor_plataforma);
				$stmt->fetch();
				}
				$stmt->free_result();

			}
			$valor_total_plataforma = $quant_plataforma * $valor_plataforma;
			
			if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 3 ')) {
				$stmt->execute();
				$stmt->store_result();
				$num_of_rows = $stmt->num_rows;
				if ($stmt->num_rows > 0) {
				$stmt->bind_result($valor_travessa);
				$stmt->fetch();
				}
				$stmt->free_result();

			}
			$valor_total_travessa = $quant_travessa * $valor_travessa;

			if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 4 ')) {
				$stmt->execute();
				$stmt->store_result();
				$num_of_rows = $stmt->num_rows;
				if ($stmt->num_rows > 0) {
				$stmt->bind_result($valor_rodas);
				$stmt->fetch();
				}
				$stmt->free_result();

			}
			$valor_total_rodas = $quant_rodas * $valor_rodas;

			if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 5 ')) {
				$stmt->execute();
				$stmt->store_result();
				$num_of_rows = $stmt->num_rows;
				if ($stmt->num_rows > 0) {
				$stmt->bind_result($valor_sapata);
				$stmt->fetch();
				}
				$stmt->free_result();

			}
			$valor_total_sapata = $quant_sapata * $valor_sapata;

			if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 6 ')) {
				$stmt->execute();
				$stmt->store_result();
				$num_of_rows = $stmt->num_rows;
				if ($stmt->num_rows > 0) {
				$stmt->bind_result($valor_escada_longa);
				$stmt->fetch();
				}
				$stmt->free_result();

			}
			$valor_total_escada_longa = $quant_escada_longa * $valor_escada_longa;

			if ($stmt = $con->prepare('SELECT valor_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 7 ')) {
				$stmt->execute();
				$stmt->store_result();
				$num_of_rows = $stmt->num_rows;
				if ($stmt->num_rows > 0) {
				$stmt->bind_result($valor_escada_curta);
				$stmt->fetch();
				}
				$stmt->free_result();

			}
			$valor_total_escada_curta = $quant_escada_curta * $valor_escada_curta;
			
			$valor_tota_pecas = $valor_total_andaime + $valor_total_plataforma + $valor_total_travessa + $valor_total_rodas + $valor_total_sapata + $valor_total_escada_longa + $valor_total_escada_curta;
			?>
			2. ALUGUEL<br>
			O locatário pagará ao locador a quantia de R$ <?php echo moeda($valor_tota_pecas).',00 '; ?>ao dia. O alugual diário constitui o pagamento pelo uso do equipamento e será devido a partir do dia da assinatura do presente.<br>
			2.1 Serão cobrados 6 dias por semana, ficando livres de cobrança o(s) domingo(s) e feriado(s).<br><br>

			3.MANUTENÇÃO<br>
			A manutenção do equipamento, objeto do presente contrato é de total responsabilidade do locatário.<br>
			3.1 O locatário se responsabilisa pelo equipamento em caso de dano, roubo ou perda do mesmo.<br>
			3.2 O locatário deverá devolver o equipamento em perfeita condição de uso. Caso equipamento volte sujo com tinta de terceiros ou massa de cimento, será cobrado um valor adicional de R$ 5,00 por peça.<br>
			3.3 Será cobrado um valor adicional de R$ 200,00 por peça danificada ou não devolvida.<br><br>

			4.PRAZO DE VIGÊNCIA DO CONTRATO<br>
			Data inicial: <?php echo trocadatabarra($data_retirada);?>.<br>
			 
			<?php 
			if(trocadatabarra($data_retorno) == '01/01/1970'){
				$data_retorno_ok = 'Indeterminado';
			}else{$data_retorno_ok = trocadatabarra($data_retorno);}
			?>
			Data de devolução: <?php echo $data_retorno_ok?>.<br><br>

			Fica eleito o Foro de Nova Petrópolis, estado do Rio Grande do Sul, como único competente, com renúncia a qualquer outro, por mais privilegiádo que seja, para dirimir as questões que surgirem na execução deste contrato.<br>
			E por estarem justos e contratados assinaram o presente contrato em 1 via que ficará de posso do locador.<br><br>

			<?php
				setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
				date_default_timezone_set('America/Sao_Paulo');
				echo 'Nova Petrópolis, '.strftime('%d de %B de %Y', strtotime('today')).'.';

			?>
			<br><br>
			Locador: _____________________________<br><br>
			Locatário: ___________________________<br><br>


		
			...................................................................................................................................................................
			<br>	
			Devolução N°: <?php echo $id_andaime; ?>  &nbsp &nbsp Nome: <?php echo $nome_cli?><br>
			Andaimes: <?php echo $quant_andaime?> &nbsp &nbsp 	|    &nbsp &nbsp  
			Plataformas: <?php echo $quant_plataforma?> &nbsp &nbsp 	|    &nbsp &nbsp 
			Travessas: <?php echo $quant_travessa?> &nbsp &nbsp 	|   &nbsp &nbsp  
			Rodas: <?php echo $quant_rodas?> &nbsp &nbsp 	| &nbsp &nbsp 
			Sapatas: <?php echo $quant_sapata?>   
			<br><br>
			...................................................................................................................................................................
			<br>	
			Retirada N°: <?php echo $id_andaime; ?>  &nbsp &nbsp Nome: <?php echo $nome_cli?><br>
			Andaimes: <?php echo $quant_andaime?> &nbsp &nbsp 	|    &nbsp &nbsp  
			Plataformas: <?php echo $quant_plataforma?> &nbsp &nbsp 	|    &nbsp &nbsp 
			Travessas: <?php echo $quant_travessa?> &nbsp &nbsp 	|   &nbsp &nbsp  
			Rodas: <?php echo $quant_rodas?> &nbsp &nbsp 	| &nbsp &nbsp 
			Sapatas: <?php echo $quant_sapata?>   
			<br><br></a>

		</div>	


	</body>
</html>	