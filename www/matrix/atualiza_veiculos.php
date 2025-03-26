
<?php
session_start();
require('db.php');
require ('funcoes.php');

	if(isset($_POST['status_mod'])){
		$status = $_POST['status_mod'];
		$nome = '';
		$id = '';
		$motorista = '';
		$status_veiculo = '';
		if($status == 'update') {
			if(isset($_POST['veiculo_nome'], $_POST['veiculo_func'], $_POST['veiculo_status'])){
				$id =  $_POST['id'];
                
				$nome = $_POST['veiculo_nome'];
				$motorista = $_POST['veiculo_func'];
				$status_veiculo = $_POST['veiculo_status'];
                echo "id:".$status_veiculo;
				$stmt = $con->prepare("UPDATE veiculo SET nome_veiculo='$nome', motorista='$motorista', status_veiculo='$status_veiculo' WHERE id_veiculo='$id'");
				$stmt->execute();
				echo $id;
				header('location: create_veiculos.php');
				die();
			}		
		}
	}
?>
