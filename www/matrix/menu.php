<?php
  if(isset($_SESSION['active'])){
    $ativo = $_SESSION['active'];
  }
?>


<div class="topnav">
	<a <?php if($ativo == 'home'){ echo 'class="active"';}?>href="index.php">Home</a>
	<a <?php if($ativo == 'cliente'){ echo 'class="active"';}?>href="create_cli.php">Clientes</a>
	<div class="dropdown">
		    <button <?php if($ativo == 'os'){ echo 'class="dropbtn active"';} else{echo 'class="dropbtn"';}?>>Ordem de Serviços
		      <i class="fa fa-caret-down"></i>
		    </button>
	    <div class="dropdown-content">
	      <div class="search-box2">
			        <input type="text" autocomplete="off" placeholder="OS..." style="width: 150px; height: 30px; border: 1px solid #dee0e4;margin-bottom: 20px; padding: 0 10px; margin-left: 20px; margin-top: 5px; margin-right: 20px;" />
			        <div class="result2"></div>
			    </div>
	      <a <?php if($ativo == 'os'){ echo 'class="active"';}?>href="create_os.php">Abrir OS</a>
	      <a <?php if($ativo == 'medida'){ echo 'class="active"';}?>href="medidas_os.php">Medidas</a>
	      <a <?php if($ativo == 'orcamento'){ echo 'class="active"';}?>href="orcamento_os.php">Orçamento</a>
	      <a <?php if($ativo == 'montagem'){ echo 'class="active"';}?>href="montagem_os.php">Montagem</a>
	      <a <?php if($ativo == 'instalacao'){ echo 'class="active"';}?>href="instalacao_os.php">Instalação</a>
	      <a <?php if($ativo == 'cobranca'){ echo 'class="active"';}?>href="cobranca_os.php">Cobrança</a>
	      <a <?php if($ativo == 'historico'){ echo 'class="active"';}?>href="historico_os.php">Histórico</a>
	      <a <?php if($ativo == 'relatorios'){ echo 'class="active"';}?>href="relatorios_os.php">Relatórios</a>
	    </div>
  	</div>
  	<a <?php if($ativo == 'agendamento'){ echo 'class="active"';}?>href="semanas.php">Agendamento</a>
  	<div class="dropdown">
		    <button <?php if($ativo == 'locacao'){ echo 'class="dropbtn active"';} else{echo 'class="dropbtn"';}?>> Andaimes
		      <i class="fa fa-caret-down"></i>
		    </button>
	    <div class="dropdown-content">
	      <a <?php if($ativo == 'locacao'){ echo 'class="active"';}?> href="create_andaime.php">Locação</a>
	      <a <?php if($ativo == 'retirados'){ echo 'class="active"';}?> href="lista_andaime.php">Retirados</a>
	      <a <?php if($ativo == 'historico'){ echo 'class="active"';}?> href="historico_andaime.php">Histórico</a>
	    </div>
  	</div>
  	<div class="dropdown">
		    <button class="dropbtn"> Configurações
		      <i class="fa fa-caret-down"></i>
		    </button>
	    <div class="dropdown-content">
	      <a <?php if($ativo == 'usuario'){ echo 'class="active"';}?> href="create_user.php">Usuários</a>
	      <a <?php if($ativo == 'produtos'){ echo 'class="active"';}?> href="create_prod.php">Produtos</a>
	      <a <?php if($ativo == 'materiais'){ echo 'class="active"';}?> href="create_materiais.php">Materiais</a>
	      <a <?php if($ativo == 'funcionario'){ echo 'class="active"';}?>href="create_fun.php">Funcionários</a>
  		  <a <?php if($ativo == 'tipo_servico'){ echo 'class="active"';}?>href="create_serv.php">Tipos de Serviços</a>
	    </div>
  	</div>
	
	<a class="user_logado">
		<?php echo 'Usuário: '.$_SESSION["name"] .' N:'.$_SESSION["nivel"];?>
	</a>
		<?php echo '<a href="logoff.php?token='.md5(session_id()).'">Sair</a>';?>
	<a> 
		<?php
			$data_hoje = date('d-m-Y');
			echo 'Dia: '.$data_hoje. ' - ';
			$data_hoje2 = date('Y-m-d');
			echo 'Semana: '.getWeekNumber($data_hoje2);
		?>
			
	</a>
</div> 