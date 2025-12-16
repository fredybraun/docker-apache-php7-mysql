<?php
 // Importar o módulo
 
 session_start();
	require('db.php');
	require ('./funcoes.php');
	require("phplot/phplot.php");
  
 // Instanciar o gráfico com tamanho pré-definido
 // Deixar em branco faz com que o gráfico encaixe na janela
 $grafico = new PHPlot(1240,600);
 
  
 // Definindo o formato final da imagem
 $grafico->SetFileFormat("png");
  
 // Definindo o título do gráfico
 $grafico->SetTitle("Faturamento 2026");
  
 // Tipo do gráfico
 // Por ser: lines, bars, boxes, bubbles, candelesticks, candelesticks2, linepoints, ohlc, pie, points, squared, stackedarea, stackedbars, thinbarline
 $grafico->SetPlotType("bars");
  
 // Título dos dados no eixo Y
 $grafico->SetYTitle("Faturamento");
  
 // Título dos dados no eixo X
 $grafico->SetXTitle("Meses");

 # Make a legend for the 3 data sets plotted:
$grafico->SetLegend(array('2022', '2023', '2024', '2025', '2026'));

$grafico->SetDataColors(array('yellow', 'orange', 'blue', 'orchid', 'green'));

$grafico->SetImageBorderType('plain');

  
 // dados do gráfico
$ano_2026 = 2026;
$ano_2025 = 2025;
$ano_2024 = 2024;
$ano_2023 = 2023;
$ano_2022 = 2022;



$dados = array();

for ($i = 1; $i <= 12; $i++) {

    $stmt = $con->prepare("SELECT SUM(valor_os) as valores FROM ordem_serv 
                            WHERE YEAR(`data_fechamento`)= '$ano_2022' 
                            AND MONTH(`data_fechamento`) = '$i'");
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($total_mes_ano_2022);
        $stmt->fetch();
    }

    $stmt = $con->prepare("SELECT SUM(valor_os) as valores FROM ordem_serv 
                            WHERE YEAR(`data_fechamento`)= '$ano_2023' 
                            AND MONTH(`data_fechamento`) = '$i'");
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($total_mes_ano_2023);
        $stmt->fetch();
    }
    $stmt = $con->prepare("SELECT SUM(valor_os) as valores FROM ordem_serv 
                            WHERE YEAR(`data_fechamento`)= '$ano_2024' 
                            AND MONTH(`data_fechamento`) = '$i'");
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($total_mes_ano_2024);
        $stmt->fetch();
    }

    $stmt = $con->prepare("SELECT SUM(valor_os) as valores FROM ordem_serv 
                            WHERE YEAR(`data_fechamento`)= '$ano_2025' 
                            AND MONTH(`data_fechamento`) = '$i'");
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($total_mes_ano_2025);
        $stmt->fetch();
    }

    $stmt = $con->prepare("SELECT SUM(valor_os) as valores FROM ordem_serv 
                            WHERE YEAR(`data_fechamento`)= '$ano_2026' 
                            AND MONTH(`data_fechamento`) = '$i'");
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($total_mes_ano_2026);
        $stmt->fetch();
    }
    $dados[$i -1] = array( $i, $total_mes_ano_2022, $total_mes_ano_2023, $total_mes_ano_2024, $total_mes_ano_2025, $total_mes_ano_2026 );	
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