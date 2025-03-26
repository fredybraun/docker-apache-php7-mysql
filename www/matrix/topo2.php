<html>
	<head>
		<meta charset="utf-8">
		<title>Sistema Funipel</title>
		<link href="style_andaime.css" rel="stylesheet" type="text/css">
		<link href="style3.css" rel="stylesheet" type="text/css">
		
		<style>
			
			 .dropdown-submenu {
            position: relative;
        }

            .dropdown-submenu > .dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -6px;
                margin-left: -1px;
                -webkit-border-radius: 0 6px 6px 6px;
                -moz-border-radius: 0 6px 6px 6px;
                border-radius: 0 6px 6px 6px;
            }

            .dropdown-submenu:hover > .dropdown-menu {
                display: block;
            }

            .dropdown-submenu > a:after {
                display: block;
                content: " ";
                float: right;
                width: 0;
                height: 0;
                border-color: transparent;
                border-style: solid;
                border-width: 5px 0 5px 5px;
                border-left-color: #cccccc;
                margin-top: 5px;
                margin-right: -10px;
            }

            .dropdown-submenu:hover > a:after {
                border-left-color: #ffffff;
            }

            .dropdown-submenu.pull-left {
                float: none;
            }

                .dropdown-submenu.pull-left > .dropdown-menu {
                    left: -100%;
                    margin-left: 10px;
                    -webkit-border-radius: 6px 0 6px 6px;
                    -moz-border-radius: 6px 0 6px 6px;
                    border-radius: 6px 0 6px 6px;
                }
		</style>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		
		
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	  	<link rel="icon" href="img/reunion.png">
	    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
	  	<script type="text/javascript" src="js/functions.js"></script>
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

			$( "#data_despesa" ).datepicker({
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
	    	$('.search-box input[type="text"]').on("keyup input", async function(){
		        /* Get input value on change */
		        var inputVal = $(this).val();
		        var resultDropdown = $(this).siblings(".result");
		        if(inputVal.length){
		            await $.get("backend-search.php", {term: inputVal}).done(function(data){
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
	    	$('.search-box2 input[type="text"]').on("keyup input", async function(){
		        /* Get input value on change */
		        var inputVal = $(this).val();
		        var resultDropdown = $(this).siblings(".result2");
		        if(inputVal.length){
		            await $.get("backend-search2.php", {term: inputVal}).done(function(data){
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

	  		//SEARCHBOX PRODUTOS DA RELACAO
	  		$('.search-prod input[type="text"]').on("keyup input", async function(){
		        /* Get input value on change */
		        var inputVal = $(this).val();
		        var resultDropdown = $(this).siblings(".result-prod");
		        if(inputVal.length){
		            await $.get("backend-prod.php", {term: inputVal}).done(function(data){
		                // Display the returned data in browser
		                resultDropdown.html(data);
		            });
		        } else{
		            resultDropdown.empty();
		        }
		    });
		    
		    // OS Set search input value on click of result item
		    $(document).on("click", ".result-prod p", function(){
		        $(this).parents(".search-prod").find('input[type="text"]').val($(this).text());
		        $(this).parent(".result-prod").empty();
		    });
	    	
	    });// <<<<---- FIM


	  	</script>

	</head>
	<body>




