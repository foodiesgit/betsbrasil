$(document).ready(function(e){
    $('body').on('click', '.cota-aposta', function(e){
        e.preventDefault();

        var id = $(this).attr('data-id');

        console.log("ID Selecionado" + id);

        $.ajax({
            url: '/ajax/carrinho/adicionar-aposta',
            method: 'GET',
            data: {
                id: id
            },
            success: function(res){

                if(res.status == 'ok'){
                    var total = $('#totalCupom').html();
                    total = parseInt(total);

                    if(res.acao == 'select'){
                        $('.cota-aposta[data-idevent='+res.idevent+']').removeClass('selecionado');
                        $('.cota-aposta[data-id='+id+']').addClass('selecionado');
                    }else if(res.acao == 'unselect'){
                        $('.cota-aposta[data-id='+id+']').removeClass('selecionado');
                    }

                    var geral = 0;
                    geral = parseInt(geral);
                    $.each( $('.selecionado'), function(i, item) {
                        geral++;
                    });

                    $('#totalCupom').html( geral );
                }
            },error: function(err){

            },complete: function(){

            }
        });
    });

    recuperaCarrinho();

    function recuperaCarrinho(){
        $.ajax({
            url: '/ajax/carrinho/recupera-carrinho',
            method: 'GET',
            success: function(res){
                $('.cota-aposta').removeClass('selecionado');

                console.log('recuperaCarrinho');
                console.log(res);
                if(res.status == 'ok'){
                    $.each(res.response, function(i, item) {
                        console.log("cota-aposta[data-id="+item.idoods+"]");
                        $('.cota-aposta[data-id='+item.idodds+']').addClass('selecionado');
                    });
                }
            },error: function(err){

            },complete: function(){

            }
        });
    }
});
