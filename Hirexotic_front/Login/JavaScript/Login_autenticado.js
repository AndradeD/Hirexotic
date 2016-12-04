//Chamado por 'login_autenticado.html'
$(document).ready(function()
{
	//confirma se o usuário está autenticado no servidor
	$.get("/Comuns/TestAut.php",
			function(data)
			{
				if(!data.autenticado)
					window.location.href="index.html";
				else{
					if (data.tipoUsuario == 0) {
							$("#nome_user").html("Bem vindo cliente " + data.nome+"<span class='caret'></span>");//Nome do usuário no canto
						}else if (data.tipoUsuario == 1){
								$("#nome_user").html("Bem vindo fornecedor " + data.nome+"<span class='caret'></span>");//Nome do usuário no canto
							}
							else {
									$("#nome_user").html("Bem vindo funcionário " + data.nome+"<span class='caret'></span>");//Nome do usuário no canto
								}
					}
			},
			"json");
});