$(document).ready(function(){
//Posta os dados do material e pega a resposta
  $("#BotaoCadastrar").click(function(){
    obj={};
    if($('.tab-pane.fade.active').attr('id')=="Fisica")
     url="/Cadastro_Client/PHP/CadastrarCliente.php";
    if($('.tab-pane.fade.active').attr('id')=="Juridica")
     url="/Cadastro_Client/PHP/CadastrarFornecedor.php";
      $.each($('.tab-pane.fade.active').find('.Campo'),
            function(key,value)
            {
              if($(this).is(".cpf, .telefone, .cnpj, .data"))
                obj[$(this).attr('id')]=$(this).cleanVal();
              else
                obj[$(this).attr('id')]=$(this).val();
            });
    	$.post(url,	obj,
      		function(dado)
          {
            $('#resposta').removeClass('alert-success');
            $('#resposta').removeClass('alert-danger');

            if(dado.sucesso)
              $("#resposta").addClass('alert-success');
            else
              $("#resposta").addClass('alert-danger');

            $("#resposta").html(dado.mensagem);
            $("#resposta").show(400);
            setTimeout(function()
            {
              $('#resposta').hide(400);
            },3500);
          }
          ,'json');

        $("#BotaoReset").click(function()
        {
          $(".Campo").val('');
        });
      });
    });
