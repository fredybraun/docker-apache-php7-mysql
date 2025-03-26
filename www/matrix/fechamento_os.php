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

if(isset($_POST['contador1'])){
		$contador1 = $_POST['contador1'];
		$os = array();
		for($i=1; $i <= $contador1; $i++){
			if(isset($_POST['os_'.$i])){
				$os[$i] = $_POST['os_'.$i];
			}	 
		}
}
?>
<div class="container-fluid mt-2 col-md-12">
	<h3>Fechamento de Ordens de serviços</h3>
		<form action="insert_fechamento.php" method="post">
			<div class="form-group">
<?php
//zera o valor total da cobrança	
$valor_total_cobranca = 0;
$contador2 = $contador1;
foreach ($os as $key=>$num_os){
    //echo "$key => $num_os <br>";
    if ($stmt3 = $con->prepare("SELECT id_os, valor_os FROM ordem_serv WHERE id_os = '$num_os' ORDER BY id_os")) {
						$stmt3->execute();
						$stmt3->store_result();
						$num_of_rows = $stmt3->num_rows;
						
						if ($stmt3->num_rows > 0) {
						$stmt3->bind_result($id_os_cli, $valor_os);
							while ($stmt3->fetch()) {
								echo '<input type="hidden" name="os_'.$key.'" id="os_'.$key.'" value="'.$id_os_cli.'">';
								echo "OS: ".$id_os_cli. " - Valor: R$ ". moeda_formato($valor_os). "<br>";
								$valor_total_cobranca = $valor_total_cobranca + $valor_os;
							}
						}
	} 
}
echo "<strong>Valor total da cobrança: R$ ". moeda_formato($valor_total_cobranca) . "</strong>";
?>
			</div>	
			<div class="form-group">	
				<label for="fos">Opções de Pagamento</label>
				<select required class="form-control w-25" id="cond_pgt" name="cond_pgt">
					<option value=""></option>
					<?php
						if ($stmt = $con->prepare('SELECT id_cond_pag, nome_cond_pag FROM condicoes_pagamento ')) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($id_cond_pag, $nome_cond_pag);
								while ($stmt->fetch()) {
							        echo '<option value="'.$id_cond_pag.'">'.utf8_encode($nome_cond_pag).'</option>';
							    }
							}
							$stmt->free_result();
						}
					?>
				</select>	
		    </div>
	    	<div class="form-group">
				<label for="nf">Nota Fiscal</label>
		    	<input type="text" class="form-control w-25" id="nf" name="nf">
		    </div>
		    <div class="form-group">
		    	<label for="ordem">Ordem de Compra</label>
		    	<input type="text" class="form-control w-25" id="ordem" name="ordem"><br>
		    	<input type="hidden" name="status" id="status" value="update">
		    	<input type="hidden" id="contador2" name="contador2" value="<?php echo $contador2; ?>">
		    </div>
		    <div class="form-group">	
		    	<button class="btn btn-primary">Finalizar</button>
		    	<button class="btn btn-primary" onClick="history.go(-1)">Voltar</button>
			</div>
		</form>
</div>
