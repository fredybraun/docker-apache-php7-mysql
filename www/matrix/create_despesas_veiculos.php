<?php
session_start();
$_SESSION["onde_estou"] = 'create_veiculos';
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
	$_SESSION['active'] = 'config';
	require('menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
<h3>Cadastro de despesa de combustível</h3>
    <div class="row">
        <div class="col-sm">  
            <form action="insert_despesas_veiculos.php" method="post">
                <div class="form-group">
                    <label for="fos">Data da despesa</label>
                    <input required class="form-control w-50" type="text" id="data_despesa"  name="data_despesa">
                </div>
                <div class="form-group">    
                    <label for="fos">Veículo</label>
                    <select required class="form-control w-50" id="veiculo" name="veiculo">
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
                    <label for="fname">KM</label>
                    <input required class="form-control w-25" type="text" id="km" name="km">
                </div>
        </div> 
        <div class="col-sm">   
            <div class="form-group">
                <label for="fname">Litros</label>
                <input required class="form-control w-25" type="text" id="litros" name="litros" onkeypress='$(this).mask("###0,00", {reverse: true});' required>	
            </div> 
            <div class="form-group">
                <label for="fname">Valor</label>
                <input required class="form-control w-25" type="text" id="valor" name="valor" onkeypress='$(this).mask("###0,00", {reverse: true});' required>	
            </div>  
            <div class="form-group">                      
                <input type="hidden" name="status" id="status" value="create">		
                <button class="btn btn-primary" type="submit">Adicionar</button>
            </div>    
        </form>	
                        </div>                        
    </div>
<div class="container-fluid mt-2 col-md-12">
	<h3>Veículos Cadastrados</h3>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th> 
                    <th scope="col">Data</th>        
                    <th scope="col">Veículo</th>
                    <th scope="col">KM</th>
                    <th scope="col">Litros</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>        
                <?php
                    if ($stmt = $con->prepare('SELECT id_despesa, data_despesa, veiculo_despesa, km_despesa, litro_despesa, valor_despesa
                        FROM despesa_combustivel ORDER BY id_despesa DESC')) {
                        $stmt->execute();
                        $stmt->store_result();
                        $num_of_rows = $stmt->num_rows;
                        if ($stmt->num_rows > 0) {
                        $stmt->bind_result($id, $data, $veiculo, $km, $litros, $valor);
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

                                            echo '<td scope="row">'. $nome_veiculo .' - '. $nome_func .'</td>';
                                        }
                                    }
                                    $stmt1->free_result();
                                }
                                echo '<td scope="row">'. $km . '</td>';
                                echo '<td scope="row">'. $litros . '</td>';
                                echo '<td scope="row">'. $valor . '</td>';
                                
                                echo '<td scope="row"><a class="badge badge-primary ml-2" href="insert_despesas_veiculos.php?editar='.$id.'" class="button">Editar</a></td>';
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