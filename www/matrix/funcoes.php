<?php
function trocadatabarra($get_data_banco){
	if($get_data_banco){
		$data_barra = date("d/m/Y", strtotime($get_data_banco));
	}
	else {
		$data_barra = NULL;
	}
	return $data_barra;
}

function trocadatatraco($get_data_form){
	$var = '20/04/2012';
	$date = str_replace('/', '-', $get_data_form);
	$data_traco =  date('Y-m-d', strtotime($date));
	return $data_traco;
}


//função para alterar o formato da moeda antes de gravar no banco
function moeda($get_valor) {

        $source = array('.', ',');
        $replace = array('', '.');
        $valor_ponto = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
        return $valor_ponto; //retorna o valor formatado para gravar no banco
    }
function moeda_formato($get_valor) {

        $valor_certo = number_format($get_valor,2,",",".");
        return $valor_certo; //retorna o valor formatado para gravar no banco
    }
   

function getStartAndEndDate($year, $week)
{
   return [
      (new DateTime())->setISODate($year, $week)->format('d-m-Y'), //start date
      (new DateTime())->setISODate($year, $week, 7)->format('d-m-Y') //end date
   ];
}


function getWeekNumber($date_value)
{
	$ddate = $date_value;
	$date = new DateTime($ddate);
	$week = $date->format("W");
	return $week;
}

?>