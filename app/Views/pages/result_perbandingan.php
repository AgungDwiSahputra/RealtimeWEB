<?= $this->extend('layout/L_dashboard') ?>

<?= $this->section('pages') ?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Result Comparison</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Result Comparison</li>
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
                            <h4 class="card-title">Result Comparison</h4>
                            <h5 class="card-subtitle">the results of the Result Comparison of each question</h5>
                        </div>
                    </div>

                    <div class="container mt-3">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <table class="table w-auto">
                                    <tr>
                                        <?php
                                        foreach ($UserPerbandingan as $DataUser) {
                                        ?>
                                            <td class="p-3">
                                                <?php
                                                echo "<h4>ID User : (" . $DataUser['no_user'] . ")</h4>";
                                                foreach ($ListPerbandinganKategori as $PerbandinganKategori) {
                                                    echo '<h5 style="text-transform:uppercase;">' . $PerbandinganKategori['kategori'] . '</h5>';
                                                    foreach ($ListPerbandinganNoSoal as $PerbandinganNoSoal) {
                                                        foreach ($ListSoal as $Soal_2) {
                                                            if ($PerbandinganNoSoal['no_soal'] == $Soal_2['no_soal']) {
                                                                if ($PerbandinganNoSoal['kategori'] == $PerbandinganKategori['kategori']) {
                                                                    echo '<b>' . $Soal_2['pertanyaan'] . '</b><br>';
                                                                }
                                                            }
                                                        }
                                                        $total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; //Nilai awal Persentase 
                                                        foreach ($ListPerbandingan as $Perbandingan) {
                                                            if ($Perbandingan['no_soal'] == $PerbandinganNoSoal['no_soal']) {
                                                                if ($Perbandingan['kategori'] == $PerbandinganKategori['kategori']) {
                                                                    /* MENGHITUNG TOTAL PERSENTASE 
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
                                                                    if ($Perbandingan['hasil'] == 'A') {
                                                                        $total[0]++;
                                                                    } else if ($Perbandingan['hasil'] == 'B') {
                                                                        $total[1]++;
                                                                    } else if ($Perbandingan['hasil'] == 'C') {
                                                                        $total[2]++;
                                                                    } else if ($Perbandingan['hasil'] == 'D') {
                                                                        $total[3]++;
                                                                    } else if ($Perbandingan['hasil'] == 'E') {
                                                                        $total[4]++;
                                                                    } else if ($Perbandingan['hasil'] == 'F') {
                                                                        $total[5]++;
                                                                    } else if ($Perbandingan['hasil'] == 'G') {
                                                                        $total[6]++;
                                                                    } else if ($Perbandingan['hasil'] == 'H') {
                                                                        $total[7]++;
                                                                    }
                                                                    // Menghitung hasil perhitungan
                                                                    if ($total[2] == 0 && $total[3] == 0 && $total[4] == 0 && $total[5] == 0 && $total[6] == 0) {
                                                                        $total[8] = 0;
                                                                    } else {
                                                                        $total[8] = ($total[2] / ($total[2] + $total[3] + $total[4] + $total[5] + $total[6])) * 100;
                                                                    }
                                                                    /* END */
                                                                    echo $Perbandingan['hasil'] . '<br>';
                                                                }
                                                            }
                                                        }
                                                        if ($PerbandinganNoSoal['kategori'] == $PerbandinganKategori['kategori']) {
                                                            echo "<b>Nilai : " . round($total[8], 2) . "%</b><br>";
                                                        }
                                                    }
                                                    echo "<hr><br>";
                                                }
                                                ?>
                                            </td>
                                        <?php
                                        }

                                        foreach ($UserPerbandingan_2 as $DataUser_2) {
                                        ?>
                                            <td class="p-3">
                                                <?php
                                                // dd($ListPerbandingan_2);
                                                echo "<h4>ID User : (" . $DataUser_2['no_user'] . ")</h4>";
                                                foreach ($ListPerbandingan_2Kategori as $Perbandingan_2Kategori) {
                                                    echo '<h5 style="text-transform:uppercase;">' . $Perbandingan_2Kategori['kategori'] . '</h5>';
                                                    foreach ($ListPerbandingan_2NoSoal as $Perbandingan_2NoSoal) {
                                                        foreach ($ListSoal as $Soal_2) {
                                                            if ($Perbandingan_2NoSoal['no_soal'] == $Soal_2['no_soal']) {
                                                                if ($Perbandingan_2NoSoal['kategori'] == $Perbandingan_2Kategori['kategori']) {
                                                                    echo '<b>' . $Soal_2['pertanyaan'] . '</b><br>';
                                                                }
                                                            }
                                                        }
                                                        $total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; //Nilai awal Persentase 
                                                        foreach ($ListPerbandingan_2 as $Perbandingan_2) {
                                                            if ($Perbandingan_2['no_soal'] == $Perbandingan_2NoSoal['no_soal']) {
                                                                if ($Perbandingan_2['kategori'] == $Perbandingan_2Kategori['kategori']) {
                                                                    if ($Perbandingan_2['no_user'] == $DataUser_2['no_user']) {
                                                                        /* MENGHITUNG TOTAL PERSENTASE 
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
                                                                        if ($Perbandingan_2['hasil'] == 'A') {
                                                                            $total[0]++;
                                                                        } else if ($Perbandingan_2['hasil'] == 'B') {
                                                                            $total[1]++;
                                                                        } else if ($Perbandingan_2['hasil'] == 'C') {
                                                                            $total[2]++;
                                                                        } else if ($Perbandingan_2['hasil'] == 'D') {
                                                                            $total[3]++;
                                                                        } else if ($Perbandingan_2['hasil'] == 'E') {
                                                                            $total[4]++;
                                                                        } else if ($Perbandingan_2['hasil'] == 'F') {
                                                                            $total[5]++;
                                                                        } else if ($Perbandingan_2['hasil'] == 'G') {
                                                                            $total[6]++;
                                                                        } else if ($Perbandingan_2['hasil'] == 'H') {
                                                                            $total[7]++;
                                                                        }
                                                                        // Menghitung hasil perhitungan
                                                                        if ($total[2] == 0 && $total[3] == 0 && $total[4] == 0 && $total[5] == 0 && $total[6] == 0) {
                                                                            $total[8] = 0;
                                                                        } else {
                                                                            $total[8] = ($total[2] / ($total[2] + $total[3] + $total[4] + $total[5] + $total[6])) * 100;
                                                                        }
                                                                        /* END */
                                                                        if (isset($Perbandingan_2['hasil'])) {
                                                                            echo $Perbandingan_2['hasil'] . '<br>';
                                                                        } else {
                                                                            echo '-<br>';
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if ($Perbandingan_2NoSoal['kategori'] == $Perbandingan_2Kategori['kategori']) {
                                                            echo "<b>Nilai : " . round($total[8], 2) . "%</b><br>";
                                                        }
                                                    }
                                                    echo "<hr><br>";
                                                }


                                                // foreach ($ListKategori as $kategori_2) {
                                                //     echo '<b>' . $kategori_2['kategori'] . ' :</b><br>';
                                                //     // foreach ($ListSoal as $Soal) {
                                                //     //     if ($Soal['kategori'] == $kategori['kategori']) {
                                                //     // echo '<b>' . $Soal['pertanyaan'] . ' :</b><br>';
                                                //     foreach ($ListPerbandingan_2 as $Perbandingan_2) {
                                                //         if ($Perbandingan_2['kategori'] == $kategori_2['kategori']) {
                                                //             foreach ($ListSoal as $Soal_2) {
                                                //                 if ($Perbandingan_2['no_soal'] == $Soal_2['no_soal']) {
                                                //                     echo '<b>' . $Soal_2['pertanyaan'] . '</b><br>';
                                                //                 }
                                                //             }
                                                //             // d($Perbandingan);
                                                //             echo '<b>' . $Perbandingan_2['hasil'] . '</b><br>';
                                                //         }
                                                //     }
                                                //     //     }
                                                //     // }
                                                // }
                                                ?>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

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

<?= $this->endSection() ?>