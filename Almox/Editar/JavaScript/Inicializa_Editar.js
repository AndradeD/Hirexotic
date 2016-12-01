//Atualiza dinamicamente os select fields de 'Editar.html'
function getCampos()
{
	obj={};
	$.each($("select.Campo"), function(k,v)
	{
		obj[$(this).attr('id')]=$(this).val()
	});
	$.post("/Editar/PHP/Inicializa_Editar.php",
	obj,
	function(data)
		{
			$.each(data.Opcoes, function(k,v){
				$("#"+k).empty();
				$.each(v, function(k2,v2){
					$("#"+k).append($('<option>').text(k2).attr('value', v2));
				});
			});
		},
	"json");
}

$(document).ready(getCampos);
//Botão para limpar a busca
$("#BotaoReset").click(function(){
	$(".Campo").empty();
	getCampos();
	$("#ResultadoBusca").attr('hidden',true);
	$("#editor").attr('hidden',true);
});
