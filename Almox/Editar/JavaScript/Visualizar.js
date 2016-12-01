$(document).ready(function(){
	//Permite multiplas linhas selecionadas(para remoção multiplas)
	$("#resposta").on('click', '.linha', function(event){
      if (event.ctrlKey)
        $(this).toggleClass('success');
      else
        {
        $('.success').removeClass('success');
        $(this).toggleClass('success');
        }
      if (document.selection)
        document.selection.empty();
      else if (window.getSelection)
        window.getSelection().removeAllRanges();

			//Vizualiza o ultimo elemento clicado
    	$.post("/Editar/PHP/Mat_Load.php",
    			{
    			"ID" :$(this).attr('id')
    			},
    			function(data)
					{
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
      $("#editor").attr("hidden",false);
    });
});
