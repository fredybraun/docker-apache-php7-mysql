<?php
	session_start();
	require('db.php');



	//if ($stmt = $con->prepare('SELECT id_os FROM ordem_serv')) {
                            $stmt->execute();
                            $stmt->store_result();
                            $num_of_rows = $stmt->num_rows;
                            if ($stmt->num_rows > 0) {
                            $stmt->bind_result($id_os);
                                while ($stmt->fetch()) {
                                    $stmt2 = $con->prepare("UPDATE ordem_serv SET data_os_cobranca = (SELECT STR_TO_DATE(data_os_cobranca, '%d/%m/%Y') WHERE id_os = '$id_os') WHERE id_os = '$id_os' ");
                                    $stmt2->execute();
                                    echo "update feito...pode ser que deu merda!!!";

                                }
                            }
                            $stmt->free_result();
                        }
//UPDATE ordem_serv SET data_os = (SELECT STR_TO_DATE(data_os, '%d/%m/%Y') WHERE id_os = 20) WHERE id_os = 20 
?>	



