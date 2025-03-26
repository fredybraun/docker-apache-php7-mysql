<?php
session_start();
$_SESSION["onde_estou"] = 'relatorios_os';
require ('./topo.php');
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
	$_SESSION['active'] = 'relatorios';
	require('menu.php');
?>
		
		<div class="create_os">
			<div class="os_ali">
				<h1>Relatórios de Ordem de Serviço</h1>

				<form action="gera_relatorio.php" method="post">
					<label for="fos">Todas as OS</label>
					<input type="hidden" name="status" id="status" value="todas_os">
	    			<input type="submit" value="Gerar" >
				</form>	
				<br><br><br>
				<h1>Relatórios de agenda</h1>
				<form action="gera_relatorio_agenda.php" method="post">
					<label for="fos">Agenda</label>
                    <select class="semana" id="semana" name="semana">
                        <option value="0">Selecione a semana</option>
                        <?php
                            $ano = '2021';
                            $data_hoje = date('Y-m-d');
                            $semana_select = getWeekNumber($data_hoje) - 2;
                           for ($i=$semana_select; $i <= 52 ; $i++) { 
                                //$week_array = getStartAndEndDate($ano,$i);
                                $semana_loop = $i.'-'.$ano;
                                if($semana_loop == $semana){
                                    echo '<option selected value="'.$i.'-'.$ano.'">'.$i.'-'.$ano.'</option>';
                                }
                                else {echo '<option value="'.$i.'-'.$ano.'">'.$i.'-'.$ano.'</option>';}
                                
                            }
                           for ($i=1; $i < $semana_select ; $i++) { 
                                //$week_array = getStartAndEndDate($ano,$i);
                                $semana_loop = $i.'-'.$ano;
                                if($semana_loop == $semana){
                                    echo '<option selected value="'.$i.'-'.$ano.'">'.$i.'-'.$ano.'</option>';
                                }
                                else {echo '<option value="'.$i.'-'.$ano.'">'.$i.'-'.$ano.'</option>';}
                                
                            }

                        ?>

                    </select>
                    <label for="fos">Responsável</label>
	    			<select required id="func" name="func">
	    				<option value=""></option>
    				<?php
						if ($stmt = $con->prepare('SELECT id_func, nome_func FROM funcionario ')) {
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
	    			<input type="submit" value="Gerar" >
				</form>
					
			</div>
			<div class="side_os">
				<div class="fake_form">
					<h1>Tempo e agendamento</h1>
					
				</div>
			</div>

			<div class="list_user">
				<h1>Ordem de serviços abertas</h1>
				<div class="horizontal">
					 <table class="tabela">
					    <tr>
					      <td>Num OS</td> 		
					      <td>Cliente</td>
					      <td>Serviço</td>
					      <td>Responsável</td>
					      <td>Data de abertura</td>
					      <td>Observações</td>
					      <td>Status</td>
					      <td>Valor</td>
					      <td>Relação</td>
					      <td>Imprimir</td>
					      <td>Editar</td>
					      <?php
					    	if($_SESSION['nivel'] == 1){
						  ?>	
					      <td>Excluir</td>
					      <?php
					        }
						  ?>
					    </tr>

						<?php
							if ($stmt = $con->prepare('SELECT id_os, id_cli, id_func, id_serv, id_status, data_os, obs_os, valor_os, semana_os FROM ordem_serv WHERE id_status = "1" OR id_status = "2" OR id_status = "3" ORDER BY id_os DESC ')) {
								$stmt->execute();
								$stmt->store_result();
								$num_of_rows = $stmt->num_rows;
								if ($stmt->num_rows > 0) {
									$stmt->bind_result($id_os, $id_cli, $id_func, $id_serv, $id_status, $data_os, $obs_os, $valor_os, $semana);
									while ($stmt->fetch()) {
										$datetime1 = date_create($data_os);
										$datetime2 = date_create(date('Y-m-d'));
										$interval = date_diff($datetime1, $datetime2);
										//echo $interval->format('%a ');

										if ($interval->format('%a ') < 15){
											$cor = '#66ff66'; //verde
										}
										if (($interval->format('%a ') >= 15) && ($interval->format('%a ') < 30)){
											$cor = '#ffff66'; //amarelo
										}
										if ($interval->format('%a ') >= 30){
											$cor = '#ff6666';//vermelho
										}
										
										if(($semana == NULL) || ($semana == 0)){
											$agenda = '#ffff66';
										}
										else {$agenda = '#66ff66';}


						?>	
								    	<tr style="background:<?php echo $cor;?>">
										    <td style="background:<?php echo $agenda;?>"><a href="dados_os.php?id_os=<?php echo $id_os; ?>"><?php echo $id_os; ?></a></td>
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
										    	<?php echo $valor_os;?>
											</td>
											<td>
										    	<a target=”_blank” href="relacao.php?relacao=<?php echo $id_os; ?>">Relação</a>
											</td>
											<td>
										    	<a target=”_blank” href="ficha.php?imprimir=<?php echo $id_os; ?>">Imprimir</a>
											</td>
										    <td>
										    	<a href="insert_os.php?editar=<?php echo $id_os; ?>">Editar</a>
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