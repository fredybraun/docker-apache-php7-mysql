<?php
session_start();
$_SESSION["onde_estou"] = 'create_os';
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
	$_SESSION['active'] = 'os';
	require('menu2.php');
?>
<script type="text/javascript">
	
</script>
<div class="container-fluid mt-2 col-md-12">
	<h3>Cadastro de Ordem de Serviço</h3>
	<div class="row">
		<div class="col-sm">
			<form action="insert_os.php" method="post">
				<div class="form-group">
					<a href="create_cli.php"><label for="fos">Cliente</label></a>
	    			<select required class="form-control w-75" id="cli_os" name="cli_os">
	    				<option value=""></option>
					<?php
						if ($stmt = $con->prepare('SELECT clientes.id_cli, clientes.nome_cli, obra_clientes.nome_obra, obra_clientes.id_obra 
												   FROM `clientes` 
												   LEFT JOIN obra_clientes ON clientes.id_cli = obra_clientes.id_cli 
												   ORDER BY clientes.nome_cli ASC')) {
							$stmt->execute();
							$stmt->store_result();
							$num_of_rows = $stmt->num_rows;
							if ($stmt->num_rows > 0) {
							$stmt->bind_result($id_cli, $nome_cli, $nome_obra, $id_obra);
								while ($stmt->fetch()) {
									if ($id_obra == NULL) {
										echo '<option value="'.$id_cli.'-0">'.$nome_cli.'</option>';
									}else{
										echo '<option value="'.$id_cli.'-'.$id_obra.'">'.$nome_cli.' | OBRA: '.$nome_obra.'</option>';
									}
							    }
							}
							$stmt->free_result();
						}
					?>
				    </select>
				</div>
				<div class="form-group">
			    <label for="fos">Serviço</label>
    			<select required class="form-control w-75" id="serv_os" name="serv_os">
    				<option value=""></option>
				<?php
					if ($stmt = $con->prepare('SELECT id_serv, descricao_serv FROM tipo_servico ')) {
						$stmt->execute();
						$stmt->store_result();
						$num_of_rows = $stmt->num_rows;
						if ($stmt->num_rows > 0) {
						$stmt->bind_result($id_serv, $nome_serv);
							while ($stmt->fetch()) {
						        echo '<option value="'.$id_serv.'">'.$nome_serv.'</option>';
						    }
						}
						$stmt->free_result();
					}
				?>
			    </select>
			    </div>
				<div class="form-group">
			    <label for="fos">Responsável</label>
    			<select required class="form-control w-75" id="func_os" name="func_os">
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
    			<select required class="form-control w-75" id="status_os" name="status_os">
    				<option value=""></option>
				<?php
					if ($stmt = $con->prepare('SELECT id_status, nome_status FROM status ')) {
						$stmt->execute();
						$stmt->store_result();
						$num_of_rows = $stmt->num_rows;
						if ($stmt->num_rows > 0) {
						$stmt->bind_result($id_status, $nome_status);
							while ($stmt->fetch()) {
								if ($id_status == 1) {
									echo '<option selected value="'.$id_status.'">'.$nome_status.'</option>';
								}
								else {
									echo '<option value="'.$id_status.'">'.$nome_status.'</option>';
								}
						        
						    }
						}
						$stmt->free_result();
					}
				?>
			    </select>
			    </div>
				<div class="form-group">
			    <label for="fos">Data da inicio</label>
			    <input required class="form-control w-75" type="text" id="os_data_inicio"  name="os_data_inicio">
			    </div>
				<div class="form-group">	
			    <label for="fos">Valor</label>
			    <input type="text" class="form-control w-75" id="os_valor"  name="os_valor" onkeypress='$(this).mask("###0,00", {reverse: true});'>
			    </div>
				<div class="form-group">
			    <label for="fos">Observações</label>
    			<textarea class="form-control w-75" id="serv_obs" name="serv_obs" placeholder="Observações..."></textarea>
    			</div>


		</div>		
		<div class="col-sm">		
		<h3>Tempo e agendamento</h3>
		<div class="form-group">
		<label for="fos">Tempo estimado</label>
			<div class="slidecontainer" id="slidecontainer">
			  <input class="form-control w-75" type="range" min="0" max="5" step="0.25" value="0" class="slider" id="os_tempo" name="os_tempo"><br>
			  Pontos: <span id="show_tempo"></span>
			</div>
			<script>
				var slider = document.getElementById("os_tempo");
				var output = document.getElementById("show_tempo");
				output.innerHTML = slider.value;

				slider.oninput = function() {
				  output.innerHTML = this.value;
				}
			</script>
			</div>
			<div class="form-group">
			<label for="fos">Semana</label>
	    	<select class="form-control w-75" class="os_semana" id="os_semana" name="os_semana">
	    		<option default value="0">Selecione a semana</option>
	    		<?php

				if ($stmt = $con->prepare('SELECT ano_vigente FROM configuracoes')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
					$stmt->bind_result($ano_vigente);
					$stmt->fetch();
					}
					$stmt->free_result();
				}
	    			$ano = $ano_vigente;
	    			$data_hoje = date('Y-m-d');
	    			$semana_select = getWeekNumber($data_hoje) - 2;
	    			for ($i=$semana_select; $i <= 52 ; $i++) { 
	    				$week_array = getStartAndEndDate($ano,$i);
						
	    				echo '<option value="'.$i.'-'.$ano.'">'.$i.'-'.$ano.'</option>';
	    			}
	    			for ($i=1; $i < $semana_select ; $i++) { 
	    				$week_array = getStartAndEndDate($ano,$i);
						
	    				echo '<option value="'.$i.'-'.$ano.'">'.$i.'-'.$ano.'</option>';
	    			}

	    		?>

	    	</select>
	    	<a id="result"></a>
	    	</div>
			<div class="form-group">
				<label for="fos">Agendamento</label>
	    		<input class="form-control w-75" type="text" id="os_agendamento"  name="os_agendamento">
	    	</div>
			<div class="form-group">
				<label for="fobs">Observações de cobrança</label>
				<textarea class="form-control w-75" id="obs_cobranca" name="obs_cobranca" placeholder="Observações de cobrança..."></textarea>
			</div>
	    	<input type="hidden" name="status" id="status" value="create">

    		<button class="btn btn-primary" type="submit">Adicionar</button>	
		</form>
	</div>		
			

