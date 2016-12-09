$(document).ready(function(){
  var d = new Date();
  var datestring = (d.getDate()<10?"0" + d.getDate():d.getDate())  + "/" + ((d.getMonth()+1)<10?"0"+d.getMonth()+1:d.getMonth()+1) + "/" + d.getFullYear();
  $("#datainicio").val(datestring);
  $("#datafim").val(datestring);

  $(".campo").change(function(){
    var year = $("#datainicio").cleanVal()%10000;
    var month =( $("#datainicio").cleanVal()%100000 - year)/10000;
    var day = ($("#datainicio").cleanVal()%100000000-$("#datainicio").cleanVal()%1000000)/1000000;
    var dInicial= new Date(year, month-1, day);
    console.log(day,month,year);
    var year = $("#datafim").cleanVal()%10000;
    var month =( $("#datafim").cleanVal()%100000 - year)/10000;
    var day = ($("#datafim").cleanVal()%100000000-$("#datainicio").cleanVal()%1000000)/1000000;
    var dFinal= new Date(year, month-1, day+1);
    var dTotal=Math.floor((dFinal-dInicial)/86400000)+1;
    console.log(day,month,year);
    if(dTotal>0)
      $("#Preco_aluguel").val(dTotal*parseFloat($("#pminimo_val").attr("data-valor")));
    });

    $("#BotaoAlugar").click(function(){
      obj={};
        $.each($('#aluguel').find('.campo'),
              function(key,value)
              {
                obj[$(this).attr('id')]=$(this).val();
              });
              obj["idautomovel"]=$(".selected").attr('id');
      	$.post("/Modal_automovel/PHP/RealizarAluguel.php",	obj,
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
                window.location.href="index.html";
              },3500);
            }
            ,'json');
        });

});
