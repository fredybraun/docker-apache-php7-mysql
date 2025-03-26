<?php
session_start();
  require('db.php');
  require ('./funcoes.php');
  require("phplot/phplot.php");

# The data labels aren't used directly by PHPlot. They are here for our
# reference, and we copy them to the legend below.
$data = array();
$ano_2024 = 2024;

for ($i = 1; $i <= 1; $i++) {
  $stmt = $con->prepare("SELECT DISTINCT COUNT(id_serv) FROM ordem_serv 
  WHERE id_serv = 1 AND id_status BETWEEN 1 AND 5 AND YEAR(`data_os`)= '$ano_2024'");
  $stmt->execute();
  $stmt->store_result();
  $num_of_rows = $stmt->num_rows;
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($tipo_servico);
    $stmt->fetch();
  }
    $data[0] = array( 'Calha', $tipo_servico );  
}
for ($i = 1; $i <= 1; $i++) {
  $stmt = $con->prepare("SELECT DISTINCT COUNT(id_serv) FROM ordem_serv 
  WHERE id_serv = 2 AND id_status BETWEEN 1 AND 5 AND YEAR(`data_os`)= '$ano_2024'");
  $stmt->execute();
  $stmt->store_result();
  $num_of_rows = $stmt->num_rows;
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($tipo_servico);
    $stmt->fetch();
  }
    $data[1] = array( 'Algerosa', $tipo_servico );  
}
for ($i = 1; $i <= 1; $i++) {
  $stmt = $con->prepare("SELECT DISTINCT COUNT(id_serv) FROM ordem_serv 
  WHERE id_serv = 3 AND id_status BETWEEN 1 AND 5 AND YEAR(`data_os`)= '$ano_2024'");
  $stmt->execute();
  $stmt->store_result();
  $num_of_rows = $stmt->num_rows;
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($tipo_servico);
    $stmt->fetch();
  }
    $data[2] = array( 'Calha e Algerosa', $tipo_servico );  
}
for ($i = 1; $i <= 1; $i++) {
  $stmt = $con->prepare("SELECT DISTINCT COUNT(id_serv) FROM ordem_serv 
  WHERE id_serv = 4 AND id_status BETWEEN 1 AND 5 AND YEAR(`data_os`)= '$ano_2024'");
  $stmt->execute();
  $stmt->store_result();
  $num_of_rows = $stmt->num_rows;
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($tipo_servico);
    $stmt->fetch();
  }
    $data[3] = array( 'Fogão', $tipo_servico );  
}
for ($i = 1; $i <= 1; $i++) {
  $stmt = $con->prepare("SELECT DISTINCT COUNT(id_serv) FROM ordem_serv 
  WHERE id_serv = 5 AND id_status BETWEEN 1 AND 5 AND YEAR(`data_os`)= '$ano_2024'");
  $stmt->execute();
  $stmt->store_result();
  $num_of_rows = $stmt->num_rows;
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($tipo_servico);
    $stmt->fetch();
  }
    $data[4] = array( 'Calefator', $tipo_servico );  
}
for ($i = 1; $i <= 1; $i++) {
  $stmt = $con->prepare("SELECT DISTINCT COUNT(id_serv) FROM ordem_serv 
  WHERE id_serv = 6 AND id_status BETWEEN 1 AND 5 AND YEAR(`data_os`)= '$ano_2024'");
  $stmt->execute();
  $stmt->store_result();
  $num_of_rows = $stmt->num_rows;
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($tipo_servico);
    $stmt->fetch();
  }
    $data[5] = array( 'Vazamento', $tipo_servico );  
}
for ($i = 1; $i <= 1; $i++) {
  $stmt = $con->prepare("SELECT DISTINCT COUNT(id_serv) FROM ordem_serv 
  WHERE id_serv = 8 AND id_status BETWEEN 1 AND 5 AND YEAR(`data_os`)= '$ano_2024'");
  $stmt->execute();
  $stmt->store_result();
  $num_of_rows = $stmt->num_rows;
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($tipo_servico);
    $stmt->fetch();
  }
    $data[6] = array( 'Limpeza Fogão', $tipo_servico );  
}
for ($i = 1; $i <= 1; $i++) {
  $stmt = $con->prepare("SELECT DISTINCT COUNT(id_serv) FROM ordem_serv 
  WHERE id_serv = 10 AND id_status BETWEEN 1 AND 5 AND YEAR(`data_os`)= '$ano_2024'");
  $stmt->execute();
  $stmt->store_result();
  $num_of_rows = $stmt->num_rows;
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($tipo_servico);
    $stmt->fetch();
  }
    $data[7] = array( 'Limpeza Calha', $tipo_servico );  
}
for ($i = 1; $i <= 1; $i++) {
  $stmt = $con->prepare("SELECT DISTINCT COUNT(id_serv) FROM ordem_serv 
  WHERE id_serv = 9 AND id_status BETWEEN 1 AND 5 AND YEAR(`data_os`)= '$ano_2024'");
  $stmt->execute();
  $stmt->store_result();
  $num_of_rows = $stmt->num_rows;
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($tipo_servico);
    $stmt->fetch();
  }
    $data[8] = array( 'Diversos', $tipo_servico );  
}
for ($i = 1; $i <= 1; $i++) {
  $stmt = $con->prepare("SELECT DISTINCT COUNT(id_serv) FROM ordem_serv 
  WHERE id_serv = 11 AND id_status BETWEEN 1 AND 5 AND YEAR(`data_os`)= '$ano_2024'");
  $stmt->execute();
  $stmt->store_result();
  $num_of_rows = $stmt->num_rows;
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($tipo_servico);
    $stmt->fetch();
  }
    $data[9] = array( 'Coifa e Canhão', $tipo_servico );  
}


$plot = new PHPlot(600,400);
$plot->SetImageBorderType('plain');

$plot->SetPlotType('pie');
$plot->SetDataType('text-data-single');
$plot->SetDataValues($data);

# Set enough different colors;
$plot->SetDataColors(array('red', 'green', 'blue', 'yellow', 'cyan',
                        'magenta', 'brown', 'lavender', 'pink',
                        'gray', 'orange'));

# Main plot title:
$plot->SetTitle("Trabalhos Executados 2024");

# Build a legend from our data array.
# Each call to SetLegend makes one line as "label: value".
foreach ($data as $row)
  $plot->SetLegend(implode(': ', $row));
# Place the legend in the upper left corner:
$plot->SetLegendPixels(5, 5);

$plot->DrawGraph();