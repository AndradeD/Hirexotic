//Busca transferencias que satisfazem os filtros selecionados
$(document).ready(function(){
    $("#BotaoBusca").click(function(){
      obj={};
      $.each($('.tab-pane.fade.active').find('.Filtro_hist'),
              function(key,value)
              {
                obj[$(this).attr('id')]=$(this).val();
              });
    	$.post("/Historico/PHP/Procurar.php",
    		obj,
    		function(data)
        {
          $('#resposta_transferencias').empty();
          $.each(data.dado, function(i,v)
          {
            $('#resposta_transferencias').append('<tr id='+v.valor+' class=linha>'+
                                                '<td>'+v.opcao.Data_transf+'</td>'+
                                                '<td>'+v.opcao.Destino+'</td>'+
                                                '<td>'+v.opcao.N_mat+'</td></tr>');
          });
        },'json');
    });
});
