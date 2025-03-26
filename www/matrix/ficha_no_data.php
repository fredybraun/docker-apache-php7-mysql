<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sistema Funipel</title>
	<link href="style2.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		@media print 
		{
		    @page {

		      size: A4 landscape; /* DIN A4 standard, Europe */
		      margin:0;
		    }
		    html, body {
		        width: 296mm;
		        /* height: 297mm; */
		        height: 200mm;
		        font-size: 11px;
		        font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
		        overflow:visible;
		    }
		    body {
		        padding-top:5mm;
		        padding-left: 5mm;
		    }
		}
	</style>
</head>
<body>
<div class="ficha">
	<table style="" border="1">
		<tbody>
			<tr style="height: 50px;">
				<td style="height: 50px;">
				<div style="padding-left: 9px; padding-right: 8px;">
					<img src="img/logo.png" width="160px" height="130px" onclick="window.print();">
				</div>
				</td>
				<td style="height: 50px; width:340px;">
					<div class="ficha_conteudo">
						Cliente:<br>
						____________________________________<br><br>
						
						Telefone:<br>
						____________________________________<br><br>

					</div>
			    </td>
			    <td style="height: 50px; width:340px" >
			    	<div class="ficha_conteudo">
						Endereço:<br>
						____________________________________<br><br>
						____________________________________<br><br>
						

					</div>
			    </td>
				<td style="height: 50px; width:130px">
					<div class="ficha_conteudo">
						<a style="font-weight: bold;">OS N°: </a><br><br>
						Data:____/____/________<br><br>
						Técnico:_______________<br>
						<br>	
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<table>
		<tbody>
			<tr>
				<td><div class="text-bold">Calhas</div></td>
				<td style="padding-top: 5px; padding-bottom: 5px">
					
					<input type="checkbox" name="">Corte 30<br>
					<input type="checkbox" name="">Corte 40<br>
				</td>
			</tr>
			<tr>
			<td><div class="text-bold">Canos</div></td>
				<td style="padding-top: 5px; padding-bottom: 5px">
				
					<input type="checkbox" name="">Retangular<br>
					<input type="checkbox" name="">Redondo<br>
				</td>
			</tr>
			<tr>
			<td><div class="text-bold">Cortes<br>Canos</div></td>		
				<td style="padding-top: 5px; padding-bottom: 5px">
					
					LG:___________<br>
					LP:___________<br>
				</td>
			</tr>
			<tr>
			<td><div class="text-bold">Beiral</div></td>		
				<td style="padding-top: 5px; padding-bottom: 5px">
				
					<input type="checkbox" name="">Madeira<br>
					<input type="checkbox" name="">Concreto<br>
				</td>
			</tr>
			<tr>
				<td><div class="text-bold">Pintura</div></td>
				<td style="padding-top: 5px; padding-bottom: 5px">
					
					<input type="checkbox" name="">S/ Pintura<br>
					<input type="checkbox" name="">Cinza<br>
					<input type="checkbox" name="">Preto <input type="checkbox" name="">600°<br>
					<input type="checkbox" name="">Branco<br>
					<input type="checkbox" name="">Tabaco<br>
					<input type="checkbox" name="">Marrom<br>
					<input type="checkbox" name="">Telha<br>
					<input type="checkbox" name="">Tinta Cliente<br>
					Cod.: __________
				</td>
			</tr>
			<tr>
			<td><div class="text-bold">Material</div></td>
				<td style="padding-top: 5px; padding-bottom: 5px">
					
					<input type="checkbox" name="">Aluzinco<br>
					<input type="checkbox" name="">Inox 304<br>
					<input type="checkbox" name="">Chapa Preta<br>
					<input type="checkbox" name="">Alumínio<br>
					<input type="checkbox" name="">Xadrez<br>
				</td>
			</tr>
		</tbody>
	</table>
	<table>
	<tbody>
			<td style="height: 50px; width: 180px;" >
				<div class="ficha_conteudo">
					<div class="text-bold" style="float: left; margin-left: -10px; margin-top:-20px;">Montagem:</div>
				</div>	
			</td>
			<td style="height: 40px; width:450px" >
				<div class="ficha_conteudo">
					<div class="text-bold" style="float: left; margin-left: -10px; margin-top:-20px;">Horas:</div>
				</div>	
			</td>
			<td style="height: 40px; width:450px" >
				<div class="ficha_conteudo">
					<div class="text-bold" style="float: left; margin-left: -10px; margin-top:-20px;">PU:</div>
				</div>
			</td>
		</tbody>
	</table>	
	</div>		
</body>
</html>
