<?php
session_start();
require ('./topo2.php');
require ('./funcoes.php');

//valida usuário esta logado, caso não, redireciona para loguin.
require('./db.php');
if(!isset($_SESSION["name"])){
header("Location: login.php");
die(); }

	$_SESSION['active'] = 'cliente';
	require('menu2.php');
?>
		
			<div class="container-fluid mt-2 col-md-12">
				<div class="form-group">
				<div class="search-box">
			        <input type="text" class="form-control w-25 mt-3" autocomplete="off" placeholder="Cliente..." />
			        <div class="result"></div>
			    </div>
			    <div class="search-box2">
			        <input type="text" class="form-control w-25 mt-3" autocomplete="off" placeholder="OS..."/>
			        <div class="result2"></div>
			    </div>
				</div>	
				<div id="fecha">
					<h3>Cadastro de obra</h3>
					<div class="row">
						<div class="col-sm">	
							<form action="insert_obra.php" method="post">
								<div class="form-group">
									<label for="fname">Nome da obra</label>
				    				<input required class="form-control w-75" type="text" id="nome_obra" name="nome_obra">
				    			</div>
								<div class="form-group">
				    				<label for="fcid">Clientes</label>
				    				<select required class="form-control w-75" id="cli_obra" name="cli_obra">
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
							   		<label for="fobs">Endereço</label>
				    				<textarea class="form-control w-75" id="end_obra" name="end_obra" placeholder="Endereço..."></textarea>
				    			</div>
								<input type="hidden" name="status" id="status" value="create">
				    			<div class="mt-2">
				    				<button type="submit" class="btn btn-primary">Adicionar</button>
				    			</div>
				    	</div>
						<div class="col-sm"></div>
				    </form>	
					</div>
				</div>
			</div>	
			<div class="container-fluid mt-2 col-md-12">
			<h3>Obras cadastradas</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Cliente</th>
						<th scope="col">Nome da obra</th>	
						<th scope="col">Endereço</th>	
						<th scope="col">Ações</th>
					</tr>
				</thead>
				<tbody>	
					<tr>
			<?php
				if ($stmt = $con->prepare('SELECT obra_clientes.id_obra, obra_clientes.nome_obra, obra_clientes.endereco_obra, clientes.nome_cli, clientes.id_cli FROM obra_clientes JOIN clientes ON obra_clientes.id_cli = clientes.id_cli;')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
					$stmt->bind_result($id_obra, $nome_obra, $end_obra, $cli_obra, $id_cli_obra);
						while ($stmt->fetch()) {
					        echo '<td scope="row">';
					        echo '<a href="dados_cliente.php?id_cliente='.$id_cli_obra.'">'.$cli_obra.'</a>';
					         echo '</td>';
							 echo '<td>';
					        echo '<spam>'.$nome_obra.'</spam>';
					         echo '</td>';
							 echo '<td>';
					        echo '<spam>'.$end_obra.'</spam>';
					         echo '</td>';
					        echo '<td>';
					        echo '<spam class="badge badge-primary"><a class="text-white" href="insert_obra.php?editar='.$id_obra.'" c> Editar </a></spam>';
					        echo '</td></tr>';
					    }
					}
					$stmt->free_result();
				}
			?>
					
				</tbody>
			</table>
		</div>
		

		<script>
		function myFunction() {
		  var x = document.getElementById("fecha");
		  if (x.style.display === "block") {
		    x.style.display = "none";
		  } else {
		    x.style.display = "block";
		  }
		}
		</script>

	</body>
</html>
