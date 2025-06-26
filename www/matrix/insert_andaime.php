<?php
	session_start();
	require('db.php');
    require ('funcoes.php');

    

	// insere andaime novo
	if(isset($_POST['status'])){
        $status = $_POST['status'];
		$cliente = '';
		$end_entrega = '';
        $data_solicitação = '';
        $quant_andaime = '';
        $quant_plataforma = '';
        $quant_travessa = '';
        $quant_rodas = '';
        $quant_sapata = '';
        $frete_entrega = '';
        $frete_retorno = '';
        $data_retirada = '';
        $data_retorno = '';
        $status_andaime = '';
        $valor = '';

        if($status = "create") {
        	if(isset($_POST['cli_andaime'])){
                $cliente = $_POST['cli_andaime'];
                $end_entrega = $_POST['end_entrega'];
                $data_solicitacao = trocadatatraco(date('Y-m-d'));

                $quant_andaime = $_POST['quant_andaime'];
                if(!$quant_andaime){$quant_andaime = 0;}

                $quant_plataforma = $_POST['quant_plataforma'];
                if(!$quant_plataforma){$quant_plataforma = 0;}

                $quant_travessa = $_POST['quant_travessa'];
                if(!$quant_travessa){$quant_travessa = 0;}

                $quant_rodas = $_POST['quant_rodas'];
                if(!$quant_rodas){$quant_rodas = 0;}

                $quant_sapata = $_POST['quant_sapata'];
                if(!$quant_sapata){$quant_sapata = 0;}

                $quant_escada_longa = $_POST['quant_escada_longa'];
                if(!$quant_escada_longa){$quant_escada_longa = 0;}

                $quant_escada_curta = $_POST['quant_escada_curta'];
                if(!$quant_escada_curta){$quant_escada_curta = 0;}

                $frete_entrega = $_POST['frete_entrega'];
                if (!$frete_entrega){$frete_entrega = 0;}

                $frete_retorno = $_POST['frete_retorno'];
                if (!$frete_retorno){$frete_retorno = 0;}

                
                $data_retirada = trocadatatraco($_POST['data_retirada']);
                $data_retorno = trocadatatraco($_POST['data_retorno']);
                $status_andaime = $_POST['status_andaime'];

                $stmt = $con->prepare("INSERT INTO andaimes (data_solicitacao, id_cli, quant_andaime, quant_plataforma, quant_travessa, quant_rodas, quant_sapata, quant_escada_longa, quant_escada_curta, frete_entrega, frete_retorno, data_retirada, data_retorno, end_entrega, status) VALUES ('$data_solicitacao', '$cliente', '$quant_andaime', '$quant_plataforma', '$quant_travessa', '$quant_rodas', '$quant_sapata', '$quant_escada_longa', '$quant_escada_curta', '$frete_entrega', '$frete_retorno', '$data_retirada', '$data_retorno', '$end_entrega', '$status_andaime')");

                $stmt->execute();
                $_SESSION['message'] = "Dados adicionados"; 
                sleep(2);
                
                header('location: create_andaime.php');
            }   
            
        }

	}

//edita 
    if (isset($_GET['editar'])) {
        $id = $_GET['editar'];
        $stmt = $con->prepare("SELECT id_andaime, data_solicitacao, id_cli, quant_andaime, quant_plataforma, quant_travessa, quant_rodas, quant_sapata, quant_escada_longa, quant_escada_curta, frete_entrega, frete_retorno, data_retirada, data_retorno, end_entrega, status, dias_locados, valor FROM andaimes WHERE id_andaime='$id'");
        $stmt->execute();
        $stmt->store_result();
        $num_of_rows = $stmt->num_rows;
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id_andaime, $data_solicitacao, $id_cli_andaime, $quant_andaime, $quant_plataforma, $quant_travessa, $quant_rodas, $quant_sapata, $quant_escada_longa, $quant_escada_curta, $frete_entrega, $frete_retorno, $data_retirada, $data_retorno, $end_entrega, $status, $dias_locados, $valor);
            $stmt->fetch();        
        }
    } 
    //deleta  
    if (isset($_GET['deletar'])) {
        $id = $_GET['deletar'];
        $stmt = $con->prepare("DELETE FROM ordem_serv WHERE id_os='$id'");
        $stmt->execute();
        header('location: create_os.php');
    }    

?>    

<?php
//valida usuário esta logado, caso não, redireciona para loguin.
if(!isset($_SESSION["name"])){
header("Location: login.php");
exit(); }
?>

<?php
    $_SESSION['active'] = 'locacao';
    require ('./topo2.php');
    require('menu2.php');
