<?= $this->extend('layout/L_dashboard') ?>

<?= $this->section('pages') ?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Users</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/pages/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                            <h4 class="card-title">Edit User</h4>
                            <h5 class="card-subtitle">edit user for your needs.</h5>
                        </div>
                    </div>
                    <form class="mt-2" action="/edit/user" method="POST">
                        <div class="mb-2">
                            <label for="no" class="mb-2">No. User</label>
                            <input class="form-control" type="text" id="no" name="no_user" value="<?= $UserByID['no_user'] ?>" readonly required>
                        </div>
                        <div class="mb-2">
                            <label for="name" class="mb-2">Name</label>
                            <input class="form-control" type="text" id="name" name="nama" value="<?= $UserByID['nama'] ?>" required>
                        </div>
                        <div class="mb-2">
                            <label for="username" class="mb-2">Username</label>
                            <input class="form-control" type="text" id="username" name="username" value="<?= $UserByID['username'] ?>" required>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="mb-2">Password</label>
                            <input class="form-control" type="text" id="password" name="password" value="<?= $UserByID['password'] ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="mb-2">Level</label>
                            <select id="default" name="level" class="form-control" required>
                                <?php
                                if ($UserByID['level'] == 'admin2') {
                                    $level = "Admin Level 2";
                                } else if ($UserByID['level'] == 'user1') {
                                    $level = "User Level 1";
                                } else {
                                    $level = "User Level 2";
                                }
                                ?>
                                <option value="<?= $UserByID['level'] ?>"><?= $level ?></option>
                                <option value="admin2">Admin Level 2</option>
                                <option value="user1">User Level 1</option>
                                <option value="user2">User Level 2</option>
                            </select>
                        </div><!-- end col -->
                        <button type="submit" class="btn btn-info" name="edituser">Edit User</button>
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
    socket.on("edit_user", function(data) {
        $('form input[name=nama]').val(data.nama);
        $('form input[name=username]').val(data.username);
        $('form input[name=password]').val(data.password);
        $('form input[name=level]').val(data.level);
    });
</script>

<?= $this->endSection() ?>