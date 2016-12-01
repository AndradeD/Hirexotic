$(document).ready(function(){
	//Pega lista de projetos e materiais
  populateCadastro();

	//Controle de formulário(ou select ou texto próprio)

	$(".Proj_opt").click(function(){
		if($(this).val()=="Novo Projeto")
		{
			$("#Proj_sel").attr("disabled",true);
			$("#Proj_text").attr("disabled",false);
		}
		else
		{
			$("#Proj_sel").attr("disabled",false);
			$("#Proj_text").attr("disabled",true);
		}
		});

	$(".Tipo_opt").click(function(){
		if($(this).val()=="Novo Tipo")
		{
			$("#Tipo_sel").attr("disabled",true);
			$("#Tipo_text").attr("disabled",false);
		}
		else
		{
			$("#Tipo_sel").attr("disabled",false);
			$("#Tipo_text").attr("disabled",true);
		}
		});
})
