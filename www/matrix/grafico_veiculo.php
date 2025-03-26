<?php
 // Importar o módulo
 
 session_start();
	require('db.php');
	require ('./funcoes.php');
	require("phplot/phplot.php");
  
 // Instanciar o gráfico com tamanho pré-definido
 // Deixar em branco faz com que o gráfico encaixe na janela
 $grafico = new PHPlot(600,400);
 
  
 // Definindo o formato final da imagem
 $grafico->SetFileFormat("png");
  
 // Definindo o título do gráfico
 $grafico->SetTitle("OS abertas 2020 - 2021 - 2022");
  
 // Tipo do gráfico
 // Por ser: lines, bars, boxes, bubbles, candelesticks, candelesticks2, linepoints, ohlc, pie, points, squared, stackedarea, stackedbars, thinbarline
 $grafico->SetPlotType("bars");
  
 // Título dos dados no eixo Y
 $grafico->SetYTitle("OS Abertas");
  
 // Título dos dados no eixo X
 $grafico->SetXTitle("Meses");

 # Make a legend for the 3 data sets plotted:
$grafico->SetLegend(array('2020', '2021', '2022'));
$grafico->SetImageBorderType('plain');
  
// dados do gráfico
//ANO
$stmt = $con->prepare("SELECT ano_vigente FROM configuracoes");
$stmt->execute();
$stmt->store_result();
$num_of_rows = $stmt->num_rows;
if ($stmt->num_rows > 0) {
    $stmt->bind_result($ano_vigente);
    while ($stmt->fetch()) {
        $ano = $ano_vigente;
    }
}




$dados = array();

for ($i = 1; $i <= 12; $i++) {
	$stmt = $con->prepare("SELECT COUNT(id_os) FROM ordem_serv WHERE YEAR(`data_os`)='$ano_anterior' AND MONTH(`data_os`) ='$i' AND id_status BETWEEN 1 AND 5");
	$stmt->execute();
	$stmt->store_result();
	$num_of_rows = $stmt->num_rows;
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($total_mes_ano_anterior);
		$stmt->fetch();
	}

	$stmt = $con->prepare("SELECT COUNT(id_os) FROM ordem_serv WHERE YEAR(`data_os`)='$ano_vigente' AND MONTH(`data_os`) ='$i' AND id_status BETWEEN 1 AND 5");
	$stmt->execute();
	$stmt->store_result();
	$num_of_rows = $stmt->num_rows;
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($total_mes_ano_atual);
		$stmt->fetch();
	}

    $stmt = $con->prepare("SELECT COUNT(id_os) FROM ordem_serv WHERE YEAR(`data_os`)='$ano_anterior_2' AND MONTH(`data_os`) ='$i' AND id_status BETWEEN 1 AND 5");
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($total_mes_ano_anterior_2);
        $stmt->fetch();
    }
    $dados[$i -1] = array( $i, $total_mes_ano_anterior_2, $total_mes_ano_anterior, $total_mes_ano_atual );	
}



 // dados do gráfico
 //$dados = array(
 //array('Dom', 12),
 //array('Seg', 20),
 //array('Ter', 7),
 //array('Qua', 2),
 //array('Qui', 6),
 //array('Sex', 4),
 //array('Dom', 12),
 //array('Seg', 20),
 //array('Ter', 7),
 //array('Qua', 2),
 //array('Qui', 6),
 //array('Sáb', 1)
 //);
  
 $grafico->SetDataValues($dados);
  
 //Exibimos o gráfico
 $grafico->DrawGraph();


?>