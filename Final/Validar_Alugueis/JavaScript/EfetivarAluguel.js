$(document).ready(function(){
$("#resposta_alugueis").on('click', '.actionitem',
  function(event)
  {
    var id=$(this).attr('data-alu_id');
    var validar= $(this).attr('data-val_alu');
    $.post("/Validar_Alugueis/PHP/EfetivarAluguel.php",
    {
      idaluguel: id,
      validado: validar,
    },
    function(dado)
    {
      $("#resposta").removeClass('alert-danger alert-success');
      if(dado.sucesso)
      {
        $("#resposta").addClass('alert-success');
        $("[data-alu_id="+id+"]").parents('tr').remove();
      }
      else
        $("#resposta").addClass('alert-danger');

      $("#resposta").html(dado.mensagem);
      $("#resposta").toggle('hidden');
      setTimeout(function()
        {
        $('#resposta').toggle('hidden');
        },3500);
      },
        'json');
      });
});
