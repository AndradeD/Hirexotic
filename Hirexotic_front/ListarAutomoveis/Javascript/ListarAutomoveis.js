
$(document).ready(function(){
      var win=window.open('Resultado.html');
    	$.post("/ListarAutomoveis/PHP/ListarAutomoveis.php",
    		{
          Modelo: $("#Modelo").val()
    		},
    		function(data)
    			{
            $(win).load(function () {
              $.each(data, function(v)
                {
                var line='<tr><td data-id="' + v.IdAutomovel + '">'+(v.Placa===null?'':v.Placa)+'</td>'+
                            '<td>'+(v.AnoFab===null?'':v.AnoFab)+'</td>'+
                            '<td>'+(v.Cor===null?'':v.Cor)+'</td>'+
                            '<td>'+(v.Combust===null?'':v.Combust)+'</td>'+
                            '<td>'+(v.PrecoMin===null?'':v.PrecoMin)+'</td>'+
                            '<td>'+(v.Modelo===null?'':v.Modelo)+'</td>'+
                            '<td>'+(v.URLImagem===null?'':v.URLImagem)+'</td>'+
                $(win.resultado).append(line);
                });
              });
          },'json');
});
