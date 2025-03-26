<?php
session_start();
require('db.php');
require ('funcoes.php');

if(isset($_POST['id_os'])){
    $id_os = $_POST['id_os'];
    $obs_cobranca = $_POST['obs_cobranca'];

    $stmt = $con->prepare("UPDATE ordem_serv SET obs_cobranca = '$obs_cobranca' WHERE id_os='$id_os'");
    $stmt->execute();

        header('location: dados_os.php?id_os='.$id_os.'');


}
?>