$(document).ready(function(){
//Posta os dados do material e pega a resposta
$("form").on("submit", function (e) {
  e.preventDefault()
	//$("#resposta").html("<h5 class='text-center'>Cadastrando...</h5>");

		$tipo=$("#Tipo_sel").val("Func");

  $.post("/Cadastrar/PHP/Cadastro_Funcionario.php",
	  {
		tipo: $tipo,
		nome: $("#Nome_text").val(),
		endereco: $("#Endereco").val(),
		tel: $("#Tel").val(),
		cpf: $("#CPF").val(),
		sexo: $("#Sexo").val(),
    matricula: $("#Matricula").val(),
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

  });
});
