@include('client.include_sbet')

<link href="/assets3/css/icons.css" rel="stylesheet" />

<link href="/assets3/plugins/sidebar/sidebar.css" rel="stylesheet" />

<link href="/assets3/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" />

<link href="/assets3/css/style.css" rel="stylesheet" />

<link href="/assets3/css/style-dark.css" rel="stylesheet" />

<link rel="stylesheet" href="/assets3/css/lite.css">


<link href="/assets3/switcher/css/switcher.css" rel="stylesheet" />

<link href="/assets3/switcher/demo.css" rel="stylesheet" />

<link href="/assets3/css/animate.css" rel="stylesheet" />
<link href="/assets3/css/floo.css" rel="stylesheet" />
@yield('main-header')
<div class="page animated" style="animation-duration: 500ms;">

<section class="section section-sm bg-gray-100">

    <div class="container">
        <div class="player-info-main">
            <h4 class="player-info-title">Informações do bilhete</h4>
            <!-- <p class="player-info-subtitle"></p> -->
            <hr>
            <div class="player-info-table">
                <div class="table-custom-wrap">
                @yield('alert')

                    <div class="form-group">
                            <label for="exampleInputEmail1">Codigo do Bilhete</label>
                            <input type="text" class="form-control" name="bilhete" id="bilhete">
                            <small id="emailHelp" class="form-text text-muted">Informe o codigo de acesso que se encontra em seu bilhete</small>
                            </br>
                            <button  id="btnVerificar" class="btn btn-primary">Verificar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
</div>


<script src="/assets3/plugins/jquery/jquery.min.js"></script>

<script src="/assets3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/assets3/plugins/ionicons/ionicons.js"></script>

<script src="/assets3/plugins/moment/moment.js"></script>

<script src="/assets3/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="/assets3/plugins/perfect-scrollbar/p-scroll.js"></script>

<script src="/assets3/js/eva-icons.min.js"></script>

<script src="/assets3/plugins/rating/jquery.rating-stars.js"></script>

<script src="/assets3/plugins/rating/jquery.barrating.js"></script>

<script src="/assets3/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js"></script>

<script src="/assets3/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

<script src="/assets3/js/sticky.js"></script>

<script src="/assets3/plugins/sidebar/sidebar.js"></script>

<script src="/assets3/plugins/sidebar/sidebar-custom.js"></script>

<script src="/assets3/js/custom.js"></script>

<script src="/assets3/switcher/js/switcher.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous"></script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



<div class="snackbars" id="form-output-global"></div>
<!-- Javascript-->
<script src="/js/core.min.js"></script>
<script src="/js/script.js"></script>

<script>
$(document).ready(function(e){

        $('#btnVerificar').click(function(e){

        var bilhete = $('#bilhete').val();
        window.location.href = "/verifica-bilhete/"+bilhete;
        });

    });
</script>
</body>





</html>