?>
<div class="container-fluid mt-2 col-md-12">
    <h3>Editar Locação de Equipamento N°: <?php echo $id;?></h3>
    <div class="row">
        <div class="col-sm">
            <form action="atualiza_andaime.php" method="post">
                <div class="form-group">
                    <label for="fos" class="row pl-3">Cliente</label>
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
                                    if($id_cli == $id_cli_andaime){
                                        echo '<option selected value="'.$id_cli.'">'.$nome_cli.'</option>';
                                    }
                                    else {
                                        echo '<option value="'.$id_cli.'">'.$nome_cli.'</option>';    
                                    }
                                    
                                }
                            }
                            $stmt->free_result();
                        }
                    ?>
                    </select>
                </div>   
                <div class="form-group"> 
                    <label for="fos">Entregar</label>
                    <textarea class="form-control w-75" id="end_entrega" name="end_entrega" placeholder="Observações..."><?php echo $end_entrega;?></textarea>
                </div>   
                <div class="form-group">    
                    <label for="fos">Andaimes</label>
                    <input  type="text" class="form-control w-75" id="quant_andaime"  name="quant_andaime" value="<?php echo $quant_andaime?>">
                </div>   
                <div class="form-group">
                    <label for="fos">Plataformas</label>
                    <input  type="text" class="form-control w-75" id="quant_plataforma"  name="quant_plataforma" value="<?php echo $quant_plataforma?>">
                </div>   
                <div class="form-group">    
                    <label for="fos">Travessas</label>
                    <input  type="text" class="form-control w-75" id="quant_travessa"  name="quant_travessa" value="<?php echo $quant_travessa?>">
                </div>   
                <div class="form-group">        
                    <label for="fos">Rodas</label>
                    <input  type="text" class="form-control w-75" id="quant_rodas"  name="quant_rodas" value="<?php echo $quant_rodas?>">
                </div>   
                <div class="form-group">    
                    <label for="fos">Sapatas</label>
                    <input  type="text" class="form-control w-75" id="quant_sapata"  name="quant_sapata" value="<?php echo $quant_sapata?>">
                   
                    <input type="hidden" name="status" value="update">
                    <input type="hidden" name="id" value="<?php echo $id_andaime; ?>">
                </div>
                <div class="form-group">
			    	<label for="fos">Escada Longa</label>
			    	<input  type="text" class="form-control w-75" id="quant_escada_longa"  name="quant_escada_longa" value="<?php echo $quant_escada_longa?>">
				</div>
				<div class="form-group">
			    	<label for="fos">Escada Curta</label>
			    	<input  type="text" class="form-control w-75" id="quant_escada_curta"  name="quant_escada_curta" value="<?php echo $quant_escada_curta?>">
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
                                    if($frete_entrega == $id_itens_locacoes){
                                        echo '<option  selected value="'.$id_itens_locacoes.'">'.$nome_itens_locacoes.'</option>';   
                                    }
                                    else {echo '<option value="'.$id_itens_locacoes.'">'.$nome_itens_locacoes.'</option>';}
                                    
                                }
                            }
                            $stmt->free_result();
                        }
                    ?>
                </select>
				</div>
				<div class="form-group">
					<label for="fos">Frete Retirada</label></a>
	    			<select class="form-control w-75" id="frete_retorno" name="frete_retorno">
	    				<option value=""></option>
						<?php
							if ($stmt = $con->prepare('SELECT id_itens_locacoes, nome_itens_locacoes FROM itens_locacoes WHERE id_itens_locacoes BETWEEN 10 AND 12')) {
								$stmt->execute();
								$stmt->store_result();
								$num_of_rows = $stmt->num_rows;
								if ($stmt->num_rows > 0) {
								$stmt->bind_result($id_itens_locacoes, $nome_itens_locacoes);
									while ($stmt->fetch()) {
										if($frete_retorno == $id_itens_locacoes){
                                            echo '<option  selected value="'.$id_itens_locacoes.'">'.$nome_itens_locacoes.'</option>';   
                                        }
                                        else {echo '<option value="'.$id_itens_locacoes.'">'.$nome_itens_locacoes.'</option>';}
									}
								}
								$stmt->free_result();
							}
						?>
				    </select>
				</div>   
                <div class="form-group">     
                    <label for="fos">Retirada</label>
                    <input required class="form-control w-75" type="text" id="data_retirada"  name="data_retirada" value="<?php echo trocadatabarra($data_retirada);?>">
                </div>   
                <div class="form-group">     
                    <label for="fos">Devolução</label>
                    <input  type="text" class="form-control w-75" id="data_retorno"  name="data_retorno" value="<?php echo trocadatabarra($data_retorno);?>">
                </div>   
                <div class="form-group">     
                    <label for="fos">Status</label>
                    <select required class="form-control w-75" id="status_andaime" name="status_andaime">
                        <option value="0" <?php if($status == 0){echo 'selected';}?>>Locação</option>
                        <option value="1" <?php if($status == 1){echo 'selected';}?>>Cobrança</option>
                        <option value="2" <?php if($status == 2){echo 'selected';}?>>Histórico</option>
                    </select>
                </div>   
                <div class="form-group">     
                    <label for="fos">Dias Locados</label>
                    <input type="text" class="form-control w-75" id="dias_locados"  name="dias_locados" value="<?php echo $dias_locados?>">
                </div>   
                <div class="form-group">     
                    <label for="fos">Valor: </label>
                    <input type="text" class="form-control w-75" id="valor"  name="valor" onkeypress='$(this).mask("###0,00", {reverse: true});' value="<?php $valor_virgula = $valor = str_replace('.', ',',$valor);echo $valor_virgula;?>">
                </div>
                <div class="form-group">    
                    <button type="submit" class="btn btn-primary" name="insert">Atualizar</button>
                    <button type="button" class="btn btn-primary" onClick="history.go(-1)">Voltar</button>   
                </div>
            </form> 
    </div>                        
 </div>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>	
			<script>
				$(document).ready(function() {
   					 $('.select2').select2();
				});
			</script>	
    </body>
</html>
