<?= $this->extend('layout/L_dashboard') ?>

<?= $this->section('pages') ?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Result</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Result</li>
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
    <!-- Proyek Terbaru -->
    <!-- ============================================================== -->

    <div class="row">
        <div class="col-12">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Result</h4>
                            <h5 class="card-subtitle">the results of the assessment of each question</h5>
                        </div>
                    </div>
                    <?php

                    use App\Models\JawabanModel;
                    use App\Models\KategoriModel;
                    use App\Models\UsersModel;

                    if ($UserDataSession['level'] == 'admin1' || $UserDataSession['level'] == 'admin2') {
                    ?>
                        <div class="table-responsive mt-2">
                            <table class="table" id="datatable_1">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Result</th>
                                        <th>Category</th>
                                        <th>Work Date</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nomor = 1;

                                    $Jawaban = new JawabanModel();
                                    if ($ListKode != 0) {
                                        foreach (array_unique($ListKode) as $kode) {
                                            $ListJawabanWhere = $Jawaban->ListJawabanWhere("kode_pengerjaan = '$kode'");
                                            // d(count($ListJawabanWhere));
                                    ?>
                                            <tr>
                                                <td><?= $nomor ?></td>
                                                <td>
                                                    <?php
                                                    $Users = new UsersModel();
                                                    for ($no = 0; $no < count($ListJawabanWhere); $no++) {
                                                        $no_userJawab = $ListJawabanWhere[$no]['no_user'];
                                                        $NamaByJawaban = $Users->ListUsersWhere("no_user = '$no_userJawab'");
                                                    }
                                                    echo $NamaByJawaban[0]['nama'];
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    for ($no = 0; $no < count($ListJawabanWhere); $no++) {
                                                        // echo $ListJawabanWhere[$no]['no_user'];
                                                        echo $ListJawabanWhere[$no]['hasil'];
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $Kategori = new KategoriModel();
                                                    for ($no = 0; $no < count($ListJawabanWhere); $no++) {
                                                        $no_kategoriJawab = $ListJawabanWhere[$no]['kategori'];
                                                        $NamaByJawaban = $Kategori->ListKategoriWhere("no_kategori = '$no_kategoriJawab'");
                                                    }
                                                    echo $NamaByJawaban[0]['kategori'];
                                                    ?></td>
                                                <td><?= $ListJawabanWhere[0]['ttl_pengerjaan'] ?></td>
                                                <td>
                                                    <?php
                                                    $total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                                    for ($no = 0; $no < count($ListJawabanWhere); $no++) {
                                                        if ($ListJawabanWhere[$no]['hasil'] == 'A') {
                                                            $total[0]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'B') {
                                                            $total[1]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'C') {
                                                            $total[2]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'D') {
                                                            $total[3]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'E') {
                                                            $total[4]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'F') {
                                                            $total[5]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'G') {
                                                            $total[6]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'H') {
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
                                            $nomor++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    } else {
                    ?>
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
                                <tbody>
                                    <?php
                                    $nomor = 1;

                                    $Jawaban = new JawabanModel();
                                    if ($ListKodeUser != 0) {
                                        foreach (array_unique($ListKodeUser) as $kode) {
                                            $ListJawabanWhere = $Jawaban->ListJawabanWhere("kode_pengerjaan = '$kode'");
                                            // d(count($ListJawabanWhere));
                                    ?>
                                            <tr>
                                                <td><?= $nomor ?></td>
                                                <td>
                                                    <?php
                                                    for ($no = 0; $no < count($ListJawabanWhere); $no++) {
                                                        // echo $ListJawabanWhere[$no]['no_user'];
                                                        echo $ListJawabanWhere[$no]['hasil'];
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $Kategori = new KategoriModel();
                                                    for ($no = 0; $no < count($ListJawabanWhere); $no++) {
                                                        $no_kategoriJawab = $ListJawabanWhere[$no]['kategori'];
                                                        $NamaByJawaban = $Kategori->ListKategoriWhere("no_kategori = '$no_kategoriJawab'");
                                                    }
                                                    echo $NamaByJawaban[0]['kategori'];
                                                    ?></td>
                                                <td><?= $ListJawabanWhere[0]['ttl_pengerjaan'] ?></td>
                                                <td>
                                                    <?php
                                                    $total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                                    for ($no = 0; $no < count($ListJawabanWhere); $no++) {
                                                        if ($ListJawabanWhere[$no]['hasil'] == 'A') {
                                                            $total[0]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'B') {
                                                            $total[1]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'C') {
                                                            $total[2]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'D') {
                                                            $total[3]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'E') {
                                                            $total[4]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'F') {
                                                            $total[5]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'G') {
                                                            $total[6]++;
                                                        } else if ($ListJawabanWhere[$no]['hasil'] == 'H') {
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
                                            $nomor++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<!-- Socket IO -->
<script>
    var nodeServer = "<?= $nodeServer ?>";
    var socket = io.connect(nodeServer);

    var UserDataSession = "<?= $UserDataSession['level'] ?>";

    socket.on("pengerjaan", function(data) {
        if (data.key == 'mulai') {
            if (UserDataSession == 'admin1' || UserDataSession == 'admin2') {
                var nomor = <?= $nomor ?>;
                $("tbody").append("<tr><td>" + nomor + "</td><td>" + data.nama + "</td><td>,,,,,,,,,</td><td>" + data.kategori + "</td><td>" + data.ttl.date + "</td><td>0</td></tr>");
            } // } else {
            //     $("tbody").append("<tr><td>" + nomor + "</td><td>" + data.hasil + "</td><td>" + data.kategori + "</td><td>" + data.ttl + "</td><td>" + total + "</td></tr>");
            // }
        } else if (data.key == 'selesai') {
            if (UserDataSession == 'admin1' || UserDataSession == 'admin2') {
                window.location.href = "<?= base_url("/pages/result") ?>";
            }
        }
    });
</script>

<?= $this->endSection() ?>