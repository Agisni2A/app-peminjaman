<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/font.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>
    <!-- login form -->
    <div class="container-fluid py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-7">
                <div class="card-group pt-5">
                    <div class="card border-0">
                        <div class="img-fuild rounded-start" style="background-image: url(assets/img/warehouse.jpg); height: 100%;">
                        </div>
                    </div>
                    <div class="card text-white p-5 text-center" style="background-color:#100901;">
                        <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                        <p class="text-white-50 mb-5">Please enter your login and password!</p>
                        <form class="form" id="loginForm" action="<?= base_url('login/process') ?>" method="POST">
                            <div class="form-outline mb-4">
                                <input type="text" placeholder="Username" name="username" id="username" class="form-control form-control-lg">
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" placeholder="Password" name="password" id="pwd" class="form-control form-control-lg">
                            </div>
                            <div class="form-outline mb-4 d-grid gap-2">
                                <button type="submit" class="btn btn-primary" id="loginButton">Login </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end login form -->

    <!-- flash error -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="modal" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Login Failed</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- end flash error -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        // document.getElementById("loginForm").addEventListener("submit", function(e) {
        //     e.preventDefault(); // Menghentikan pengiriman form

        //     // Simulasikan logika otentikasi di sini (ganti dengan logika sesungguhnya)
        //     var email = document.getElementById("username").value;
        //     var password = document.getElementById("pwd").value;

        //     if (email === "admin" && password === "admin") {
        //         // Login berhasil, Anda dapat mengarahkan pengguna ke halaman lain di sini
        //         alert("Login berhasil!");
        //     } else {
        //         // Login gagal, tampilkan pesan kesalahan atau modal
        //         $('#errorModal').modal('show');
        //     }
        // });
        <?php if (session()->getFlashdata('error')) : ?>
            $(document).ready(function() {
                $('#errorModal').modal('show');
            });
        <?php endif; ?>
    </script>
</body>

</html>