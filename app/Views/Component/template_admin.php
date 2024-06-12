<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <base href="<?= base_url('AdminLTE') ?>/">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="dist/js/sweetalert2.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/logout') ?>" role="button">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="<?= base_url('/dashboard') ?>" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= session()->get('nama_user') ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="<?= base_url('/dashboard') ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('kategori') ?>" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p> Kategori </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('barang')  ?>" class="nav-link">
                                <i class="nav-icon fas  fa-cubes"></i>
                                <p> Barang </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('gambar_barang') ?>" class="nav-link">
                                <i class="nav-icon fas  fa-image"></i>
                                <p> Gambar Barang </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('pesanan')  ?>" class="nav-link">
                                <i class="nav-icon fas  fa-download"></i>
                                <p> Pesanan Masuk </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('laporan') ?>" class="nav-link">
                                <i class="nav-icon fa fa-file"></i>
                                <p> Laporan </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('setting') ?>" class="nav-link">
                                <i class="nav-icon fa fa-asterisk"></i>
                                <p> Setting </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('rekening') ?>" class="nav-link">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p> Rekening </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('user') ?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p> User </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('/logout_admin') ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign"></i>
                                <p> Log Out </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><?= $title ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?= $this->renderSection('content') ?>
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="dist/js/sweetalert2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        function previewImg() {
            const foto = document.querySelector('#foto')
            const fotoLabel = document.querySelector('.custom-file-label')
            const imgPreview = document.querySelector('.img-preview')

            fotoLabel.textContent = foto.files[0].name

            const fileFoto = new FileReader();

            fileFoto.readAsDataURL(foto.files[0])

            fileFoto.onload = function(e) {
                imgPreview.src = e.target.result
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                responsive: true,
                lengthChange: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                autoWidth: false,
            });
            $('#example2').DataTable({
                responsive: true,
                lengthChange: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                autoWidth: false,
            });

            // Initialize Select2 Elements
            $('.select2').select2({
                // theme: 'bootstrap4'
            });

            // Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $('[data-mask]').inputmask();
        });
    </script>

    <script>
        $(document).ready(function() {
            var flash = $('#flash').data('flash');

            if (flash) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: flash,
                });
            }
        });
    </script>


</body>

</html>