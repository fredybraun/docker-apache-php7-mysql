
<?php
$datetime1 = date_create('2020-03-23');
$datetime2 = date_create(date('Y-m-d'));
$interval = date_diff($datetime1, $datetime2);
echo $interval->format('%a ');

if ($interval->format('%a ') < 15){
	echo 'verde';
}
if (($interval->format('%a ') >= 15) && ($interval->format('%a ') < 30)){
	echo 'amarelo';
}
if ($interval->format('%a ') >= 30){
	echo 'vermelho';
}

?>
<br>
<?php

$origDate = "2019-01-15";
 
$newDate = date("d/m/Y", strtotime($origDate));
echo $newDate;

function trocadatabarra($get_data_banco){
	$data_barra = date("d/m/Y", strtotime($get_data_banco));
	echo 'nova data com a função'.$data_barra;
}

function trocadatatraco($get_data_form){
	$var = '20/04/2012';
	$date = str_replace('/', '-', $get_data_form);
	$data_traco =  date('Y-m-d', strtotime($date));
	echo '<br>nova data com a função para o banco'.$data_traco;
}

trocadatabarra('2019-01-16');
trocadatatraco('25/02/2020');
?>

