<?php
session_start();
$_SESSION["onde_estou"] = 'create_andaime';
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
	$_SESSION['active'] = 'locacao';
	require('menu2.php');
?>
<?php
	if ($stmt = $con->prepare("SELECT SUM(quant_andaime) FROM andaimes WHERE status = '0'")) {
	$stmt->execute();
	$stmt->store_result();
	$num_of_rows = $stmt->num_rows;
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($quant_andaime);
		$stmt->fetch();
	    // echo $quant_andaime;        
	}
	$stmt->free_result();
}
?>
<?php
	if ($stmt = $con->prepare("SELECT SUM(quant_plataforma) FROM andaimes WHERE status = '0'")) {
	$stmt->execute();
	$stmt->store_result();
	$num_of_rows = $stmt->num_rows;
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($quant_plataforma);
		$stmt->fetch();
	    // echo $quant_plataforma;        
	}
	$stmt->free_result();
}
?>
<?php
	if ($stmt = $con->prepare("SELECT SUM(quant_travessa) FROM andaimes WHERE status = '0'")) {
	$stmt->execute();
	$stmt->store_result();
	$num_of_rows = $stmt->num_rows;
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($quant_travessa);
		$stmt->fetch();
	    // echo $quant_travessa;        
	}
	$stmt->free_result();
}
?>
<?php
	if ($stmt = $con->prepare("SELECT SUM(quant_rodas) FROM andaimes WHERE status = '0'")) {
	$stmt->execute();
	$stmt->store_result();
	$num_of_rows = $stmt->num_rows;
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($quant_rodas);
		$stmt->fetch();
	    // echo $quant_rodas;        
	}
	$stmt->free_result();
}
?>
<?php
	if ($stmt = $con->prepare("SELECT SUM(quant_sapata) FROM andaimes WHERE status = '0'")) {
	$stmt->execute();
	$stmt->store_result();
	$num_of_rows = $stmt->num_rows;
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($quant_sapata);
		$stmt->fetch();
	    // echo $quant_sapata;        
	}
	$stmt->free_result();
}
?>
<?php
	if ($stmt = $con->prepare("SELECT SUM(quant_escada_longa) FROM andaimes WHERE status = '0'")) {
	$stmt->execute();
	$stmt->store_result();
	$num_of_rows = $stmt->num_rows;
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($quant_escada_longa);
		$stmt->fetch();
	    // echo $quant_andaime;        
	}
	$stmt->free_result();
}
?>
<?php
	if ($stmt = $con->prepare("SELECT SUM(quant_escada_curta) FROM andaimes WHERE status = '0'")) {
	$stmt->execute();
	$stmt->store_result();
	$num_of_rows = $stmt->num_rows;
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($quant_escada_curta);
		$stmt->fetch();
	    // echo $quant_andaime;        
	}
	$stmt->free_result();
}
?>
<div class="container-fluid mt-2 col-md-12">
	<h3>Cadastro de Locação de Andaime</h3>
	<div class="row">
		<div class="col-sm">
			<form action="insert_andaime.php" method="post">
				<div class="form-group">
					<a href="create_cli.php"><label for="fos" class="row pl-3">Cliente</label></a>
	    			<select required class="row select2" id="cli_andaime" name="cli_andaime" style="width: 75%;">
	    				<option value=""></option>
    				<?php
						if ($stmt = $con->prepare('SELECT id_cli, nome_cli FROM clientes ORDER BY nome_cli ')) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($id_cli, $nome_cli);
								while ($stmt->fetch()) {
							        echo '<option value="'.$id_cli.'">'.$nome_cli.'</option>';
							    }
							}
							$stmt->free_result();
						}
					?>
				    </select>
				</div>
				<div class="form-group">
			    	<label for="fos">Entregar</label>
    				<textarea class="form-control w-75" id="end_entrega" name="end_entrega" placeholder="Observações..."></textarea>
    			</div>
				<div class="form-group">
			    	<label for="fos">Andaimes</label>
			    	<input  type="text" class="form-control w-75" id="quant_andaime"  name="quant_andaime">
			    </div>
				<div class="form-group">
			   		<label for="fos">Plataformas</label>
			    	<input  type="text" class="form-control w-75" id="quant_plataforma"  name="quant_plataforma">
			    </div>
				<div class="form-group">
			    	<label for="fos">Travessas</label>
			    	<input  type="text" class="form-control w-75" id="quant_travessa"  name="quant_travessa">
			    </div>
				<div class="form-group">
			    	<label for="fos">Rodas</label>
			    	<input  type="text" class="form-control w-75" id="quant_rodas"  name="quant_rodas">
			    </div>
				<div class="form-group">
			    	<label for="fos">Sapatas</label>
			    	<input  type="text" class="form-control w-75" id="quant_sapata"  name="quant_sapata">
				</div>
				<div class="form-group">
			    	<label for="fos">Escada Longa</label>
			    	<input  type="text" class="form-control w-75" id="quant_escada_longa"  name="quant_escada_longa">
				</div>
				<div class="form-group">
			    	<label for="fos">Escada Curta</label>
			    	<input  type="text" class="form-control w-75" id="quant_escada_curta"  name="quant_escada_curta">
				</div>
		</div>		
		<div class="col-sm">
				<div class="form-group">
					<label for="fos">Frete Entrega</label></a>
	    			<select class="form-control w-75" id="frete_entrega" name="frete_entrega">
	    				<option value=""></option>
						<?php
							if ($stmt = $con->prepare('SELECT id_itens_locacoes, nome_itens_locacoes FROM itens_locacoes WHERE id_itens_locacoes BETWEEN 10 AND 12')) {
								$stmt->execute();
								$stmt->store_result();
								$num_of_rows = $stmt->num_rows;
								if ($stmt->num_rows > 0) {
								$stmt->bind_result($id_itens_locacoes, $nome_itens_locacoes);
									while ($stmt->fetch()) {
										echo '<option value="'.$id_itens_locacoes.'">'.$nome_itens_locacoes.'</option>';
									}
								}
								$stmt->free_result();
							}
						?>
				    </select>
				</div>
				<div class="form-group">
					<label for="fos">Frete Retirada</label></a>
	    			<select class="form-control w-75" id="frete_retirada" name="frete_retirada">
	    				<option value=""></option>
						<?php
							if ($stmt = $con->prepare('SELECT id_itens_locacoes, nome_itens_locacoes FROM itens_locacoes WHERE id_itens_locacoes BETWEEN 10 AND 12')) {
								$stmt->execute();
								$stmt->store_result();
								$num_of_rows = $stmt->num_rows;
								if ($stmt->num_rows > 0) {
								$stmt->bind_result($id_itens_locacoes, $nome_itens_locacoes);
									while ($stmt->fetch()) {
										echo '<option value="'.$id_itens_locacoes.'">'.$nome_itens_locacoes.'</option>';
									}
								}
								$stmt->free_result();
							}
						?>
				    </select>
				</div>
				<div class="form-group">     
                    <label for="fos">Retirada</label>
                    <input required class="form-control w-75" type="text" id="data_retirada"  name="data_retirada" >
                </div>   
				<div class="form-group">    
				    <label for="fos">Devolução</label>
				    <input  type="text" class="form-control w-75" id="data_retorno"  name="data_retorno">
				</div>
				<div class="form-group">    
				    <label for="fos">Status</label>
	    			<select required class="form-control w-75" id="status_andaime" name="status_andaime">
	    				<option value="0" selected="">Locação</option>
	    				<option value="1">Cobrança</option>
	    				<option value="2">Histórico</option>
				    </select>
				</div>
				<div class="form-group">    
				    <input type="hidden" name="status" id="status" value="create">

	    			<button type="submit" class="btn btn-primary">Adicionar</button>	
				    </form>
				</div>
				<div class="form-group mt-4">     
				    <h3>Estoque:</h3>
					<?php
						if ($stmt = $con->prepare('SELECT quantidade_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 1 ')) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_andaime);
							$stmt->fetch();
							}
							$stmt->free_result();
						}
					?>
			    	<li class="list-unstyled">Andaimes: <?php echo $quantidade_andaime - $quant_andaime ;?></li>
    				
					<?php
						if ($stmt = $con->prepare('SELECT quantidade_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 2 ')) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_plataformas);
							$stmt->fetch();
							}
							$stmt->free_result();
						}
					?>
					<li class="list-unstyled">Plataformas: <?php echo $quantidade_plataformas - $quant_plataforma ;?></li>
					
					<?php
						if ($stmt = $con->prepare('SELECT quantidade_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 3 ')) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_travessas);
							$stmt->fetch();
							}
							$stmt->free_result();
						}
					?>
    				<li class="list-unstyled">Travessas: <?php echo $quantidade_travessas - $quant_travessa ;?></li>
					
					<?php
						if ($stmt = $con->prepare('SELECT quantidade_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 4 ')) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_rodas);
							$stmt->fetch();
							}
							$stmt->free_result();
						}
					?>
    				<li class="list-unstyled">Rodas: <?php echo $quantidade_rodas - $quant_rodas ;?></li>

					<?php
						if ($stmt = $con->prepare('SELECT quantidade_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 5 ')) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_sapatas);
							$stmt->fetch();
							}
							$stmt->free_result();
						}
					?>
    				<li class="list-unstyled">Sapatas: <?php echo $quantidade_sapatas - $quant_sapata ;?></li>
					<?php
						if ($stmt = $con->prepare('SELECT quantidade_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 6 ')) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_escada_longa);
							$stmt->fetch();
							}
							$stmt->free_result();
						}
					?>
    				<li class="list-unstyled">Escada Longa: <?php echo $quantidade_escada_longa - $quant_escada_longa ;?></li>
					<?php
						if ($stmt = $con->prepare('SELECT quantidade_itens_locacoes FROM itens_locacoes WHERE  id_itens_locacoes = 7 ')) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($quantidade_escada_curta);
							$stmt->fetch();
							}
							$stmt->free_result();
						}
					?>
    				<li class="list-unstyled">Escada Curta: <?php echo $quantidade_escada_curta - $quant_escada_curta ;?></li>
				</div>    
		</div>	
	</div>
