<?php
	session_start();
	require('db.php');
	require ('./funcoes.php');

	// insere cliente novo
	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$nome = '';
		$cliente = '';
        $endereco = '';
        if($status == 'create') {
            if(isset($_POST['nome_obra'], $_POST['cli_obra'], $_POST['end_obra'])){
                $nome = $_POST['nome_obra'];
                $cliente = $_POST['cli_obra'];
                $endereco = $_POST['end_obra'];
                $stmt = $con->prepare("INSERT INTO obra_clientes (nome_obra, endereco_obra, id_cli) VALUES ('$nome', '$endereco', '$cliente')");
                $stmt->execute();
                $_SESSION['message'] = "Dados adicionados"; 
                header('location: create_obra.php');
            }   
        }

	}

	//edita usuário	
	if (isset($_GET['editar'])) {
		$id = $_GET['editar'];
		$stmt = $con->prepare("SELECT * FROM obra_clientes WHERE id_obra='$id'");
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id_obra, $nome_obra, $endereco_obra, $id_cliente);
			$stmt->fetch();
		}
	}

	//deleta usuário	
	// if (isset($_GET['deletar'])) {
	// 	$id = $_GET['deletar'];
	// 	$stmt = $con->prepare("DELETE FROM clientes WHERE id_cli='$id'");
	// 	$stmt->execute();
	// 	header('location: create_cli.php');
	// }
?>
<?php
	$_SESSION['active'] = 'cliente';
	require ('./topo2.php');
	require('menu2.php');
?>
	<div class="container-fluid mt-2 col-md-12">
				<div class="form-group">
				<div class="search-box">
			        <input type="text" class="form-control w-25 mt-3" autocomplete="off" placeholder="Cliente..." />
			        <div class="result"></div>
			    </div>
			    <div class="search-box2">
			        <input type="text" class="form-control w-25 mt-3" autocomplete="off" placeholder="OS..."/>
			        <div class="result2"></div>
			    </div>
				</div>	
				<div id="fecha">
					<h3>Cadastro de obra</h3>
					<div class="row">
						<div class="col-sm">	
							<form action="insert_obra.php" method="post">
								<div class="form-group">
									<label for="fname">Nome da obra</label>
				    				<input required class="form-control w-75" type="text" id="nome_obra" name="nome_obra" value='<?php echo $nome_obra; ?>'>
				    			</div>
								<div class="form-group">
				    				<label for="fcid">Clientes</label>
				    				<select required class="form-control w-75" id="cli_obra" name="cli_obra">
										<option value=""></option>
										<?php
											if ($stmt = $con->prepare('SELECT id_cli, nome_cli FROM clientes ORDER BY nome_cli ')) {
												$stmt->execute();
												$stmt->store_result();
												$num_of_rows = $stmt->num_rows;
												if ($stmt->num_rows > 0) {
												$stmt->bind_result($id_cli, $nome_cli);
													while ($stmt->fetch()) {
                                                        if ($id_cliente == $id_cli) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
														echo '<option '.$selected.' value="'.$id_cli.'">'.$nome_cli.'</option>';
													}
												}
												$stmt->free_result();
											}
										?>
									</select>
							    </div>
								<div class="form-group">
							   		<label for="fobs">Endereço</label>
                                       <input required class="form-control w-75" type="text" id="end_obra" name="end_obra" placeholder="Endereço..." value="<?php echo $endereco_obra; ?>">
				    			</div>
								<input type="hidden" name="status" id="status" value="update">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
				    			<div class="mt-2">
				    				<button type="submit" class="btn btn-primary">Atualizar</button>
				    			</div>
				    	</div>
						<div class="col-sm"></div>
				    </form>	
					</div>
				</div>
			</div>
	</body>
</html>	
<?php
	if(isset($_POST['status'])){
		//$status = $_POST[status];
		$nome = '';
		$cliente = '';
        $endereco = '';
        $id = '';
		if($status == 'update') {
			if(isset($_POST['id'], $_POST['nome_obra'], $_POST['cli_obra'], $_POST['end_obra'])){
				$id = $_POST['id'];
				$nome = $_POST['nome_obra'];
                $cliente = $_POST['cli_obra'];
                $endereco = $_POST['end_obra'];
				$stmt = $con->prepare("UPDATE obra_clientes SET 
                    nome_obra='$nome', 
                    endereco_obra = '$endereco',
                    id_cli = '$cliente'
                     WHERE id_obra='$id'");
				$stmt->execute();
				$_SESSION['message'] = "Dados atualizados"; 
				header('location: create_obra.php');
			}	
		}
	}
?>