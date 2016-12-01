$(document).ready(function(){
$("#resposta_materiais").on('click', '.remove_mat',
  function(event)
  {
    var id=$(this).attr('data-mat_id');
    $.post("/Transferencia/PHP/Remove_mat.php",
    {
      Id_Mat: id
    },
    function(dado)
    {
      $("#mens_remove").removeClass('alert-danger alert-success');
      if(dado.sucesso)
      {
        $("#mens_remove").addClass('alert-success');
        $("[data-mat_id="+id+"]").parents('tr').remove();
      }
      else
        $("#mens_remove").addClass('alert-danger');

      $("#mens_remove").html(dado.mensagem);
      $("#mens_remove").toggle('hidden');
      setTimeout(function()
      {
        $('#mens_remove').toggle('hidden');
      },3500);

      if(parseInt($(".success [data-n_mat=1]").text())>1)
        $(".success [data-n_mat=1]").html((parseInt($(".success [data-n_mat=1]").text())-1));
      else
      {
        $.post("/Transferencia/PHP/Cancela.php",
        {
          "ID" :$(".success").attr('id')
        },
        function(data)
        {
          if(data.sucesso)
            $(".success").remove();
        },
        'json');
      }
    },
    'json');
  });
});
