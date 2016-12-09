$(document).ready(function(){
//Posta os dados do material e pega a resposta
$("form").on("submit", function (e) {
  e.preventDefault()
	//$("#resposta").html("<h5 class='text-center'>Cadastrando...</h5>");	
	$tipo = $(".tablinks active").data("id");	

if ($tipo == "pessoaFisica"){
    $.post("/Cadastrar/PHP/Cadastro_User.php",
	  {
		tipo: $tipo,
		nome: $("#Nome_text").val(),
		endereco: $("#Endereco").val(),
		tel: $("#Tel").val(),
		cpf: $("#CPF").val(),
		sexo: $("#Sexo").val(),
        usuario: $("#Usuario").val(),
        senha: $("#Senha").val()
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
} else
    if ($tipo == "pessoaJuridica") {
        $.post("/Cadastrar/PHP/Cadastro_User.php",
      {
      tipo: $tipo,
      nome: $("#Nome_text").val(),
  		endereco: $("#Endereco").val(),
  		tel: $("#Tel").val(),
  		cnpj: $("#CNPJ").val(),
      usuario: $("#Usuario").val(),
      senha: $("#Senha").val()
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
    } else {
        $.post("/Cadastrar/PHP/Cadastro_User.php",
	  {
	      tipo: $tipo,
	      nome: $("#Nome_text").val(),
	      endereco: $("#Endereco").val(),
	      tel: $("#Tel").val(),
	      cpf: $("#CPF").val(),
	      cnpj: $("#CNPJ").val(),
	      sexo: $("#Sexo").val(),
	      placa: $("#Placa").val(),
	      anoFab: $("#AnoFab").val(),
	      cor: $("#Cor").val(),
	      combustivel: $("#Combust").val(),
	      precoMinimo: $("#PrecoMin").val(),
	      imagem: $("#imagem").val(),
	      usuario: $("#Usuario").val(),
	      senha: $("#Senha").val()
	  },
		function (dado) {
		    $('#resposta').removeClass('alert-success');
		    $('#resposta').removeClass('alert-danger');

		    if (dado.sucesso)
		        $("#resposta").addClass('alert-success');
		    else
		        $("#resposta").addClass('alert-danger');

		    $("#resposta").html(dado.mensagem);
		    $("#resposta").show(400);
		    setTimeout(function () {
		        $('#resposta').hide(400);
		    }, 3500);
		},
    'json');
    }
  });
});
