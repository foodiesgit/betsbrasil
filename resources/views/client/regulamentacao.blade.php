

        @include('client.include_sbet')
        @yield('main-header')
        <div class="page animated" style="animation-duration: 500ms;">

        <section class="section section-sm bg-gray-100">

        <div class="container">
            <div class="player-info-main">
                <h4 class="player-info-title">Regulamentação</h4>
                <!-- <p class="player-info-subtitle"></p> -->
                <hr>
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
        <script src="js/core.min.js"></script>
        <script src="js/script.js"></script>



</body>





</html>

