//Modal de remoção
$(document).ready(function(){
    $("#BotaoRemover").click(function(){
      $('#Dialogo_remocao').load('/Modal_transf.html');
      $('#Dialogo_remocao').modal('toggle');
    });
});
