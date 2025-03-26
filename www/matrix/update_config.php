<?php
	session_start();
	require('db.php');
	require ('./funcoes.php');
	
	// insere usuário novo
	if(isset($_POST['ano_vigente'])){
		$ano_vigente = $_POST['ano_vigente'];
		$stmt = $con->prepare("UPDATE configuracoes SET ano_vigente='$ano_vigente'");
		$stmt->execute();
		$_SESSION['message'] = "Dados adicionados"; 
		header('location: configuracoes.php');	
	}
?>