<?php
    session_start();
   require ('./topo2.php');
   require ('./funcoes.php');

    //valida usuário esta logado, caso não, redireciona para loguin.
    require('./db.php');
    if(!isset($_SESSION["name"])){
        
    exit(); }

   $_SESSION['active'] = 'os';
   require('menu2.php');

   if (isset($_GET['relacao'])) {
        $id = $_GET['relacao'];
        $stmt = $con->prepare("SELECT id_os, id_cli FROM ordem_serv WHERE id_os='$id'");
        $stmt->execute();
        $stmt->store_result();
        $num_of_rows = $stmt->num_rows;
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id_os, $id_cli_os);
            $stmt->fetch();

        }    
    }
?>
    <body>
        <script type="text/javascript">
            function removeritem(){
                alert("Você esta prestes a remover um item da relação");
            }
        </script>
        <div class="container-fluid mt-2 col-md-12">
            <h3>Relação da OS <?php echo $id_os;?></h3>    
            <label>
                <span>Buscar Produto</span>
                <input type="search" class="form-control" name="busca" id="busca" />
            </label>
            
        
            <div id="resultado_busca">
            </div>
                <div class="container-fluid">
                    <div class="row bg-secondary text-white w-100">
                        <div class="col-5">Produto </div>
                        <div class="col-2">Valor Unit.</div>
                        <div class="col-2">Quantidade</div>
                        <div class="col-2">Fator</div>
                    </div>
                    <div class="form-group">
                        <form action="relacao_os.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_os" value="<?php echo $id_os;?>">
                            <input type="hidden" name="id_cli_os" value="<?php echo $id_cli_os;?>">
                            <div id="content_retorno">
                            
                                

                            




                            </div>
                         <button class="mt-2 btn btn-primary">Prosseguir</button>     
                        </form>

                    </div>
                </div>     
            </div>  
        </div>
        <br><br><br>
        <div class="container-fluid mt-2 col-md-12">
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Quantidade</th>
                  <th scope="col">Descrição</th>
                  <th scope="col">Valor Unitário</th>
                  <th scope="col">Valor Total</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  
                  

          
<?php
if (isset($_GET['relacao'])) {
    $id_os = $_GET['relacao'];
    $valor_total_rel_somado = 0;
    if ($stmt_d = $con->prepare("SELECT id_rel_itens FROM relacao WHERE id_os = '$id_os'")) {
        $stmt_d->execute();
        $stmt_d->store_result();
        $num_of_rows = $stmt_d->num_rows;
        
        if ($stmt_d->num_rows > 0) {
        $stmt_d->bind_result($id_rel_itens);
            while ($stmt_d->fetch()) {
                $stmt_e = $con->prepare("SELECT id_prod, quant_prod, valor_unit_prod, base_calculo_os, valor_total_prod  FROM relacao_itens WHERE id_rel_itens = '$id_rel_itens'");
                $stmt_e->execute();
                $stmt_e->store_result();
                $num_of_rows = $stmt_e->num_rows;
                
                if ($stmt_e->num_rows > 0) {
                $stmt_e->bind_result($id_prod, $quant_prod, $valor_unit_prod, $base_calculo_os, $valor_total_prod);
                    while ($stmt_e->fetch()) {
                        $stmt_f = $con->prepare("SELECT nome_prod FROM produtos WHERE id_prod = '$id_prod'");
                        $stmt_f->execute();
                        $stmt_f->store_result();
                        $num_of_rows = $stmt_f->num_rows;

                        if ($stmt_f->num_rows > 0) {
                        $stmt_f->bind_result($nome_prod);
                        $stmt_f->fetch();
                        echo '<tr>
                                <th scope="row">'.$quant_prod.'</th>
                                <td >'.$nome_prod.'</td>
                                <td >'.moeda_formato($valor_unit_prod).'</td>
                                <td >'.moeda_formato($valor_total_prod).'</td>
                                <td ><a onclick="removeritem()" href="update_relacao.php?id_os='.$id_os.'&id_prod='.$id_prod.'" ><span class="badge badge-danger">Remover</span></a></td>
                            </tr>';
                        $valor_total_rel_somado = $valor_total_rel_somado + $valor_total_prod;  
                        }
                    }
                }
            }
        }
    }           
}
?>   
            </tr>
              </tbody>
              <thead>
                <tr>
                  <th scope="col" class="table-primary">Valor Total da OS</th>
                  <th class="table-primary"><?php echo "R$" . moeda_formato($valor_total_rel_somado);?></th>
                  <th class="table-primary"></th>
                  <th class="table-primary"></th>
                  <th class="table-primary"></th>
                </tr>
              </thead>  
            </table>
        </div>  

    </body>
</html>
<?php
    unset($_SESSION['contador']);
?>