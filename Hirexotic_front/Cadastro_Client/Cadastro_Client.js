$(document).ready(function(){
//Posta os dados do material e pega a resposta
$("form").on("submit", function (e) {
  e.preventDefault()
	//$("#resposta").html("<h5 class='text-center'>Cadastrando...</h5>");

	if($('input[name=Tipo_opt]:checked', "#Cadastro_tipo").val()=="Pessoa Fisica")
		$tipo=$("#Tipo_sel").val("PF");
	else
		$tipo=$("#Tipo_sel").val("PJ");

if ($tipo == "PF"){
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
  }else{
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
  }
  });
});
