<?php
session_start();
require ('./topo2.php');
require ('./funcoes.php');
$_SESSION["onde_estou"] = 'create_andaime';
?>

<?php
//valida usuário esta logado, caso não, redireciona para loguin.
require('./db.php');
if(!isset($_SESSION["name"])){
	header("Location: login.php");
exit(); }

$_SESSION['active'] = 'locacao';
require('menu2.php');

//edita usuário 
if (isset($_GET['id_andaime'])) {
    $id = $_GET['id_andaime'];
    $stmt = $con->prepare("SELECT id_andaime, data_solicitacao, id_cli, quant_andaime, quant_plataforma, quant_travessa, quant_rodas, quant_sapata, quant_escada_longa, quant_escada_curta, frete_entrega, frete_retorno, data_retirada, data_retorno, end_entrega, status, valor, dias_locados FROM andaimes WHERE id_andaime='$id'");
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_andaime, $data_solicitacao, $id_cli, $quant_andaime, $quant_plataforma, $quant_travessa, $quant_rodas, $quant_sapata, $quant_escada_longa, $quant_escada_curta, $frete_entrega, $frete_retorno, $data_retirada, $data_retorno, $end_entrega, $status, $valor, $dias_locados);
        $stmt->fetch();     
    }

} 
?>

<div class="container-fluid mt-2 col-md-12">
	<h3>Dados da Locação de Equipamento N°: <?php echo $id_andaime;?></h3>
				<?php

						if ($stmt = $con->prepare("SELECT * FROM clientes WHERE id_cli = '$id_cli'")) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($id_cli, $nome_cli, $cpf_cli, $end_cli, $num_cli, $cid_cli, $tel_cli, $tel2_cli, $obs_cli, $contato_cli, $bairro_cli);
								$stmt->fetch();
								?>
								<strong>Cliente: </strong><?php echo '<a href="dados_cliente.php?id_cliente='.$id_cli.'">'.$nome_cli.'</a>'?><br>
								<strong>CPF/CNPJ: </strong><?php echo $cpf_cli;?><br>
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
								?>
								<strong>Endereço: </strong><?php echo $end_cli.', '.$num_cli.' - '.$bairro_cli.' - '.$nome_cidade;?><br>
								<strong>Telefone: </strong><?php echo $tel_cli;?><br>
								<strong>Telefone: </strong><?php echo $tel2_cli;?><br>
								<strong>Contato: </strong><?php echo $contato_cli;?><br>	
								<strong>Observações: </strong><?php echo $obs_cli;?><br><br>
								<?php
							}
							$stmt->free_result();
						}

					?>

				<strong>Endereço de entrega: </strong><?php echo $end_entrega;?><br>
				<strong>Data de solicitação: </strong><?php echo trocadatabarra($data_solicitacao);?><br>
				<strong>Data de retirada: </strong><?php echo trocadatabarra($data_retirada);?><br>
				<strong>Data de retorno: </strong><?php if(trocadatabarra($data_retorno) == '01/01/1970'){echo 'Indeterminado';}else{echo trocadatabarra($data_retorno);} ;?><br>
				<strong>Frete de entrega: </strong><?php if($frete_entrega == 0){echo 'Não';} if($frete_entrega == 10){echo 'Frete Local';} if($frete_entrega == 11){echo 'Frete Distância 20km';} if($frete_entrega == 12){echo 'Frete Distância 40km';}?><br>
				<strong>Frete de retorno: </strong><?php if($frete_retorno == 0){echo 'Não';} if($frete_retorno == 10){echo 'Frete Local';} if($frete_retorno == 11){echo 'Frete Distância 20km';} if($frete_retorno == 12){echo 'Frete Distância 40km';}?><br>
				<strong>Peças locadas: </strong>Andaimes: <?php echo $quant_andaime;?> | Plataformas: <?php echo $quant_plataforma;?> | Travessas: <?php echo $quant_travessa;?> | Rodas: <?php echo $quant_rodas;?> | Sapatas: <?php echo $quant_sapata;?> | Escada Longa: <?php echo $quant_escada_longa;?> | Escada Curta: <?php echo $quant_escada_curta;?><br>
				<strong>Dias locados: </strong><?php echo $dias_locados;?><br>
				<strong>Valor total: </strong><?php if($valor){echo "R$ ".moeda_formato($valor);}?><br>	
			<div class="form-group mt-2">
				<button type="button" class="btn btn-primary"onClick="history.go(-1)">Voltar</button>
				<?php
					echo '<a href="insert_andaime.php?editar='.$id_andaime.'"><button type="button" class="btn btn-primary ">Editar</button></a>';
					echo '<a target=”_blank” href="contrato_andaime.php?imprimir='.$id_andaime.'"><button type="button" class="btn btn-primary ml-1">imprimir</button></a>';	
				?>			
					
			</div>
</div>
				



		</body>
</html>