<div class="container-fluid mt-2 col-md-12">
	<h3 class = "text-white">Ordem de serviços abertas</h3>
					 <table class="table table-md">
					 	<thead>
						    <tr >
						      <th scope="col">OS</th> 	
							  <th scope="col"></th> 
						      <th scope="col">Cliente</th>
						      <th scope="col">Serviço</th>
						      <th scope="col">Responsável</th>
						      <th scope="col">Abertura</th>
							  <th scope="col">Agenda</th>
						      <th scope="col">Observações</th>
						      <th scope="col">Status</th>
						      <th scope="col"></th>
						      <th scope="col"></th>
						      <th scope="col"></th>
						      <?php
						    	if($_SESSION['nivel'] == 1){
							  ?>	
						      <th scope="col">Excluir</th>
						      <?php
						        }
							  ?>
						    </tr>
						</thead>
						<?php
							if ($stmt = $con->prepare('SELECT id_os, id_cli, id_obra, id_func, id_serv, id_status, data_os, obs_os, valor_os, semana_os, agendamento_os FROM ordem_serv WHERE id_status = "1" OR id_status = "2" OR id_status = "3" ORDER BY id_os DESC ')) {
								$stmt->execute();
								$stmt->store_result();
								$num_of_rows = $stmt->num_rows;
								if ($stmt->num_rows > 0) {
									$stmt->bind_result($id_os, $id_cli, $id_obra, $id_func, $id_serv, $id_status, $data_os, $obs_os, $valor_os, $semana, $agendamento_os);
									while ($stmt->fetch()) {
										$datetime1 = date_create($data_os);
										$datetime2 = date_create(date('Y-m-d'));
										$interval = date_diff($datetime1, $datetime2);
										//echo $interval->format('%a ');

										if ($interval->format('%a ') < 15){
											$status = 'Em dia';
											$badge = 'badge-success';
										}
										if (($interval->format('%a ') >= 15) && ($interval->format('%a ') < 30)){
											
											$status = 'Alerta';
											$badge = 'badge-warning';
										}
										if ($interval->format('%a ') >= 30){
											$status = 'Atrasado';
											$badge = 'badge-danger';
										}
										
										if((!$semana == NULL) || (!$semana == 0)){
											$agenda = 'badge badge-success';
										}
										else {$agenda = null;}
						?>	
								    	<tr >
										    <th scope="row">
												<a href="dados_os.php?id_os=<?php echo $id_os; ?>">
													<?php
														if(!$agenda == null) {
															echo '<span style= "width: 60px" class=" w-110 badge badge-success">';
															echo $id_os;
															echo '</span>';
														}	
														else {
															echo '<span style= "width: 60px; background-color: #dbdbdb" class=" w-110 badge badge-light">';
															echo $id_os;
															echo '</span>';
														}
													?>
													
												</a>
											</th>
											<th scope="row">
												<span style= "width: 80px" class="badge <?php echo $badge; ?> w-110 "><?php echo $status; ?></span>
											</th>
										    <?php
										    if ($stmt2 = $con->prepare("SELECT clientes.nome_cli,  obra_clientes.nome_obra
																		FROM clientes 
																		LEFT JOIN obra_clientes ON clientes.id_cli = obra_clientes.id_cli 
																		AND (obra_clientes.id_obra = '$id_obra' OR obra_clientes.id_obra IS NULL)
																		WHERE clientes.id_cli ='$id_cli'
																		")) {
										    	$stmt2->execute();
												$stmt2->store_result();
												$num_of_rows2 = $stmt2->num_rows;
												if ($stmt2->num_rows > 0) {
													$stmt2->bind_result($nome_cli, $nome_obra);
													while ($stmt2->fetch()) {
														if ($nome_obra == NULL) {
															echo '<td>'.$nome_cli."</td>";
														}else {
															echo '<td>'.$nome_cli.' | OBRA: '.$nome_obra."</td>";
														}
													}
												}
										    
										    }	
										    ?>
										    <?php
										    if ($stmt3 = $con->prepare("SELECT $id_serv, descricao_serv FROM tipo_servico WHERE id_serv ='$id_serv'")) {
										    	$stmt3->execute();
												$stmt3->store_result();
												$num_of_rows3 = $stmt3->num_rows;
												if ($stmt3->num_rows > 0) {
													$stmt3->bind_result($id_serv, $descricao_serv);
													while ($stmt3->fetch()) {
														echo "<td>".$descricao_serv."</td>";
													}
												}
										    
										    }	
										    ?>
										    <?php
										    if ($stmt4 = $con->prepare("SELECT id_func, nome_func FROM funcionario WHERE id_func ='$id_func'")) {
										    	$stmt4->execute();
												$stmt4->store_result();
												$num_of_rows4 = $stmt4->num_rows;
												if ($stmt4->num_rows > 0) {
													$stmt4->bind_result($id_func, $nome_func);
													while ($stmt4->fetch()) {
														echo "<td>".$nome_func."</td>";
													}
												}
										    
										    }	
										    ?>
										    <td><?php echo trocadatabarra($data_os); ?></td>
											<td><?php if($agendamento_os != '1970-01-01'){echo trocadatabarra($agendamento_os);}?></td>
										    <td><?php echo $obs_os; ?></td>
										    <?php
										    if ($stmt5 = $con->prepare("SELECT id_status, nome_status FROM status WHERE id_status ='$id_status'")) {
										    	$stmt5->execute();
												$stmt5->store_result();
												$num_of_rows5 = $stmt5->num_rows;
												if ($stmt5->num_rows > 0) {
													$stmt5->bind_result($id_status, $nome_status);
													while ($stmt5->fetch()) {
														echo "<td>".$nome_status."</td>";
													}
												}
										    
										    }	
										    ?>

										    
											<td>
												<spam class="badge badge-primary">
										    		<a class="text-white" target=”_blank” href="relacao.php?relacao=<?php echo $id_os; ?>">Relação</a>
												</spam>
											</td>
											<td>
												<spam class="badge badge-primary">
										    		<a class="text-white" target=”_blank” href="ficha.php?imprimir=<?php echo $id_os; ?>">Imprimir</a>
												</spam>
											</td>
										    <td>
												<spam class="badge badge-primary">
										    		<a class="text-white" href="insert_os.php?editar=<?php echo $id_os; ?>">Editar</a>
												</spam>	
											</td>
										    <?php
										    		if($_SESSION['nivel'] == 1){

										    		
										    	?>	
										    	<td>
										        <a href="insert_os.php?deletar=<?php echo $id_os; ?>" onclick="return confirm('Tem certeza que deseja deletar esse registro?');">Excluir</a>
										    	</td>
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
</div>				
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