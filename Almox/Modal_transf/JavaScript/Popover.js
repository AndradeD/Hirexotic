//Popover com dados da transferência
$('#Transf_id').change(function()
{
  $('#glyphicon').popover('hide');
  if($(this).val()!='')
    $.post("/Modal_transf/PHP/Popover.php",
    {transf: $(this).val()},
    function(data)
      {
//Tabela com materiais do modal
        var conteudo = "<dl class='dl-horizontal text-center'>";
        $.each(data.dado, function(k,v){
          conteudo += "<dt>"+ v.tipo +"</dt><dd>"+ v.quantidade + "</dd>";
        });
        conteudo += "</dl>";
        var titulo="<h4>" + data.titulo['Destino']+ "</h4>";
//Cria popover sobre glyphicon
        $('#glyphicon').popover(
          { title: '',
            content: '',
            placement: 'left',
            trigger: 'focus',
            html:true});
        $('#glyphicon').data('bs.popover').options.content=conteudo;
        $('#glyphicon').data('bs.popover').options.title=titulo;
      },
      'json');
    else
      $('#glyphicon').popover('destroy');
});
