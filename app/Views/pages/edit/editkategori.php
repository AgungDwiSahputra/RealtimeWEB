<?= $this->extend('layout/L_dashboard') ?>

<?= $this->section('pages') ?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Bank Soal</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/pages/dahsboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bank Soal</li>
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
        <div class="col-md-12">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Edit Category</h4>
                            <h5 class="card-subtitle">edit category for your needs.</h5>
                        </div>
                    </div>
                    <form class="mt-2" action="/edit/kategori" method="POST">
                        <div class="mb-2">
                            <label for="no" class="mb-2">No. Category</label>
                            <input class="form-control" type="text" id="no" name="no_kategori" value="<?= $KategoriByID['no_kategori'] ?>" readonly required>
                        </div>
                        <div class="mb-2">
                            <label for="kategori" class="mb-2">Kategori</label>
                            <input class="form-control" type="text" id="kategori" name="kategori" value="<?= $KategoriByID['kategori'] ?>" required>
                        </div>
                        <button type="submit" class="btn btn-info" name="editsoal">Edit Soal</button>
                    </form>
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
    socket.on("edit_kategori", function(data) {
        $('form input[name=kategori]').val(data.kategori);
    });
</script>

<?= $this->endSection() ?>