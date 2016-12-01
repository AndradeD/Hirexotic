$(document).ready(function(){
  $.post("/Modal_hist/PHP/Modal.php",
  {
    Transf: $(".success").prop('id')
  },
  function(data)
  {
    $.each(data.Transferencia, function(k,v)
    {
      if(v!='')
        $("#" + k).append("<td>"+v+"</td>");
      else
        $("#"+ k).remove();
    });
    $.each(data.Materiais, function(k,v){
//Insere glyphicon para ser usado com popover
      $("#resposta_materiais").append("<tr><td><a role='button' tabindex="+k+"><font color='blue'><span class='glyphicon glyphicon-question-sign' style='cursor:pointer'></span></font></a></td>"+
                                      "<td>"+v.Tipo+"</td>"+
                                      "<td>"+v['Marca/Modelo']+"</td>"+
                                      "<td>"+v['S/N']+"</td></tr>");

      var details="<table class='table table-condensed text-center'>";
      $.each(v, function(k2,v2){
        if(v2 != '')
          details +="<tr><td><strong>"+k2+"</strong></td><td>"+v2+"</td></tr>";
      });
      details +="</table>";
//Cria popover
      $("#resposta_materiais").find('a').last().popover(
                                      { title: 'Detalhes do Material',
                                        content: details,
                                        placement: 'top',
                                        trigger: 'focus',
                                        html: true});

    });
  },'json');
});
