
<?php
session_start();
require('db.php');
require ('funcoes.php');

	if(isset($_POST['status_mod'])){
		$status = $_POST['status_mod'];
		$data_despesa = '';
		$id_veiculo = '';
        $km='';
        $litro='';
        $valor='';
		if($status == 'update') {
			if(isset($_POST['data_despesa'], $_POST['veiculo'], $_POST['km'], $_POST['litros'], $_POST['valor'])){
				$id =  $_POST['id'];
				$data = trocadatatraco($_POST['data_despesa']);
				$veiculo = $_POST['veiculo'];
                $km = $_POST['km'];
                $litros = moeda($_POST['litros']);
                $valor = moeda($_POST['valor']);
				
                $stmt = $con->prepare("UPDATE despesa_combustivel SET 
                data_despesa='$data', 
                veiculo_despesa='$veiculo', 
                km_despesa='$km', 
                litro_despesa='$litros', 
                valor_despesa='$valor' WHERE id_despesa='$id'");
				
                $stmt->execute();
				echo $id;
				header('location: create_despesas_veiculos.php');
				die();
			}		
		}
	}
?>
