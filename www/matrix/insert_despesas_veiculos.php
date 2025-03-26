<?php
	session_start();
	require('db.php');
	require ('funcoes.php');

	// insere produto
	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$data_despesa = '';
		$id_veiculo = '';
        $km='';
        $litro='';
        $valor='';
		if($status == 'create') {
			if(isset($_POST['data_despesa'], $_POST['veiculo'], $_POST['km'], $_POST['litros'], $_POST['valor'])){
				$data_despesa = trocadatatraco($_POST['data_despesa']);
				$id_veiculo = $_POST['veiculo'];
				$km = $_POST['km'];
				$litros = moeda($_POST['litros']);
                $valor = moeda($_POST['valor']);
                echo $data_despesa;
				$stmt = $con->prepare("INSERT INTO despesa_combustivel (data_despesa, veiculo_despesa, km_despesa, litro_despesa, valor_despesa) VALUES ('$data_despesa', '$id_veiculo', '$km', '$litros', '$valor')");
				$stmt->execute();
				$_SESSION['message'] = "Dados adicionados"; 
				header('location: create_despesas_veiculos.php');
			}
		}

	}
	//edita usuário	
	if (isset($_GET['editar'])) {
		$id = $_GET['editar'];
		$stmt = $con->prepare("SELECT id_despesa, data_despesa, veiculo_despesa, km_despesa, litro_despesa, valor_despesa
		FROM despesa_combustivel WHERE id_despesa='$id'");
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $data, $veiculo, $km, $litros, $valor);
			$stmt->fetch();
		}
	}
	//deleta usuário	
	//if (isset($_GET['deletar'])) {
		//$id = $_GET['deletar'];
		//$stmt = $con->prepare("DELETE FROM produtos WHERE id_prod='$id'");
		//$stmt->execute();
		//header('location: create_prod.php');
		//exit();
	//}

	$_SESSION['active'] = 'produtos';
require ('./topo2.php');
require ('./menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
	<h3>Editar despesa de combustível</h3>
		<div class="row">
        <div class="col-sm">  
			<form action="atualiza_despesas_veiculos.php" method="post">
                <div class="form-group">
                    <label for="fos">Data da despesa</label>
                    <input required class="form-control w-50" type="text" id="data_despesa"  name="data_despesa" value="<?php echo trocadatabarra($data);?>">
                </div>
                <div class="form-group">    
                    <label for="fos">Veículo</label>
                    <select required class="form-control w-50" id="veiculo" name="veiculo" >
                        <option value=""></option>
                        <?php
                            if ($stmt = $con->prepare('SELECT id_veiculo, nome_veiculo, motorista FROM veiculo WHERE status_veiculo = 1 ORDER BY nome_veiculo ')) {
								$stmt->execute();
								$stmt->store_result();
								$num_of_rows = $stmt->num_rows;
								if ($stmt->num_rows > 0) {
								$stmt->bind_result($id_veiculo, $nome_veiculo, $motorista);
									while ($stmt->fetch()) {
										if($stmt2 = $con->prepare("SELECT nome_func FROM funcionario WHERE id_func = '$motorista' ")){
											$stmt2->execute();
											$stmt2->store_result();
											$num_of_rows = $stmt2->num_rows; 
											if ($stmt2->num_rows > 0) {
												$stmt2->bind_result($nome_func);    
												$stmt2->fetch();
											}
										}
										if($veiculo == $id_veiculo){echo '<option selected value="'.$id_veiculo.'">'.$nome_veiculo.' - '.$nome_func.'</option>';}    
										else {echo '<option value="'.$id_veiculo.'">'.$nome_veiculo.' - '.$nome_func.'</option>';}
									}
								}
								$stmt->free_result();
								$stmt2->free_result();
							}
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fname">KM</label>
                    <input required class="form-control w-25" type="text" id="km" name="km" value="<?php echo $km;?>">
                </div>
        </div> 
        <div class="col-sm">   
            <div class="form-group">
                <label for="fname">Litros</label>
                <input required class="form-control w-25" type="text" id="litros" name="litros" value="<?php echo moeda_formato($litros);?>" onkeypress='$(this).mask("###0,00", {reverse: true});' required>
            </div> 
            <div class="form-group">
                <label for="fname">Valor</label>
                <input required class="form-control w-25" type="text" id="valor" name="valor" value="<?php echo moeda_formato($valor);?>" onkeypress='$(this).mask("###0,00", {reverse: true});' required>
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
