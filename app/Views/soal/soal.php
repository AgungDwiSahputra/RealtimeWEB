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
        <!-- MENU SOAL -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <!-- Sidebar scroll-->
                    <div class="scroll-sidebar" style="max-height: 50vh;">
                        <!-- Sidebar navigation-->
                        <nav class="sidebar-nav overflow-scroll">
                            <ul id="sidebarnav">
                                <?php
                                $no_soal = 0;
                                foreach ($ListKategori as $kategori) { //Perulangan untuk Kategori
                                    if ($get_page == $kategori['kategori']) { //Kondisi untuk kategori pada page sesuai dengan kategorip pada database
                                ?>

                                        <li class="sidebar-item text-dark" style="width: auto !important;"> <a class="sidebar-link has-arrow waves-effect waves-dark text-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-comment-question-outline text-dark"></i><span class="hide-menu"><?= $kategori['kategori'] ?></span></a>
                                            <ul aria-expanded="false" class="collapse first-level" id="MenuSoal" style="width: auto !important;">
                                                <?php
                                                foreach ($ListSoal as $Soal_button) { //Perulangan untuk Soal
                                                    if ($Soal_button['kategori'] == $kategori['kategori']) { //Kondisi kategori pada soal sama dengan kategori pada perulangan sblmnya
                                                        // Kondisi untuk membatasi antara penilai dan melihat
                                                        if (count($ListJawabanKdSoal) > 0) { //Kondisi ketika jawaban yang berstatus tidak itu tersedia
                                                            if ($UserDataSession['no_user'] == $ListPengerjaanKategori[0]['no_user']) {
                                                                // echo "/pages/soal/" . $get_page . "/" . $no_soal . "/mengerjakan";
                                                ?>
                                                                <li class="sidebar-item text-dark" style="width: auto !important;">
                                                                    <a href="/pages/soal/<?= $kategori['kategori'] ?>/<?= $Soal_button['no_soal'] ?>/mengerjakan/" class="sidebar-link text-dark"><i class="mdi mdi-playlist-plus text-dark"></i> <span class="hide-menu NamaKategori"><?= $Soal_button['pertanyaan'] ?></span></a>
                                                                </li>
                                                            <?php
                                                                $no_soal++;
                                                            }
                                                        } else {
                                                            // echo "/pages/soal/" . $get_page . "/" . $no_soal . "/mengerjakan";
                                                            ?>
                                                            <li class="sidebar-item text-dark" style="width: auto !important;">
                                                                <a href="/pages/soal/<?= $kategori['kategori'] ?>/<?= $Soal_button['no_soal'] ?>/mengerjakan/" class="sidebar-link text-dark"><i class="mdi mdi-playlist-plus text-dark"></i> <span class="hide-menu NamaKategori"><?= $Soal_button['pertanyaan'] ?></span></a>
                                                            </li>
                                                <?php
                                                            $no_soal++;
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </li>

                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Bagian Submit -->
            <?php
            if (count($ListJawabanKdSoal) > 0 && $get_no != '') { // Kondisi ketika sudah mulai menilai
                //TOmbol ini akan tidak ada ketika level user2
                if ($UserDataSession['level'] != 'user2') {
                    if ($UserDataSession['no_user'] == $ListPengerjaanKategori[0]['no_user']) {
            ?>
                        <div id="selesai">
                            <form action="/pages/soal/<?= $get_page ?>/<?= $get_no ?>/eksekusi" method="GET">
                                <input name="selesai" class="btn btn-warning float-right w-100 mb-2" type="submit" value="Selesai Kategori">
                                <input name="selesai" class="btn btn-info float-right w-100" type="submit" value="Selesai All Kategori">
                            </form>
                        </div>
                <?php
                    }
                }
            } else if (count($ListJawabanKdSoal) > 0 && $get_no == '') { // Kondisi ketika sudah mulai menilai namun belum memilih soal
                ?>
                <div id="selesai" class="text-center text-danger font-weight-bold">
                    <span>Pilih salah satu soal</span>
                </div>
            <?php
            }
            ?>
        </div>
        <!-- ISI PENILAIAN -->
        <?php
        if ($UserDataSession['level'] != 'user2') { //Untuk User Admin dan user1
        ?>

            <div class="col-md-9">
                <?php
                if (count($ListJawabanKdSoal) > 0) { //Kondisi ketika jawaban yang berstatus tidak itu tersedia
                    for ($i = 0; $i < count($ListJawabanKdSoalF); $i++) { //Menggunakan for untuk menyesuaikan banyaknya list jawaban dengan hasil filter no_soal yang sama
                        foreach ($ListSoal as $Soal) { //Mengulang List Soal
                            if ($Soal['no_soal'] == $ListJawabanKdSoalF[$i]['no_soal']) { //Kondisi untuk menyesuaikan no_soal
                ?>

                                <div class="card">
                                    <div class="card-body">
                                        <h3><?= $Soal['pertanyaan'] ?></h3>

                                        <!-- List Jawaban -->
                                        <h4 class="px-1 py-1 mt-2 " id="hasil<?= $ListJawabanKdSoalF[$i]['no_soal'] ?>" style="background-color: rgba(0,0,0,0.05);">
                                            <?php
                                            //Digunakan untuk mengambil data hasil pada list Jawaban
                                            $ListJawabanFinal = '';
                                            foreach ($ListJawabanKdSoal as $ListJawaban) { //Mengulang List Jawaban tanpa filter data duplikat
                                                if ($Soal['no_soal'] == $ListJawaban['no_soal']) { //Kondisi untuk menyesuaikan no_soal
                                                    if ($ListJawaban['hasil'] == 'A' || $ListJawaban['hasil'] == 'B') {
                                                        $ListJawabanFinal .= " || " . $ListJawaban['hasil'] . " || ";
                                                    } else if ($ListJawaban['hasil'] == 'C' || $ListJawaban['hasil'] == 'D' || $ListJawaban['hasil'] == 'H') {
                                                        $ListJawabanFinal .= $ListJawaban['hasil'] . " | ";
                                                    } else {
                                                        $ListJawabanFinal .= $ListJawaban['hasil'] . " ";
                                                    }
                                                }
                                            }
                                            ?>
                                            <span id="isiHasil<?= $ListJawabanKdSoalF[$i]['no_soal'] ?>"><?= $ListJawabanFinal ?></span>
                                        </h4>

                                        <!-- Progress Bar -->
                                        <?php
                                        $total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; //Nilai awal 
                                        foreach ($ListJawabanKdSoal as $ListJawaban) { //Mengulang List Jawaban tanpa filter data duplikat
                                            if ($Soal['no_soal'] == $ListJawaban['no_soal']) { //Kondisi untuk menyesuaikan no_soal
                                                /* 
                                            Total[0] = A
                                            Total[1] = B
                                            Total[2] = C
                                            Total[3] = D
                                            Total[4] = E
                                            Total[5] = F
                                            Total[6] = G
                                            Total[7] = H
                                            Total[8] = TOTAL PERHITUNGAN PENILAIAN
                                            */
                                                if ($ListJawaban['hasil'] == 'A') {
                                                    $total[0]++;
                                                } else if ($ListJawaban['hasil'] == 'B') {
                                                    $total[1]++;
                                                } else if ($ListJawaban['hasil'] == 'C') {
                                                    $total[2]++;
                                                } else if ($ListJawaban['hasil'] == 'D') {
                                                    $total[3]++;
                                                } else if ($ListJawaban['hasil'] == 'E') {
                                                    $total[4]++;
                                                } else if ($ListJawaban['hasil'] == 'F') {
                                                    $total[5]++;
                                                } else if ($ListJawaban['hasil'] == 'G') {
                                                    $total[6]++;
                                                } else if ($ListJawaban['hasil'] == 'H') {
                                                    $total[7]++;
                                                }
                                            }
                                        }
                                        // Menghitung hasil perhitungan
                                        if ($total[2] == 0 && $total[3] == 0 && $total[4] == 0 && $total[5] == 0 && $total[6] == 0) {
                                            $total[8] = 0;
                                        } else {
                                            $total[8] = ($total[2] / ($total[2] + $total[3] + $total[4] + $total[5] + $total[6])) * 100;
                                        }

                                        /* REALTIME PROGRESS */
                                        if ($Soal['no_soal'] == $ListJawaban['no_soal']) { //Kondisi untuk menyesuaikan no_soal
                                            if ($UserDataSession['no_user'] == $ListPengerjaanKategori[0]['no_user']) {
                                                $client->initialize();
                                                $client->emit('progress', ['total' => $total[8], 'no_soal' => $ListJawabanKdSoalF[$i]['no_soal']]);
                                                $client->close();
                                            }
                                        }
                                        ?>
                                        <!-- Progres Bar -->
                                        <div id="progress-bar<?= $ListJawabanKdSoalF[$i]['no_soal'] ?>" class="progress-bar <?php if ($total[8] < 80) {
                                                                                                                                echo "bg-warning";
                                                                                                                            } else if ($total[8] >= 80) {
                                                                                                                                echo "bg-info";
                                                                                                                            } ?>" role="progressbar" style="width: <?= $total[8] ?>%;height:20px;">
                                            <!-- Display -->
                                            <span class="<?php if ($total[8] == 0) {
                                                                echo "text-dark";
                                                            } ?>"><?= $total[8] ?>%
                                            </span>
                                        </div>
                                    </div>
                                </div>

                    <?php
                            }
                        }
                    }
                    ?>

                    <div class="card">
                        <div class="card-body">
                            <form id="FormPenilaian" action="/pages/soal/<?= $get_page ?>/<?= $get_no ?>/eksekusi" method="GET">
                                <!-- INPUT UNTUK PENYIMPANAN DATA TOMBOL PENILAIAN -->
                                <input type="text" name="jawab" id="jawaban" hidden>
                                <!-- FOKUS NO SOAL -->
                                <?php
                                foreach ($ListSoal as $Soal_Jawaban) { //Mengulang List Soal
                                    if ($Soal_Jawaban['no_soal'] == $Soal_GET) { //Kondisi untuk menyesuaikan no_soal
                                        // Kondisi untuk membatasi antara penilai dan melihat
                                        if ($UserDataSession['no_user'] == $ListPengerjaanKategori[0]['no_user']) {
                                ?>
                                            <h3 class="mb-4"><?= $Soal_Jawaban['pertanyaan'] ?></h3>

                                    <?php
                                        } else {
                                            echo "<h3 class='text-danger'=>Hanya Dapat Melihat</h3>";
                                        }
                                    }
                                }

                                /* Perbedaan ketika sudah mulai mengerjakan */
                                if (count($ListJawabanKdSoal) > 0 && $get_no != '') { //Kondisi ketika sudah mulai mengerjakan
                                    ?>

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
                                                <button class="btn btn-warning" name="undo" type="submit" value="undo">Undo</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else if (count($ListJawabanKdSoal) > 0 && $get_no == '') { //Kondisi ketika sudah mulai mengerjakan namun belum memilih soal
                                ?>
                                    <div class="text-center text-danger font-weight-bold">Pilih salah satu soal</div>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        <?php
            /* ================================================ */
            /* END BAGIAN ADMIN DAN USER1 */
            /* ================================================ */
        } else { //Untuk Level user2
        ?>

            <div class="col-md-9">
                <?php
                /* PENGERJAAN */
                if (count($ListPengerjaanKategori) > 0) {
                    /* Kondisi ketika List Jawaban lebih dari 0 */
                    /* Mengklik tombol mengerjakan pada soal ini */
                    if (count($ListJawabanKdSoal_2) > 0) { //Kondisi ketika jawaban yang berstatus tidak itu tersedia
                ?>
                        <div class="container">
                            <div class="row">
                                <?php
                                for ($i = 0; $i < count($ListPengerjaanKategori); $i++) { //Untuk mengambil semua data List Pengerjaan
                                    foreach ($ListSoal as $Soal_Pengerjaan) {
                                        if ($Soal_Pengerjaan['no_soal'] == $ListPengerjaanKategori[$i]['no_soal']) {
                                            // d($ListJawabanKdSoalF_2[$z]['no_soal']);
                                            // d($Soal_Pengerjaan['no_soal']);
                                ?>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h3><?= $Soal_Pengerjaan['pertanyaan'] ?></h3>

                                                        <form id="FormPenilaian" action="/pages/soal/<?= $get_page ?>/<?= $ListPengerjaanKategori[$i]['no_soal'] ?>/eksekusi" method="GET">
                                                            <button class="btn btn-info d-block ml-auto" type="submit" name="pengerjaan" value="pengerjaan">Mulai Menilai</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                            break;
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        for ($i = 0; $i < count($ListJawabanKdSoalF_2); $i++) { //Menggunakan for untuk menyesuaikan banyaknya list jawaban dengan hasil filter no_soal yang sama
                            foreach ($ListSoal as $Soal) { //Mengulang List Soal
                                if ($Soal['no_soal'] == $ListJawabanKdSoalF_2[$i]['no_soal']) { //Kondisi untuk menyesuaikan no_soal
                        ?>

                                    <div class="card">
                                        <div class="card-body">
                                            <h3><?= $Soal['pertanyaan'] ?></h3>

                                            <!-- List Jawaban -->
                                            <h4 class="px-1 py-1 mt-2" style="background-color: rgba(0,0,0,0.05);">
                                                <?php
                                                //Digunakan untuk mengambil data hasil pada list Jawaban
                                                foreach ($ListJawabanKdSoal_2 as $ListJawaban) { //Mengulang List Jawaban tanpa filter data duplikat
                                                    if ($Soal['no_soal'] == $ListJawaban['no_soal']) { //Kondisi untuk menyesuaikan no_soal
                                                        if ($ListJawaban['hasil'] == 'A' || $ListJawaban['hasil'] == 'B') {
                                                            echo $ListJawaban['hasil'] = " || " . $ListJawaban['hasil'] . " || ";
                                                        } else if ($ListJawaban['hasil'] == 'C' || $ListJawaban['hasil'] == 'D' || $ListJawaban['hasil'] == 'H') {
                                                            echo $ListJawaban['hasil'] = $ListJawaban['hasil'] . " | ";
                                                        } else {
                                                            echo $ListJawaban['hasil'] = $ListJawaban['hasil'] . " ";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </h4>

                                            <!-- Progress Bar -->
                                            <?php
                                            $total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; //Nilai awal 
                                            foreach ($ListJawabanKdSoal_2 as $ListJawaban) { //Mengulang List Jawaban tanpa filter data duplikat
                                                if ($Soal['no_soal'] == $ListJawaban['no_soal']) { //Kondisi untuk menyesuaikan no_soal
                                                    /* 
                                                Total[0] = A
                                                Total[1] = B
                                                Total[2] = C
                                                Total[3] = D
                                                Total[4] = E
                                                Total[5] = F
                                                Total[6] = G
                                                Total[7] = H
                                                Total[8] = TOTAL PERHITUNGAN PENILAIAN
                                                */
                                                    if ($ListJawaban['hasil'] == 'A') {
                                                        $total[0]++;
                                                    } else if ($ListJawaban['hasil'] == 'B') {
                                                        $total[1]++;
                                                    } else if ($ListJawaban['hasil'] == 'C') {
                                                        $total[2]++;
                                                    } else if ($ListJawaban['hasil'] == 'D') {
                                                        $total[3]++;
                                                    } else if ($ListJawaban['hasil'] == 'E') {
                                                        $total[4]++;
                                                    } else if ($ListJawaban['hasil'] == 'F') {
                                                        $total[5]++;
                                                    } else if ($ListJawaban['hasil'] == 'G') {
                                                        $total[6]++;
                                                    } else if ($ListJawaban['hasil'] == 'H') {
                                                        $total[7]++;
                                                    }
                                                }
                                            }
                                            // Menghitung hasil perhitungan
                                            if ($total[2] == 0 && $total[3] == 0 && $total[4] == 0 && $total[5] == 0 && $total[6] == 0) {
                                                $total[8] = 0;
                                            } else {
                                                $total[8] = ($total[2] / ($total[2] + $total[3] + $total[4] + $total[5] + $total[6])) * 100;
                                            }
                                            ?>
                                            <!-- Progres Bar -->
                                            <div id="progress-bar" class="progress-bar <?php if ($total[8] < 80) {
                                                                                            echo "bg-warning";
                                                                                        } else if ($total[8] >= 80) {
                                                                                            echo "bg-info";
                                                                                        } ?>" role="progressbar" style="width: <?= $total[8] ?>%;height:20px;">
                                                <!-- Display -->
                                                <span class="<?php if ($total[8] == 0) {
                                                                    echo "text-dark";
                                                                } ?>"><?= $total[8] ?>%
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                        <?php
                                }
                            }
                        }
                        /* END KONDISI LIST JAWABAN LEBIH DARI 0 */
                    } else { //Kondisi ketika List Jawaban = 0
                        ?>
                        <div class="container">
                            <div class="row">
                                <?php
                                for ($i = 0; $i < count($ListPengerjaanKategori); $i++) { //Untuk mengambil semua data List Pengerjaan
                                    foreach ($ListSoal as $Soal_Pengerjaan) {
                                        if ($Soal_Pengerjaan['no_soal'] == $ListPengerjaanKategori[$i]['no_soal']) {
                                ?>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h3><?= $Soal_Pengerjaan['pertanyaan'] ?></h3>

                                                        <form id="FormPenilaian" action="/pages/soal/<?= $get_page ?>/<?= $ListPengerjaanKategori[$i]['no_soal'] ?>/eksekusi" method="GET">
                                                            <button class="btn btn-info d-block ml-auto" type="submit" name="pengerjaan" value="pengerjaan">Mulai Menilai</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                }

                /* LEMBAR PENILAIAN */
                if (count($ListJawabanKdSoal_2) > 0) { //Jika List Jawaban Tersedia
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <form id="FormPenilaian_2" action="/pages/soal/<?= $get_page ?>/<?= $get_no ?>/eksekusi" method="GET">
                                <!-- INPUT UNTUK PENYIMPANAN DATA TOMBOL PENILAIAN -->
                                <input type="text" name="jawab" id="jawaban_2" hidden>
                                <!-- FOKUS NO SOAL -->
                                <?php
                                foreach ($ListSoal as $Soal_Jawaban) { //Mengulang List Soal
                                    if ($Soal_Jawaban['no_soal'] == $Soal_GET) { //Kondisi untuk menyesuaikan no_soal
                                ?>
                                        <h3 class="mb-4"><?= $Soal_Jawaban['pertanyaan'] ?></h3>

                                    <?php
                                    }
                                }

                                /* Perbedaan ketika sudah mulai mengerjakan */
                                if (count($ListJawabanKdSoal_2) > 0 && $get_no != '') { //Kondisi ketika sudah mulai mengerjakan
                                    ?>

                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-info mx-1" type="button" name="a" onclick="nilai_2('A')">A</button><button class="btn btn-sm btn-info mx-1" type="button" name="b" onclick="nilai_2('B')">B</button>
                                    </div>
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-info mx-1" type="button" name="c" onclick="nilai_2('C')">C</button><button class="btn btn-sm btn-info mx-1" type="button" name="d" onclick="nilai_2('D')">D</button>
                                        <button class="btn btn-sm btn-info mx-1" type="button" name="e" onclick="nilai_2('E')">E</button><button class="btn btn-sm btn-info mx-1" type="button" name="f" onclick="nilai_2('F')">F</button>
                                        <button class="btn btn-sm btn-info mx-1" type="button" name="g" onclick="nilai_2('G')">G</button>
                                    </div>
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-info mx-1" type="button" name="h" onclick="nilai_2('H')">H</button>
                                    </div>
                                    <div class="container-fluid mt-3">
                                        <div class="row">
                                            <div class="col-6 p-0">
                                                <button class="btn btn-warning" name="undo" type="submit" value="undo">Undo</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else if (count($ListJawabanKdSoal_2) > 0 && $get_no == '') { //Kondisi ketika sudah mulai mengerjakan namun belum memilih soal
                                ?>
                                    <div class="text-center text-danger font-weight-bold">Pilih salah satu soal</div>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        <?php
            /* ================================================ */
            /* END BAGIAN USER2 */
            /* ================================================ */
        }
        ?>
    </div>
</div>

<!-- SCRIPT UNTUK MEMULAI PENGERJAAN -->
<script type="text/javascript">
    // var jml_karakter = '';
    // var space = '';
    // var nilai_asli = '';
    // var nilai = document.getElementById("isiHasil3").innerText;
    // for (var i = 0; i < nilai.length; i++) {
    //     space += nilai[i].replace(' ', '');
    //     // nilai_asli = nilai[i].replace('|', '');
    // }
    // console.log(space);
    // for (var i = 0; i < space.length; i++) {
    //     nilai_asli += space[i].replace('|', '');
    //     // nilai_asli = nilai[i].replace('|', '');
    // }
    // console.log(nilai_asli);
    // console.log(nilai_asli[nilai_asli.length - 1]);
    // if (nilai_asli[nilai_asli.length - 1] == 'A' || nilai_asli[nilai_asli.length - 1] == 'B') {
    //     jml_karakter += " || " + nilai_asli[nilai_asli.length - 1] + " || ";
    // } else if (nilai_asli[nilai_asli.length - 1] == 'C' || nilai_asli[nilai_asli.length - 1] == 'D' || nilai_asli[nilai_asli.length - 1] == 'H') {
    //     jml_karakter += nilai_asli[nilai_asli.length - 1] + " | ";
    // } else {
    //     jml_karakter += nilai_asli[nilai_asli.length - 1] + " ";
    // }
    // console.log(jml_karakter);
    // console.log(jml_karakter.length);

    // var nilaiBaru = nilai.slice(0, -(parseInt(jml_karakter)));
    // console.log(nilaiBaru);
    /*   VARIABEL PUBLIC  */
    // Socket IO
    var nodeServer = "<?= $nodeServer ?>";
    var socket = io.connect(nodeServer);
    /* ================== */

    /* PROSES REALTIME */
    socket.on("progress", function(data) {
        //Progres Bar
        var progress = document.getElementById('progress-bar' + data.no_soal);
        var status = '';
        if (data.total < 80) {
            status = 'bg-warning';
        } else if (data.total >= 80) {
            status = 'bg-info';
        }
        progress.classList = "progress-bar " + status;
        progress.style = "width: " + data.total + "%;height:20px;";
        progress.innerHTML = data.total + "%";
    });

    socket.on("hasil_jawab", function(data) {
        //Untuk Soal Membaca
        var nilai = document.getElementById("hasil" + data.no_soal).innerHTML;
        if (data.jawaban == 'A' || data.jawaban == 'B') {
            nilai += " || " + data.jawaban + " || ";
        } else if (data.jawaban == 'C' || data.jawaban == 'D' || data.jawaban == 'H') {
            nilai += data.jawaban + " | ";
        } else {
            nilai += data.jawaban + " ";
        }
        document.getElementById("hasil" + data.no_soal).innerHTML = nilai;
        document.getElementById("jawab").value = data.jawaban;
    });
    socket.on("undo_jawab", function(data) {
        //Untuk Soal Membaca
        var jml_karakter = '';
        var space = '';
        var nilai_asli = '';
        var nilai = document.getElementById("isiHasil" + data.no_soal).innerHTML;
        /* Menghapus space dan | (garis tegak) */
        for (var i = 0; i < nilai.length; i++) {
            space += nilai[i].replace(' ', '');
        }
        console.log(space);
        for (var i = 0; i < space.length; i++) {
            nilai_asli += space[i].replace('|', '');
        }
        console.log(nilai_asli);
        /* ======================================= */
        if (nilai_asli[nilai_asli.length - 1] == 'A' || nilai_asli[nilai_asli.length - 1] == 'B') {
            jml_karakter += " || " + nilai_asli[nilai_asli.length - 1] + " || ";
        } else if (nilai_asli[nilai_asli.length - 1] == 'C' || nilai_asli[nilai_asli.length - 1] == 'D' || nilai_asli[nilai_asli.length - 1] == 'H') {
            jml_karakter += nilai_asli[nilai_asli.length - 1] + " | ";
        } else {
            jml_karakter += nilai_asli[nilai_asli.length - 1] + " ";
        }
        nilai = nilai.slice(0, -(parseInt(jml_karakter.length)));
        document.getElementById("hasil" + data.no_soal).innerHTML = nilai;
        document.getElementById("jawab").value = data.jawaban;
        console.log(nilai);
    });

    socket.on("hasil_Tjawab", function(data) {
        window.location.href = "/pages/soal/" + data.kategori + "/" + data.no_soal;
    });

    socket.on("selesai", function(data) {
        window.location.href = "<?= base_url("/pages/soal/$get_page/") ?>";
    });

    socket.on("selesai_kategori", function(data) {
        window.location.href = "<?= base_url("/pages/soal/$get_page/") ?>";
    });
    /* =============== */

    <?php
    if (count($ListJawabanKdSoal) > 0) { // Kondisi ketika sudah mulai menilai
        foreach ($ListKategori as $kategori) {
            if ($get_page == $kategori['kategori']) {
                if ($UserDataSession['level'] != 'user2') {
    ?>
                    /* Variabel-variabel */
                    var data_user = <?php echo $UserDataSession['no_user'] ?>;
                    var jawab_user = <?php echo $ListJawabanKdSoal[0]['no_user'] ?>;
                    var btn_nilai = document.getElementsByTagName("button");
                    /* ================= */
                    /* Block tombol penilaian jika ada yang sedang mnegerjakan */
                    if (jawab_user != data_user) { // Kondisi jika user pengerjaan soal berbeda dengan user login
                        for (let i = 0; i < 11; i++) {
                            btn_nilai[i].setAttribute("disabled", true);
                        }
                    }

                    /* UNTUK ACTION BUTTON PENILAIAN A s/d H */
                    function nilai($n) { //KOndisi jika button penlaian di klik
                        document.getElementById("jawaban").value = $n;
                        console.log(document.getElementById("jawaban").value);
                        $("#FormPenilaian").submit();
                    }
                <?php
                }
                ?>
                /* UNTUK ACTION BUTTON PENILAIAN A s/d H */
                function nilai_2($n) { //KOndisi jika button penlaian di klik
                    document.getElementById("jawaban_2").value = $n;
                    console.log(document.getElementById("jawaban_2").value);
                    $("#FormPenilaian_2").submit();
                }
                // Foreach End
    <?php
            }
        }
    }
    ?>
</script>
<!-- =============================================================== -->
<?= $this->endSection() ?>