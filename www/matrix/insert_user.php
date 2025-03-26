<?php
	session_start();
	require('db.php');

	// insere usuário novo
	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$username = '';
		$password = '';
		$nivel ='';
		if($status == 'create') {
			if(isset($_POST['username'], $_POST['password'])){
				$username = $_POST['username'];
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$nivel = $_POST['nivel'];
				$stmt = $con->prepare("INSERT INTO contas (username, password, nivel) VALUES ('$username', '$password', '$nivel')");
				$stmt->execute();
				$_SESSION['message'] = "Dados adicionados"; 
				header('location: create_user.php');
			}	
		}
	}
	
	
	
	//edita usuário	
	if (isset($_GET['editar'])) {
		$id = $_GET['editar'];
		$stmt = $con->prepare("SELECT * FROM contas WHERE id='$id'");
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $username, $password, $nivel);
			$stmt->fetch();
		}
	}

	//deleta usuário	
	if (isset($_GET['deletar'])) {
		$id = $_GET['deletar'];
		$stmt = $con->prepare("DELETE FROM contas WHERE id='$id'");
		$stmt->execute();
		header('location: create_user.php');
	}
?>
<?php
	$_SESSION['active'] = 'usuario';
	require ('./topo.php');
	require('menu.php');
?>


		<div class="create_user">
			<div class="user_ali">
				<h1>Editar usuário</h1>
				<form action="insert_user.php" method="post">
					<label for="username">
						<i class="fas fa-user"></i>
					</label>
					<input type="text" name="username" placeholder="Username" id="username" required value="<?php echo $username; ?>">
					<label for="password">
						<i class="fas fa-lock"></i>
					</label>
					<input type="hidden" name="status" value="update">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="password" name="password" placeholder="Password" id="password" required value="">
					<label for="nivel">Nível</label>
					<select name="nivel" id="nivel"
					required>
						<?php
							if($nivel == 1){
								echo '<option selected value="1">1</option>
								<option value="2">2</option>';
							}
							if($nivel == 2){
								echo '<option  value="1">1</option>
								<option selected value="2">2</option>';
							}
						?>
					</select>
					<input type="submit" name="insert" value="Atualizar">
					<input type="button" value="Voltar" onClick="history.go(-1)">
				</form>
			</div>	
		</div>
	</body>
</html>	
<?php
	if(isset($_POST['status'])){
		$status = $_POST[status];
		$username = '';
		$password = '';
		$id = '';
		$nivel = '';
		if($status == 'update') {
			if(isset($_POST['username'], $_POST['password'])){
				$username = $_POST['username'];
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$id = $_POST['id'];
				$nivel =  $_POST['nivel'];
				$stmt = $con->prepare("UPDATE contas SET username='$username', password='$password', nivel = '$nivel' WHERE id='$id'");
				$stmt->execute();
				$_SESSION['message'] = "Dados atualizados"; 
				header('location: create_user.php');
			}	
		}
	}
?>
