<html>
	<head>
		<meta charset="utf-8">
		<title>Sistema Funipel</title>
		<link href="style_andaime.css" rel="stylesheet" type="text/css">
		<link href="style2.css" rel="stylesheet" type="text/css">
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">	
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  	<link rel="stylesheet" href="/resources/demos/style.css">
	  	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	  	<link rel="icon" href="img/reunion.png">
	    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
	  	<script>
	  		$( function() {
	    	$( "#os_data_inicio" ).datepicker({
			   buttonImageOnly: true,
			   dateFormat: 'dd/mm/yy',
			   dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
			   dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			   dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			   monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			   monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
			   nextText: 'Próximo',
			   prevText: 'Anterior',
	    	});

	    	$( "#os_agendamento" ).datepicker({
			   buttonImageOnly: true,
			   dateFormat: 'dd/mm/yy',
			   dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
			   dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			   dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			   monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			   monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
			   nextText: 'Próximo',
			   prevText: 'Anterior',
	    	});

	    	$( "#data_retirada" ).datepicker({
			   buttonImageOnly: true,
			   dateFormat: 'dd/mm/yy',
			   dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
			   dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			   dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			   monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			   monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
			   nextText: 'Próximo',
			   prevText: 'Anterior',
	    	});

	    	$( "#data_retorno" ).datepicker({
			   buttonImageOnly: true,
			   dateFormat: 'dd/mm/yy',
			   dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
			   dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			   dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			   monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			   monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
			   nextText: 'Próximo',
			   prevText: 'Anterior',
	    	});

	    	//SEAECH DE CLIENTES
	    	$('.search-box input[type="text"]').on("keyup input", function(){
		        /* Get input value on change */
		        var inputVal = $(this).val();
		        var resultDropdown = $(this).siblings(".result");
		        if(inputVal.length){
		            $.get("backend-search.php", {term: inputVal}).done(function(data){
		                // Display the returned data in browser
		                resultDropdown.html(data);
		            });
		        } else{
		            resultDropdown.empty();
		        }
		    });
		    
		    // Set search input value on click of result item
		    $(document).on("click", ".result p", function(){
		        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
		        $(this).parent(".result").empty();
		    });
	    	
	    	//SEAECH OS
	    	$('.search-box2 input[type="text"]').on("keyup input", function(){
		        /* Get input value on change */
		        var inputVal = $(this).val();
		        var resultDropdown = $(this).siblings(".result2");
		        if(inputVal.length){
		            $.get("backend-search2.php", {term: inputVal}).done(function(data){
		                // Display the returned data in browser
		                resultDropdown.html(data);
		            });
		        } else{
		            resultDropdown.empty();
		        }
		    });
		    
		    // OS Set search input value on click of result item
		    $(document).on("click", ".result2 p", function(){
		        $(this).parents(".search-box2").find('input[type="text"]').val($(this).text());
		        $(this).parent(".result2").empty();
		    });


	  		//SEARCHBOX PRODUTOS DA RELAÇÂO
	  		$('.search-prod input[type="text"]').on("keyup input", function(){
		        /* Get input value on change */
		        var inputVal_prod = $(this).val();
		        var resultDropdown_prod = $(this).siblings(".result_prod");
		        if(inputVal_prod.length){
		            $.get("backend-prod.php", {term: inputVal_prod}).done(function(data1){
		                // Display the returned data in browser
		                resultDropdown_prod.html(data1);
		            });
		        } else{
		            resultDropdown_prod.empty();
		        }
		    });
		    
		    // Set search input value on click of result item
		    $(document).on("click", ".result_prod a", function(){
		        $(this).parents(".search-prod").find('input[type="text"]').val($(this).text());
		        $(this).parent(".result_prod").empty();
		        
		    });
	    	
	    });// <<<<---- FIM


	  	</script>

	</head>
	<body>




