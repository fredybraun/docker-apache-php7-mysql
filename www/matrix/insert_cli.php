<?php
	session_start();
	require('db.php');
	require ('./funcoes.php');

	// insere cliente novo
	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$nome = '';
		$cpf = '';
        $tel1 = '';
        $tel2 = '';
        $endereco = '';
        $numero = '';
        $cidade = '';
        $observacoes = '';
        $contato = '';
        $bairro	= '';
        $id = '';	
        if($status == 'create') {
            if(isset($_POST['cli_nome'], $_POST['cli_tel'], $_POST['cli_end'], $_POST['cli_cid'])){
                $nome = $_POST['cli_nome'];
                $cpf = $_POST['cli_cpf'];
                $tel1 = $_POST['cli_tel'];
                $tel2 = $_POST['cli_tel2'];
                $endereco = $_POST['cli_end'];
                $numero = $_POST['cli_num'];
                $cidade = $_POST['cli_cid'];
                $observacoes = $_POST['cli_obs'];
                $contato = $_POST['cli_contato'];
        		$bairro	= $_POST['cli_bairro'];
                $stmt = $con->prepare("INSERT INTO clientes (nome_cli, cpf_cli, end_cli, num_cli, cid_cli, tel_cli, tel2_cli, obs_cli, contato_cli, bairro_cli) VALUES ('$nome', '$cpf', '$endereco', '$numero', '$cidade', '$tel1', '$tel2', '$observacoes', '$contato', '$bairro')");
                $stmt->execute();
                $_SESSION['message'] = "Dados adicionados"; 
                header('location: create_cli.php');
				exit();
            }   
        }

	}

	//edita usuário	
	if (isset($_GET['editar'])) {
		$id = $_GET['editar'];
		$stmt = $con->prepare("SELECT * FROM clientes WHERE id_cli='$id'");
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $nome, $cpf, $endereco, $numero, $cidade, $tel1, $tel2,   $observacoes, $contato, $bairro);
			$stmt->fetch();
		}
	}

	//deleta usuário	
	if (isset($_GET['deletar'])) {
		$id = $_GET['deletar'];
		$stmt = $con->prepare("DELETE FROM clientes WHERE id_cli='$id'");
		$stmt->execute();
		header('location: create_cli.php');
		exit();
	}
?>
<?php
	if(isset($_POST['status'])){
		//$status = $_POST[status];
		$nome = '';
		$cpf = '';
        $tel1 = '';
        $tel2 = '';
        $endereco = '';
        $numero = '';
        $cidade = '';
        $observacoes = '';
        $contato = '';
        $bairro = '';
        $id = '';
		if($status == 'update') {
			if(isset($_POST['id'], $_POST['cli_nome'], $_POST['cli_tel'], $_POST['cli_end'], $_POST['cli_cid'])){
				$id = $_POST['id'];
				$nome = $_POST['cli_nome'];
                $cpf = $_POST['cli_cpf'];
                $tel1 = $_POST['cli_tel'];
                $tel2 = $_POST['cli_tel2'];
                $endereco = $_POST['cli_end'];
                $numero = $_POST['cli_num'];
                $cidade = $_POST['cli_cid'];
                $observacoes = $_POST['cli_obs'];
                $contato = $_POST['cli_contato'];
        		$bairro	= $_POST['cli_bairro'];
				$stmt = $con->prepare("UPDATE clientes SET nome_cli='$nome', cpf_cli='$cpf' ,end_cli='$endereco', num_cli='$numero', cid_cli='$cidade', tel_cli='$tel1', tel2_cli='$tel2', obs_cli='$observacoes', contato_cli='$contato', bairro_cli='$bairro' WHERE id_cli='$id'");
				$stmt->execute();
				$_SESSION['message'] = "Dados atualizados"; 
				header('location: ./create_cli.php');
				exit();
			}	
		}
	}
?>
<?php
	$_SESSION['active'] = 'cliente';
	require ('./topo2.php');
	require('menu2.php');
?>
	<div class="container-fluid mt-2 col-md-12">
		<h3>Editar usuário</h3>
		<div class="row">
			<div class="col-sm">	
			<form action="insert_cli.php" method="post">
				<div class="form-group">
					<label for="fname">Nome</label>
    				<input type="text" class="form-control w-75" id="cli_nome" name="cli_nome" value="<?php echo $nome; ?>">
    			</div>
			    <div class="form-group">
    				<label for="fcpf">CPF/CNPJ</label>
    				<input type="text" class="form-control w-75" id="cli_cpf" name="cli_cpf" value="<?php echo $cpf; ?>">
    			</div>
			    <div class="form-group">	
    				<label for="ftelefone">Telefone</label>
    				<input type="text" class="form-control w-75" id="cli_tel" name="cli_tel" value="<?php echo $tel1; ?>">
    			</div>
			    <div class="form-group">	
    				<label for="ftelefone2">Telefone2</label>
    				<input type="text" class="form-control w-75" id="cli_tel2" name="cli_tel2" value="<?php echo $tel2; ?>">
    			</div>
			    <div class="form-group">	
    				<label for="fcontato">Contato</label>
    				<input type="text" class="form-control w-75" id="cli_contato" name="cli_contato" value="<?php echo $contato; ?>">
    			</div>
 			</div>		
			<div class="col-sm">
				<div class="form-group">	
    				<label for="fend">Endereço</label>
    				<input type="text" class="form-control w-75" id="cli_end" name="cli_end" value="<?php echo $endereco; ?>">
				</div>
				<div class="form-group">	
	    			<label for="fnum">Número</label>
	    			<input type="text" class="form-control w-75" id="cli_num" name="cli_num" value="<?php echo $numero; ?>">
	    		</div>
				<div class="form-group">	
	    			<label for="fbairro">Bairro</label>
	    			<input required type="text" class="form-control w-75" id="cli_bairro" name="cli_bairro" value="<?php echo $bairro;?>">
	    		</div>
				<div class="form-group">	
	    			<label for="fcid">Cidade</label>
	    			<select class="form-control w-75" id="cli_cid" name="cli_cid" value="<?php echo $cidade; ?>">
	    				<option value=""></option>	
				      	<option <?php if($cidade == '1') echo"selected"; ?> value="1">Nova Petrópolis</option>
				      	<option <?php if($cidade == '2') echo"selected"; ?> value="2">Picada Café</option>
				      	<option <?php if($cidade == '3') echo"selected"; ?> value="3">Gramado</option>
				      	<option <?php if($cidade == '4') echo"selected"; ?> value="4">Canela</option>
				      	<option <?php if($cidade == '5') echo"selected"; ?> value="5">São Francisco de Paula</option>
				      	<option <?php if($cidade == '6') echo"selected"; ?> value="6">Presidente Lucena</option>
				      	<option <?php if($cidade == '7') echo"selected"; ?> value="7">Caxias do Sul</option>
				    </select>
				</div>
				<div class="form-group">    
				    <label for="fobs">Observações</label>
	    			<textarea class="form-control w-75" id="cli_obs" name="cli_obs" placeholder="Observações..." style="height:100px">
	    				 <?php echo $observacoes; ?>
	    			</textarea>
	    		</div>	
	    			<input type="hidden" name="status" id="status" value="update">
	    			<input type="hidden" name="id" value="<?php echo $id; ?>">
	    		<div class="mt-2">	
	    			<button type="submit" class="btn btn-primary">Atualizar</button>
	    			<button type="button"class="btn btn-primary"  onClick="history.go(-1)">Voltar</button>
	    		</div>	
				</form>
			</div>	
		</div>
	</div>	
	</body>
</html>	
