//Faz o login e modifica a barra de navegação
$("form").on("submit", function (e) {
  e.preventDefault()
  $.post("/Login/PHP/Login.php",
      {
        usuario: $("#usuario").val(),
        senha: $("#senha").val()
      },
      function(data)
      {
        alert(data.mensagem);
        if(data.sucesso)
        {
          $("#Login_bar").load("Login_autenticado.html");
        }
      },
      "json"
      );
});
