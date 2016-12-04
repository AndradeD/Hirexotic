//Abre nova janela com os resultados da busca
$(document).ready(function(){
    $("#BotaoConsultar").click(function(){
      var win=window.open('Resultado.html');
    	$.post("/Consultar/PHP/Consultar.php",
    		{
          Material: $("#Material").val(),
          Modelo: $("#Modelo").val(),
          Projeto: $("#Projeto").val()
    		},
    		function(data)
    			{
            $(win).load(function () {
              $.each(data, function(i,v)
                {
                var line='<tr><td>'+(v.Tipo===null?'':v.Tipo)+'</td>'+
                            '<td>'+(v.Marca===null?'':v.Marca)+'</td>'+
                            '<td>'+(v.SN===null?'':v.SN)+'</td>'+
                            '<td>'+(v.Danfe===null?'':v.Danfe)+'</td>'+
                            '<td>'+(v.Local===null?'':v.Local)+'</td>'+
                            '<td>'+(v.Empenho===null?'':v.Empenho)+'</td>'+
                            '<td>'+(v.Trem===null?'':v.Trem)+'</td>'+
                            '<td>'+(v.Projeto===null?'':v.Projeto)+'</td>'+
                            '<td>'+(v.Id===null?'':v.Id)+'</td></tr>';
                $(win.resultado).append(line);
                $(win.Material).val($('#Material').val());
                $(win.Modelo).val($('#Modelo').val());
                $(win.Projeto).val($('#Projeto').val());
                });
              });
          },'json');
    });
});
