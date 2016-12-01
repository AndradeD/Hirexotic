//Modal com detalhes
$(document).ready(function()
{
	$("#resposta_transferencias").on('click', '.linha', function(event)
  {
    $('.success').removeClass('success');
    $(this).toggleClass('success');
    $('#Detalhe_histórico').load('/Modal_hist.html');
    $('#Detalhe_histórico').modal('toggle');
  });
});
