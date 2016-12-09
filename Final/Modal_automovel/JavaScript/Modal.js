$(document).ready(function(){
  $.post("/Modal_automovel/PHP/DetalharAutomovel.php",
  {
    id: $(".selected").prop('id')
  },
  function(automovel)
  {
    $.each(automovel, function(k,v)
    {
      if(v!='')
        $("#" + k).append("<td id='" +k+"_val' data-valor="+v+">"+v+"</td>");
      else
        $("#"+ k).remove();
    });
  },'json');
});
