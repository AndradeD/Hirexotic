//Função 'getCampos' definida em 'Historico.js'
$(document).ready(function()
{
	$("select.Filtro_hist").change(function()
	{
		getCampos($('.tab-pane.fade.active').find("select.Filtro_hist"));
	});
});
