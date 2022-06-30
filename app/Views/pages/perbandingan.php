<?= $this->extend('layout/L_dashboard') ?>

<?= $this->section('pages') ?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Comparison</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Comparison</li>
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
                            <h4 class="card-title">Comparison</h4>
                            <h5 class="card-subtitle">the results of the comparison of each question</h5>
                        </div>
                    </div>

                    <div class="container mt-3">
                        <div class="row justify-content-center">
                            <?php
                            if ($UserDataSession['level'] == 'user2') {
                                foreach ($ListPerbandingan_2 as $data) {
                            ?>
                                    <a href="/pages/perbandingan/<?= $data['ttl_selesai'] ?>"><button type="button" class="btn btn-info mx-2 mt-2"><b><?= $data['ttl_selesai'] ?></b></button></a>
                                <?php
                                }
                            } else {
                                foreach ($ListPerbandingan as $data) {
                                ?>
                                    <a href="/pages/perbandingan/<?= $data['ttl_selesai'] ?>"><button type="button" class="btn btn-info mx-2 mt-2"><b><?= $data['ttl_selesai'] ?></b></button></a>
                            <?php
                                }
                            }
                            ?>
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