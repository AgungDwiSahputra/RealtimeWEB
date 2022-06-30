<?= $this->extend('layout/L_dashboard') ?>

<?= $this->section('pages') ?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Manage Questions</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Questions</li>
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
        <div class="col-md-5">
            <?php if (session()->getFlashdata('alert') == 'danger') { ?>
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
            <div class="card card-hover">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Add Question</h4>
                            <h5 class="card-subtitle">add question for your needs.</h5>
                        </div>
                    </div>
                    <form class="mt-2" action="/add/banksoal" method="POST">
                        <div class="mb-2">
                            <label for="pertanyaan" class="mb-2">Question</label>
                            <input class="form-control" type="text" id="pertanyaan" name="pertanyaan" placeholder="Enter Question" required>
                        </div>
                        <div class="mb-4">
                            <label class="mb-2">Category</label>
                            <select id="default" name="kategori" class="form-control" required>
                                <option value="">Select available category...</option>
                                <?php foreach ($ListKategori as $List) : ?>
                                    <option value="<?= $List['kategori'] ?>"><?= $List['kategori'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><!-- end col -->
                        <button type="submit" class="btn btn-info" name="tambahPertanyaan">Add Question</button>
                    </form>
                </div>
            </div>

            <div class="card card-hover">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Add Category</h4>
                            <h5 class="card-subtitle">add category for your needs.</h5>
                        </div>
                    </div>
                    <form class="mt-2" action="/add/kategori" method="POST">
                        <div class="mb-2">
                            <label for="kategori" class="mb-2">Question Category</label>
                            <input class="form-control" type="text" id="kategori" name="kategori" placeholder="Enter Category ..." required>
                        </div>
                        <button type="submit" class="btn btn-info" name="tambahPertanyaan">Add Category</button>
                    </form>

                    <!-- Tabel Category -->
                    <div class="table-responsive mt-3">
                        <table class="table" id="datatable_1">
                            <thead class="thead-light">
                                <tr>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="ListKategori">
                                <?php
                                foreach ($ListKategori as $List) :
                                ?>
                                    <tr id="<?= $List['no_kategori'] ?>">
                                        <td class="kategori"><?= $List['kategori'] ?></td>
                                        <td style="width: 100px;">
                                            <a href="/pages/kategori/edit/<?= $List['no_kategori'] ?>"><i class="fas fa-pencil-alt text-success me-1"></i></a>
                                            <?php
                                            if ($UserDataSession['level'] == 'admin1') {
                                            ?>
                                                |
                                                <a href="/delete/kategori/<?= $List['no_kategori'] ?>"><i class="fas fa-trash-alt text-danger ms-1"></i></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Questions</h4>
                            <h5 class="card-subtitle">All Questions</h5>
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table" id="datatable_1">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Question</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="ListSoal">
                                <?php
                                $no = 1;
                                foreach ($ListSoal as $dataList) :
                                ?>
                                    <tr id="<?= $dataList['no_soal'] ?>">
                                        <td><?= $no ?></td>
                                        <td class="pertanyaan"><?= $dataList['pertanyaan'] ?></td>
                                        <td class="kategori"><?= $dataList['kategori'] ?></td>
                                        <td>
                                            <a href="/pages/banksoal/edit/<?= $dataList['no_soal'] ?>"><i class="fas fa-pencil-alt text-success me-1"></i></a>
                                            <?php
                                            if ($UserDataSession['level'] == 'admin1') {
                                            ?>
                                                |
                                                <a href="/delete/soal/<?= $dataList['no_soal'] ?>"><i class="fas fa-trash-alt text-danger ms-1"></i></a>
                                            <?php
                                            }
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
    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ======================================================================= -->
<!-- REALTIME Socket.io-->
<!-- ======================================================================= -->
<script>
    var nodeServer = "<?= $nodeServer ?>";
    var socket = io.connect(nodeServer);
    var UserDataSession = "<?= $UserDataSession['level'] ?>";
    var no = <?= $no ?>;

    socket.on("add_soal", function(data) {
        var no_soal = data.no_soal;
        if (UserDataSession == 'admin1') {
            $("#ListSoal").append("<tr><td>" + no + "</td><td>" + data.pertanyaan + "</td><td>" + data.kategori + "</td><td><a href='/pages/banksoal/edit/" + no_soal + "'><i class='fas fa-pencil-alt text-success me-1' data-toggle='modal' data-target='#edit'></i></a> | <a href='/delete/soal/" + no_soal + "'><i class='fas fa-trash-alt text-danger ms-1'></i></a>");
        } else if (UserDataSession == 'admin2') {
            $("#ListSoal").append("<tr><td>" + no + "</td><td>" + data.pertanyaan + "</td><td>" + data.kategori + "</td><td><a href='/pages/banksoal/edit/" + no_soal + "'><i class='fas fa-pencil-alt text-success me-1' data-toggle='modal' data-target='#edit'></i></a>");
        }
        no++;
    });
    socket.on("delete_soal", function(data) {
        <?php
        foreach ($ListSoal as $dataList) :
        ?>
            var no_soal = <?= $dataList['no_soal'] ?>;
            if (no_soal == data.no_soal) {
                var parse = '#ListSoal #' + no_soal;
                var coba = $(parse).remove();
            }
        <?php endforeach; ?>
    });
    socket.on("edit_soal", function(data) {
        <?php
        foreach ($ListSoal as $dataList) :
        ?>
            var no_soal = <?= $dataList['no_soal'] ?>;
            if (no_soal == data.no_soal) {
                var parse = '#ListSoal #' + no_soal;
                $(parse + ' .pertanyaan').html(data.pertanyaan);
                $(parse + ' .kategori').html(data.kategori);
            }
        <?php endforeach; ?>
    });

    /* Realtime Kategori */
    socket.on("add_kategori", function(data) {
        var no_kategori = data.no_kategori;
        if (UserDataSession == 'admin1') {
            $("#ListKategori").append("<tr><td>" + data.kategori + "</td><td><a href='/pages/banksoal/edit/" + no_kategori + "'><i class='fas fa-pencil-alt text-success me-1' data-toggle='modal' data-target='#edit'></i></a> | <a href='/delete/kategori/" + no_kategori + "'><i class='fas fa-trash-alt text-danger ms-1'></i></a>");
        } else if (UserDataSession == 'admin2') {
            $("#ListKategori").append("<tr><td>" + data.kategori + "</td><td><a href='/pages/banksoal/edit/" + no_kategori + "'><i class='fas fa-pencil-alt text-success me-1' data-toggle='modal' data-target='#edit'></i></a>");
        }
        no++;
    });
    socket.on("delete_kategori", function(data) {
        <?php
        foreach ($ListKategori as $dataList) :
        ?>
            var no_kategori = <?= $dataList['no_kategori'] ?>;
            if (no_kategori == data.no_kategori) {
                var parse = '#ListKategori #' + no_kategori;
                var coba = $(parse).remove();
            }
        <?php endforeach; ?>
    });
    socket.on("edit_kategori", function(data) {
        <?php
        foreach ($ListKategori as $dataList) :
        ?>
            var no_kategori = <?= $dataList['no_kategori'] ?>;
            if (no_kategori == data.no_kategori) {
                var parse = '#ListKategori #' + no_kategori;
                $(parse + ' .kategori').html(data.kategori);
            }
        <?php endforeach; ?>
    });
</script>

<?= $this->endSection() ?>