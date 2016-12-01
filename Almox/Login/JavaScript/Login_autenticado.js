//Chamado por 'login_autenticado.html'
$(document).ready(function()
{
	//confirma se o usuário está autenticado no servidor
	$.get("/Comuns/TestAut.php",
			function(data)
			{
				if(!data.autenticado)
					window.location.href="index.html";
				else
					$("#nome_user").html(data.nome+"<span class='caret'></span>");//Nome do usuário no canto
			},
			"json");
});