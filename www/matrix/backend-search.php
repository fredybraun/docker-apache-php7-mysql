<?php
/*BUSCA CLIENTE*/
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("172.18.0.2", "root", "password", "id12999633_apoc", "3306");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM clientes WHERE nome_cli LIKE ? OR tel_cli LIKE ? OR tel2_cli LIKE ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sss", $param_term, $param_term, $param_term);
        
        // Set parameters
        $param_term = '%'.$_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $cid_cli = $row['cid_cli'];
                    
                    if( $row["cid_cli"] != null) {
                        if ($stmt2 = $link->prepare("SELECT nome_cidade FROM cidade WHERE id_cidade = '$cid_cli'")) {
                            $stmt2->execute();
                            $stmt2->store_result();
                            $num_of_rows = $stmt2->num_rows;
                            if ($stmt2->num_rows > 0) {
                            $stmt2->bind_result($nome_cidade);
                                $stmt2->fetch();
                            }
                            $stmt2->close();
                        } 
                    }

                    
                    echo '<div style="border-radius: 5px; border-style: solid; border-width: 1px; border-color: #ccc; width: 30rem; margin-top: 10px;">';
                    echo '<div style="padding: 10px 10px 0 10px; font-size: 18px"><a href="dados_cliente.php?id_cliente='.$row["id_cli"].'">'.  $row["nome_cli"] . '</a></div>';
                    echo '<div style="padding-left: 10px; padding-top: 0px;">' . $row["end_cli"] .', '. $row["num_cli"] . ' - '. $row["bairro_cli"] . ' - '. $nome_cidade .'</div>';
                    echo '<div style="padding-left: 10px; padding-top: 0px;">'. $row["tel_cli"] . ' / ' . $row["tel2_cli"] . '</div>';
                    echo '<div style="padding-left: 10px; padding-top: 0px; padding-bottom: 10px;"><a class="badge badge-primary" href="insert_cli.php?editar='.$row["id_cli"].'">Editar</a></div>';
                    echo '</div>';
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($link);
?>