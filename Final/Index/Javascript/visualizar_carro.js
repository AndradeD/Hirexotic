//Modal com detalhes
$(document).ready(function()
{
  $("#Workbench").on('click', '.carro', function(event)
  {
    $('.selected').removeClass('selected');
    $(this).toggleClass('selected');
    $('#Detalhe_carro').load('/Modal_automovel.html');
    $('#Detalhe_carro').modal('toggle');
  });
});
