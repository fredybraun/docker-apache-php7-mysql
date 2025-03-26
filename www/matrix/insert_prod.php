<?php
	session_start();
	require('db.php');
	require ('funcoes.php');

	// insere produto
	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$nome = '';
		$valor = '';
		if($status == 'create') {
			if(isset($_POST['prod_nome'], $_POST['prod_valor'], $_POST['cat_prod'], $_POST['status_prod'])){
				$nome = $_POST['prod_nome'];
				$valor = moeda($_POST['prod_valor']);
				$cat_prod = $_POST['cat_prod'];
				$status_prod = $_POST['status_prod'];
				$stmt = $con->prepare("INSERT INTO produtos (nome_prod, valor_unit_prod, status_prod, cat_prod) VALUES ('$nome', '$valor', '$status_prod', '$cat_prod')");
				$stmt->execute();
				$_SESSION['message'] = "Dados adicionados"; 
				header('location: create_prod.php');
			}
		}

	}
	//edita usuário	
	if (isset($_GET['editar'])) {
		$id = $_GET['editar'];
		$stmt = $con->prepare("SELECT id_prod, nome_prod, valor_unit_prod, status_prod, cat_prod FROM produtos WHERE id_prod='$id'");
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $nome, $valor, $status_prod, $cat_prod);
			$stmt->fetch();
		}
	}
	//deleta usuário	
	if (isset($_GET['deletar'])) {
		$id = $_GET['deletar'];
		$stmt = $con->prepare("DELETE FROM produtos WHERE id_prod='$id'");
		$stmt->execute();
		header('location: create_prod.php');
		exit();
	}

	$_SESSION['active'] = 'produtos';
require ('./topo2.php');
require ('./menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
	<h3>Editar Produtos</h3>
		<form action="atualiza_prod.php" method="post">
			<div class="form-group">
				<label for="nome">Descrição</label>
				<input class="form-control w-50" type="text" name="prod_nome" id="prod_nome" required value="<?php echo $nome; ?>">
			</div>
			<div class="form-group">
				<label for="valor">Valor</label>
				<input class="form-control w-25" type="text" id="prod_valor"  name="prod_valor" onkeypress='$(this).mask("###0,00", {reverse: true});' value="<?php $valor_virgula = $valor = str_replace('.', ',',$valor);echo $valor_virgula;?>">
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
									if($id_cat_prod == $cat_prod){echo '<option selected value="'.$id_cat_prod.'">'.$nome_cat_prod.'</option>';}
									else{echo '<option value="'.$id_cat_prod.'">'.$nome_cat_prod.'</option>';}
							        
							    }
							}
							$stmt->free_result();
					}
				?>
			</select>
			<label for="fos">Status</label>
			<select class="form-control w-25" id="status_prod" name="status_prod">
				<?php
					if ($status_prod == 0){
						echo '<option value="1">Ativo</option>';
						echo '<option selected value="0">Inativo</option>';
					}
					if ($status_prod == 1){
						echo '<option selected value="1">Ativo</option>';
						echo '<option value="0">Inativo</option>';
					}
				?>
			</select>
		</div>
			<input type="hidden" name="status_mod" value="update">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<button class="btn btn-primary" type="submit">Atualizar</button>
			<button type="button" class="btn btn-primary"onClick="history.go(-1)">Voltar</button>
		</form>
			</div>	
</div>
	</body>
</html>	
