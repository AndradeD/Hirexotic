$(document).ready(function(){
$.getJSON("/Transferencia/PHP/Transferencia.php",
  	function(data)
    {
      $.each(data.dado, function(i,v)
      {
        $('#resposta_transferencias').append('<tr id='+v.nr+' class=linha>'+
                                            '<td>'+v.nr+'</td>'+
                                            '<td>'+v.destino+'</td>'+
                                            '<td data-n_mat=1>'+v.nrMat+'</td></tr>');
      });
    });
$("#resposta_transferencias").on('click', '.linha',
  function(event)
  {
    $('.success').removeClass('success');
    $(this).toggleClass('success');
    if (document.selection)
      document.selection.empty();
    else if (window.getSelection)
      window.getSelection().removeAllRanges();
    $.post("/Transferencia/PHP/Transf_Load.php",
        {
        "ID" :$(this).attr('id')
        },
        function(data)
        {
          $(".campo_transf").val('');

          $("#Destino").val(data['Transf']['Destino']);
          $("#Solicitante").val(data['Transf']['Solicitante']);
          $("#BI").val(data['Transf']['BI']);
          $("#Data_BI").val(data['Transf']['Data_BI']);
          if(data['Transf']['Externo']==1)
          {
            $("#Dados_Ext").attr('disabled',false);
            if(data['Transf']['Guia']!="")
              $("#Guia").val(data['Transf']['Guia']);
            if(data['Transf']['Data_guia']!="")
              $("#Data_guia").val(data['Transf']['Data_guia']);
          }
          else
            $("#Dados_Ext").attr('disabled',true);

          $("#resposta_materiais").empty();
          $.each(data.Material, function(i,v)
          {
            $('#resposta_materiais').append('<tr><td><a><font color="red"><span class="glyphicon glyphicon-remove remove_mat" data-mat_id= ' +v.ID+ ' style="cursor:pointer"></span></font></a></td>'+
                                            '<td>'+v.Tipo+'</td>'+
                                            '<td>'+v.Marca+'</td>'+
                                            '<td>'+v.SN+'</td></tr>');
          });
        },
        "json");
    });
});
