
$(document).ready(function(){
      var win=window.open('Resultado.html');
    	$.post("/ListarModelos/PHP/ListarModelos.php",
    		{
    		},
    		function(data)
    			{
            $(win).load(function () {
              $.each(data, function(modelo)
                {
                var line='<tr><td>'+(modelo.Nome===null?'':modelo.Nome)+'</td>'+
                            '<td>'+(modelo.Marca===null?'':modelo.Marca)+'</td>'+
                            '<td>'+(modelo.Ano===null?'':modelo.Ano)+'</td>'+
                            '<td>'+(modelo.NumPassageiros===null?'':modelo.NumPassageiros)+'</td>'+
                            '<td>'+(modelo.Velocidade===null?'':modelo.Velocidade)+'</td>'+
                            '<td>'+(modelo.Cilindradas===null?'':modelo.Cilindradas)+'</td>'+
                            '<td>'+(modelo.NumPortas===null?'':modelo.NumPortas+'</td>'+
                $(win.resultado).append(line);
                });
              });
          },'json');
});
