<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | Realtime Web</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/login_asset/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/css/util.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <!-- App css -->
    <link href="/login_asset/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/login_asset/css/app.min.css" rel="stylesheet" type="text/css" />
    <!--===============================================================================================-->
</head>

<body id="body" class="auth-page" style="background-image: url('/images/p-1.png'); background-size: cover; background-position: center center;">

    <!-- Log In page -->
    <div class="container-md">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <a href="index.html" class="logo logo-admin">
                                            <img src="/images/icons/logo.png " height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Let's Get Started Realtime Chat</h4>
                                        <p class="text-muted  mb-0">Sign in</p>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <?php if (session()->getFlashdata('alert') == 'danger') { ?>
                                        <div class="alert custom-<?= session()->getFlashdata('alert') ?> custom-alert-<?= session()->getFlashdata('alert') ?> icon-custom-alert shadow-sm fade show mt-3" role="alert">
                                            <i class="mdi mdi-alert-outline alert-icon text-<?= session()->getFlashdata('alert') ?> align-self-center font-30 me-3"></i>
                                            <div class="alert-text my-1">
                                                <h5 class="mb-1 fw-bold mt-0"><?= session()->getFlashdata('judul') ?></h5>
                                                <span><?= session()->getFlashdata('pesan') ?></span>
                                            </div>
                                            <div class="alert-close">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php } else if (session()->getFlashdata('alert') == 'success') { ?>
                                        <div class="alert custom-<?= session()->getFlashdata('alert') ?> custom-alert-<?= session()->getFlashdata('alert') ?> icon-custom-alert shadow-sm fade show mt-3" role="alert">
                                            <i class="mdi mdi-checkbox-marked-outline alert-icon text-<?= session()->getFlashdata('alert') ?> align-self-center font-30 me-3"></i>
                                            <div class="alert-text my-1">
                                                <h5 class="mb-1 fw-bold mt-0"><?= session()->getFlashdata('judul') ?></h5>
                                                <span><?= session()->getFlashdata('pesan') ?></span>
                                            </div>
                                            <div class="alert-close">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <form class="my-4" action="/login/auth" method="POST">
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                                        </div>
                                        <!--end form-group-->

                                        <div class="form-group">
                                            <label class="form-label" for="userpassword">Password</label>
                                            <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
                                        </div>
                                        <!--end form-group-->

                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input" type="checkbox" id="customSwitchSuccess" name="aktif" value="1">
                                                    <label class="form-check-label" for="customSwitchSuccess">Remember me</label>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-sm-6 text-end">
                                                <a href="#" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end form-group-->

                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <button class="btn btn-primary" type="submit" name="btn">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end form-group-->
                                    </form>
                                    <!--end form-->
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end card-body-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="/vendor/jquery/jquery-3.6.0.min.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/bootstrap/js/popper.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/daterangepicker/moment.min.js"></script>
    <script src="/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="/js/main.js"></script>
    <!-- App js -->
    <script src="/login_asset/js/app.js"></script>

</body>

</html>