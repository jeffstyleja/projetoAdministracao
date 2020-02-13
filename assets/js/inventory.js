$(function () {
    $(window).on('load',function () {
        $('input[name=name]').focus();
    });
    $('input[name=price]').mask('000.000.000.000.000,00',{
        reverse:true,placeholder:"0,00"
    });
});
