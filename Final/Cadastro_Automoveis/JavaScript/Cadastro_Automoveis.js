$(document).ready(function(){
  $.getJSON("/Cadastro_Automoveis/PHP/ListarModelos.php",
      	  function(data){
      		createOption(data, "Modelo");
  	     });

  $('form')
  .submit( function( e ) {
    $.ajax( {
      url: '/Cadastro_Automoveis/PHP/CadastrarAutomovel.php',
      type: 'POST',
      data: new FormData( this ),
      processData: false,
      contentType: false,
      dataType: "json",
    }).done(function (data){
      $('#resposta').removeClass('alert-success');
      $('#resposta').removeClass('alert-danger');

      if(data.sucesso)
        $("#resposta").addClass('alert-success');
      else
        $("#resposta").addClass('alert-danger');

      $("#resposta").html(data.mensagem);
      $("#resposta").show(400);
      setTimeout(function()
      {
        $('#resposta').hide(400);
      },3500);
    });
    e.preventDefault();
  } );
});
