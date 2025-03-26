<?php
session_start();
$_SESSION["onde_estou"] = 'create_retirada_abastecimento';
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
	$_SESSION['active'] = 'veiculos';
	require('menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
<h3>Retirada para abastecimento</h3>
    <div class="row">
        <div class="col-sm">  
            <form action="insert_retirada_abastecimento.php" method="post">
                <div class="form-group">
                    <label for="fos">Data da retirada</label>
                    <input class="form-control w-25" type="text" id="data_retirada"  name="data_retirada" onkeypress='$(this).mask("###0,00", {reverse: true});' required>
                </div>
                <div class="form-group">
                    <label for="fos">Veículo</label>
                    <select required class="form-control w-25" id="veiculo " name="veiculo">
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
                                    echo '<option value="'.$id_veiculo.'">'.$nome_veiculo.' - '.$nome_func.'</option>';
                                }
                            }
                            $stmt->free_result();
                            $stmt2->free_result();
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">	
                    <labelfor="fos">Valor</label>
                    <input class="form-control w-25" type="text" id="retirada_valor"  name="retirada_valor" onkeypress='$(this).mask("###0,00", {reverse: true});' required>	
                    <input type="hidden" name="status" id="status" value="create">
                </div>
                <div class="form-group">                      
                    		
                    <button class="btn btn-primary" type="submit">Adicionar</button>
                </div>    
            </form>	
        </div>                     
    </div>
<div class="container-fluid mt-2 col-md-12">
	<h3>Retiradas Cadastradas</h3>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th> 
                    <th scope="col">Data</th>        
                    <th scope="col">Veículo</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>        
                <?php
                    if ($stmt = $con->prepare('SELECT id_retirada, data_retirada, veiculo_retirada, valor_retirada
                        FROM retirada_abastecimento ORDER BY id_retirada DESC')) {
                        $stmt->execute();
                        $stmt->store_result();
                        $num_of_rows = $stmt->num_rows;
                        if ($stmt->num_rows > 0) {
                        $stmt->bind_result($id, $data, $veiculo, $valor);
                            while ($stmt->fetch()) {
                                echo '<tr>';
                                echo '<td scope="row">'. $id . '</td>';
                                echo '<td scope="row">'. trocadatabarra($data) . '</td>';

                                if ($stmt1 = $con->prepare("SELECT nome_veiculo, motorista FROM veiculo WHERE id_veiculo = '$veiculo'")) {
                                    $stmt1->execute();
                                    $stmt1->store_result();
                                    $num_of_rows = $stmt1->num_rows;
                                    if ($stmt1->num_rows > 0) {
                                    $stmt1->bind_result($nome_veiculo, $motorista);
                                        while ($stmt1->fetch()) {
                                            if($stmt2 = $con->prepare("SELECT nome_func FROM funcionario WHERE id_func = '$motorista' ")){
                                                $stmt2->execute();
                                                $stmt2->store_result();
                                                $num_of_rows = $stmt2->num_rows; 
                                                if ($stmt2->num_rows > 0) {
                                                    $stmt2->bind_result($nome_func);    
                                                    $stmt2->fetch();
                                                }
                                            }  
                                            echo '<td scope="row">'. $nome_veiculo .' - '.$nome_func.'</td>';
                                        }
                                    }
                                    $stmt1->free_result();
                                    $stmt2->free_result();
                                }
                                echo '<td scope="row"> R$ '. moeda_formato($valor) . '</td>';
                                
                                echo '<td scope="row"><a class="badge badge-primary ml-2" href="insert_retirada_abastecimento.php?editar='.$id.'" class="button">Editar</a></td>';
                                echo '</tr>';
                            }
                        }
                        $stmt->free_result();
                    }
                ?>
        </table>    
</div>
</body>
</html>