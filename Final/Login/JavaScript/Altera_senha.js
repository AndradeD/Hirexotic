//Altera senha do usuário
$(document).ready(function()
{
  $("form").on("submit", function (e)
  {
    e.preventDefault();
  		$.post("/Login/PHP/AlteraSenha.php",
     		{
     			senha_antiga: $("#Senha_antiga").val(),
     			nova_senha: $("#Nova_senha").val(),
     			nova_senha2: $("#Nova_senha2").val()
     		},
     		function(data)
     		{
     			alert(data.mensagem);
     			if(data.sucesso)
     				$("#Login_bar").load("Login_autenticado.html");
     			else if(data.mensagem=="Usuário não logado")
     				$("#Login_bar").load("Login.html");
     		},
     		"json");
    });
});
