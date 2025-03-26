<?php
session_start();
//valida usuário esta logado, caso não, redireciona para loguin.
require('./db.php');
if(!isset($_SESSION["name"])){
header("Location: ./login.php");
exit(); }
require ('./topo2.php');
require ('./funcoes.php');
?>

		<?php
			$_SESSION['active'] = 'home';
			include('menu2.php');
		?>
		<div class="container-fluid mt-2 col-md-12">
			<div class="row">
				<div class="col-sm">
					<h3>Totais de Ordens de Serviço</h3>
					<li class="list-unstyled"><a href="medidas_os.php">Medidas: 
						<?php
							if ($stmt = $con->prepare("SELECT COUNT(id_status) FROM ordem_serv WHERE id_status = '1' ")) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_medidas);
								$stmt->fetch();
							     echo $quantidade_medidas;        
							}
							$stmt->free_result();
						}
						?>
					</a></li>
					<li class="list-unstyled"><a href="orcamento_os.php">Orçamentos: 
						<?php
							if ($stmt = $con->prepare("SELECT COUNT(id_status) FROM ordem_serv WHERE id_status = '6' ")) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_medidas);
								$stmt->fetch();
							     echo $quantidade_medidas;        
							}
							$stmt->free_result();
						}
						?>
					</a></li>
					<li class="list-unstyled"><a href="montagem_os.php">Montagens: 
						<?php
							if ($stmt = $con->prepare("SELECT COUNT(id_status) FROM ordem_serv WHERE id_status = '2' ")) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_medidas);
								$stmt->fetch();
							     echo $quantidade_medidas;        
							}
							$stmt->free_result();
						}
						?>
					</a></li>
					<li class="list-unstyled"><a href="instalacao_os.php">Instalações: 
						<?php
							if ($stmt = $con->prepare("SELECT COUNT(id_status) FROM ordem_serv WHERE id_status = '3' ")) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_medidas);
								$stmt->fetch();
							     echo $quantidade_medidas;        
							}
							$stmt->free_result();
						}
						?>
					</a></li>
					<li class="list-unstyled"><a href="cobranca_os.php">Cobranças: 
						<?php
							if ($stmt = $con->prepare("SELECT COUNT(id_status) FROM ordem_serv WHERE id_status = '4' ")) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
								$stmt->bind_result($quantidade_medidas);
								$stmt->fetch();

								$stmt2 = $con->prepare("SELECT SUM(valor_os) FROM ordem_serv WHERE id_status = '4'");
								$stmt2->execute();
								$stmt2->store_result();
								$num_of_rows2 = $stmt2->num_rows;
								if ($stmt2->num_rows > 0) {
									$stmt2->bind_result($total_valor_os);
									$stmt2->fetch();
								}
							     echo $quantidade_medidas.'</a> Valor total das OS: R$ '. moeda_formato($total_valor_os);        
							}
							$stmt->free_result();
						}
						?>
					</li>
					<li class="list-unstyled"><a href="historico_os.php">Histórico: 
						<?php
							if ($stmt = $con->prepare("SELECT COUNT(id_status) FROM ordem_serv WHERE id_status = '5' ")) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_medidas);
								$stmt->fetch();
							     echo $quantidade_medidas;        
							}
							$stmt->free_result();
						}
						?>
					</a></li>
				</div>				
			</div>
			<div class="row">
				<div class="col-sm">
					<img class="rounded mt-3 mb-3" alt="" src="grafico.php" title="">
				</div>
				<div class="col-sm">
					<img class="rounded mt-3 mb-3" alt="" src="graficoFechamento.php" title="">
				</div>	
			</div>
			<div class="row">
				<div class="col-sm">
					<img class="rounded mt-3 mb-3" alt="" src="grafico2.php" title="">
				</div>
				<div class="col-sm">
					<img class="rounded mt-3 mb-3" alt="" src="grafico5.php" title="">
				</div>	
				<div class="col-sm">
					<img class="rounded mt-3 mb-3" alt="" src="graficoFat.php" title="">
				</div>
				
			</div>			
		</div>
	</body>
</html>