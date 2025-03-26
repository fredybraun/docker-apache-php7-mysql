<?php
	session_start();
	require('db.php');
	require ('./funcoes.php');
	// insere
	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$nome = '';
		$valor = '';
		$agenda = '';
        $quantidade = '';
		if($status == 'create') {
			if(isset($_POST['item_nome'])){
				$nome = $_POST['item_nome'];
				$valor = moeda($_POST['item_valor']);
                $quantidade = $_POST['item_quantidade'];
				$stmt = $con->prepare("INSERT INTO itens_locacoes (nome_itens_locacoes, valor_itens_locacoes, quantidade_itens_locacoes) VALUES ('$nome', '$valor', '$quantidade')");
				$stmt->execute();
				$_SESSION['message'] = "Dados adicionados"; 
				header('location: create_locacoes.php');
			}	
		}
	}
	

	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$id = '';
		$nome = '';
		$valor = '';
		if($status == 'update') {
			if(isset($_POST['item_nome'])){
                $id = $_POST['id'];
				$nome = $_POST['item_nome'];
				$valor = moeda($_POST['item_valor']);
                $quantidade = $_POST['item_quantidade'];
                
				$stmt = $con->prepare("UPDATE itens_locacoes SET nome_itens_locacoes='$nome', valor_itens_locacoes='$valor', quantidade_itens_locacoes='$quantidade' WHERE id_itens_locacoes ='$id'");
				$stmt->execute();
				$_SESSION['message'] = "Dados atualizados"; 
				header('location: create_locacoes.php');
			}	
		}
	}


	
	//edita usuário	
	if (isset($_GET['editar'])) {
		$id = $_GET['editar'];
		$stmt = $con->prepare("SELECT id_itens_locacoes, nome_itens_locacoes, valor_itens_locacoes, quantidade_itens_locacoes FROM itens_locacoes WHERE id_itens_locacoes='$id'");
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $nome, $valor, $quantidade);
			$stmt->fetch();
		}
	}

	//deleta usuário	
	if (isset($_GET['deletar'])) {
		$id = $_GET['deletar'];
		$stmt = $con->prepare("DELETE FROM itens_locacoes WHERE id_itens_locacoes='$id'");
		$stmt->execute();
		header('location: create_locacoes.php');
	}
?>
<?php
	$_SESSION['active'] = 'locacoes';
	require ('./topo2.php');
	require('menu2.php');
?>


<div class="container-fluid mt-2 col-md-12">
	<h3>Inserir novo funcionário</h1>
	<form action="insert_locacoes.php" method="post">
		<div class="form-group">
            <label for="fos">Nome do item</label>
			<input class="form-control w-25" type="text" name="item_nome" id="item_nome" value="<?php echo $nome?>"required>
		</div>
        <div class="form-group">
            <label for="fos">Valor do item</label>
			<input class="form-control w-25" type="text" name="item_valor" id="item_valor" onkeypress='$(this).mask("###0,00", {reverse: true});' value="<?php echo moeda_formato($valor)?>"required>
		</div>
        <div class="form-group">
			<label for="fos">Quantidade Total</label>
			<input class="form-control w-25" type="text" name="item_quantidade" id="item_quantidade" value="<?php echo $quantidade?>" required>
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
