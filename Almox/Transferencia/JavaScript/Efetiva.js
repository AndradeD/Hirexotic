$(document).ready(function(){
  $("#BtEfetiva").click(function()
  {
    var conf=false;
    if(!($(".success")[0]==null))
      conf=confirm("Deseja efetuar a transferencia?"+
                    "\nEssa operação não poderá ser desfeita");
    if(conf)
    {
      $.post('/Transferencia/PHP/Efetiva.php',
      {
        transferencia: $(".success").prop('id'),
        Destino: $("#Destino").val(),
        Solicitante: $("#Solicitante").val(),
        BI: $("#BI").val(),
        Data_BI: $("#Data_BI").val(),
        Guia_transf: $("#Guia").val(),
        Data_guia: $("#Data_guia").val()
      },
      function(data)
      {
        $("#mens_remove").removeClass('alert-danger alert-success');
        if(data.sucesso)
        {
          $('.campo_transf').val('');
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
