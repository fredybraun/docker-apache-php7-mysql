

function fill(Value) {
   $('#busca').val(Value);
   $('#resultado_busca').hide();
}


$(document).ready(function() {
   $("#busca").keyup(function() {
       var name = $('#busca').val();
       if (name == "") {
           $("#resultado_busca").html("");
       }
       else {
           $.ajax({
               type: "POST",
               url: "sys/sys.php",
               data: {
                   search: name
               },
               success: function(html) {
                   $("#resultado_busca").html(html).show();
               }
           });
       }
   });

    $("body").on("click", "#resultado_busca a", function(){
        var dadosProduto = $(this).attr('id');

        $.ajax({
                method: 'post',
                url: 'sys/sys.php',
                data: {add_produto: 'sim', produto: dadosProduto},
                success: function(retorno){
                    $("#content_retorno").html(retorno);
                }
            });
            

    });


    $('body').on('click','.close-div', function(){
                var dadosProdutoRemover = $(this).attr('id');


        $.ajax({
                method: 'post',
                url: 'sys/sys.php',
                data: {remover_produto: 'sim', produtoRemover: dadosProdutoRemover},
                success: function(retorno){
                    $("#content_retorno").html(retorno);
                }
            });        

    });





});
        







