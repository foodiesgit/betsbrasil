$(document).ready(function(e){
    $('body').on('click', '.cota-aposta', function(e){
        e.preventDefault();

        var id = $(this).attr('data-id');

        console.log('id bets', id);

        $.ajax({
            url: '/carrinho/adicionar-aposta/',
            method: 'GET',
            data: {
                id: id
            },
            success: function(res){
                console.log("Ajax /carrinho/adicionar-aposta -- SUCCESS");
                console.log(res);

                //$('.cota-aposta[data-id='+id+']').addClass('cota_selected');
                //$('#modal_carrinho').modal('show');

                if(res.status == 'erro2'){
                    $('.cota-aposta[data-id='+res.idodds+']').removeClass('cota_selected');
                }

                recuperarCupomAposta();

            },error: function(err){
                console.log("Ajax /carrinho/adicionar-aposta -- ERROR");
                console.log(err);
            },complete: function(){
                console.log("Ajax /carrinho/adicionar-aposta -- COMPLETE");
            }
        });
    });

    function recuperarCupomAposta(){
        $('.corpo_carrinho').html('<div class="text-center"><div class="spinner-border"><span class="sr-only">Carregando</span></div></div>');

        $.ajax({
            url: '/carrinho/recupera-carrinho',
            method: 'GET',
            success: function(res){
                console.log("Ajax /carrinho/recupera-carrinho -- SUCCESS");
                console.log(res);

                if(res.status == 'ok'){
                    $('.corpo_carrinho').html('');

                    console.log("O tamanho do retorno é " + res.response.length);

                    var tamanho = res.response.length;

                    if(tamanho == 0){
                        $('#totalCupom').hide();
                    }else{
                        $('#totalCupom').show();
                        $('#totalCupom').html(tamanho);
                    }

                    $('.cota-aposta').removeClass('cota_selected');

                    var soma_momento = 0;
                    var multiplicacao = 1;

                    if(res.response.length > 0){
                        res.response.map(function(item, i){

                            var valor_apostado = parseFloat(item.valor_apostado);
                            var valor_momento = parseFloat(item.valor_momento);

                            soma_momento = soma_momento + valor_momento;
                            multiplicacao = multiplicacao * valor_momento;

                            console.log("Multi: " + multiplicacao);
                            var retorno_possivel = valor_apostado * valor_momento;
                            var retorno_possivel = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(retorno_possivel);

                            $('.cota-aposta[data-id='+item.idodds+']').addClass('cota_selected');

                            $('.corpo_carrinho').append('<div class="ca-item" data-id="'+item.id+'">'+
                                '<div class="ca-delete" data-id="'+item.id+'"><i class="ti ti-close"></i></div>'+
                                '<div class="ca-main">'+
                                '<span class="ca-aposta">'+item.name+'</span>'+
                                '<span class="ca-tipo" style="margin-top: 15px;">'+item.subgrupo+'</span>'+
                                '<span class="ca-jogo">'+item.time_home+' x '+item.time_away+'</span>'+
                                '</div>'+
                                '<div class="ca-cota ca-valor-momento" data-id="'+item.id+'">'+item.valor_momento+'</div>'+
                                '<div class="ca-valor">'+
                                    '<input type="text" class="ca-input valor-apostado" data-id="'+item.id+'" value="'+item.valor_apostado+'">'+
                                    '<span class="ca-jogo" style="margin-top: 15px;">Retornos Possíveis</span>'+
                                    '<span class="ca-jogo ca-retorno-possivel" data-id="'+item.id+'">'+retorno_possivel+'</span>'+
                                '</div>'+
                                '</div>');
                        });

                        $('.corpo_carrinho').append('<div class="d-flex flex-row justify-content-between mt-2 mb-2">'+
                                '<span>Cotações</span>'+
                                '<span id="ca-total-cotacoes">'+soma_momento.toFixed(2)+'</span>'+
                            '</div>');
                        $('.corpo_carrinho').append('<div class="d-flex flex-row justify-content-between mt-2 mb-2">'+
                                '<span>Possível Retorno</span>'+
                                '<span id="ca-total-possivel-retorno">30.5</span>'+
                            '</div>');

                        $('.corpo_carrinho').append('<div class="d-flex flex-row justify-content-between mt-2 mb-2">'+
                                '<span>Valor Aposta</span>'+
                                '<span><input type="text" class="valor-total-aposta form-control"></span>'+
                            '</div>');
                    }else{
                        $('.corpo_carrinho').html('<p class="text-center"><b>Nenhuma aposta</b></p>');
                    }

                    $('.corpo_carrinho').append('<div class="btn-colocar-aposta">'+
                        '<span class="texto1">Apostar - <span class="valor ca-total-aposta">R$ 0,00</span></span>'+
                        '<span class="texto2">Total Cotas: <span class="ca-total-cotas">'+soma_momento.toFixed(2)+'</span></span>'+
                        '<span class="texto2">Possível Retorno: <span class="ca-total-retorno">R$ 0,00</span></span>'+
                    '</div>');

                    $('.ca-input').maskMoney({
                        prefix: '', thousands: '.', decimal: ',', allowZero: true, allowEmpty: true
                    });
                    $('.valor-total-aposta').maskMoney({
                        prefix: 'R$ ', thousands: '.', decimal: ',', allowZero: true, allowEmpty: true
                    });

                    adicionaBotaoAposta();
                }else{
                    $('.corpo_carrinho').html('');
                }
            },error: function(err){
                console.log("Ajax /carrinho/recupera-carrinho -- ERROR");
                console.log(err);
            },complete: function(){
                console.log("Ajax /carrinho/recupera-carrinho -- COMPLETE");
            }
        });
    }

    recuperarCupomAposta();

    adicionaBotaoAposta();

    function adicionaBotaoAposta(){
        var soma_aposta = 0.00;
        var soma_retorno = 0.00;

        soma_aposta = parseFloat(soma_aposta);
        soma_retorno = parseFloat(soma_retorno);

        $('.valor-apostado').each(function(index){
            var valor = $(this).val();
            var id = $(this).attr('data-id');

            var cota = parseFloat( $('.ca-valor-momento[data-id='+id+']').html() );

            var valor_format = valor.replace(".", "");
            var valor_format = valor_format.replace(",", ".");

            var valor_momento = parseFloat(cota);
            var valor_apostado = parseFloat(valor);

            var retorno_possivel = valor_apostado * valor_momento;

            soma_aposta = soma_aposta + valor_apostado;
            soma_retorno = soma_retorno + retorno_possivel;
        });

        console.log('soma_aposta', soma_aposta);
        console.log('soma_retorno', soma_retorno);

        //#CA3B1B

        if(soma_aposta < 10){
            $('.btn-colocar-aposta').css('background-color', '#a1a1a1');
        }else{
            $('.btn-colocar-aposta').css('background-color', '#CA3B1B');
        }

        var soma_aposta = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(soma_aposta);
        var soma_retorno = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(soma_retorno);

        $('.ca-total-aposta').html( soma_aposta );
        $('.ca-total-retorno').html( soma_retorno );
        $('#ca-total-possivel-retorno').html( soma_retorno );
        $('.valor-total-aposta').val( soma_aposta );
    }

    $('body').on('click', '.btn-colocar-aposta', function(e){
        var i = 0;

        $('.ca-item').each(function(e){
            i++;
        });

        if(i > 0){
            $('#modal_carrinho').modal('hide')
            Swal.fire({
                title: 'Confirma a Aposta?',
                text: "Tem certeza que deseja enviar as apostas selecionadas?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar Aposta',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.corpo_carrinho').html('<div class="text-center"><div class="spinner-border"><span class="sr-only">Carregando</span></div></div>');
                    window.location.href = "/carrinho/colocar-aposta";
                }
            });
        }else{

        }

    });

    $('body').on('click', '.ca-delete', function(e){
        var id = $(this).attr('data-id');

        $.ajax({
            url: '/carrinho/excluir-aposta',
            method: 'GET',
            data: {
                id: id,
            },
            success: function(res){
                if(res.status == 'ok'){
                    $('.ca-item[data-id="'+id+'"]').remove();
                    $('.cota-aposta[data-id='+res.idodds+']').removeClass('cota_selected');

                    recuperarCupomAposta();
                }
            },error: function(err){
                console.log("/carrinho/excluir-aposta --> ERRO");
                console.log(err);
            },complete: function(){
                adicionaBotaoAposta();
            }
        });
    });

    $('body').on('focusout', '.valor-total-aposta', function(e){

    });

    $('body').on('focusout', '.valor-apostado', function(e){
        var id = $(this).attr('data-id');
        var valor = $(this).val();

        var valor_format = valor.replace(".", "");
        var valor_format = valor_format.replace(",", ".");

        var valor_momento = parseFloat( $('.ca-valor-momento[data-id='+id+']').html() );
        var valor_apostado = parseFloat(valor_format);
        var retorno_possivel = valor_apostado * valor_momento;
        var retorno_possivel = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(retorno_possivel);

        $('.ca-retorno-possivel[data-id="'+id+'"]').html( retorno_possivel );

        $.ajax({
            url: '/carrinho/atualiza-aposta',
            method: 'GET',
            data: {
                id: id,
                valor: valor_format
            },
            success: function(res){

            },error: function(err){

            },complete: function(){

            }
        });

        adicionaBotaoAposta();
    });

    $('body').on('click', '.click_ir_jogo', function(e){
        var id = $(this).attr('data-id');

        window.location.href = '/events/' + id;
    });




















});
