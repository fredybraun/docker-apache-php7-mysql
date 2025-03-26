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
die(); }
?>
<?php
	$_SESSION['active'] = 'materiais';
	require('menu.php');
?>
		<div class="create_fun">
			<div class="fun_ali">
				<h1>Cadastro valor dos materiais/fornecedores</h1>
				<form action="insert_materiais.php" method="post">
					<label for="username">Material</label>
					<input type="text" name="mat_nome" id="mat_nome" required>
					<label for="username">Valor</label>
					<input type="text" name="mat_valor" id="mat_valor" required>
					<input type="hidden" name="status" id="status" value="create">
					<input type="submit" name="insert" value="Adicionar">
				</form>	
			</div>
		</div>
		<div class="list_user">
			<h1>Materiais cadastrados</h1>
			<div class="horizontal">
			<?php
				if ($stmt = $con->prepare('SELECT id_mat, nome_mat, valor_mat FROM materiais ')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
					$stmt->bind_result($id, $nome, $valor);
						while ($stmt->fetch()) {
					        echo '<div class="resultado">';
					        echo $nome. ' --> R$ '.$valor;
					        echo '<div class="resultado_botoes">';
					        if($_SESSION['nivel'] == 1){
					        	echo '<a href="insert_materiais.php?editar='.$id.'" class="button">Editar</a>';
					        	echo '<a href="insert_materiais.php?deletar='.$id.'" class="button"';?>onclick="return confirm('Tem certeza que deseja deletar esse registro?');"<?php echo '>Deletar</a>';
					        }
					        
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