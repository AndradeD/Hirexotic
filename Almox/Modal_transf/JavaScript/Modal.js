//Inicializa modal
$(document).ready(function(){
  $.get("/Modal_transf/PHP/Modal.php",
  function(data){
    createOption(data, "Transf_id");
  },'json');
  $('#Transf_id').change(function()
  {
    if($('#Transf_id').val()=='')
    {
      $('#Dados_transf').show();
      $('#Destino').prop('required',true);//Só é requerido para novas transferencias
    }
    else
    {
      $('#Dados_transf').hide();
      $('#Destino').prop('required',false);
    }
  });
});
