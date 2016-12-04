$(document).ready(function(){
  //Reseta os campos do formulário
  $("#BotaoLimpar").click(function(){
    $(".Campo").val('');
    $("#Proj_sel").attr("disabled",false);
    $("#Proj_text").attr("disabled",true);
    $("#Tipo_sel").attr("disabled",false);
    $("#Tipo_text").attr("disabled", true);
    $("#Tipo_opt_exist").prop('checked',true)
    $("#Proj_opt_exist").prop('checked',true)
    populateCadastro();
    $("#resposta").attr('hidden', true);
  });
});
