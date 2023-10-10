<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Assets IT</title>

    <!-- bootstrap 5 css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <!-- BOX ICONS CSS-->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <!-- custom css -->
    <link rel="stylesheet" href="/assets/css/dashboard/sadditem.css" />
    <link rel="stylesheet" href="/assets/css/dashboard/dashboard.css" />
</head>

<body>
    <!-- Side-Nav -->
    <div class="side-navbar d-flex justify-content-between flex-wrap flex-column" id="sidebar">
        <ul class="nav flex-column text-white w-100 ">
            <a href="#" class="nav-link h3 text-white my-2">
                SPL
            </a>
            <li class="nav-link ">
                <a href="<?= site_url("/dashboard") ?>" class="text-decoration-none text-light">
                    <i class="bx bxs-dashboard "></i><span class="mx-2">Dashboard</span></a>
            </li>
            <li>
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link text-light">
                    <i class='bx bxs-component'></i><span class="mx-2"> Master</span> </a>
                <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="<?= site_url("/dashboard/master/maset") ?>" class="nav-link text-light px-4"><i class='bx bxs-package'></i><span class="mx-3">Asset</span></a>
                    </li>
                    <li>
                        <a href="<?= site_url("/dashboard/master/muser") ?>" class="nav-link text-light px-4"><i class='bx bx-user'></i> <span class="mx-3">User</span> </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link text-light">
                    <i class='bx bx-menu'></i><span class="mx-2"> Main Menu </span> </a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="<?= site_url("/dashboard/mmenu/pinjam") ?>" class="nav-link text-light px-4"> <span class="mx-3">Peminjaman</span></a>
                    </li>
                    <li>
                        <a href="<?= site_url("/dashboard/mmenu/kembali") ?>" class="nav-link text-light px-4"> <span class="mx-3">Pengembalian</span> </a>
                    </li>
                </ul>
            </li>
        </ul>
        <span href="/logout" class=" text-center w-100 mb-5">
            <h4>
                <a href="/logout" class="text-decoration-none text-white">Logout</a>
            </h4>
        </span>
    </div>

    <!-- Main Wrapper -->
    <div class=" my-container">
        <!-- Top Nav -->
        <nav class="navbar ps-5 d-flex">
            <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
            <a href="/" class="text-decoration-none">
                <h4 class="text-light align-self-start p-2">Inventory IT</h4>
            </a>
            <span class="d-flex align-items-center"><i class='bx bxs-user-circle pe-2 bx-md' style="color: white;"></i>
                <h6 class="text-light pe-4 text-uppercase"><?php $username = session()->get('username'); ?> <?= $username; ?> </h6>
            </span>
        </nav>
        <!--End Top Nav -->
        <div class="space"></div>
        <!-- main -->
        <div class="container-sm p-3">
            <div class="card" style="background-color: #100901;">
                <h5 class="card-header text-light">Edit Item</h5>
            </div>
            <div class="card p-3">
                <form class="row g-3" action="<?= base_url('/dashboard/editAction') ?>" method="post">
                    <?= csrf_field() ?>
                    <?php if ($data) : ?>
                        <div class="col-md-6">
                            <label for="kodeItem" class="form-label">Kode Item</label>
                            <input type="text" class="form-control" id="kodeItem" name="kodeItem" value="<?= $data['kodeItemId']; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="namaItem" class="form-label">Nama Item</label>
                            <input type="text" class="form-control" id="namaItem" name="namaItem" value="<?= $data['namaItem']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="<?= $data['brand']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" value="<?= $data['type']; ?>" name="type">
                        </div>
                        <div class="col-md-6">
                            <label for="detail" class="form-label">Spesifikasi</label>
                            <input type="text" class="form-control" id="detail" name="detail" value="<?= $data['detail']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="lokasiItem" class="form-label">Lokasi Item</label>
                            <input type="text" class="form-control" id="lokasiItem" name="lokasiItem" value="<?= $data['lokasiItem']; ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="warehouse" class="form-label">Warehouse</label>
                            <select class="form-select" id="warehouse" name="warehouse" aria-label="Default select" aria-value="<?= $data['warehouse']; ?>">
                                <option value="1">SPL 1</option>
                                <option value="2">SPL 2</option>
                                <option value="3">SPL 3</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="tglPembelian" class="form-label">Tanggal Beli</label>
                            <input type="date" class="form-control" id="tglPembelian" name="tglPembelian" value="<?= $data['tglPembelian']; ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <input type="text" class="form-control" id="cond" name="kondisi" value="<?= $data['kondisi']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="createBy" class="form-label">Dibuat Oleh</label>
                            <select class="form-select" id="createBy" name="createBy" aria-label="Default select" aria-value="<?= $data['createBy']; ?>">
                                <option value="1">PAK ASEP</option>
                                <option value="2">PAK NATA</option>
                            </select>
                        </div>

                        <div class="col-12 pt-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    <?php endif; ?>

                    <?php if (session('error')) : ?>
                        <div class="alert alert-danger mt-3">
                            <?= session('error'); ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <!-- end main -->

    </div>
    <script>
        var jsonData = <?= $jsonData ?>;

        console.log(jsonData);
    </script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- custom js -->
    <script src="/assets/js/dashboard.js"> </script>
</body>

</html>