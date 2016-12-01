//JavaScript para fazer o povoamento das select-tags de filtro
function getCampos(index)
{
//Envia valor dos campos anteriores + campo a ser atualizado
	obj={};
	obj['Id']=$(".campoBusca").eq(index+1).attr('id');
	for(i=0; i<=index;i++)
		obj[$(".campoBusca").eq(i).attr('id')]=$(".campoBusca").eq(i).val();
	$.post("/Consultar/PHP/Populate.php",
	obj,
	function(data)
		{
			//'Reseta' campos posteriores
			$(".campoBusca:gt("+index+")").html($('<option>').text('Todos').attr('value', ''));
			$.each(data.Opcoes, function(k,v)
			{
				$("#"+k).empty();
				$.each(v, function(k2,v2){
					$("#"+k).append($('<option>').text(k2).attr('value', v2));
				});
				//Coloca a opção 'Todos' no topo e como selecionada
				$("#"+k+"> option[value='']").insertBefore($("#"+k+" :nth-child(1)"));
				$("#"+k+" > option[value='']").prop('selected',true);
			});
		},
	"JSON");
}

$(document).ready(function()
{
	//inicializa o 1 campo
	getCampos(-1);
	$(".campoBusca").change(function()
	{
		//nao ativa para o ultimo campo
		if($(".campoBusca").index(this) != $(".campoBusca").length)
			getCampos($(".campoBusca").index(this));
	});
});
