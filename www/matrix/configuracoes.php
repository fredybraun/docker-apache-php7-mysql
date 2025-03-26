<?php
session_start();
require ('./topo2.php');
require ('./funcoes.php');
?>

<?php
//valida usuário esta logado, caso não, redireciona para loguin.
require('./db.php');
if(!isset($_SESSION["name"])){
	header("Location: login.php");
exit(); }

$_SESSION['active'] = 'cliente';
require('menu2.php');


?>
<div class="container-fluid mt-2 col-md-12">
    <h1><span class="badge badge-danger">Cuidado ao fazer alterações</span></h1>
    <h3>Configurações do Sistema</h3>
    <form action="update_config.php" method="post">
        <div class="form-group">
                <label for="ano_vigente">Ano Vigente </label>
                <?php
                    $stmt = $con->prepare("SELECT ano_vigente FROM configuracoes");
                    $stmt->execute();
                    $stmt->store_result();
                    $num_of_rows = $stmt->num_rows;
                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($ano_vigente);
                        while ($stmt->fetch()) {
                            $ano = $ano_vigente;
                        }
                    }
                ?>
                <input type="text" class="form-control w-25" id="ano_vigente" name="ano_vigente" value="<?php if(isset($ano)){echo $ano;} ?>">          
        </div>
        <div class="form-group">
                 <button type="submit" class="btn btn-primary"name="insert" >Atualizar</button>  
        </div>
    </form>
</div>