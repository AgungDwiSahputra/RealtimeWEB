<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!--===============================================================================================-->
    <link href="/js/dashboard/jquery-steps/jquery.steps.css" rel="stylesheet">
    <link href="/js/dashboard/jquery-steps/steps.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/dashboard/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="/css/dashboard/c3.min.css">
    <link rel="stylesheet" type="text/css" href="/css/dashboard/style.min.css">
    <link rel="stylesheet" type="text/css" href="/js/dashboard/prism/prism.css">
    <!--===============================================================================================-->
    <!-- Socket io -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.min.js"></script>
    <script src="/vendor/jquery/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

        <?= $this->include('layout/nav') ?>

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            <?= $this->renderSection('pages') ?>

            <!-- ============================================================== -->
            <!-- Footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                Copyright &copy; 2019 De Creative Agency | This website is made by <a href="https://decreativeart.com" target="_BLANK">Team De Creative</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End Footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Main wrapper  -->
    <!-- ============================================================== -->
    <div class="chat-windows"></div>

    <!--===============================================================================================-->
    <script src="/vendor/bootstrap/js/popper.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <!-- apps -->
    <script src="/js/dashboard/app.min.js"></script>
    <script src="/js/dashboard/app.init.js"></script>
    <script src="/js/dashboard/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="/js/dashboard/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/js/dashboard/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="/js/dashboard/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/js/dashboard/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/js/dashboard/custom.min.js"></script>
    <script src="/js/dashboard/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="/js/dashboard/jquery-validation/dist/jquery.validate.min.js"></script>
    <!--custome -->
    <script src="/js/dashboard/pages/dashboards/dashboard1.js"></script>
    <!-- This Page JS -->
    <script src="/js/dashboard/prism/prism.js"></script>

    <!--===============================================================================================-->
    <!-- Socket IO -->
    <script>
        <?php
        if ($get_page != null) {
        ?>
            /* Realtime Kategori */
            socket.on("add_kategori", function(data) {
                $('#MenuSoal').append("<li class='sidebar-item' id='" + data.no_kategori + "'> <a class='has-arrow sidebar-link' href='javascript:void(0)' aria-expanded='false'><i class='mdi mdi-playlist-plus'></i> <span class='hide-menu' id='NamaKategori'>" + data.kategori + "</span></a><ul aria-expanded='false' class='collapse second-level'></ul></li>");
            });
            socket.on("delete_kategori", function(data) {
                <?php
                foreach ($ListKategori as $dataList) :
                ?>
                    var no_kategori = <?= $dataList['no_kategori'] ?>;
                    if (no_kategori == data.no_kategori) {
                        var parse = '#MenuSoal #' + no_kategori;
                        $(parse).remove();
                    }
                <?php endforeach; ?>
            });
            socket.on("edit_kategori", function(data) {
                <?php
                foreach ($ListKategori as $dataList) :
                ?>
                    var no_kategori = <?= $dataList['no_kategori'] ?>;
                    if (no_kategori == data.no_kategori) {
                        var parse = '#MenuSoal #' + no_kategori;
                        $(parse + ' .NamaKategori').html(data.kategori);
                    }
                <?php endforeach; ?>
            });
        <?php
        }
        ?>
    </script>
</body>

</html>