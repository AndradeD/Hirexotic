$(document).ready(function(){
$.getJSON("/Validar_Alugueis/PHP/ListarAlugueis.php",
  function(data)
  {
      $.each(data.dado, function(i,v){
        $("#resposta_alugueis").append('<tr><td>'+v.placa+'</td>'+
                                            '<td>'+v.modelo+'</td>'+
                                            '<td>'+v.cor+'</td>'+
                                            '<td>'+v.anofab+'</td>'+
                                            '<td>'+v.combustivel+'</td>'+
                                            '<td>'+v.nomefornecedor+'</td>'+
                                            '<td>'+v.telfornecedor+'</td>'+
                                            '<td><a><font color="red"><span class="glyphicon glyphicon-remove actionitem" data-val_alu="false" data-alu_id= ' +v.id+ ' style="cursor:pointer"></span></font></a></td>'+
                                            '<td><a><font color="green"><span class="glyphicon glyphicon-ok actionitem" data-val_alu="true" data-alu_id= ' +v.id+ ' style="cursor:pointer"></span></font></a></td></tr>');
      });
  });
});
