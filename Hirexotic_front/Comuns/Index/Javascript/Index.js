$(document).ready(function(){

  $.get("/Index/PHP/Index.php",
	  {
	  },
		function(dado)
    {
      var imagens_carros = "";
      for (var i = 0; i < dado.automovel.length;i++){
          imagens_carros += "<img class='img-thumbnail' src='"+dado.automovel[i].urlImagem+"' id="+dado.automovel[i].Id+" onclick="$.load("/Modal_automovel/Javascript/Modal.js")"></img>"
      }

      $("#Workbench").append(imagens_carros);
    },
    'json');

});
