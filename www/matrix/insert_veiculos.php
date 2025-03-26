<?php
	session_start();
	require('db.php');
	require ('funcoes.php');

	// insere produto
	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$nome = '';
		$motorista = '';
        $status_veiculo = '';
		if($status == 'create') {
			if(isset($_POST['veiculo_nome'], $_POST['veiculo_func'], $_POST['veiculo_status'])){
				$nome = $_POST['veiculo_nome'];
				$motorista = $_POST['veiculo_func'];
				$status_veiculo = $_POST['veiculo_status'];
				$stmt = $con->prepare("INSERT INTO veiculo (nome_veiculo, motorista, status_veiculo) VALUES ('$nome', '$motorista', '$status_veiculo')");
				$stmt->execute();
				$_SESSION['message'] = "Dados adicionados"; 
				header('location: create_veiculos.php');
			}
		}

	}
	//edita usuário	
	if (isset($_GET['editar'])) {
		$id = $_GET['editar'];
		$stmt = $con->prepare("SELECT id_veiculo, nome_veiculo, motorista, status_veiculo FROM veiculo WHERE id_veiculo='$id'");
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $nome, $motorista, $status_veiculo);
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

	$_SESSION['active'] = 'config';
require ('./topo2.php');
require ('./menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
	<h3>Editar Veículos</h3>
		<form action="atualiza_veiculos.php" method="post">
			<div class="form-group">
				<label for="nome">Nome do veículo</label>
				<input class="form-control w-50" type="text" name="veiculo_nome" id="veiculo_nome" required value="<?php echo $nome; ?>">
			</div>
			<div class="form-group">
                <label for="fos">Responsável</label>
                <select required class="form-control w-25" id="veiculo_func" name="veiculo_func">
                    <option value=""></option>
                <?php
                    if ($stmt = $con->prepare('SELECT id_func, nome_func FROM funcionario WHERE status = 1 ORDER BY nome_func ')) {
                        $stmt->execute();
                        $stmt->store_result();
                        $num_of_rows = $stmt->num_rows;
                        if ($stmt->num_rows > 0) {
                        $stmt->bind_result($id_fun, $nome_fun);
                            while ($stmt->fetch()) {
                                if($id_fun == $motorista){ 
                                    echo '<option selected value="'.$id_fun.'">'.$nome_fun.'</option>';
                                }
                                else {echo '<option value="'.$id_fun.'">'.$nome_fun.'</option>';}
                            }
                        }
                        $stmt->free_result();
                    }
                ?>
                </select>
		    </div>
		    <div class="form-group">
                <label for="fos">Status</label>
                <select class="form-control w-25" id="veiculo_status" name="veiculo_status">
                    <?php
                        if ($status_veiculo == 0){
                            echo '<option value="1">Ativo</option>';
                            echo '<option selected value="0">Inativo</option>';
                        }
                        if ($status_veiculo == 1){
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
