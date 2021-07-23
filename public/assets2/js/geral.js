$(document).ready(function(e){
    $('body').on('click', '.click_ir_jogo', function(e){
        var id = $(this).attr('data-id');
        window.location.href = "/events/"+id+"";
    });
});