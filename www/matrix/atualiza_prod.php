
<?php
session_start();
require('db.php');
require ('funcoes.php');

	if(isset($_POST['status_mod'])){
		$status = $_POST['status_mod'];
		$nome = '';
		$id = '';
		$cat_prod = '';
		$status_prod = '';
		if($status == 'update') {
			if(isset($_POST['prod_nome'], $_POST['prod_valor'], $_POST['cat_prod'], $_POST['status_prod']) ){
				$id =  $_POST['id'];
				$nome = $_POST['prod_nome'];
				$valor = moeda($_POST['prod_valor']);
				$cat_prod = $_POST['cat_prod'];
				$status_prod = $_POST['status_prod'];
				$stmt = $con->prepare("UPDATE produtos SET nome_prod='$nome', valor_unit_prod='$valor', status_prod='$status_prod', cat_prod='$cat_prod' WHERE id_prod='$id'");
				$stmt->execute();
				echo $id;
				header('location: create_prod.php');
				die();
			}		
		}
	}
?>
