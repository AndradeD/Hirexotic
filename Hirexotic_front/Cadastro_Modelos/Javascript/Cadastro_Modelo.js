$(document).ready(function(){

  $.get("/Comuns/TestAut.php",
			function(data)
			{
				if(data.tipoUsuario != 1){
          window.location.href="index.html";
        }else{
  $.post("/Cadastro_Modelo/PHP/Cadastro_Modelo.php",
	  {
		nome: $("#Nome_text").val(),
		marca: $("#Marca").val(),
		ano: $("#Ano").val(),
		numPassageiros: $("#NumPassageiros").val(),
		velocidade: $("#Velocidade").val(),
    cilindradas: $("#Cilindradas").val(),
    numPortas: $("#NumPortas").val(),
	  },
		function(dado)
    {
      $('#resposta').removeClass('alert-success');
      $('#resposta').removeClass('alert-danger');

      if(dado.sucesso)
        $("#resposta").addClass('alert-success');
      else
        $("#resposta").addClass('alert-danger');

      $("#resposta").html(dado.mensagem);
      $("#resposta").show(400);
      setTimeout(function()
      {
        $('#resposta').hide(400);
      },3500);
    },
    'json');

  });
});
}
