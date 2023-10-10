<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengmbalian</title>

    <!-- bootstrap 5 css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <!-- BOX ICONS CSS-->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <!-- custom css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <link rel="stylesheet" href="/assets/css/dashboard/dashboard.css" />
    <link rel="stylesheet" href="/assets/css/dashboard/pinjam.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <!-- Side-Nav -->
    <div class="side-navbar d-flex justify-content-between flex-wrap flex-column" id="sidebar">
        <ul class="nav flex-column text-white w-100 ">
            <a href="#" class="nav-link h3 text-light my-2">
                <h4>
                    SPL
                </h4>
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
                <ul class="collapse show nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="<?= site_url("/dashboard/mmenu/pinjam") ?>" class="nav-link text-light px-4"> <span class="mx-3">Peminjaman</span></a>
                    </li>
                    <li class="active">
                        <a href="<?= site_url("/dashboard/mmenu/kembali") ?>" class="nav-link text-dark px-4"> <span class="mx-3">Pengembalian</span></a>
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
    <div class="my-container">
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
        <div class=" space">
        </div>
        <!--End Top Nav -->
        <!-- main -->
        <div class="container pt-3">
            <div class="card" style="background-color: #100901;">
                <h5 class="card-header text-light">Pengembalian Asset</h5>
            </div>
            <div class="card p-3">
                <form class="row g-3" id="kembalikan">
                    <?= csrf_field() ?>
                    <div class="col-md-6">
                        <label for="namaBorrower" class="form-label">Nama Peminjam</label>
                        <select class="form-select" name="employe" id="namaBorrower">
                            <option value="null">Pilih Employe</option>
                            <?php foreach ($employe as $employes) : ?>
                                <option value="<?= $employes['employeId']; ?>"><?= $employes['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <table class="table table-striped display nonwrap" id="itemTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Kode Item</th>
                                <th scope="col">Nama Items</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Type</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Lokasi Item</th>
                                <th scope="col">Warehouse</th>
                                <th scope="col">Tgl Beli</th>
                                <th scope="col">PIC ID</th>
                                <th scope="col">Kondisi</th>
                                <th scope="col">Dibuat Oleh</th>
                                <!-- <th scope="col">Status</th> -->
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Simpan</button>
                    </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

    <!-- custom js -->
    <script src="/assets/js/kembali.js"> </script>
    <script src="/assets/js/dashboard.js"> </script>
</body>

</html>