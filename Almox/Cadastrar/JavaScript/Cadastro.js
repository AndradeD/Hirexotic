$(document).ready(function(){
//Posta os dados do material e pega a resposta
$("form").on("submit", function (e) {
  e.preventDefault()
	//$("#resposta").html("<h5 class='text-center'>Cadastrando...</h5>");

	if($('input[name=Proj_opt]:checked', "#Cadastro_projeto").val()=="Projeto Existente")
		$projeto=$("#Proj_sel").val();
	else
		$projeto=$("#Proj_text").val();

	if($('input[name=Tipo_opt]:checked', "#Cadastro_tipo").val()=="Tipo Existente")
		$tipo=$("#Tipo_sel").val();
	else
		$tipo=$("#Tipo_text").val();

  $.post("/Cadastrar/PHP/Cadastro.php",
	  {
		tipo: $tipo,
		marca: $("#Marca").val(),
		serie: $("#Serie").val(),
		nf: $("#NF").val(),
		local: $("#Local").val(),
		empenho: $("#Empenho").val(),
		trem: $("#TREM").val(),
    proj: $projeto,
		id: $("#ID").val()
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
