//Faz logout do usuário
$("#logout").click(function(){
	$.get("/Login/PHP/Logout.php",
    	function(data)
    	{
    		alert(data.mensagem);
    		if(data.sucesso)
    			window.location.href="index.html";
    	},
    	"json"
    	);
});
