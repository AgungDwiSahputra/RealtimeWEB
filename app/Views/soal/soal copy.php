<?= $this->extend('layout/L_dashboard') ?>

<?= $this->section('pages') ?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Question</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Question</li>
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
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <!-- Sidebar scroll-->
                    <div class="scroll-sidebar" style="max-height: 50vh;">
                        <!-- Sidebar navigation-->
                        <nav class="sidebar-nav overflow-scroll">
                            <ul id="sidebarnav">
                                <?php
                                $no = 0;
                                foreach ($ListKategori as $kategori) {
                                    if ($get_page == $kategori['kategori']) {
                                ?>
                                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark text-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-playlist-plus text-dark"></i><span class="hide-menu"><?= $kategori['kategori'] ?> </span></a>
                                            <ul aria-expanded="false" class="collapse  first-level">
                                                <?php
                                                foreach ($ListSoal as $Soal) {
                                                    if ($Soal['kategori'] == $kategori['kategori']) {
                                                        if ($ListJawabanByKdPengerjaan != null) {
                                                ?>
                                                            <?php
                                                            if (session()->get('lihat') == null) {
                                                            ?>
                                                                <form id="LihatPengerjaan" action="/pages/soal/<?= $KategoriByJawaban[0]['kategori']  ?>/<?= $get_no ?>/lihat" method="post">
                                                                    <li class="sidebar-item" onclick="lihat_pengerjaan()"><a href="javascript:void(0)" class="sidebar-link text-dark"><i class="mdi mdi-octagram text-dark"></i><span class="hide-menu"> <?= $no + 1 ?>. <?= $Soal['pertanyaan'] ?> </span></a>
                                                                    </li>
                                                                </form>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <li class="sidebar-item"><a href="/pages/soal/<?= $KategoriByJawaban[0]['kategori']  ?>/<?= $no + 1 ?>" class="sidebar-link text-dark"><i class="mdi mdi-octagram text-dark"></i><span class="hide-menu"> <?= $no + 1 ?>. <?= $Soal['pertanyaan'] ?> </span></a></li>
                                                            <?php
                                                            }
                                                            $no++;
                                                        } else {
                                                            ?>
                                                            <!-- <form id="MulaiMengerjakan" action="" method="post"> -->
                                                            <li class="sidebar-item"><a href="/pages/soal/<?= $kategori['kategori'] ?>/<?= $no + 1 ?>/mengerjakan/1" class="sidebar-link text-dark"><i class="mdi mdi-octagram text-dark"></i><span class="hide-menu"> <?= $no + 1 ?>. <?= $Soal['pertanyaan'] ?> </span></a></li>
                                                            <!-- </form> -->
                                                <?php
                                                            $no++;
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        </form>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </nav>
                        <!-- End Sidebar navigation -->
                    </div>
                    <!-- End Sidebar scroll-->
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php
                        //session()->remove('mengerjakan');
                        //dd(session()->get('mengerjakan'));
                        if ($ListJawabanByStatus != null) {
                            if ($UserDataSession['no_user'] == $ListJawabanByKdPengerjaan[0]['no_user']) {
                                // dd($KategoriByJawaban[0]['kategori']);
                        ?>
                                <form action="/pages/soal/<?= $KategoriByJawaban[0]['kategori'] ?>/<?= $get_no ?>/eksekusi" method="POST">
                                    <input type="submit" name="selesai" class="btn btn-info float-right w-100" value="selesai">
                                </form>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <?php
                    foreach ($ListKategori as $kategori) {
                        if ($get_page == $kategori['kategori']) {
                            if ($ListJawabanByStatus == null) {
                                if (session()->get('no_jawaban') != '') {
                                    session()->remove('no_jawaban');
                                }
                                session()->remove('lihat');
                            } else {
                                if ($get_page != $KategoriByJawaban[0]['kategori']) {
                                    $kategori = $KategoriByJawaban[0]['kategori'];
                                    exit(header("Location:/pages/soal/$kategori/1"));
                                }
                                if ($UserDataSession['no_user'] == $ListJawabanByKdPengerjaan[0]['no_user']) {
                                    $data = [
                                        'lihat' => 'Aktif'
                                    ];
                                    session()->set($data);
                                }
                                if (session()->get('lihat') == null) {
                                    $JawabNoUser = $ListJawabanByKdPengerjaan[0]['no_user'];
                                    $data_pengerja = $UserByJawaban[0];
                    ?>
                                    <h3 class="my-4 ml-4 text-center">Soal <?= $get_page ?> sedang dikerjakan oleh : <br><b><?= $data_pengerja['nama'] ?></b></h3>
                                    <?php
                                } else {
                                    if ($get_page != $KategoriByJawaban[0]['kategori']) {
                                        exit(header("Location:/pages/soal/$kategori/1"));
                                    }
                                    /* MEMBUAT SESSION NO_JAWABAN */
                                    if ($ListJawabanByKdPengerjaan != null) {
                                        if (session()->get('no_jawaban') == '') {
                                            session()->set(['no_jawaban' => $ListJawabanByKdPengerjaan[0]['no_jawaban']]);
                                        }
                                    }

                                    // List Soal
                                    $n = 1;
                                    $List_Soal[0] = $ListSoalByKategori[0]['pertanyaan'];
                                    foreach ($ListSoalByKategori as $DataList) {
                                        $List_Soal[$n] = $DataList['pertanyaan'];
                                        $n++;
                                    }
                                    for ($no = 0; $no < $jumlahSoal; $no++) {
                                        if ($get_no != '') {
                                            if ($get_no == $no + 1) {
                                    ?>
                                                <h6 class="card-subtitle">
                                                    <h3 class="mt-1">
                                                        <?php
                                                        //echo $no+1;
                                                        echo $List_Soal[$no + 1];
                                                        ?>
                                                    </h3>
                                                    <div class="progress mt-3" style="height: 20px;">
                                                        <?php
                                                        if ($ListJawabanByStatus != null) {
                                                            $total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                                            for ($no = 0; $no < count($K_NoSoal_Status); $no++) {
                                                                if ($hasil[$no]['hasil'] == 'A') {
                                                                    $total[0]++;
                                                                } else if ($hasil[$no]['hasil'] == 'B') {
                                                                    $total[1]++;
                                                                } else if ($hasil[$no]['hasil'] == 'C') {
                                                                    $total[2]++;
                                                                } else if ($hasil[$no]['hasil'] == 'D') {
                                                                    $total[3]++;
                                                                } else if ($hasil[$no]['hasil'] == 'E') {
                                                                    $total[4]++;
                                                                } else if ($hasil[$no]['hasil'] == 'F') {
                                                                    $total[5]++;
                                                                } else if ($hasil[$no]['hasil'] == 'G') {
                                                                    $total[6]++;
                                                                } else if ($hasil[$no]['hasil'] == 'H') {
                                                                    $total[7]++;
                                                                }
                                                            }
                                                            if ($total[2] == 0 && $total[3] == 0 && $total[4] == 0 && $total[5] == 0 && $total[6] == 0) {
                                                                $total[8] = 0;
                                                            } else {
                                                                $total[8] = ($total[2] / ($total[2] + $total[3] + $total[4] + $total[5] + $total[6])) * 100;
                                                            }
                                                        } else {
                                                            $total[8] = 0;
                                                        }
                                                        //echo $total[8];
                                                        if ($UserDataSession['no_user'] == $ListJawabanByKdPengerjaan[0]['no_user']) {
                                                            $client->initialize();
                                                            $client->emit('progress', ['total' => $total[8]]);
                                                            $client->close();
                                                        }
                                                        ?>
                                                        <div id="progress-bar" class="progress-bar <?php if ($total[8] < 80) {
                                                                                                        echo "bg-warning";
                                                                                                    } else if ($total[8] >= 80) {
                                                                                                        echo "bg-info";
                                                                                                    } ?>" role="progressbar" style="width: <?= $total[8] ?>%;height:20px;"> <?= $total[8] ?></div>
                                                    </div>
                                                    <div class="mt-4 bg-secondary p-2">
                                                        <?php
                                                        if (count($ListJawabanByKdPengerjaan) > 0) {
                                                            for ($no = 0; $no < count($K_NoSoal_Status); $no++) {
                                                                if ($hasil[$no]['hasil'] == 'A' || $hasil[$no]['hasil'] == 'B') {
                                                                    $hasil[$no]['hasil'] = " || " . $hasil[$no]['hasil'] . " || ";
                                                                } else if ($hasil[$no]['hasil'] == 'C' || $hasil[$no]['hasil'] == 'D' || $hasil[$no]['hasil'] == 'H') {
                                                                    $hasil[$no]['hasil'] = $hasil[$no]['hasil'] . " | ";
                                                                } else {
                                                                    $hasil[$no]['hasil'] = $hasil[$no]['hasil'] . " ";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <h4 class="text-light m-0">
                                                            <?php
                                                            // dd($hasil[0]['hasil']);
                                                            for ($no = 0; $no < count($K_NoSoal_Status); $no++) {
                                                            ?>
                                                                <span id="hasil<?= $no ?>"><?php if ($hasil[$no]['hasil'] != '') {
                                                                                                echo $hasil[$no]['hasil'];
                                                                                            } ?></span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </h4>
                                                    </div>
                                                </h6>
                    <?php
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="card">
                <?php
                if (session()->get('lihat') != null) {
                ?>
                    <div class="card-body">
                        <form id="FormPenilaian" action="/pages/soal/<?= $get_page ?>/<?= $get_no ?>/eksekusi" method="POST">
                            <!-- INPUT UNTUK PENYIMPANAN DATA TOMBOL PENILAIAN -->
                            <input type="text" name="jawab" id="jawaban">

                            <div class="mt-2">
                                <button class="btn btn-sm btn-info mx-1" type="button" name="a" onclick="nilai('A')">A</button><button class="btn btn-sm btn-info mx-1" type="button" name="b" onclick="nilai('B')">B</button>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-info mx-1" type="button" name="c" onclick="nilai('C')">C</button><button class="btn btn-sm btn-info mx-1" type="button" name="d" onclick="nilai('D')">D</button>
                                <button class="btn btn-sm btn-info mx-1" type="button" name="e" onclick="nilai('E')">E</button><button class="btn btn-sm btn-info mx-1" type="button" name="f" onclick="nilai('F')">F</button>
                                <button class="btn btn-sm btn-info mx-1" type="button" name="g" onclick="nilai('G')">G</button>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-info mx-1" type="button" name="h" onclick="nilai('H')">H</button>
                            </div>
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-6 p-0">
                                        <button class="btn btn-warning" name="undo<?= $get_no ?>" type="submit" value="undo">Undo</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

<script>
    /* SOCKET IO */
    // Socket IO
    var nodeServer = "<?= $nodeServer ?>";
    var socket = io.connect(nodeServer);

    socket.on("progress", function(data) {
        //Progres Bar
        var progress = document.getElementById('progress-bar');
        if (data.total < 80) {
            var status = 'bg-warning';
        } else if (data.total >= 80) {
            var status = 'bg-info';
        }
        progress.class = "progress-bar " + status;
        progress.style = "width: " + data.total + "%;height:20px;";
        progress.innerHTML = data.total;
    });

    socket.on("hasil_jawab", function(data) {
        //Untuk Soal Membaca
        var nilai = document.getElementById("hasil" + (parseInt(data.no_soal) - 1)).innerHTML;
        if (data.jawaban == 'A' || data.jawaban == 'B') {
            nilai = " || " + data.jawaban + " || ";
        } else if (data.jawaban == 'C' || data.jawaban == 'D' || data.jawaban == 'H') {
            nilai = data.jawaban + " | ";
        } else {
            nilai = data.jawaban + " ";
        }
        document.getElementById("hasil" + (parseInt(data.no_soal) - 1)).innerHTML = nilai;
        document.getElementById("jawab" + (parseInt(data.no_soal) - 1)).value = data.jawaban;
    });

    socket.on("pengerjaan", function(data) {
        <?php
        if (count($K_NoJawaban_Status) != 0) {
            $noClick = (int)$K_NoJawaban_Status[0]['no_soal'][4];
        ?>
            window.location.href = "<?= base_url("/pages/soal/$get_page/$noClick") ?>";
        <?php
        }
        ?>
    });
    socket.on("selesai", function(data) {
        window.location.href = "<?= base_url("/pages/soal/$get_page/1") ?>";
    });
</script>

<!-- JavaScript Pengelola SOal -->
<?php
if (count($hasil) > 0) { //EKsekusi jika sudah memulai mengerjakan
?>
    <script>
        console.log('Coba');
        <?php
        foreach ($ListKategori as $kategori) {
            if ($get_page == $kategori['kategori']) {
        ?>
                var data_user = <?php echo $UserDataSession['no_user'] ?>;
                var jawab_user = <?php echo $ListJawabanByKdPengerjaan[0]['no_user'] ?>;
                var btn_nilai = document.getElementsByTagName("button");
                var no_soal = <?php echo $get_no ?>;
                var jumlahSoal = "<?= count($K_NoSoal_Status) ?>";

                /* Block tombol penilaian jika ada yang sedang mnegerjakan */
                if (jawab_user != data_user) { // Kondisi jika user pengerjaan soal berbeda dengan user login
                    for (let i = 0; i < 11; i++) {
                        btn_nilai[i].setAttribute("disabled", true);
                    }
                } else { // Eksekusi khusus user pengerjaan soal sesuai dengan user login
                    const jawaban = [];
                    <?php //Membuat variabel jawaban JavaScript dengan variabel hasil yang ada di PHP
                    if ($get_page == $kategori['kategori']) {
                        for ($no = 0; $no < count($K_NoSoal_Status); $no++) {
                    ?>
                            var no = "<?= $no ?>";
                            jawaban[parseInt(no)] = "<?= $hasil[$no]['hasil'] ?>";
                            // Ekseskusi Block tombol penilaian A s/d H jika sudah ada jawaban
                            // if (jawaban[parseInt(no)] !== ' ' && no_soal == parseInt(no) + 1) {
                            //     for (let i = 0; i < 9; i++) {
                            //         btn_nilai[i].setAttribute("disabled", true);
                            //         //btn_nilai[i].removeAttribute("disabled");
                            //     }
                            // }
                    <?php
                        }
                    }
                    ?>
                } //Syntax JavaScript


                /* UNTUK ACTION BUTTON PENILAIAN A s/d H */
                function nilai($n) {
                    <?php
                    if ($get_page == $kategori['kategori']) {
                    ?>
                        //Untuk Soal
                        for (no = 0; no < jumlahSoal; no++) {
                            var nilai = "";
                            if ($n == 'A' || $n == 'B') {
                                nilai = " || " + $n + " || ";
                            } else if ($n == 'C' || $n == 'D' || $n == 'H') {
                                nilai = $n + " | ";
                            } else {
                                nilai = $n + " ";
                            }
                            // document.getElementById("hasil").innerHTML = nilai;
                            document.getElementById("jawaban").value = $n;
                            console.log(document.getElementById("jawaban").value);
                            $("#FormPenilaian").submit();
                        }
                    <?php
                    }
                    ?>
                }
                // Foreach End
        <?php
            }
        }
        ?>

        function lihat_pengerjaan() {
            console.log("Lihat Mengerjakan");
            $("#LihatPengerjaan").submit();
        }
    </script>
<?php
} else {
?>
    <script>
        function mulai_mengerjakan() {
            console.log("Mulai Mengerjakan");
            $("#MulaiMengerjakan").submit();
        }
    </script>
<?php
}
?>
<!-- =============================================================== -->
<?= $this->endSection() ?>