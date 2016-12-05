//Inicializa o index carregando a barra de navegaçao apropriada
jQuery.ajaxSetup(
	{
		cache: true
	});
$.get("/Comuns/TestAut.php",
		function(data)
		{
			if(data.autenticado)
				$("#Login_bar").load("Login_autenticado.html");
			else
				$("#Login_bar").load("Login.html");
		},
		"json");
$('.local').mask('U0UL0');
$('.empenho').mask('000/ 000000');
$('.identificador').mask('UU 000');
$('.nota_fisc').mask('000 de 00/00/00');
$('.bi').mask('9999');
$('.data').mask('00/00/0000');
