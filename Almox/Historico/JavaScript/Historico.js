//Atualiza dinamicamente os select fields de 'Historico.html'
function getCampos(selector)
{
	obj={};
	$.each(selector, function(k,v)
	{
		obj[$(this).attr('id')]=$(this).val()
	});
	$.post("/Historico/PHP/Historico.php",
	obj,
	function(data)
		{
			$.each(data.Opcoes, function(k,v){
				$("#"+k).empty();
				$.each(v, function(k2,v2){
					$("#"+k).append($('<option>').text(k2).attr('value', v2));
				});
				//Coloca opção 'Todos' em primeiro e selecionada
				$("#"+k+"> option[value='']").insertBefore($("#"+k+" :nth-child(1)"));
				$("#"+k+" > option[value='']").prop('selected',true);
			});
		},
	"json");
}

//Reseta campos
$(document).ready(function()
{
	getCampos($("select.Filtro_hist"));
	$("#BotaoReset").click(function()
	{
		$(".Filtro_hist").empty();
		getCampos($("select.Filtro_hist"));
	});
});
