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
					<h3>Cadastro de Cliente</h3>
					<div class="row">
						<div class="col-sm">	
							<form action="insert_cli.php" method="post">
								<div class="form-group">
									<label for="fname">Nome</label>
				    				<input required class="form-control w-75" type="text" id="cli_nome" name="cli_nome">
				    			</div>
				    			<div class="form-group">
				    				<label for="fcpf">CPF/CNPJ</label>
				    				<input type="text" class="form-control w-75" id="cli_cpf" name="cli_cpf">
				    			</div>
				    			<div class="form-group">
				    				<label for="ftelefone">Telefone</label>
				    				<input required type="text" class="form-control w-75" id="cli_tel" name="cli_tel">
				    			</div>
				    			<div class="form-group">
				    				<label for="ftelefone2">Telefone2</label>
				    				<input type="text" class="form-control w-75" id="cli_tel2" name="cli_tel2">
				    			</div>
				    			<div class="form-group">
				    				<label for="fcontato">Contato</label>
				    				<input type="text" class="form-control w-75" id="cli_contato" name="cli_contato">
				    			</div>
				    	</div>
					    <div class="col-sm">
					    		<div class="form-group">
				    				<label for="fend">Endereço</label>
				    				<input required type="text" class="form-control w-75" id="cli_end" name="cli_end">
				    			</div>
								<div class="form-group">	
					    			<label for="fnum">Número</label>
					    			<input required type="text" class="form-control w-75" id="cli_num" name="cli_num">
				    			</div>
				    			<div class="form-group">
				    				<label for="fbairro">Bairro</label>
				    				<input required type="text" class="form-control w-75" id="cli_bairro" name="cli_bairro">
				    			</div>
				    			<div class="form-group">
				    				<label for="fcid">Cidade</label>
				    				<select required class="form-control w-75" id="cli_cid" name="cli_cid">
					    				<option value=""></option>	
								      	<option value="1">Nova Petrópolis</option>
								      	<option value="2">Picada Café</option>
								      	<option value="3">Gramado</option>
								      	<option value="4">Canela</option>
								      	<option value="5">São Francisco de Paula</option>
								      	<option value="6">Presidente Lucena</option>
								      	<option value="7">Caxias do Sul</option>
								    </select>
							    </div>
				    			<div class="form-group">
							   		<label for="fobs">Observações</label>
				    				<textarea class="form-control w-75" id="cli_obs" name="cli_obs" placeholder="Observações..." style="height:100px"></textarea>
				    			</div>
				    			<input type="hidden" name="status" id="status" value="create">
				    			<div class="mt-2">
				    				<button type="submit" class="btn btn-primary">Adicionar</button>
				    			</div>
				    			
							</form>	
						</div>		
					</div>
				</div>
			</div>	
		<div class="container-fluid mt-2 col-md-12">
			<h3>Clientes cadastrados</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Nome</th>	
						<th scope="col">Opções</th>	
					</tr>
				</thead>
				<tbody>	
					<tr>
			<?php
				if ($stmt = $con->prepare('SELECT id_cli, nome_cli FROM clientes ORDER BY  nome_cli')) {
					$stmt->execute();
					$stmt->store_result();
					$num_of_rows = $stmt->num_rows;
					if ($stmt->num_rows > 0) {
					$stmt->bind_result($id_cli, $nome_cli);
						while ($stmt->fetch()) {
					        echo '<td scope="row">';
					        echo '<a href="dados_cliente.php?id_cliente='.$id_cli.'">'.$nome_cli.'</a>';
					         echo '</td>';
					        echo '<td>';
					        if($_SESSION['nivel'] == 1){
					        	echo '<spam class="badge badge-primary"><a class="text-white" href="insert_cli.php?editar='.$id_cli.'" c> Editar </a></spam>';
					        	echo '<spam class="badge badge-primary"><a class="text-white" href="insert_cli.php?deletar='.$id_cli.'" class="button"';?>onclick="return confirm('Tem certeza que deseja deletar esse registro?');"<?php echo '> Deletar </a></spam>';
					        }
					        
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
