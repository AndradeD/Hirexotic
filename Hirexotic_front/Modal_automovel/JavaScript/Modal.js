$(document).ready(function(){
  $.post("/Modal_automovel/PHP/Modal.php",
  {
    id: $(this).Id
  },
  function(data)
  {
      $("#automovel_dados").append("<tr><td><a role='button' tabindex="+k+"><font color='blue'><span class='glyphicon glyphicon-question-sign' style='cursor:pointer'></span></font></a></td>"+
                                      "<td>"+data.automovel.Nome+"</td>"+
                                      "<td>"++"</td>"+
                                      "<td>"++"</td></tr>");
    });
  },'json');
});
