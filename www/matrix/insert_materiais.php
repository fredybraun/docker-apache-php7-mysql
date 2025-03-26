<?php
	session_start();
	require('db.php');
	require ('./funcoes.php');

	// insere usuário novo
	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$nome = '';
		$valor = '';
		$id = '';
		if($status == 'create') {
			if(isset($_POST['mat_nome'], $_POST['mat_valor']) ){
				$nome = $_POST['mat_nome'];
				$valor = $_POST['mat_valor'];
				$stmt = $con->prepare("INSERT INTO materiais (nome_mat, valor_mat) VALUES ('$nome', '$valor')");
				$stmt->execute();
				$_SESSION['message'] = "Dados adicionados"; 
				header('location: create_materiais.php');
			}	
		}
	}
	
	
	
	//edita usuário	
	if (isset($_GET['editar'])) {
		$id = $_GET['editar'];
		$stmt = $con->prepare("SELECT * FROM materiais WHERE id_mat='$id'");
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $nome, $valor);
			$stmt->fetch();
		}
	}

	//deleta usuário	
	if (isset($_GET['deletar'])) {
		$id = $_GET['deletar'];
		$stmt = $con->prepare("DELETE FROM materiais WHERE id_mat='$id'");
		$stmt->execute();
		header('location: create_materiais.php');
	}
?>
<?php
	$_SESSION['active'] = 'materiais';
	require ('./topo.php');
	require('menu.php');
?>


		<div class="create_fun">
			<div class="fun_ali">
				<h1>Editar materiais/fornecedores</h1>
				<form action="insert_materiais.php" method="post">
					<label for="username">Material</label>
					<input type="text" name="mat_nome" id="mat_nome" required value="<?php echo $nome; ?>">
					<label for="username">Valor</label>
					<input type="text" name="mat_valor" id="mat_valor" required value="<?php echo $valor; ?>">
					<input type="hidden" name="status" value="update">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit" name="insert" value="Atualizar">
					<input type="button" value="Voltar" onClick="history.go(-1)">
				</form>
			</div>	
		</div>
	</body>
</html>	
<?php
	if(isset($_POST['status'])){
		//$status = $_POST[status];
		$nome = '';
		$id = '';
		if($status == 'update') {
			if(isset($_POST['mat_nome'], $_POST['mat_valor']) ){
				$nome = $_POST['mat_nome'];
				$valor = $_POST['mat_valor'];
				$id = $_POST['id'];
				$stmt = $con->prepare("UPDATE materiais SET nome_mat='$nome', valor_mat='$valor' WHERE id_mat='$id'");
				$stmt->execute();
				$_SESSION['message'] = "Dados atualizados"; 
				header('location: create_materiais.php');
			}	
		}
	}
?>
