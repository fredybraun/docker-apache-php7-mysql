<!DOCTYPE html>
<?php
	require ('./topo.php');
?>

		<div class="login">
			<h1>MATRIX</h1>
			<form action="authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Usuário" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Senha" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>
	</body>
</html>