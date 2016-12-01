//Cria campos '<option>' no elemento 'id'
//dado no formato data:{dado:{0:{opcao:'opcao',valor:'valor'},1:{opcao:'opcao',valor:'val}}}
function createOption(data, id)
{
  $('#'+id).empty();
  $.each(data.dado, function(i,v)
  {
    $('#'+id).append($('<option>').text(v.opcao).attr('value', v.valor));
  });
}
