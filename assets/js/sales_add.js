function selectClient(obj) {
    var id = $(obj).attr('data-id');
    var name = $(obj).html();
    $('.searchresults').hide();
    $('#client_name').val(name);
    $('#client_id').val(id);
}

function addProd(obj) {
    $('#add_prod').val('');
    var id = $(obj).attr('data-id');
    var name = $(obj).attr('data-name');
    var price = $(obj).attr('data-price');
    $('.searchresults').hide();
    if($("input[name='quant["+id+"]']").length == 0){
        var tr = '<tr>' +
            '<td>' + name + '</td>' +
            '<td>' +
            '<input type="number" name="quant['+id+']" class="p_quant" value="1" data-price="'+price+'" onchange="updateSubtotal(this)">' +
            '</td>' +
            '<td> R$ ' + price + '</td>' +
            '<td class="subtotal"> R$ ' + price + '</td>' +
            '<td><a href="javascript:;" onclick="excluirProd(this)" class="button button_small button_del">Excluir</a></td>' +
            '</tr>';
        $('#products_table').append(tr);
    }
    updateTotal();
}

function excluirProd(obj) {
    $(obj).closest('tr').remove();
}

function updateSubtotal(obj){
      var qtd = $(obj).val();
      if(qtd <=0){
          $(obj).val(1);
      }
      var price = $(obj).attr('data-price');
      var subtotal = price * qtd;
      subtotal = parseFloat(subtotal.toFixed(2));
      $(obj).closest('tr').find('.subtotal').html('R$ '+ subtotal);
      updateTotal();
}

function updateTotal(){
    var total = 0;
    for (var q=0; q < $('.p_quant').length ; q++){
        var quant = $('.p_quant').eq(q);
        var price = quant.attr('data-price');
        var subtotal= price* parseInt(quant.val());
        total += subtotal;
    }
    $('input[name=total_price]').val(total.toFixed(2));
}

$(function () {
    $('input[name=total_price]').mask('000.000.000.000.000,00', {
        reverse: true, placeholder: "0,00"
    });

    $('.client_add_button').on('click', function (e) {
        e.preventDefault();
        var name = $('#client_name').val();
        if (name != '' && name.length >= 4) {
            if (confirm('Você deseja adicionar um cliente com nome: ' + name + '?')) {
                $.ajax({
                    url: BASE_URL + '/ajax/addclient',
                    type: 'POST',
                    data: {name: name},
                    success: function (json) {
                        json = JSON.parse(json);
                        console.log('id retornado' + json.id);
                        $('.searchresults').hide();
                        $('#client_id').val(json.id);
                    }
                })
            }
        }
    });

    $('#client_name').on('keyup', function () {
        var datatype = $(this).attr('data-type');
        var q = $(this).val();
        if (datatype != '') {
            $.ajax({
                url: BASE_URL + '/ajax/' + datatype,
                type: 'GET',
                data: {q: q},
                dataType: 'json',
                success: function (json) {
                    if ($('.searchresults').length == 0) {
                        $('#client_name').after('<div class="searchresults"></div>');
                    }
                    $('.searchresults').css('left', $('#client_name').offset().left + 'px');
                    $('.searchresults').css('top', $('#client_name').offset().top + $('#client_name').height() + 6 + 'px');
                    var html = '';
                    for (var i in json) {
                        html += "<div class='si' ><a href='javascript:;' data-id='" + json[i].id + "' onclick='selectClient(this)'>" + json[i].name + "</a></div>";
                    }
                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }
    });

    $('#add_prod').on('keyup', function () {
        var datatype = $(this).attr('data-type');
        var q = $(this).val();
        if (datatype != '') {
            $.ajax({
                url: BASE_URL + '/ajax/' + datatype,
                type: 'GET',
                data: {q: q},
                dataType: 'json',
                success: function (json) {
                    if ($('.searchresults').length == 0) {
                        $('#add_prod').after('<div class="searchresults"></div>');
                    }
                    $('.searchresults').css('left', $('#add_prod').offset().left + 'px');
                    $('.searchresults').css('top', $('#add_prod').offset().top + $('#add_prod').height() + 6 + 'px');
                    var html = '';
                    for (var i in json) {
                        html += "<div class='si' ><a href='javascript:;' data-id='" + json[i].id + "' onclick='addProd(this)' data-price='" + json[i].price + "' " +
                            "data-name='" + json[i].name + "'>" + json[i].name + "" +
                            " - R$ " + json[i].price + "</a></div>";
                    }
                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }
    });
});