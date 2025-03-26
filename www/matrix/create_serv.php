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
die();}
?>
<?php
	$_SESSION['active'] = 'tipo_servico';
	require('menu.php');
?>
		<div class="create_serv">
			<div class="serv_ali">
				<h1>Inserir novo tipo de serviço</h1>
				<form action="insert_serv.php" method="post">
					<label for="name">Descrição</label>
					<input type="text" name="serv_nome" id="serv_nome" required>
					<input type="hidden" name="status" id="status" value="create">
					<input type="submit" name="insert" value="Adicionar">
				</form>	
			</div>
		</div>
		<div class="list_user">
			<h1>Tipo de serviços cadastrados</h1>
			<div class="horizontal">
			<?php
				if ($stmt = $con->prepare('SELECT id_serv, descricao_serv FROM tipo_servico ')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
					$stmt->bind_result($id, $nome);
						while ($stmt->fetch()) {
					        echo '<div class="resultado">';
					        echo $nome;
					        echo '<div class="resultado_botoes">';
					        if($_SESSION['nivel'] == 1){
					        	echo '<a href="insert_serv.php?editar='.$id.'" class="button">Editar</a>';
					        	echo '<a href="insert_serv.php?deletar='.$id.'" class="button"';?>onclick="return confirm('Tem certeza que deseja deletar esse registro?');"<?php echo '>Deletar</a>';
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