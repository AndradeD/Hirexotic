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
$('.data').mask('00/00/0000');
$('.cpf').mask('000.000.000-00', {reverse: true});
$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
$('.telefone').mask('0000-00009');

$(document).ready(function(){
    $.get("/Index/PHP/ListarAutomoveis.php",
  		function(dado)
      {
        var imagens_carros = "";
        for (var i = 0; i < dado.dado.length;i++){
            imagens_carros += "<img class='img-thumbnail carro' src='" + dado.dado[i].urlimagem +"' id=" + dado.dado[i].id+" width='320' height='236');'</img>";
          }
        $("#Workbench").append(imagens_carros);
      },
      'json');
  });
