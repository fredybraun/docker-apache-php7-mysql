<?php
session_start();
require ('./topo2.php');
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
	$_SESSION['active'] = 'funcionario';
	require('menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
	<h3>Inserir novo funcionário</h1>
	<form action="insert_fun.php" method="post">
		<div class="form-group">
			<label for="username">Nome</label>
			<input type="text" name="fun_nome" id="fun_nome" required>
		</div>			
		<div class="form-check mt-3">
			<input  type="checkbox" class="form-check-input" id="fun_status"  name="fun_status" value="1">
			<label for="fos" class="form-check-label">Ativo</label>
		</div>
		<div class="form-check mt-3">
			<input  type="checkbox" class="form-check-input" id="agenda"  name="agenda" value="1">
			<label for="fos" class="form-check-label">Agendamento</label>
		</div>
		<div class="form-group">
			<input type="hidden" name="status" id="status" value="create">
			<br>
			<button class="btn btn-primary" type="submit">Adicionar</button>
		</div>	
	</form>	
</div>
<div class="container-fluid mt-2 col-md-12">
	<h3>Funcionários cadastrados</h3>
			<div class="container-fluid">
					 	<div class="row bg-secondary text-white w-100">
						      <div class="col-3">Nome</div> 		
						      <div class="col-2">Status</div>
						      <div class="col-5">Agenda</div>
						      <div class="col-1"></div>
						      <div class="col-1"></div>
						</div>	
			<?php
				if ($stmt = $con->prepare('SELECT id_func, nome_func, status, agenda FROM funcionario ')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
					$stmt->bind_result($id, $nome, $status, $agenda);
						while ($stmt->fetch()) {
							echo '<div class="row">';
					        echo '<div class="col-3">'.$nome.'</div>';
					        echo '<div class="col-2">'.$status.'</div>';
					        echo '<div class="col-5">'.$agenda.'</div>';
					        if($_SESSION['nivel'] == 1){
					        	echo '<div class="col-0"><spam class="badge badge-primary"><a class="text-white" href="insert_fun.php?editar='.$id.'">Editar</a><spam></div>';
					        	echo '<div class="col-1"><spam class="badge badge-danger"><a class="text-white" href="insert_fun.php?deletar='.$id.'">Deletar</a></div>';
					        }
					        
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