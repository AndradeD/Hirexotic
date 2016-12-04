$(document).ready(function(){

  $.get("/Index/PHP/Index.php",
	  {
	  },
		function(dado)
    {
      var imagens_carros = "";
      for (var i = 0; i < dado.length;i++){
          imagens_carros += "<img class='img-thumbnail' src='"+dado.urlImagem+"' id="+dado.Id+"></img>"
      }

      $("#Workbench").append(imagens_carros);
    },
    'json');

});
