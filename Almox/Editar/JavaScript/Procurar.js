$(document).ready(function(){
  $("form").on("submit", function (e) {
    e.preventDefault(); //Não muda de pagina
      //Envia todos os campos de busca
      obj={};
    	$.each($(".Campo"), function(k,v)
    	{
    		obj[$(this).attr('id')]=$(this).val()
    	});
      $.post("/Editar/PHP/Procurar.php",
    		obj,
        //Popula a tabela com Tipo|Modelo|Numero de série + Primary key no BD(como id da linha)
    		function(data){
          $('#resposta').empty();
          data=$.parseJSON(data);
          $.each(data.dado, function(i,v)
          {
            $('#resposta').append('<tr id='+v.valor+' class=linha>'+
                                  '<td>'+v.opcao.tipo+'</td>'+
                                  '<td>'+v.opcao.modelo+'</td>'+
                                  '<td>'+v.opcao.sn+'</td></tr>')
          });
        });
        $("#ResultadoBusca").attr("hidden",false);
    });
});
