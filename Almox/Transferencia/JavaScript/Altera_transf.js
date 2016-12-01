$(document).ready(function(){
  $("#salva_transf").click(function(){
    $.post('/Transferencia/PHP/Altera_transf.php',
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
      $('#mens_altera').removeClass('alert-success alert-danger');
      if(data.sucesso)
      {
        $("#mens_altera").addClass('alert-success');
        $('#resposta_transferencias').empty();
        $.getJSON("/Transferencia/PHP/Transferencia.php",
          	function(data)
            {
              $.each(data.dado, function(i,v)
              {
                $('#resposta_transferencias').append('<tr id='+v.nr+' class="linha success">'+
                                                    '<td>'+v.nr+'</td>'+
                                                    '<td>'+v.destino+'</td>'+
                                                    '<td>'+v.nrMat+'</td></tr>');
              });
            });
      }
      else
        $("#mens_altera").addClass('alert-danger');

      $("#mens_altera").html(data.mensagem);
      $("#mens_altera").toggle('hidden');
      setTimeout(function()
      {
        $('#mens_altera').toggle('hidden');
      },3500);

    },
    'json');
  });
});
