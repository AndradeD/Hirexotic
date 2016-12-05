$(document).ready(function(){

  $.get("/Index/PHP/ListarAutomoveis.php",
	  {
	  },
		function(dado)
    {
      var imagens_carros = "";
      for (var i = 0; i < dado.dado.length;i++){
          imagens_carros += "<img class='img-thumbnail' src='" + dado.dado[i].urlimagem +"' id=" + dado.dado[i].id+" width='320' height='236' onclick='$.load(\"/Modal_automovel/Javascript/Modal.js\");'</img>";
        }
      $("#Workbench").append(imagens_carros);
    },
    'json');
});
onclick='$.load("/Modal_automovel/Javascript/Modal.js")'
