        @include('client.include_sbet')
		@yield('main-header')
        <link href="/assets3/css/icons.css" rel="stylesheet" />
        <link href="/assets3/plugins/sidebar/sidebar.css" rel="stylesheet" />
        <link href="/assets3/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" />
        <link href="/assets3/css/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="/assets3/css/lite.css">
        <link href="/assets3/switcher/css/switcher.css" rel="stylesheet" />
        <link href="/assets3/switcher/demo.css" rel="stylesheet" />
        <link href="/assets3/css/floo.css" rel="stylesheet" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

        
<style>
  a {
    text-decoration: none;
  }
  .float{
      position:fixed;
      width:60px;
      height:60px;
      bottom:40px;
      right:40px;
      background-color:#fff;
      color:#FFF;
      border-radius:50px;
      text-align:center;
      box-shadow: 2px 2px 3px #999;
      }
  .my-float{
    margin-top:11px;

  }
.autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
</style>
        <div class="page animated" style="animation-duration: 50ms;">

        <section class="section section-sm bg-gray-100">

        <div class="container">
            <div class="player-info-main">
					<article class="heading-component">
                    <div class="heading-component-inner">
                      <h5 class="heading-component-title">INFORMA????ES DO BILHETE</h5>
                    </div>
                  </article>
                <div class="player-info-table">
                    <div class="table-custom-wrap">
                    @yield('alert')
                        <div class="form-group">
                                <?php echo $dados->regulamento; ?>
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

        <script src="/assets3/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

        <script src="/assets3/js/sticky.js"></script>

        <script src="/assets3/plugins/sidebar/sidebar.js"></script>

        <script src="/assets3/plugins/sidebar/sidebar-custom.js"></script>

        <script src="/assets3/js/custom.js"></script>

        <script src="/assets3/switcher/js/switcher.js"></script>



        <div class="snackbars" id="form-output-global"></div>
        <!-- Javascript-->
        <script src="/js/core.min.js"></script>
        <script src="/js/script.js"></script>



</body>





</html>

