<?php
	session_start();
	require('db.php');
	require ('./funcoes.php');
	// insere usuário novo
	if(isset($_POST['status'])){
		$status1 = $_POST['status'];
		$nome = '';
		$status = '';
		$agenda = '';
		if($status1 == 'create') {
			if(isset($_POST['fun_nome'])){
				$nome = $_POST['fun_nome'];
				$fun_status = $_POST['fun_status'];
				$agenda = $_POST['agenda'];
				$stmt = $con->prepare("INSERT INTO funcionario (nome_func, status, agenda) VALUES ('$nome', '$fun_status', '$agenda')");
				$stmt->execute();
				$_SESSION['message'] = "Dados adicionados"; 
				header('location: create_fun.php');
			}	
		}
	}
	

	if(isset($_POST['status'])){
		$status2 = $_POST['status'];
		$nome = '';
		$id = '';
		$fun_status = '';
		$agenda = '';
		if($status2 == 'update') {
			if(isset($_POST['fun_nome'])){
				$nome = $_POST['fun_nome'];
				$id = $_POST['id'];
                if(!isset($_POST['fun_status'])){
                    $fun_status = 0;
                }else{$fun_status = $_POST['fun_status'];}
				if(!isset($_POST['agenda'])){
                    $agenda = 0;
                }else{$agenda = $_POST['agenda'];}
				$stmt = $con->prepare("UPDATE funcionario SET nome_func='$nome', status='$fun_status', agenda='$agenda' WHERE id_func='$id'");
				$stmt->execute();
				$_SESSION['message'] = "Dados atualizados"; 
				header('location: create_fun.php');
			}	
		}
	}


	
	//edita usuário	
	if (isset($_GET['editar'])) {
		$id = $_GET['editar'];
		$stmt = $con->prepare("SELECT id_func, nome_func, status, agenda FROM funcionario WHERE id_func='$id'");
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $nome, $fun_status, $agenda);
			$stmt->fetch();
		}
	}

	//deleta usuário	
	if (isset($_GET['deletar'])) {
		$id = $_GET['deletar'];
		$stmt = $con->prepare("DELETE FROM funcionario WHERE id_func='$id'");
		$stmt->execute();
		header('location: create_fun.php');
	}
?>
<?php
	$_SESSION['active'] = 'funcionario';
	require ('./topo2.php');
	require('menu2.php');
?>


<div class="container-fluid mt-2 col-md-12">
	<h3>Inserir novo funcionário</h1>
	<form action="insert_fun.php" method="post">
		<div class="form-group">
			<label for="username">Nome</label>
			<input type="text" name="fun_nome" id="fun_nome" value="<?php echo $nome?>"required>
		</div>			
		<div class="form-check mt-3">
			<input  type="checkbox" class="form-check-input" id="fun_status"  name="fun_status" value="1" <?php if($fun_status == 1) {echo 'checked';}?>>
			<label for="fos" class="form-check-label">Ativo</label>
		</div>
		<div class="form-check mt-3">
			<input  type="checkbox" class="form-check-input" id="agenda"  name="agenda" value="1" <?php if($agenda == 1) {echo 'checked';}?>>
			<label for="fos" class="form-check-label">Agendamento</label>
		</div>
		<div class="form-group">
			<input type="hidden" name="status" id="status" value="update">
			<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
			<br>
			<button class="btn btn-primary" type="submit">Atualizar</button>
			<button type="button" class="btn btn-primary"onClick="history.go(-1)">Voltar</button>
		</div>	
	</form>	
</div>
	</body>
</html>	
