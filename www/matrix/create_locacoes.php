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
die(); }
?>
<?php
	$_SESSION['active'] = 'locacoes';
	require('menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
	<h3>Inserir Item de Locação</h3>
	<form action="insert_locacoes.php" method="post">
		<div class="form-group">
			<label for="fos">Nome do item</label>
			<input class="form-control w-25" type="text" name="item_nome" id="item_nome" required>
		</div>
        <div class="form-group">
			<label for="fos">Valor do item</label>
			<input class="form-control w-25" type="text" name="item_valor" id="item_valor" onkeypress='$(this).mask("###0,00", {reverse: true});' required>
		</div>
        <div class="form-group">
			<label for="fos">Quantidade Total</label>
			<input class="form-control w-25" type="text" name="item_quantidade" id="item_quantidade" required>
		</div>					
		<div class="form-group">
			<input type="hidden" name="status" id="status" value="create">
			<br>
			<button class="btn btn-primary" type="submit">Adicionar</button>
		</div>	
	</form>	
</div>
<div class="container-fluid mt-2 col-md-12">
	<h3>Itens de Locação Cadastrados</h3>
			<div class="container-fluid">
					 	<div class="row bg-secondary text-white w-100">
						      <div class="col-3">Nome</div> 		
						      <div class="col-2">Valor</div>
						      <div class="col-5">Quantidade</div>
						      <div class="col-1"></div>
						      <div class="col-1"></div>
						</div>	
			<?php
				if ($stmt = $con->prepare('SELECT id_itens_locacoes, nome_itens_locacoes, valor_itens_locacoes, quantidade_itens_locacoes FROM itens_locacoes')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
					$stmt->bind_result($id, $nome, $valor, $quantidade);
						while ($stmt->fetch()) {
							echo '<div class="row">';
					        echo '<div class="col-3">'.$nome.'</div>';
					        echo '<div class="col-2">R$ '.moeda_formato($valor).'</div>';
                            echo '<div class="col-3">'.$quantidade.'</div>';
					        if($_SESSION['nivel'] == 1){
					        	echo '<div class="col-0"><spam class="badge badge-primary"><a class="text-white" href="insert_locacoes.php?editar='.$id.'">Editar</a><spam></div>';
					        	echo '<div class="col-1"><spam class="badge badge-danger"><a class="text-white" href="insert_locacoes.php?deletar='.$id.'">Deletar</a></div>';
					        }
					        
					        echo '</div>';
					    }
					}
					$stmt->free_result();
				}
			?>
			</div>
</div>
	</body>
</html>