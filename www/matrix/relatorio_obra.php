<?php
session_start();
require ('./topo2.php');
require ('./funcoes.php');
?>

<?php
//valida usuário esta logado, caso não, redireciona para loguin.
require('./db.php');
if(!isset($_SESSION["name"])){
	header("Location: login.php");
exit(); }

$_SESSION['active'] = 'cliente';



if (isset($_GET['id_cli'])) {
    $id_cli = (int)$_GET['id_cli']; // Cast to integer if expected
} 


if (isset($_GET['id_obra'])) {
    $id_obra = (int)$_GET['id_obra']; // Cast to integer if expected
   
}


if ($stmt2 = $con->prepare("SELECT nome_obra FROM obra_clientes WHERE id_obra = '$id_obra'")) {
    $stmt2->execute();
    $stmt2->store_result();
    $num_of_rows = $stmt2->num_rows;
    if ($stmt2->num_rows > 0) {
    $stmt2->bind_result($nome_obra);
    $stmt2->fetch();
    }
}


if ($stmt = $con->prepare("SELECT nome_cli FROM clientes WHERE id_cli='$id_cli'")) {
    $stmt->execute();
    $stmt->store_result();
    $num_of_rows = $stmt->num_rows;
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nome_cli);
        $stmt->fetch(); 
    }

} 

echo '<h5>Relatório de itens da obra <strong>'.(!empty($nome_obra) ? $nome_obra : 'sem obra'). '</strong> do cliente <strong>'.$nome_cli.'</strong></h5>';
echo '<table class="table table-sm table-hover">';
    echo '<thead><tr>';
    echo '<th scope="col">Nome do produto</th>';
    echo '<th scope="col">Quantidade</th>';
    echo '<th scope="col">Valor unitário</th>';
    echo '<th scope="col">Valor total</th>';
    echo '</tr></thead>';
    echo '<tbody>';

if ($id_obra == 'sem obra') {
    if ($stmt = $con->prepare("
SELECT 
  os.id_obra,
  ri.id_prod,
  p.nome_prod,
  SUM(ri.quant_prod) as quant_prod_total,
  AVG(ri.valor_unit_prod) as valor_unit_prod_media,
  SUM(ri.valor_total_prod) as valor_total_prod_soma
FROM relacao_itens ri
JOIN produtos p ON ri.id_prod = p.id_prod
JOIN ordem_serv os ON ri.id_os = os.id_os
WHERE os.id_cli = '$id_cli'
AND os.id_status IN (3, 4, 5)
GROUP BY os.id_obra, ri.id_prod, p.nome_prod
ORDER BY os.id_obra, ri.id_prod")) {
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
		    $stmt->bind_result($id_obra, $id_prod, $nome_prod, $quant_prod_total, $valor_unit_prod_media, $valor_total_prod_soma);
            $custo_total_obra = 0;
        while ($stmt->fetch()) {
            if($id_obra == null) {
                $custo_total_obra += $valor_total_prod_soma;
                echo '<tr>';
                echo '<td>'.$nome_prod.'</td>';
                echo '<td>'.$quant_prod_total.'</td>';
                echo '<td>R$ '.number_format($valor_unit_prod_media, 2, ',', '.').'</td>';
                echo '<td>R$ '.number_format($valor_total_prod_soma, 2, ',', '.').'</td>';
                echo '</tr>';
                }
        }   
        echo '<tr>';
        echo '<td colspan="3"><strong>Custo total da obra</strong></td>';
        echo '<td><strong>R$ '.number_format($custo_total_obra, 2, ',', '.').'</strong></td>';
        echo '</tr>';
		}
	}
}
else {
    if ($stmt = $con->prepare("
SELECT 
  os.id_obra,
  ri.id_prod,
  p.nome_prod,
  SUM(ri.quant_prod) as quant_prod_total,
  AVG(ri.valor_unit_prod) as valor_unit_prod_media,
  SUM(ri.valor_total_prod) as valor_total_prod_soma
FROM relacao_itens ri
JOIN produtos p ON ri.id_prod = p.id_prod
JOIN ordem_serv os ON ri.id_os = os.id_os
WHERE os.id_obra = '$id_obra'
  AND os.id_cli = '$id_cli'
  AND os.id_status IN (3, 4, 5)
GROUP BY os.id_obra, ri.id_prod, p.nome_prod
ORDER BY os.id_obra, ri.id_prod")) {
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($stmt->num_rows > 0) {
		    $stmt->bind_result($id_obra, $id_prod, $nome_prod, $quant_prod_total, $valor_unit_prod_media, $valor_total_prod_soma);
            $custo_total_obra = 0;
        while ($stmt->fetch()) {
            $custo_total_obra += $valor_total_prod_soma;
            echo '<tr>';
            echo '<td>'.$nome_prod.'</td>';
            echo '<td>'.$quant_prod_total.'</td>';
            echo '<td>R$ '.number_format($valor_unit_prod_media, 2, ',', '.').'</td>';
            echo '<td>R$ '.number_format($valor_total_prod_soma, 2, ',', '.').'</td>';
            echo '</tr>';
        }   
        echo '<tr>';
        echo '<td colspan="3"><strong>Custo total da obra</strong></td>';
        echo '<td><strong>R$ '.number_format($custo_total_obra, 2, ',', '.').'</strong></td>';
        echo '</tr>';
		}
	}
}


    
    
?>    