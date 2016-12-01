$(document).ready(function(){
  var array=new Array();
  $('.success').each(function(k,v){array.push($(v).attr('id'));});
  $("#form-transf").submit(function(e){
    e.preventDefault();
    $.post("/Modal_transf/PHP/Transferencia.php",
      {
      transferencia: $('#Transf_id').val(),
      Destino: $('#Destino').val(),
      Solicitante: $('#Solicitante').val(),
      BI:  $('#BI').val(),
      Data_BI:  $('#Data_BI').val(),
      Externo: $('#Externo').is(':checked')?1:0,
      Guia_transf: $('#Guia').val(),
      Data_guia: $('#Data_guia').val(),
      itens: array //Itens selecionados(como array)
      },
      function(data)
      {
        data=$.parseJSON(data);
        if(data.sucesso)
        {
//Remove as linhas com os equipamentostransferidos
          $('#resposta_remocao').addClass('alert-success');
          $(".success").remove();
          if($(".linha").attr('id')==null)
          {
//se nao tiver mais linhas, limpa a tela
            $("#editor").attr('hidden',true);
            $('#ResultadoBusca').attr('hidden',true);
            $('.Campo_Ent').val('')
          }
          else
//Caso contrário, mostra os dados do equipamento na primeira linha
            $.post("/Editar/PHP/Mat_Load.php",
            			{
            			"ID" :$(".linha").attr('id')
            			},
            			function(data){
                    $("#Tipo_Busca").val(data["Tipo"])
                  	$("#Marca_Busca").val(data["Marca/Modelo"])
            				$("#Serie_Busca").val(data["S/N"])
            				$("#NF_Busca").val(data["Danfe"])
            				$("#Local_Busca").val(data["Local Almox"])
            				$("#Empenho_Busca").val(data["Nota de Empenho"])
            				$("#Trem_Busca").val(data["TREM"])
            				$("#Proj_Busca").val(data["Projeto"])
            				$("#ID_Busca").val(data["Identificador"])
                    $("#Chave_bd").val(data["ID"])
            			},"json");
        }
        else
          $('#resposta_remocao').addClass('alert-danger');

//Exibe mensagem de resposta
        $('#resposta_remocao').html(data.mensagem);
        $('#resposta_remocao').toggle('hidden');
        setTimeout(function()
        {
          if($('#Dialogo_remocao').hasClass('in'))
            $('#Dialogo_remocao').modal('toggle');
          $('#Dialogo_remocao').empty();
        },3000);
      });
  });
});
