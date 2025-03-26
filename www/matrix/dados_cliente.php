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
			<h3>Dados do cliente <?php echo $nome_cli;?></h3>
			<strong>Cliente: </strong><?php echo '<a href="dados_cliente.php?id_cliente='.$id_cli.'">'.$nome_cli.'</a>';?><br>
			<strong>CPF/CNPJ: </strong><?php echo $cpf_cli;?><br>			
			<strong>Endereço: </strong><?php echo $end_cli.', '.$num_cli.' - '.$bairro_cli.' - '.$nome_cidade;?><br>
			<strong>Telefone: </strong><?php echo $tel_cli;?><br>
			<strong>Telefone: </strong><?php echo $tel2_cli;?><br>
			<strong>Contato: </strong><?php echo $contato_cli;?><br>	
			<strong>Observações: </strong><?php echo $obs_cli;?><br>
			<a class="text-white" href="https://api.whatsapp.com/send?phone=55<?php echo $tel_cli;?>" target="_blank"><button type="button"class="btn btn-success">Whatsapp</button></a>
			<a href="https://maps.google.com/maps?q=<?php echo $end_cli.', '.$num_cli.','.$nome_cidade; ?>" target="_blank"><button type="button"class="btn btn-primary">Google Maps</button></a>
			<br>
			<br>
			
				
	<?php
		//zera o valor todas das os em cobrança
		$valor_total_cobranca = 0;

		if ($stmt3 = $con->prepare("SELECT id_os, id_obra, id_status, valor_os FROM ordem_serv WHERE id_cli = '$id_cli' ORDER BY id_os")) {
			$stmt3->execute();
			$stmt3->store_result();
			$num_of_rows = $stmt3->num_rows;
			echo '<h3>Ordens de serviços: '.$num_of_rows.'</h3>';
			?>
			<table class="table table-sm w-50">
			    <tread>
				    <tr>
				      	<th scope="col">OS</th> 
						<th scope="col">Obra</th>		
				      	<th scope="col">Status</th>
				      	<th scope="col"></th>
				      	<th scope="col"></th>
			      		<th scope="col"></th>
				      	<th scope="col">Valor</th>
				    </tr>
				</tread>   
			<?php
			if ($stmt3->num_rows > 0) {
			$stmt3->bind_result($id_os_cli, $id_obra, $id_status, $valor_os);
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
                    }
					if ($stmt6 = $con->prepare("SELECT nome_obra FROM obra_clientes WHERE id_obra = '$id_obra'")) {
                        $stmt6->execute();
                        $stmt6->store_result();
                        $num_of_rows = $stmt6->num_rows;
                        if ($stmt6->num_rows > 0) {
                        $stmt6->bind_result($nome_obra);
                            $stmt6->fetch();
                        }
                        $stmt6->free_result();
					}	
					echo '<tr>';
					echo '<th scope="col"><a href="dados_os.php?id_os='.$id_os_cli.'">'.$id_os_cli.'</a></th>';
					if (isset($nome_obra)) {
						echo '<th scope="col">' .$nome_obra.'</th>';
					}else{
						echo '<th scope="col"></th>';
					}
					echo '<th scope="col">' .$nome_status.'</th>';
					echo '<th scope="col"><a href="insert_os.php?editar='.$id_os_cli.'">Editar</a></th>';
					echo '<th scope="col"><a target=”_blank” href="relacao.php?relacao='.$id_os_cli.'">Relação</a></th>';
					echo '<th scope="col"><a target=”_blank” href="ficha.php?imprimir='.$id_os_cli.'">OS</a></th>';
					echo '<th scope="col">R$ '.moeda_formato($valor_os).' </a></th>';
					echo 	'</tr>';
				}
			}
		}
							echo '</table>';	
		echo '<strong>Valor total das OS em COBRANÇA: R$ '.moeda_formato($valor_total_cobranca).'</strong>';
			?>
		<div class="form-group mt-2"> 
			<?php
			
			echo '<a href="fechamento.php?id_cliente='.$id.'"><button class="btn btn-primary">Fechamento</button></a>';
			echo '<button class="btn btn-primary ml-1" onClick="history.go(-1)">Voltar</button>';
			?>	
		</div>	
	</div>
	</form>
</div>
		</body>
</html>