</div>
<div class="container-fluid mt-2 col-md-12">
	<h3>Andaimes Locados</h3>
		 <table class="table table-sm">
		    <tread>
			    <tr>
			      	<th scope="col">Num Locação</th> 		
			      	<th scope="col">Cliente</th>
			      	<th scope="col">Data da retirada</th>
			      	<th scope="col">Data da retorno</th>
		      		<th scope="col">Dias corridos</th>
			      	<th scope="col">Status</th>
			      	<th scope="col">Imprimir</th>
			      	<th scope="col">Editar</th>
			     	 <?php
			    		if($_SESSION['nivel'] == 1){
				  	?>	
			      	<th scope="col">Excluir</th>
			      	<?php
			      	  }
				  	?>
			    </tr>
			</tread>    	

						<?php
							if ($stmt = $con->prepare('SELECT id_andaime, id_cli, data_retirada, data_retorno, status FROM andaimes WHERE status = "0" OR status = "1"ORDER BY id_andaime DESC ')) {
								$stmt->execute();
								$stmt->store_result();
								$num_of_rows = $stmt->num_rows;
								if ($stmt->num_rows > 0) {
									$stmt->bind_result($id_andaime, $id_cli, $data_retirada, $data_retorno, $status);
									while ($stmt->fetch()) {
										$datetime1 = date_create($data_retirada);
										$datetime2 = date_create(date('Y-m-d'));
										$interval = date_diff($datetime1, $datetime2);
										$diferenca = $interval->format('%a ');

										if ($interval->format('%a ') < 15){
											$cor = '#66ff66'; //verde
										}
										if (($interval->format('%a ') >= 15) && ($interval->format('%a ') < 30)){
											$cor = '#ffff66'; //amarelo
										}
										if ($interval->format('%a ') >= 30){
											$cor = '#ff6666';//vermelho
										}
										
						
						?>	
								    	<tr style="background:<?php echo $cor;?>">
										    <th scope="col"><a href="dados_andaime.php?id_andaime=<?php echo $id_andaime; ?>"><?php echo $id_andaime; ?></a></th>
										    <?php
										    if ($stmt2 = $con->prepare("SELECT id_cli, nome_cli FROM clientes WHERE id_cli ='$id_cli'")) {
										    	$stmt2->execute();
												$stmt2->store_result();
												$num_of_rows2 = $stmt2->num_rows;
												if ($stmt2->num_rows > 0) {
													$stmt2->bind_result($id_cli, $nome_cli);
													while ($stmt2->fetch()) {
														echo "<td>".$nome_cli."</td>";
													}
												}
										    
										    }	
										    ?>
										    <th scope="col"><?php echo trocadatabarra($data_retirada); ?></th>
										    <th scope="col"><?php if(trocadatabarra($data_retorno) == '01/01/1970'){echo 'Indeterminado';}else{echo trocadatabarra($data_retorno);} ;?></th>
											<th scope="col"><?php echo $diferenca;?></th>
										    <?php
										    if($status == 0){
										    	echo '<th scope="col">Locados</th>';
										    }	
										    if($status == 1){
										    	echo '<th scope="col">Cobrança</th>';
										    }
										    ?>
											<th scope="col">
										    	<a target=”_blank” href="contrato_andaime.php?imprimir=<?php echo $id_andaime; ?>">Imprimir</a>
											</th>
										    <th scope="col">
										    	<a href="insert_andaime.php?editar=<?php echo $id_andaime; ?>">Editar</a>
											</th>
										    <?php
										    		if($_SESSION['nivel'] == 1){

										    		
										    	?>	
										    	<th scope="col">
										        <a href="insert_os.php?deletar=<?php echo $id_os; ?>" onclick="return confirm('Tem certeza que deseja deletar esse registro?');">Excluir</a>
										    	</th>
										        <?php
										        }
										 		?>
										</tr>
										<?php    
								    }
								}
								$stmt->free_result();
							}
						?>


					</table>
				</div>
			</div>
			<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>	
			<script>
				$(document).ready(function() {
   					 $('.select2').select2();
				});
			</script>	

			<script type="text/javascript">
				$(document).ready(function(){
					$('.search-box input[type="text"]').on("keyup input", function(){
						/* Get input value on change */
						var inputVal = $(this).val();
						var resultDropdown = $(this).siblings(".result");
						if(inputVal.length){
							$.get("backend-search.php", {term: inputVal}).done(function(data){
								// Display the returned data in browser
								resultDropdown.html(data);
							});
						} else{
							resultDropdown.empty();
						}
					});
					
					// Set search input value on click of result item
					$(document).on("click", ".result p", function(){
						$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
						$(this).parent(".result").empty();
					});
				});
		</script>
		</body>
</html>