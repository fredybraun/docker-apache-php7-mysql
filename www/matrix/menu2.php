<?php
  if(isset($_SESSION['active'])){
    $ativo = $_SESSION['active'];
  }
// Contador de agendamentos do dia
require('./db.php');
$data_agendamento = date("Y-m-d");
$quantidade_agendamento = 0;
if ($stmt = $con->prepare("SELECT agendamento_os FROM ordem_serv WHERE agendamento_os = '$data_agendamento'")) {
            $stmt->execute();
            $stmt->store_result();
            $num_of_rows = $stmt->num_rows;
            if ($stmt->num_rows > 0) {
            $stmt->bind_result($agendamentos);
              while ($stmt->fetch()) {
                    $quantidade_agendamento = $quantidade_agendamento + 1;              }
            }
            $stmt->free_result();
          }
?>
<div class="btn-group mt-2 col-md-12" role="group" aria-label="Exemplo básico">
  <a class="btn btn-primary" href="index.php" role="button">Home</a>
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Clientes
    </button>
    <div class="dropdown-menu">
    	<div class="whatsappsite">
        <input type="text" id="text" autocomplete="off" placeholder="(XX)9XXXX-XXXX..." style="margin-bottom: 10px; padding: 0 10px; margin-left: 25px; margin-top: 5px; margin-right: 20px;" />
        <button type="button" class="btn btn-success btn-sm ml-4" onClick="javascript: window.open('https://api.whatsapp.com/send?phone=55' + document.getElementById('text').value);"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
  <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
</svg> Whatsapp </button>
      </div>
      <hr>
      <a class="dropdown-item mt-3" href="create_cli.php">Cadastro de Clientes</a>
      <a class="dropdown-item mt-3" href="create_obra.php">Cadastro de Obras</a>
    </div>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Ordem de Serviço
    </button>
    <div class="dropdown-menu">
    	<div class="search-box2">
  			        <input type="text" autocomplete="off" placeholder="OS..." style="margin-bottom: 10px; padding: 0 10px; margin-left: 20px; margin-top: 5px; margin-right: 20px;" />
  			        <div class="result2" style="margin-bottom: 10px; margin-left: 20px; "></div>
  		</div>
      <hr>      
      <a class="dropdown-item" href="create_os.php">Abrir OS</a>
      <a class="dropdown-item" href="medidas_os.php">Medidas</a>
      <a class="dropdown-item" href="orcamento_os.php">Orçamento</a>
      <a class="dropdown-item" href="montagem_os.php">Montagem</a>
      <a class="dropdown-item" href="instalacao_os.php">Instalação</a>
      <a class="dropdown-item" href="cobranca_os.php">Cobrança</a>
      <a class="dropdown-item" href="historico_os.php">Histórico</a>
      <a class="dropdown-item" href="relatorios_os.php">Relatórios</a>
      <a class="dropdown-item" href="ficha_no_data.php" target=”_blank”>Ficha Imprimir</a>
    </div>
  </div>
  <a class="btn btn-primary" href="semanas.php" role="button">Agendamento <span class="badge badge-danger"><?php echo $quantidade_agendamento;?></span></a>
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Andaimes
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="create_andaime.php">Locação</a>
      <a class="dropdown-item" href="lista_andaime.php">Retirados</a>
      <a class="dropdown-item" href="historico_andaime.php">Histórico</a>
    </div>
  </div>


  <div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Administração
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="create_prod.php">Produtos</a>
      <a class="dropdown-item" href="create_locacoes.php">Locações</a>
      <li class="dropdown-submenu">
        <button type="button" class="dropdown-item" data-toggle="dropdown">Veículos</button>
        <ul class="dropdown-menu">
        <a class="dropdown-item" href="create_retirada_abastecimento.php">Retirada Abastecimento</a>
        <a class="dropdown-item" href="create_veiculos.php">Adicionar Veículos</a>
        <a class="dropdown-item" href="create_despesas_veiculos.php">Despesa de Veículos</a>
        <a class="dropdown-item" href="relatorio_despesas_veiculos.php">Relatório de Veículos</a>
        </ul>
      </li>
    </div>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Configurações
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="create_user.php">Usuários</a>
      <a class="dropdown-item" href="create_materiais.php">Materiais</a>
      <a class="dropdown-item" href="create_fun.php">Funcionários</a>
      <a class="dropdown-item" href="create_serv.php">Tipos de Serviços</a> 
      <a class="dropdown-item" href="configuracoes.php">Sistema Geral</a>
      
    </div>
  </div>
  <a class="btn btn-success" href="semanas.php" role="button">
  	<?php
  			$data_hoje = date('d-m-Y');
  			echo 'Dia: '.$data_hoje. ' - ';
  			$data_hoje2 = date('Y-m-d');
  			echo 'Semana: '.getWeekNumber($data_hoje2);
  		?>
  </a>
  <a class="btn btn-warning" href="" role="button"><?php echo 'Usuário: '.$_SESSION["name"] .' N:'.$_SESSION["nivel"];?></a>	
  <a class="btn btn-danger" href="<?php echo 'logoff.php?token='.md5(session_id());?>" role="button">Sair</a>	
</div>  
<script>
function wbFunction() {
			var whatsapp = document.getElementById("whatsappnum").value;
			return "https://api.whatsapp.com/send?phone="+ whatsapp();
	    }

	  	</script>