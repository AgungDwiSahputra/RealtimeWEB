<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="index.html">
                <!-- Logo icon -->
                <b class="logo-icon mr-0">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="/images/icons/favicon.png" alt="homepage" class="dark-logo" width="40" />
                    <!-- Light Logo icon -->
                    <img src="/images/icons/favicon.png" alt="homepage" class="light-logo" width="40" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                    <!-- dark Logo text -->
                    <img src="/images/icons/logo-text.png" alt="homepage" class="dark-logo" width="150" />
                    <!-- Light Logo text -->
                    <img src="/images/icons/logo-text.png" class="light-logo" alt="homepage" width="150" />
                </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/images/icons/user.jpg" alt="user" class="rounded-circle" width="31"></a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow"><span class="bg-primary"></span></span>
                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white mb-2">
                            <div class=""><img src="/images/icons/user.jpg" alt="user" class="img-circle" width="60"></div>
                            <div class="ml-2">
                                <h4 class="mb-0"><?= $UserDataSession['nama'] ?></h4>
                                <p class="mb-0">Level : <?= $UserDataSession['level'] ?></p>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout"><button name="logout" class="btn" type="submit"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</button></a>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown mt-3">
                        <div class="user-pic"><img src="/images/icons/user.jpg" alt="users" class="rounded-circle" width="40" /></div>
                        <div class="user-content hide-menu ml-2">
                            <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 user-name font-medium"><?= $UserDataSession['nama'] ?></h5>
                                <span class="op-5 user-email">Level : <?= $UserDataSession['level'] ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <li class="nav-small-cap"><i class="hide-menu mdi mdi-dots-horizontal"></i> <span class="hide-menu">Menu Utama</span></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/pages/dashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/pages/perbandingan" aria-expanded="false"><i class="mdi mdi-backup-restore"></i><span class="hide-menu">Perbandingan</span></a></li>
                <?php
                if ($UserDataSession['level'] == 'admin1' || $UserDataSession['level'] == 'admin2') {
                ?>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/pages/users" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Users</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/pages/banksoal" aria-expanded="false"><i class="mdi mdi-briefcase"></i><span class="hide-menu">Manage Question</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-comment-question-outline"></i><span class="hide-menu">Group Question (User 1) </span></a>
                        <ul aria-expanded="false" class="collapse first-level" id="MenuSoal">
                            <?php
                            $no = 0;
                            foreach ($ListKategori as $kategori) {
                            ?>
                                <li class="sidebar-item" id="<?= $kategori['no_kategori'] ?>"> <a class="sidebar-link waves-effect waves-dark" href="/pages/soal/<?= $kategori['kategori'] ?>/" aria-expanded="false"><i class="mdi mdi-playlist-plus"></i> <span class="hide-menu NamaKategori"><?= $kategori['kategori'] ?></span></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php
                } else {
                ?>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-comment-question-outline"></i><span class="hide-menu">Group Question </span></a>
                        <ul aria-expanded="false" class="collapse first-level" id="MenuSoal">
                            <?php
                            $no = 0;
                            foreach ($ListKategori as $kategori) {
                            ?>
                                <li class="sidebar-item" id="<?= $kategori['no_kategori'] ?>"> <a class="sidebar-link waves-effect waves-dark" href="/pages/soal/<?= $kategori['kategori'] ?>/" aria-expanded="false"><i class="mdi mdi-playlist-plus"></i> <span class="hide-menu NamaKategori"><?= $kategori['kategori'] ?></span></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php
                }

                ?>
                <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/pages/result" aria-expanded="false"><i class="mdi mdi-bookmark-check"></i><span class="hide-menu">Result</span></a></li> -->
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->