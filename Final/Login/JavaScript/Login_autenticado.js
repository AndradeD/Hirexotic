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
					if (data.tipo == 0) {
							$("#nome_user").html(data.nome+"<span class='caret'></span>");//Nome do usuário no canto
						}else if (data.tipo == 1){
								$("#nome_user").html(data.nome+"<span class='caret'></span>");//Nome do usuário no canto
								$("#navbar").load('Nav_fornecedor.html');
							}
							else {
									$("#nome_user").html(data.nome+"<span class='caret'></span>");//Nome do usuário no canto
									$("#navbar").load('Nav_funcionario.html');
								}
					}
			},
			"json");
});