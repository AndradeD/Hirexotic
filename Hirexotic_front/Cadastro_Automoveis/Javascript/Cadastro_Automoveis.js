$(document).ready(function(){

  $.get("/Comuns/TestAut.php",
			function(data)
			{
				if(data.tipoUsuario != 1){
          window.location.href="index.html";
        }else{
          $.get("/ListarModelos/PHP/ListarModelos.php",{
          },
          function(data){
              var options = "";
              $.each(data, function(modelo){
                  options += "<option>"+modelo.Nome+"</option>"
              }
              $("#Modelo").append(options);
          }
          setTimeout(function()
            {
              $('#resposta').hide(400);
            },3500);
          },
          'json');

  $("#BotaoCadastro").click(function(
    $.post("/Cadastro_Automoveis/PHP/Cadastro_Automoveis.php",
      {
      placa: $("#Placa").val(),
      anoFab: $("#AnoFab").val(),
      cor: $("#Cor").val(),
      combustivel: $("#Combust").val(),
      precoMin: $("#PrecoMin").val(),
      modelo: $("#Modelo_text").val(),
      imagem: $("#URLImagem").val(),
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

  ));
  });

  $("#selectModelo").click(function(
    $("#Modelo_text").text($("#Modelo").val());
  ));
);
});
