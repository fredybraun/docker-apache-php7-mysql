<?php
session_start();
$_SESSION["onde_estou"] = 'create_os';
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
	$_SESSION['active'] = 'os';
	require('menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
	<h3>Cadastro Produtos</h3>
	<form action="insert_prod.php" method="post">
		<div class="form-group">
			<label for="fos">Descrição</label>
			<input class="form-control w-50" type="text" name="prod_nome" id="prod_nome" required>
		</div>
		<div class="form-group">	
			<labelfor="fos">Valor</label>
			<input class="form-control w-25" type="text" id="prod_valor"  name="prod_valor" onkeypress='$(this).mask("###0,00", {reverse: true});' required>
			<input type="hidden" name="status" id="status" value="create">	
		</div>
		<div class="form-group">
			<label for="fos">Categoria</label>
			<select class="form-control w-25" id="cat_prod" name="cat_prod">
				<?php
					if ($stmt = $con->prepare('SELECT id_cat_prod, nome_cat_prod FROM categoria_produto ORDER BY id_cat_prod ')) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($id_cat_prod, $nome_cat_prod);
								while ($stmt->fetch()) {
							        echo '<option value="'.$id_cat_prod.'">'.$nome_cat_prod.'</option>';
							    }
							}
							$stmt->free_result();
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="fos">Status</label>
			<select class="form-control w-25" id="status_prod" name="status_prod">
				<option default value="1">Ativo</option>
				<option value="0">Inativo</option>
			</select>
		</div>	
		<button class="btn btn-primary" type="submit">Adicionar</button>
	</form>	
</div>
<div class="container-fluid mt-2 col-md-12">
	<h3>Produtos cadastrados</h3>
	<label>
        <span>Buscar Produto</span>
        <input type="search" class="form-control" name="busca" id="busca" />
    </label>
    <div id="resultado_busca"></div>

	 <table class="table table-sm">
	 	<thead>
		    <tr>
		    	<th scope="col">ID</th> 		
		        <th scope="col">Nome</th>
		        <th scope="col">Valor</th>
		        <th scope="col">Status</th>
		        <th scope="col">Editar</th>
		    </tr>
		</thead>        
			<?php
				if ($stmt = $con->prepare('SELECT id_prod, nome_prod, valor_unit_prod, status_prod
					FROM produtos ORDER BY nome_prod')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
					$stmt->bind_result($id, $nome, $valor, $status_prod);
						while ($stmt->fetch()) {
					        echo '<tr>';
					        echo '<td scope="row">'. $id . '</td>';
					        echo '<td scope="row">'. $nome . '</td>';
					        echo '<td scope="row">'. $valor . '</td>';
					        if($status_prod == 1){echo '<td scope="row">Ativo</td>';}
					        else{echo '<td scope="row">Inativo</td>';}
					        
					        echo '<td scope="row"><a class="badge badge-primary ml-2" href="insert_prod.php?editar='.$id.'" class="button">Editar</a></td>';
					        echo '</tr>';
					    }
					}
					$stmt->free_result();
				}
			?>
		</div>
	</body>
</html>