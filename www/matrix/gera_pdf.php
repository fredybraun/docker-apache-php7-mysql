<?php 
 include("mpdf/mpdf.php");



 $mpdf=new mPDF(); 
 $mpdf->SetDisplayMode('fullpage');
 //$css = file_get_contents("css/estilo.css");
 //$mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML('ficha.html');
 $mpdf->Output();

 exit;