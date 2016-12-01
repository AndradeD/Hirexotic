//JavaScript para calcular quantitativo dos materiais
function showQuant(data)
{
	$("#Disponivel").empty();
	$("#Utilizado").empty();
	$("#Reservado").empty();
	$("#Local").empty();
	$.each(data, function(i,v)
  {
    $('#'+v.opcao).append(v.valor);
  });
}

$(document).ready(function()
{
	$(".campoBusca").change(function()
	{
		obj={};
		index=$(".campoBusca").index(this);
		for(var i=0;i<=index;i++)
			obj[$(".campoBusca").eq(i).prop('id')]=$(".campoBusca").eq(i).val();
		$.post("/Consultar/PHP/Quantitativo.php",
		obj,
		function(data)
			{
				showQuant(data);
			},
		"JSON");
	});
});
