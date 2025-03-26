<?php
session_start();
require ('./topo.php');
require ('./funcoes.php');
?>


<?php
//valida usuário esta logado, caso não, redireciona para loguin.
require('./db.php');
if(!isset($_SESSION["name"])){
header("Location: login.php");
exit(); }
?>
<?php
	$_SESSION['active'] = 'usuario';
	require('menu.php');
?>
		<div class="create_user">
			<div class="cli_user">
				<h1>Inserir novo usuário</h1>
				<form action="insert_user.php" method="post">
					<label for="username">
						<i class="fas fa-user"></i>
					</label>
					<input type="text" name="username" placeholder="Usuário" id="username" required>
					<label for="password">
						<i class="fas fa-lock"></i>
					</label>
					<input type="hidden" name="status" id="status" value="create">
					<input type="password" name="password" placeholder="Password" id="password" required>
					
					<label for="nivel">Nível</label>
					<select name="nivel" id="nivel"
					required>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>

					<input type="submit" name="insert" value="Adicionar">
				</form>	
			</div>
		</div>
		<div class="list_user">
			<h1>Usuários cadastrados</h1>
			<div class="horizontal">
			<?php
				if ($stmt = $con->prepare('SELECT id, username FROM contas ')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
					$stmt->bind_result($id, $username);
						while ($stmt->fetch()) {
					        echo '<div class="resultado">';
					        echo $username;
					        echo '<div class="resultado_botoes">';
					        echo '<a href="insert_user.php?editar='.$id.'" class="button">Editar</a>';
					        echo '<a href="insert_user.php?deletar='.$id.'" class="button"';?>onclick="return confirm('Tem certeza que deseja deletar esse registro?');"<?php echo '>Deletar</a>';
					        echo '</div>';
					        echo '</div>';
					    }
					}
					$stmt->free_result();
				}
			?>
			</div>
		</div>
	</body>
</html>