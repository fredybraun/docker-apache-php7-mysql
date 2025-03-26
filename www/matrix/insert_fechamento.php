<?php
session_start();
require('db.php');
require ('funcoes.php');
$date = date("M d, Y G:i");
$date_db = date('Y-m-d');
if(isset($_POST['contador2'])){
    $contador2 = $_POST['contador2'];
    $os = array();
    for($i=1; $i <= $contador2; $i++){
        if(isset($_POST['os_'.$i])){
            $os[$i] = $_POST['os_'.$i];
        }    
    }
    if(isset($_POST['cond_pgt'])){$condicao_pagamento = $_POST['cond_pgt'];}
    if(isset($_POST['nf'])){$nf = $_POST['nf'];}
    if(isset($_POST['ordem'])){$ordem = $_POST['ordem'];}
}
        
foreach ($os as $key=>$num_os){

    echo "OS: ".$num_os."<br>";
    echo "cond: ".$condicao_pagamento."<br>";
    echo "nf: ".$nf."<br>";
    echo "ordem: ".$ordem."<br><br>";
    echo "data:" . $date;

    $stmt = $con->prepare("UPDATE ordem_serv SET id_status='5', condicao_pagamento = '$condicao_pagamento', nf= '$nf', oc= '$ordem', data_os_fechamento ='$date', data_fechamento = '$date_db'  WHERE id_os='$num_os'");
    $stmt->execute();
}
    header('location: ./create_cli.php');
       
?> 