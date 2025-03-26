<?php
session_start();
require ('./funcoes.php');
require('./db.php');

//Recebe e valida ID da OS e ID do produto a ser removido da RELACAO
if(isset($_GET['id_os']) || isset($_GET['id_prod'])){
	$id_os = $_GET['id_os'];
	$id_prod = $_GET['id_prod'];


//Seleciona o que deve ser removido
	if($stmt_d = $con->prepare("SELECT id_rel_itens, valor_total_prod FROM relacao_itens WHERE id_prod = '$id_prod' AND id_os = '$id_os'")){
		$stmt_d->execute();
		$stmt_d->store_result();
		$num_of_rows = $stmt_d->num_rows;
		
		if ($stmt_d->num_rows > 0) {
		$stmt_d->bind_result($id_rel_itens, $valor_total_prod);
			
			while ($stmt_d->fetch()) {
//Com base na selecão, remove da tabela relação				
				$stmt2 = $con->prepare("DELETE FROM relacao WHERE id_rel_itens='$id_rel_itens'");
				$stmt2->execute();
//Desconta o valor do item a ser removido do valor final da OS		
				$stmt5 = $con->prepare("UPDATE ordem_serv SET valor_os = valor_os - '$valor_total_prod' WHERE id_os='$id_os'");
				$stmt5->execute();
			}
		}
	}	

//Com base na selecão, remove da tabela relação de itens
	$stmt = $con->prepare("DELETE FROM relacao_itens WHERE id_os='$id_os' AND id_prod='$id_prod'");
	$stmt->execute();

	header('location: relacao2.php?relacao=' . $id_os);
}

?>