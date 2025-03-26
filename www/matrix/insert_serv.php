<?php
	session_start();
	require('db.php');

	// insere usuário novo
	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$nome = '';
		$id = '';
		if($status == 'create') {
			if(isset($_POST['serv_nome'])){
				$nome = $_POST['serv_nome'];
				$stmt = $con->prepare("INSERT INTO tipo_servico (descricao_serv) VALUES ('$nome')");
				$stmt->execute();
				$_SESSION['message'] = "Dados adicionados"; 
				header('location: create_serv.php');
			}	
		}
	}
	
	
	
	//edita usuário	
	if (isset($_GET['editar'])) {
		$id = $_GET['editar'];
		$stmt = $con->prepare("SELECT * FROM tipo_servico WHERE id_serv='$id'");
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $nome);
			$stmt->fetch();
		}
	}

	//deleta usuário	
	if (isset($_GET['deletar'])) {
		$id = $_GET['deletar'];
		$stmt = $con->prepare("DELETE FROM tipo_servico WHERE id_serv='$id'");
		$stmt->execute();
		header('location: create_serv.php');
	}
?>
<?php
	$_SESSION['active'] = 'tipo_servico';
	require ('./topo.php');
	require('menu.php');
?>

		<div class="create_serv">
			<div class="serv_ali">
				<h1>Editar usuário</h1>
				<form action="insert_serv.php" method="post">
					<label for="name">Descrição</label>
					<input type="text" name="serv_nome" id="serv_nome" required value="<?php echo $nome; ?>">
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
			if(isset($_POST['serv_nome'])){
				$nome = $_POST['serv_nome'];
				$id = $_POST['id'];
				$stmt = $con->prepare("UPDATE tipo_servico SET descricao_serv='$nome' WHERE id_serv='$id'");
				$stmt->execute();
				$_SESSION['message'] = "Dados atualizados"; 
				header('location: create_serv.php');
			}	
		}
	}
?>
