//Testa se o usuário está autenticado
//Usar em paginas html 'restritas'
$.get("/Comuns/TestAut.php",
	function(data)
	{
		if(!data.autenticado)
			window.location.href="index.html";
	},
	"json");
