$(document).ready(function(){

$.get("/Comuns/TestAut.php",
	function(data)
  {
  var htmlAluguel = "";

	if(!data.tipoUsuario != 2)
		window.location.href="index.html";

  $.get("/ListarAlugueis/PHP/ListarAlugueis.php",
  function(aluguel,automoveis,fornecedor)
  {
      $.each(aluguel.length){
        htmlAluguel += "<div class='form-group'><label for='placa'>Placa</label><br><input type='text' class='Campo form-control placa' id='placa' name='placa'>"+automoveis.placa+"</div>"
				"<div class='form-group'><label for='anoFab'>Ano de Fabricação</label><br><input type='text' class='Campo form-control anoFab' id='anoFab' name='anoFab'>"+automoveis.anoFab+"</div>"+
				"<div class='form-group'><label for='cor'>Cor</label><br><input type='Text' class='Campo form-control cor' id='cor' name='cor'>"+automoveis.cor+"</div>"+
				"<div class='form-group'><label for='combustivel'>Combustível</label><br><input type='text' class='Campo form-control combustivel' id='combustivel' name='combustivel'>"+automoveis.combustivel+"</div>";
        "<div class='form-group'><label for='modelo'>Modelo</label><br><input type='text' class='Campo form-control modelo' id='modelo' name='modelo'>"+automoveis.modelo.nome+"</div>";
        "<div class='form-group'><label for='fornecedor_nome'>Nome Fornecedor</label><br><input type='text' class='Campo form-control fornecedor_nome' id='fornecedor_nome' name='fornecedor_nome'>"+fornecedor.nome+"</div>";
        "<div class='form-group'><label for='telefone'>Telefone</label><br><input type='text' class='Campo form-control telefone' id='telefone' name='telefone'>"+fornecedor.telefone+"</div>";
        "<div class='col-md-12 text-center'><button id='ConfirmaAluguel' type='submit' class='btn btn-lg btn-success' onclick='"+ValidateAluguel(aluguelAutomovel.Id)+"'>Validar Aluguel</button></div>";
      }

      $("#Aluguel_automovel").append(htmlAluguel);

  })
}


function ValidateAluguel(idAutomovel){

  $.ajax( {
    url: '/ValidarAluguel/PHP/ValidarAluguel.php',
    type: 'POST',
    data: "idAutomovel="+idAutomovel,
    processData: false,
    contentType: false,
    dataType: "json",
  }).done(function (validado){
    $('#resposta').removeClass('alert-success');
    $('#resposta').removeClass('alert-danger');

    if(validado)
      $("#resposta").addClass('alert-success');
    else
      $("#resposta").addClass('alert-danger');

    $("#resposta").html(data.mensagem);
    $("#resposta").show(400);
    setTimeout(function()
    {
      $('#resposta').hide(400);
    },3500);
  });
}
