$(document).ready(function(){
  $("#BtCancela").click(function()
  {
    var conf=false;
    if(!($(".success")[0]==null))
      conf=confirm("Deseja cancelar a transferencia?"+
                    "\nEssa operação não poderá ser desfeita");
    if(conf)
    {
      $.post("/Transferencia/PHP/Cancela.php",
      {
        "ID" :$(".success").attr('id')
      },
      function(data)
      {
        $("#mens_remove").removeClass('alert-danger alert-success');
        $('.campo_transf').val('');
        if(data.sucesso)
        {
          $(".success").remove();
          $('#resposta_materiais').empty();
          $("#mens_remove").addClass('alert-success');
        }
        else
          $("#mens_remove").addClass('alert-danger');

        $("#mens_remove").html(data.mensagem);
        $("#mens_remove").toggle('hidden');
        setTimeout(function()
        {
          $('#mens_remove').toggle('hidden');
        },3500);
      },
      'json');
    }
  });
});
