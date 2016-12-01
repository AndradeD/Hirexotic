$(document).ready(function(){
    $("#BotaoEditar").click(function(){
    	$.post("/Editar/PHP/Editar.php",
    		{
        //Todos os campos do material
  			Tipo: $("#Tipo_Busca").val(),
  			Marca: $("#Marca_Busca").val(),
  			Serie: $("#Serie_Busca").val(),
  			NF: $("#NF_Busca").val(),
  			Local: $("#Local_Busca").val(),
  			Empenho: $("#Empenho_Busca").val(),
  			Trem: $("#Trem_Busca").val(),
  			Projeto: $("#Proj_Busca").val(),
  			Identificador: $("#ID_Busca").val(),
    		ID: $("#Chave_bd").val() //ID dele no banco(campo oculto)
    		},
        //Informa se foi ou não bem sucedida a edição
    		function(data)
    			{
            $('#resposta_edicao').removeClass('alert-success');
            $('#resposta_edicao').removeClass('alert-danger');
            if(data.sucesso)
            {
              $('#resposta_edicao').addClass('alert-success');
              $('#resposta_edicao').html('Item editado com sucesso');
              $('#'+$("#Chave_bd").val()).empty();
              $.each(data.dado, function(i,v)
              {
                //Atualiza a linha do elemento na tabela exibida na pagina
                $('#'+$("#Chave_bd").val()).append('<td>'+v.opcao.tipo+'</td>'+
                                                  '<td>'+v.opcao.modelo+'</td>'+
                                                  '<td>'+v.opcao.sn+'</td>');
              });
            }
            else
            {
              $('#resposta_edicao').addClass('alert-danger');
              $('#resposta_edicao').html('Erro ao editar o item selecionado');
            }
            $('#resposta_edicao').toggle('hidden');
            setTimeout(function()
            {
              $('#resposta_edicao').toggle('hidden');
            },3500);
    			},
          'json');
    });
});
