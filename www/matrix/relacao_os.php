<?php
session_start();
require ('./topo2.php');
require ('./funcoes.php');
?>

<?php
$_SESSION['active'] = 'os';
require('menu2.php');
?>

<body>
        <div class="container-fluid mt-2 col-md-12">
            <h3>Revisão</h3> 
            <div class="container-fluid">
                    <div class="row bg-secondary text-white w-100">
                        <div class="col-5">Produto </div>
                        <div class="col-2">Valor Unit.</div>
                        <div class="col-1">Quantidade</div>
                        <div class="col-1">Fator</div>
                        <div class="col-2">Valor Total</div>
                    </div>
            </div>
            <form action="insert_relacao.php" method="post" enctype="multipart/form-data" target="_blank">	
            	

<?php
if(isset($_POST['contador_id'])){
	//echo $_POST['contador_id'];
	$id_os = $_POST['id_os'];
	$id_cli_os = $_POST['id_cli_os'];
	$contador_id = $_POST['contador_id'];
	$id_prod = array();
	$quantidade_prod = array();
	$valor_unit = array();
	$valor_unit_fator = array();
	$fator = array();
	$valor_total_os = 0;
	for($i=1; $i <= $contador_id; $i++){
		if(isset($_POST['id_prod_'.$i])){
			$id_prod[$i] = $_POST['id_prod_'.$i];
			if ($stmt = $con->prepare("SELECT nome_prod FROM produtos WHERE id_prod = '$id_prod[$i]'")) {
			$stmt->execute();
			$stmt->store_result();
			$num_of_rows = $stmt->num_rows;
			
			if ($stmt->num_rows > 0) {
			$stmt->bind_result($nome_prod);
				while ($stmt->fetch()) {
					//echo "Nome do produto: ".$nome_prod;
				}
			}
		}
		}
		if(isset($_POST['quantidade_'.$i])){
			$quantidade_prod[$i] = moeda($_POST['quantidade_'.$i]);
			//echo "qtd:".$quantidade_prod[$i]."<br>";
		}
		if(isset($_POST['valor_unit_'.$i])){
			$valor_unit[$i] = moeda($_POST['valor_unit_'.$i]);
			//echo "valor_unit:".$valor_unit[$i]."<br>";
		}

		if(isset($_POST['fator_'.$i])){
			$fator[$i] = moeda($_POST['fator_'.$i]);
			//echo "fator:".$fator[$i]."<br>";
		}
		


		//calculo valor total
		$valor_unit_fator[$i] = $valor_unit[$i] * $fator[$i];

		$valor_total_item = 0;
		$valor_total_item = ($fator[$i] * $valor_unit[$i]) * $quantidade_prod[$i];

		$valor_total_os = $valor_total_os + $valor_total_item;

		echo '<input type="hidden" name="id_prod_'.$i.'" value="'.$id_prod[$i].'">
		      <input type="hidden" name="quantidade_prod_'.$i.'" value="'.$quantidade_prod[$i].'">
			  <input type="hidden" name="valor_unit_'.$i.'" value="'.$valor_unit_fator[$i].'">	
			  <input type="hidden" name="fator_'.$i.'" value="'.$fator[$i].'">	
			  <input type="hidden" name="valor_total_item_'.$i.'" value="'.$valor_total_item.'">	
					<div class="row w-100">
                        <div class="col-5 ml-2">'.$nome_prod.'</div>
                        <div class="col-2">'.moeda_formato($valor_unit_fator[$i]).'</div>
                        <div class="col-1 text-center">'.$quantidade_prod[$i].'</div>
                        <div class="col-1">'.$fator[$i].'</div>
                        <div class="col-2">'.moeda_formato($valor_total_item).'</div>
                    </div>';
	}
	echo '<input type="hidden" name="id_os" value="'.$id_os.'">';
	echo '<input type="hidden" name="id_cli_os" value="'.$id_cli_os.'">';
	echo '<input type="hidden" name="contador_id" value="'.$contador_id.'">';
	echo '<input type="hidden" name="valor_total_os" value="'.$valor_total_os.'">';
	echo '<h3 class="mt-2">Valor Total da OS R$ '.moeda_formato($valor_total_os).'</h3>';
}
?>
			<br>	
			<div class="form-group">
			    <label for="fos">Alterar Status</label>
    			<select required class="form-control w-25" id="status_os" name="status_os">
    				<option value=""></option>
				<?php
					if ($stmt = $con->prepare('SELECT id_status, nome_status FROM status ')) {
						$stmt->execute();
						$stmt->store_result();
						$num_of_rows = $stmt->num_rows;
						if ($stmt->num_rows > 0) {
						$stmt->bind_result($id_status, $nome_status);
							while ($stmt->fetch()) {
						        echo '<option value="'.$id_status.'">'.$nome_status.'</option>';
						    }
						}
						$stmt->free_result();
					}
				?>
			    </select>
			</div>
			<button  class= "btn btn-primary mt-2">Prosseguir</button> 
			<button type="button" class="btn btn-primary mt-2" onClick="history.go(-1)">Voltar</button>
		</form>  

		</div>
</body>		