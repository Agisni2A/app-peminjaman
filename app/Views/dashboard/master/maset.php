<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Master Assets</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://sandbox.scoretility.com/static/js/Editor-1.8.1/css/editor.dataTables.css">

    <!-- bootstrap 5 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- BOX ICONS CSS-->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <!-- custom css -->
    <link rel="stylesheet" href="/assets/css/dashboard/dashboard.css" />
    <link rel="stylesheet" href="/assets/css/dashboard/saset.css" />
</head>

<body>
    <!-- Side-Nav -->
    <div class="side-navbar d-flex justify-content-between flex-wrap flex-column" id="sidebar">
        <ul class="nav flex-column text-white w-100 ">
            <a href="#" class="nav-link h3 text-white my-2">
                <h4>
                    SPL
                </h4>
            </a>
            <li class="nav-link">
                <a href="<?= site_url("/dashboard") ?>" class="text-decoration-none text-light">
                    <i class="bx bxs-dashboard "></i><span class="mx-2">Dashboard</span></a>
            </li>
            <li>
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link text-light">
                    <i class='bx bxs-component'></i><span class="mx-2"> Master</span> </a>
                <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                    <li class="w-100 active">
                        <a href="<?= site_url("/dashboard/master/maset") ?>" class="nav-link text-dark px-4"><i class='bx bxs-package'></i><span class="mx-3">Asset</span></a>
                    </li>
                    <li>
                        <a href="<?= site_url("/dashboard/master/muser") ?>" class="nav-link text-light px-4"> <i class='bx bx-user'></i><span class="mx-3">User</span> </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link text-light">
                    <i class='bx bx-menu'></i><span class="mx-2">Main Menu </span> </a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="<?= site_url("/dashboard/mmenu/pinjam") ?>" class="nav-link text-light px-4"><span class="mx-3">Peminjaman</span></a>
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
        <div class="space"></div>
        <!--End Top Nav -->

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="modal" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Success</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="card p-3">
            <div class="table-responsive text-nowrap">
                <div class="text-center">
                    <h3 class="header dark">ASSETS IT</h3>
                </div>
                <!-- Table -->
                <table class="table table-striped display nonwrap" id="item" style="width: 100%;">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Code Item</th>
                            <th scope="col">Name Items</th>
                            <th scope="col">Location Item</th>
                            <th scope="col">Warehouse</th>
                            <th scope="col">Buy Date</th>
                            <th scope="col">Name PIC</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- End Table -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://sandbox.scoretility.com/static/js/Editor-1.8.1/js/dataTables.editor.js"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="/assets/js/table.js"> </script>
    <script src="/assets/js/dashboard.js"> </script>
</body>

</html>