<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Item</title>

    <!-- bootstrap 5 css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <!-- BOX ICONS CSS-->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <!-- custom css -->
    <link rel="stylesheet" href="/assets/css/dashboard/sadditem.css" />
    <link rel="stylesheet" href="/assets/css/dashboard/dashboard.css" />

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://sandbox.scoretility.com/static/js/Editor-1.8.1/css/editor.dataTables.css">
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
                <h5 class="card-header text-light">Tambah Item Baru</h5>
            </div>
            <div class="card p-3">
                <form class="row g-3" id="add">
                    <div class="col-md-6">
                        <label for="kodeItemId" class="form-label">Kode Item</label>
                        <input type="text" class="form-control" id="kodeItemId" name="kodeItemId" required>
                    </div>
                    <div class="col-md-6">
                        <label for="namaItem" class="form-label">Nama Item</label>
                        <input type="text" class="form-control" id="namaItem" name="namaItem" required>
                    </div>
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>
                    <div class="col-md-6">
                        <label for="detail" class="form-label">Spesifikasi</label>
                        <input type="text" class="form-control" id="detail" name="detail">
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type">
                    </div>
                    <div class="col-md-3">
                        <label for="tglPembelian" class="form-label">Tanggal Beli</label>
                        <input type="date" class="form-control" id="tglPembelian" name="tglPembelian" required>
                    </div>
                    <div class="col-md-3">
                        <label for="kondisi" class="form-label">Kondisi</label>
                        <input type="text" class="form-control" id="kondisi" name="kondisi" required>
                    </div>
                    <div class="col-md-3">
                        <label for="createBy" class="form-label">Dibuat Oleh</label>
                        <select class="form-select" id="createBy" name="createBy" aria-label="Default select" required>
                            <option value="1">PAK ASEP</option>
                            <option value="2">PAK NATA</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" aria-label="Default select" required>
                            <option value="0">Tersedia</option>
                            <option value="1" disabled>Dipinjam</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-3">
                        <label for="employeId" class="form-label">Name PIC</label>
                        <select class="form-select" name="employeId" id="employeId" disabled required>
                            <?php foreach ($employe as $employes) : ?>
                                <option value="<?= $employes['employeId']; ?>"><?= $employes['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="warehouse" class="form-label">Warehouse</label>
                        <select class="form-select" id="warehouse" name="warehouse" aria-label="Default select example" disabled required>
                            <option value="1">SPL 1</option>
                            <option value="3">SPL 3</option>
                            <option value="2">SPL 4</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="lokasiItem" class="form-label">Location Item</label>
                        <input type="text" class="form-control" id="lokasiItem" name="lokasiItem" disabled required>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" disabled required>
                    </div> -->

                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-primary">Tambah ke table</button>
                        <button class="btn btn-primary" type="button" id="save" disabled>Simpan</button>
                    </div>
                    <?php if (session('error')) : ?>
                        <div class="alert alert-danger mt-3">
                            <?= session('error'); ?>
                        </div>
                    <?php endif; ?>
                </form>
                <div class="card p-2 mt-4">
                    <table class="table table-striped display nonwrap " id="addItems" style="width:100%;">
                        <thead>
                            <tr>
                                <th scope="col">Kode Item</th>
                                <th scope="col">Nama Items</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Type</th>
                                <th scope="col">Detail</th>
                                <!-- <th scope="col">Lokasi Item</th> -->
                                <!-- <th scope="col">Warehouse</th> -->
                                <th scope="col">Tgl Beli</th>
                                <!-- <th scope="col">PIC ID</th> -->
                                <th scope="col">Kondisi</th>
                                <th scope="col">Dibuat Oleh</th>
                                <th scope="col">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end main -->

    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- custom js -->
    <script src="/assets/js/dashboard.js"> </script>
    <script src="/assets/js/tambah.js"> </script>

    <!-- <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://sandbox.scoretility.com/static/js/Editor-1.8.1/js/dataTables.editor.js"></script>
</body>

</html>