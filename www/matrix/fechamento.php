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
        $stmt->bind_result($id_cli, $nome_cli, $cpf_cli, $end_cli, $num_cli, $cid_cli, $tel_cli, $tel2_cli, $obs_cli, $contato_cli, $bairro_cli);
        $stmt->fetch();     
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
	<h3>Dados do cliente <?php echo $nome_cli;?></h3>
	<strong>Cliente: </strong><?php echo '<a href="dados_cliente.php?id_cliente='.$id_cli.'">'.$nome_cli.'</a>';?><br>
	<strong>CPF/CNPJ: </strong><?php echo $cpf_cli;?><br>			
	<strong>Endereço: </strong><?php echo $end_cli.', '.$num_cli.' - '.$bairro_cli.' - '.$nome_cidade;?><br>
	<strong>Telefone: </strong><?php echo $tel_cli;?><br>
	<strong>Telefone: </strong><?php echo $tel2_cli;?><br>
	<strong>Contato: </strong><?php echo $contato_cli;?><br>	
	<strong>Observações: </strong><?php echo $obs_cli;?><br><br>
	<br>
	<form action="fechamento_os.php" method="post">
		<table class="table table-sm w-50">
			    <tread>
				    <tr>
				      	<th scope="col">OS</th> 		
				      	<th scope="col">Valor</th>
				      	<th scope="col">Fechamento</th>
				    </tr>
				</tread> 
	<?php
		//zera o valor todas das os em cobrança
		$valor_total_cobranca = 0;
		$contador1 = 0;

		if ($stmt3 = $con->prepare("SELECT id_os, id_status, valor_os FROM ordem_serv WHERE id_cli = '$id_cli' AND id_status = '4' ORDER BY id_os")) {
			$stmt3->execute();
			$stmt3->store_result();
			$num_of_rows = $stmt3->num_rows;
			echo '<h3>Ordens de serviços para fechamento: '.$num_of_rows.'</h3>';
			if ($stmt3->num_rows > 0) {
			$stmt3->bind_result($id_os_cli, $id_status, $valor_os);
				while ($stmt3->fetch()) {
					
					if ($stmt4 = $con->prepare("SELECT nome_status FROM status WHERE id_status = '$id_status'")) {
                        $stmt4->execute();
                        $stmt4->store_result();
                        $num_of_rows = $stmt4->num_rows;
                        if ($stmt4->num_rows > 0) {
                        $stmt4->bind_result($nome_status);
                            $stmt4->fetch();
                        }
                        $stmt4->free_result();

                        // Soma os valores das OS em cobranças
                        if($id_status == 4){
                        	$valor_total_cobranca = $valor_total_cobranca + $valor_os;
                        }
                        
                    $contador1++;
                    }
                   	

					echo '<tr>';
					echo '<th scope="col"><a href="dados_os.php?id_os='.$id_os_cli.'">'.$id_os_cli.'</a></th>';
					echo '<th scope="col">Valor: R$ '.moeda_formato($valor_os).' </a></th>';
					echo '<th scope="col"><div class="form-check"><input type="checkbox" class="form-check-input" id="os_'.$contador1.'" name = "os_'.$contador1.'" value = "'.$id_os_cli.'"></div></th>';
					echo 	'</tr>';
	

						

					
				}
			}
		}
		echo '</table>';
		echo '<strong>Valor total das OS em COBRANÇA: R$ '.moeda_formato($valor_total_cobranca).'</strong>';
	?>
				<div class="form-group mt-2"> 
					<input type="hidden" id="contador1" name="contador1" value="<?php echo $contador1; ?>">
					
					<button class="btn btn-primary">Prosseguir</button>	
					<button class="btn btn-primary" onClick="history.go(-1)">Voltar</button>
				</div>	
				</form>

			</div>
		</body>
</html>