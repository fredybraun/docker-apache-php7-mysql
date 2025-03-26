<?php
	session_start();
	require('db.php');
	require ('funcoes.php');

	// insere produto
	if(isset($_POST['status'])){
		$status = $_POST['status'];
		$data_retirada = '';
		$veiculo = '';
        $valor='';
		if($status == 'create') {
			if(isset($_POST['data_retirada'], $_POST['veiculo'],  $_POST['retirada_valor'])){
				$data_retirada = trocadatatraco($_POST['data_retirada']);
				$veiculo = $_POST['veiculo'];
                $valor = moeda($_POST['retirada_valor']);
                
				$stmt = $con->prepare("INSERT INTO retirada_abastecimento (data_retirada, veiculo_retirada, valor_retirada) VALUES ('$data_retirada', '$veiculo','$valor')");
				$stmt->execute();
				$_SESSION['message'] = "Dados adicionados"; 
				header('location: create_retirada_abastecimento.php');
			}
		}

	}
	//edita usuário	
	if (isset($_GET['editar'])) {
		$id = $_GET['editar'];
		$stmt = $con->prepare("SELECT id_retirada, data_retirada, veiculo_retirada, valor_retirada
        FROM retirada_abastecimento WHERE id_retirada='$id'");
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $data, $veiculo, $valor);
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
<h3>Retirada para abastecimento</h3>
    <div class="row">
        <div class="col-sm">  
            <form action="atualiza_retirada_abastecimento.php" method="post">
                <div class="form-group">
                    <label for="fos">Data da retirada</label>
                    <input class="form-control w-25" type="text" id="data_retirada"  name="data_retirada" value="<?php echo trocadatabarra($data);?>"onkeypress='$(this).mask("###0,00", {reverse: true});' required>
                </div>
                <div class="form-group">
                    <label for="fos">Veículo</label>
                    <select required class="form-control w-25" id="veiculo" name="veiculo">
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
                      // ---------------------------------------------
                      //  if ($stmt = $con->prepare('SELECT id_func, nome_func FROM funcionario WHERE status = 1 ORDER BY nome_func ')) {
                      //      $stmt->execute();
                      //      $stmt->store_result();
                      //      $num_of_rows = $stmt->num_rows;
                      //      if ($stmt->num_rows > 0) {
                      //      $stmt->bind_result($id_fun, $nome_fun);
                      //          while ($stmt->fetch()) {
                      //              if($id_fun == $responsavel){
                      //                  echo '<option selected value="'.$id_fun.'">'.$nome_fun.'</option>';
                      //              }
                      //              else {echo '<option value="'.$id_fun.'">'.$nome_fun.'</option>';}
                      //              
                      //          }
                      //      }
                      //      $stmt->free_result();
                      //  }
                      //------------------
                    ?>
                    </select>
                </div>
                <div class="form-group">	
                    <labelfor="fos">Valor</label>
                    <input class="form-control w-25" type="text" id="retirada_valor"  name="retirada_valor" value="<?php echo moeda_formato($valor);?>" onkeypress='$(this).mask("###0,00", {reverse: true});' required>
                </div>
                <div class="form-group">                      
                    <input type="hidden" name="status_mod" value="update">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button class="btn btn-primary" type="submit">Atualizar</button>
                    <button type="button" class="btn btn-primary"onClick="history.go(-1)">Voltar</button>
                </div>    
            </form>	
        </div>                     
    </div>



	</body>
</html>	
