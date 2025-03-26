<?php
session_start();

	if(isset($_POST['search'])){
		include_once "../db.php";
		$textoBusca = strip_tags($_POST['search']);
		$textoBuscaSeparado = preg_split('/\s+/', $textoBusca);

		if(count($textoBuscaSeparado) > 1){
			$buscar = $con->prepare("SELECT id_prod, nome_prod, valor_unit_prod FROM produtos WHERE nome_prod LIKE '%$textoBuscaSeparado[0]%' AND nome_prod LIKE '%$textoBuscaSeparado[1]%' AND status_prod = 1 ORDER BY nome_prod");
		}

		if(count($textoBuscaSeparado) > 2){
			$buscar = $con->prepare("SELECT id_prod, nome_prod, valor_unit_prod FROM produtos WHERE nome_prod LIKE '%$textoBuscaSeparado[0]%' AND nome_prod LIKE '%$textoBuscaSeparado[1]%' AND nome_prod LIKE '%$textoBuscaSeparado[2]%' AND status_prod = 1 ORDER BY nome_prod");
		}

		else {$buscar = $con->prepare("SELECT id_prod, nome_prod, valor_unit_prod FROM produtos WHERE nome_prod LIKE '%$textoBuscaSeparado[0]%' AND status_prod = 1 ORDER BY nome_prod");}

		
		$buscar->execute();
		$buscar->store_result();
		$retorno = array();
		$retorno['dados'] = '';
		$num_of_rows = $buscar->num_rows;
		$retorno['qtd'] = $num_of_rows;
		if ($num_of_rows > 0) {
			$buscar->bind_result($id_prod, $nome_prod, $valor_unit_prod );
			while ($buscar->fetch()) {
				$retorno['dados'] .= '<li><a href="#" id="'.$id_prod.'">'.$nome_prod.'</a> - R$ '.$valor_unit_prod.'<a class="badge badge-primary ml-2" href="insert_prod.php?editar='.$id_prod.'">Editar</a></li>';
			}

		}else{$retorno = null;}

		//echo json_encode($retorno);
		echo $retorno['dados'];
	}

	//REMOVE PRODUTO CLICADO NO BOTAO REMVER
	if(isset($_POST['remover_produto'])){
		$produtoIdRemover = (int)$_POST['produtoRemover'];	
		unset($_SESSION['contador'][$produtoIdRemover]);	
	}	



	//ADD PRODUTO CLICADO NA BUSCA
	if(isset($_POST['add_produto'])){
		include_once "../db.php";
		require ('../funcoes.php');
		$contador_id = 0;
		$produtoId = (int)$_POST['produto'];
		if(isset($_SESSION['contador'][$produtoId])){
			$_SESSION['contador'][$produtoId] += 1;
		}else{
			$_SESSION['contador'][$produtoId] = 1;
		}

		
		
		foreach($_SESSION['contador'] as $idProd => $qtd){
			$pegaProduto = $con->prepare("SELECT id_prod, nome_prod, valor_unit_prod FROM produtos WHERE id_prod = '$idProd'");
			$pegaProduto->execute();
			$pegaProduto->store_result();
			$retorno1 = array();
			$retorno1['dados'] = '';
			$retorno1['contador'] = '';
			$num_of_rows = $pegaProduto->num_rows;
			if ($num_of_rows > 0) {
				$pegaProduto->bind_result($id_prod, $nome_prod, $valor_unit_prod );
				while ($pegaProduto->fetch()) {
					$contador_id = $contador_id +1;
					$retorno1['dados'] .= '<input type="hidden" name="id_prod_'.$contador_id.'" value="'.$id_prod.'"><div id="allo" class="row bg-light w-100"><div class="col-4">'.$nome_prod.'</div><a href="#" id="'.$id_prod.'" class="close-div badge badge-danger">Remover</a><div class="col-2"><input type="text" name="valor_unit_'.$contador_id.'" value="'.moeda_formato($valor_unit_prod).'"></div><div class="col-2"><input type="text" name="quantidade_'.$contador_id.'"></div><div class="col-2"><input type="text" name="fator_'.$contador_id.'"></div></div>';
					
				}
				

			}else{$retorno1 = null;}
			$retorno1['contador'] .= '<input type="hidden" id="contador_id" name="contador_id" value="'.$contador_id.'">';
			//echo json_encode($retorno);
			echo $retorno1['dados'];
			
		}
		
		echo $retorno1['contador'];	
	}





?>	