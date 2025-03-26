
<?php
session_start();
require('db.php');
require ('funcoes.php');

	if(isset($_POST['status_mod'])){
		$status = $_POST['status_mod'];
		$data_retirada = '';
		$veiculo = '';
        $valor='';
		if($status == 'update') {
			if(isset($_POST['data_retirada'], $_POST['veiculo'], $_POST['retirada_valor'])){
				$id =  $_POST['id'];
				$data = trocadatatraco($_POST['data_retirada']);
				$veiculo = $_POST['veiculo'];
                $valor = moeda($_POST['retirada_valor']);
				
                $stmt = $con->prepare("UPDATE retirada_abastecimento SET 
                data_retirada='$data', 
                veiculo_retirada='$veiculo', 
                valor_retirada='$valor' WHERE id_retirada='$id'");
				
                $stmt->execute();
				echo $id;
				header('location: create_retirada_abastecimento.php');
				die();
			}		
		}
	}
?>
