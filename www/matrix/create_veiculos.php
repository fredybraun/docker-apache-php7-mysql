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
	<h3>Cadastro de Veículos</h3>
	<form action="insert_veiculos.php" method="post">
		<div class="form-group">
			<label for="fos">Nome do veículo</label>
			<input class="form-control w-50" type="text" name="veiculo_nome" id="veiculo_nome" required>
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
                            echo '<option value="'.$id_fun.'">'.$nome_fun.'</option>';
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
				<option default value="1">Ativo</option>
				<option value="0">Inativo</option>
			</select>
		</div>
        <input type="hidden" name="status" id="status" value="create">		
		<button class="btn btn-primary" type="submit">Adicionar</button>
	</form>	
</div>
<div class="container-fluid mt-2 col-md-12">
	<h3>Veículos cadastrados</h3>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th> 		
                    <th scope="col">Nome</th>
                    <th scope="col">Motorista</th>
                    <th scope="col">Status</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>        
                <?php
                    if ($stmt = $con->prepare('SELECT id_veiculo, nome_veiculo, motorista, status_veiculo
                        FROM veiculo ORDER BY id_veiculo')) {
                        $stmt->execute();
                        $stmt->store_result();
                        $num_of_rows = $stmt->num_rows;
                        if ($stmt->num_rows > 0) {
                        $stmt->bind_result($id, $nome, $motorista, $status);
                            while ($stmt->fetch()) {
                                echo '<tr>';
                                echo '<td scope="row">'. $id . '</td>';
                                echo '<td scope="row">'. $nome . '</td>';

                                if ($stmt1 = $con->prepare("SELECT nome_func FROM funcionario WHERE id_func = '$motorista'")) {
                                    $stmt1->execute();
                                    $stmt1->store_result();
                                    $num_of_rows = $stmt1->num_rows;
                                    if ($stmt1->num_rows > 0) {
                                    $stmt1->bind_result($nome_fun);
                                        while ($stmt1->fetch()) {
                                            echo '<td scope="row">'. $nome_fun . '</td>';
                                        }
                                    }
                                    $stmt1->free_result();
                                }
                                if($status == 1){echo '<td scope="row">Ativo</td>';}
                                else{echo '<td scope="row">Inativo</td>';}
                                
                                echo '<td scope="row"><a class="badge badge-primary ml-2" href="insert_veiculos.php?editar='.$id.'" class="button">Editar</a></td>';
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