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
                        <li class="breadcrumb-item"><a href="index.php?page=dashboard">Dashboard</a></li>
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
        <div class="col-md-5">
            <?php

            use App\Models\UsersModel;

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
            <div class="card card-hover">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Add User</h4>
                            <h5 class="card-subtitle">add user for your needs.</h5>
                        </div>
                    </div>
                    <form class="mt-2" action="/add/user" method="POST">
                        <div class="mb-2">
                            <label for="name" class="mb-2">Name</label>
                            <input class="form-control" type="text" id="name" name="nama" placeholder="Enter Name" required>
                        </div>
                        <div class="mb-2">
                            <label for="username" class="mb-2">Username</label>
                            <input class="form-control" type="text" id="username" name="username" placeholder="Enter Username" required>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="mb-2">Password</label>
                            <input class="form-control" type="text" id="password" name="password" placeholder="Enter password" required>
                        </div>
                        <div class="mb-4">
                            <label class="mb-2">Level</label>
                            <select id="default" name="level" class="form-control" required>
                                <option value="">Select available level...</option>
                                <option value="admin2">Admin Level 2</option>
                                <option value="user1">User Level 1</option>
                                <option value="user2">User Level 2</option>
                            </select>
                        </div><!-- end col -->
                        <button type="submit" class="btn btn-info" name="tambahAkun">Add User</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($listUserAdmin1 as $dataList) :
                                ?>
                                    <tr id="<?= $dataList['no_user'] ?>">
                                        <td class="no"><?= $no ?></td>
                                        <td class="nama"><?= $dataList['nama'] ?></td>
                                        <td class="username"><?= $dataList['username'] ?></td>
                                        <td class="level"><?= $dataList['level'] ?></td>
                                        <td>
                                            <a href="/pages/users/edit/<?= $dataList['no_user'] ?>"><i class="fas fa-pencil-alt text-success me-1" data-toggle="modal" data-target="#edit"></i></a>
                                            <?php
                                            if ($UserDataSession['level'] == 'admin1') {
                                            ?>
                                                |
                                                <a href="/delete/user/<?= $dataList['no_user'] ?>"><i class="fas fa-trash-alt text-danger ms-1"></i></a>
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
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="EditForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="EditForm">Edit Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form-validation-2" class="form" action="" method="POST">
                    <div class="form-group">
                        <labelU for="noU">No. User</labelU>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="noU" id="noU" value="'.$id.'" readonly>
                        </div>
                    </div>
                    <!--end form-group-->

                    <div class="form-group">
                        <label for="name">Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="nama" value="'.$r['nama'].'" id="name">
                        </div>
                    </div>
                    <!--end form-group-->

                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="username" value="'.$r['username'].'" id="username">
                        </div>
                    </div>
                    <!--end form-group-->

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="password" id="password" placeholder="Enter New Password">
                        </div>
                    </div>
                    <!--end form-group-->

                    <div class="form-group">
                        <label class="mb-2">Level</label>
                        <select class="form-control" id="default" name="level">
                            <option value="'.$r['level'].'">'.$level.'</option>
                            <option value="admin2">Admin Level 2</option>
                            <option value="user1">User Level 1</option>
                            <option value="user2">User Level 2</option>
                        </select>
                    </div>
                    <!--end form-group-->

                    <div class="form-group mb-0 row mt-3">
                        <div class="col-12 mt-2">
                            <div class="d-grid">
                                <button class="btn btn-info" type="submit" name="edit">Edit Account</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end form-group-->
                </form>
                <!--end form-->
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- ======================================================================= -->
<!-- REALTIME Socket.io-->
<!-- ======================================================================= -->
<script>
    var nodeServer = "<?= $nodeServer ?>";
    var socket = io.connect(nodeServer);
    var UserDataSession = "<?= $UserDataSession['level'] ?>";
    var no = <?= $no ?>;

    socket.on("add_user", function(data) {
        var no_user = data.no_user;
        if (UserDataSession == 'admin1') {
            $("tbody").append("<tr><td>" + no + "</td><td>" + data.nama + "</td><td>" + data.username + "</td><td>" + data.level + "</td><td><a href='/pages/users/edit/" + no_user + "'><i class='fas fa-pencil-alt text-success me-1' data-toggle='modal' data-target='#edit'></i></a> | <a href='/delete/user/" + no_user + "'><i class='fas fa-trash-alt text-danger ms-1'></i></a></tr>");
        } else if (UserDataSession == 'admin2') {
            $("tbody").append("<tr><td>" + no + "</td><td>" + data.nama + "</td><td>" + data.username + "</td><td>" + data.level + "</td><td><a href='/pages/users/edit/" + no_user + "'><i class='fas fa-pencil-alt text-success me-1' data-toggle='modal' data-target='#edit'></i></a></tr>");
        }
        no++;
    });
    socket.on("delete_user", function(data) {
        <?php
        foreach ($listUserAdmin1 as $dataList) :
        ?>
            var no_user = <?= $dataList['no_user'] ?>;
            if (no_user == data.no_user) {
                var parse = 'tbody tr[id=' + no_user + ']';
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