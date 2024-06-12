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

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md" style="background-color: #2FA0B5;">
            <div class="container">
                <a href="<?= base_url() ?>" class="navbar-brand">
                    <i class="fas fa-store text-white"></i>
                    <span class="brand-text font-weight-light text-white"><b>Reglow Store</b></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= base_url('/') ?>" class="nav-link text-white">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-white">Kategori</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <?php foreach ($kategori as $key => $value) { ?>
                                    <li><a href="<?= base_url('/kategori_barang/' . $value->id_kategori) ?>" class="dropdown-item text-dark"> <?= $value->nama_kategori ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/about') ?>" class="nav-link text-white">About</a>
                        </li>
                        <li class="nav-item">
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-warning ml-2" type="submit">Search</button>
                            </form>
                        </li>
                    </ul>
                </div>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">

                        <?php if (session()->get('email') == "") { ?>
                            <a class="nav-link" href="<?= base_url('/pelanggan') ?>">
                                <span class="brand-text font-weight-light text-white">Login/Register</span>
                                <img src="<?= base_url('assets/foto/profil.png') ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
                            </a>

                        <?php } else { ?>
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <span class="brand-text font-weight-light text-white"><?= session()->get('nama_pelanggan')  ?></span>
                                <img src="<?= base_url('assets/foto/profil.png') ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('profil_saya/' . session()->get('id_pelanggan')) ?>" class="dropdown-item">
                                    <i class="fas fa-shopping-cart mr-2 text-white"></i>Profil Saya
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('pesanan_saya') ?>" class="dropdown-item">
                                    <i class="fas fa-shopping-cart mr-2 text-white"></i>Pesanan Saya
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('/logout')  ?>" class="dropdown-item dropdown-footer">Log Out</a>
                            </div>
                        <?php } ?>
                    </li>
                    <?php
                    $keranjang = $cart->contents();
                    $jml_item = 0;
                    foreach ($keranjang as $key => $value) {
                        $jml_item = $jml_item + $value['qty'];
                    }
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-shopping-cart text-white"></i>
                            <span class="badge badge-danger navbar-badge"><?= $jml_item ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <?php if (empty($keranjang)) { ?>
                                <a href="#" class="dropdown-item">
                                    <p>Keranjang Belanja Kosong</p>
                                </a>
                                <?php } else {
                                foreach ($keranjang as $key => $value) {
                                    $id = $value['id'];
                                ?>
                                    <a href="#" class="dropdown-item">
                                        <div class="media">
                                            <img src="<?= base_url('assets/gambar/' . $value['image']) ?>" alt="User Avatar" class="img-size-50 mr-3">
                                            <div class="media-body">
                                                <h3 class="dropdown-item-title">
                                                    <?= $value['name'] ?>
                                                </h3>
                                                <p class="text-sm"><?= $value['qty'] ?> x Rp.<?= number_format($value['price'], 0) ?></p>
                                                <p class="text-sm text-muted">
                                                    <i class="fa fa-calculator"></i> Rp.<?= number_format($value['subtotal'], 0); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                <?php }
                                ?>
                                <a href="#" class="dropdown-item">
                                    <div class="media">
                                        <div class="media-body">
                                            <tr>
                                                <td colspan="2"> </td>
                                                <td class="right"><strong>Total:</strong> Rp.<?= number_format($cart->total(), 0) ?></td>
                                            </tr>
                                        </div>
                                    </div>
                                </a>

                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('/cek_keranjang') ?>" class="dropdown-item dropdown-footer">View Cart</a>
                                <a href="<?= base_url('belanja/cekout') ?>" class="dropdown-item dropdown-footer">Check Out</a>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> <?= $title ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Toko Online</a></li>
                                <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
                            </ol>
                        </div>
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="<?= base_url('assets/slider/slider1.jpg') ?>">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?= base_url('assets/slider/slider2.jpg') ?>">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?= base_url('assets/slider/slider3.jpg') ?>">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?= base_url('assets/slider/slider4.jpg') ?>">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container">
                    <div class="row">
                        <?= $this->renderSection('content') ?>
                    </div>
                </div>
            </div>

            <footer class="main-footer text-center text-white" style="background-color: #2FA0B5;">
                <strong style="color : white;">Copyright &copy; 2024 <a href="" class="text-white">Samuel </a>.</strong> All rights reserved.
            </footer>
        </div>
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