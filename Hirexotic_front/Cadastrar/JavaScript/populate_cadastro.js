//Funcao que pega os materiais e projetos
function populateCadastro()
	{
	$.getJSON("/Cadastrar/PHP/Tipo_cadastro_return.php",
	function(data){
		createOption(data, "Tipo_sel");
	});
	$.getJSON("/Cadastrar/PHP/Projeto_cadastro_return.php",
	function(data){
		createOption(data, "Proj_sel");
	});
	};
