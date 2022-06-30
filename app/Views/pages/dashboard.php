<?= $this->extend('layout/L_dashboard') ?>

<?= $this->section('pages') ?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Dashboard</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Users -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <?php
            $no = 1; //Variabel Public
            if (session()->getFlashdata('alert') == 'danger') { ?>
                <div class="alert alert-<?= session()->getFlashdata('alert') ?>">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="text-<?= session()->getFlashdata('alert') ?>"><i class="fa fa-check-circle"></i> <?= session()->getFlashdata('judul') ?></h3> <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php } else if (session()->getFlashdata('alert') == 'success') { ?>
                <div class="alert alert-<?= session()->getFlashdata('alert') ?>">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="text-<?= session()->getFlashdata('alert') ?>"><i class="fa fa-exclamation-triangle"></i> <?= session()->getFlashdata('judul') ?></h3> <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php } ?>
            <div id="carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active"> <img class="img-fluid" src="/images/slider/hero-1.jpg" alt="First slide"> </div>
                    <div class="carousel-item"> <img class="img-fluid" src="/images/slider/hero-1.jpg" alt="Second slide"> </div>
                    <div class="carousel-item"> <img class="img-fluid" src="/images/slider/hero-1.jpg" alt="Third slide"> </div>
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
            </div>
            <div class="card card-hover">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <img src="/images/icons/user.jpg" alt="" style="width: 20vw;max-width:50px;">
                        </div>
                        <div class="col-9">
                            <div class="align-items-center align-self-center align-content-center">
                                <h4><b>Hello, <?= $UserDataSession['nama'] ?></b></h4>
                                <span>Level : <?= $UserDataSession['level'] ?></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
        if ($UserDataSession['level'] == 'admin1' || $UserDataSession['level'] == 'admin2') {
        ?>
            <div class="col-md-6">
                <div class="card card-hover">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Users</h4>
                                <h5 class="card-subtitle">All Users</h5>
                            </div>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table" id="datatable_1">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                    </tr>
                                </thead>
                                <tbody id="tambah_data">
                                    <?php
                                    if ($UserDataSession['level'] == 'admin2') {
                                        foreach ($listUserAdmin2 as $dataList) :
                                    ?>
                                            <tr id="<?= $dataList['no_user'] ?>">
                                                <td class="no"><?= $no ?></td>
                                                <td class="nama"><?= $dataList['nama'] ?></td>
                                                <td class="username"><?= $dataList['username'] ?></td>
                                                <td class="level"><?= $dataList['level'] ?></td>
                                            </tr>
                                        <?php
                                            $no++;
                                        endforeach;
                                    } else {
                                        foreach ($listUserAdmin1 as $dataList) :
                                        ?>
                                            <tr id="<?= $dataList['no_user'] ?>">
                                                <td class="no"><?= $no ?></td>
                                                <td class="nama"><?= $dataList['nama'] ?></td>
                                                <td class="username"><?= $dataList['username'] ?></td>
                                                <td class="level"><?= $dataList['level'] ?></td>
                                            </tr>
                                    <?php
                                            $no++;
                                        endforeach;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-hover">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Result</h4>
                                <h5 class="card-subtitle">the results of the assessment of each question</h5>
                            </div>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table" id="datatable_1">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Result</th>
                                        <th>Category</th>
                                        <th>Work Date</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody class="isi_data">
                                    <?php
                                    foreach ($ListJawaban as $dataList) :
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td>
                                                <?php
                                                $no_userJawab = $dataList['no_user'];
                                                $NamaByJawaban = $UserModel->ListUsersWhere("no_user = '$no_userJawab'");
                                                echo $NamaByJawaban[0]['nama'];
                                                ?></td>
                                            <td><?= $dataList['hasil'] ?></td>
                                            <td><?= $dataList['kategori'] ?></td>
                                            <td><?= $dataList['ttl_pengerjaan'] ?></td>
                                            <td>
                                                <?php
                                                $hasilList = explode(",", $dataList['hasil']);
                                                $total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                                for ($no = 0; $no < count($hasilList); $no++) {
                                                    if ($hasilList[$no] == 'A') {
                                                        $total[0]++;
                                                    } else if ($hasilList[$no] == 'B') {
                                                        $total[1]++;
                                                    } else if ($hasilList[$no] == 'C') {
                                                        $total[2]++;
                                                    } else if ($hasilList[$no] == 'D') {
                                                        $total[3]++;
                                                    } else if ($hasilList[$no] == 'E') {
                                                        $total[4]++;
                                                    } else if ($hasilList[$no] == 'F') {
                                                        $total[5]++;
                                                    } else if ($hasilList[$no] == 'G') {
                                                        $total[6]++;
                                                    } else if ($hasilList[$no] == 'H') {
                                                        $total[7]++;
                                                    }
                                                }
                                                if ($total[2] == 0 && $total[3] == 0 && $total[4] == 0 && $total[5] == 0 && $total[6] == 0) {
                                                    $total[8] = 0;
                                                } else {
                                                    $total[8] = ($total[2] / ($total[2] + $total[3] + $total[4] + $total[5] + $total[6])) * 100;
                                                }
                                                echo $total[8];
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="col-md-6">
                <div class="card card-hover">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Result</h4>
                                <h5 class="card-subtitle">the results of the assessment of each question</h5>
                            </div>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table" id="datatable_1">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Result</th>
                                        <th>Category</th>
                                        <th>Work Date</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody class="ListPengerjaan">
                                    <?php
                                    foreach ($JawabanUsers as $dataList) :
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $dataList['hasil'] ?></td>
                                            <td><?= $dataList['kategori'] ?></td>
                                            <td><?= $dataList['ttl_pengerjaan'] ?></td>
                                            <td>
                                                <?php
                                                $hasilList = explode(",", $dataList['hasil']);
                                                $total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                                for ($no = 0; $no < count($hasilList); $no++) {
                                                    if ($hasilList[$no] == 'A') {
                                                        $total[0]++;
                                                    } else if ($hasilList[$no] == 'B') {
                                                        $total[1]++;
                                                    } else if ($hasilList[$no] == 'C') {
                                                        $total[2]++;
                                                    } else if ($hasilList[$no] == 'D') {
                                                        $total[3]++;
                                                    } else if ($hasilList[$no] == 'E') {
                                                        $total[4]++;
                                                    } else if ($hasilList[$no] == 'F') {
                                                        $total[5]++;
                                                    } else if ($hasilList[$no] == 'G') {
                                                        $total[6]++;
                                                    } else if ($hasilList[$no] == 'H') {
                                                        $total[7]++;
                                                    }
                                                }
                                                if ($total[2] == 0 && $total[3] == 0 && $total[4] == 0 && $total[5] == 0 && $total[6] == 0) {
                                                    $total[8] = 0;
                                                } else {
                                                    $total[8] = ($total[2] / ($total[2] + $total[3] + $total[4] + $total[5] + $total[6])) * 100;
                                                }
                                                echo $total[8];
                                                ?>

                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <!-- ============================================================== -->
    <!-- End Users -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- Socket IO -->
<script>
    var nodeServer = "<?= $nodeServer ?>";
    var socket = io.connect(nodeServer);

    var UserDataSession = "<?= $UserDataSession['level'] ?>";
    var no = <?= $no ?>;

    socket.on("pengerjaan", function(data) {
        if (data.key == 'mulai') {
            if (UserDataSession == 'admin1' || UserDataSession == 'admin2') {
                var no = <?= $no ?>;
                $(".ListPengerjaan").append("<tr><td>" + no + "</td><td>" + data.nama + "</td><td>,,,,,,,,,</td><td>" + data.kategori + "</td><td>" + data.ttl.date + "</td><td>0</td></tr>");
            } // } else {
            //     $("tbody").append("<tr><td>" + no + "</td><td>" + data.hasil + "</td><td>" + data.kategori + "</td><td>" + data.ttl + "</td><td>" + total + "</td></tr>");
            // }
        } else if (data.key == 'selesai') {
            if (UserDataSession == 'admin1' || UserDataSession == 'admin2') {
                window.location.href = "<?= base_url("/pages/dashboard") ?>";
            }
        }
    });

    socket.on("add_user", function(data) {
        // var no_user = data.no_user;
        if (UserDataSession == 'admin1') {
            $("tbody[id=tambah_data]").append("<tr><td>" + no + "</td><td>" + data.nama + "</td><td>" + data.username + "</td><td>" + data.level + "</td></tr>");
        } else if (UserDataSession == 'admin2') {
            if (data.level != 'admin2') {
                $("tbody[id=tambah_data]").append("<tr><td>" + no + "</td><td>" + data.nama + "</td><td>" + data.username + "</td><td>" + data.level + "</td></tr>");
            }
        }

        no++;
    });

    socket.on("delete_user", function(data) {
        <?php
        foreach ($listUserAdmin1 as $dataList) :
        ?>
            var no_user = <?= $dataList['no_user'] ?>;
            if (no_user == data.no_user) {
                var parse = 'tbody #' + no_user;
                var coba = $(parse).remove();
            }

        <?php endforeach; ?>
    });

    socket.on("edit_user", function(data) {
        <?php
        foreach ($listUserAdmin1 as $dataList) :
        ?>
            var no_user = <?= $dataList['no_user'] ?>;
            if (no_user == data.no_user) {
                var parse = 'tbody #' + no_user;
                $(parse + ' .nama').html(data.nama);
                $(parse + ' .username').html(data.username);
                $(parse + ' .level').html(data.level);
            }
        <?php endforeach; ?>

    });
</script>

<?= $this->endSection() ?>