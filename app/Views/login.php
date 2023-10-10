<!DOCTYPE html>
<html>
<?= $this->include('head'); ?>

<body>
    <div class="container">
        <div class="login-container">
            <div class="center logo-login">
                <img class="mb-4" src="assets/img/logo.png" alt="" width="74%" height="auto" class="img img-responsive img-rounded align-self-start">
            </div>
            <div class="space-6"></div>
            <div class="main">
                <h4 class="header blue text-start fw-lighter">
                    <i class="fa fa-coffee green" aria-hidden="true"></i>
                    Please enter user & password
                </h4>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <div class="space-6"></div>
                <div class="lock clearfix grid gap-0 row-gap-3">

                    <form action="<?= base_url('login/process') ?>" method="POST">
                        <?= csrf_field() ?>

                        <span class="block input-icon input-icon-right">
                            <input class="input" type="text" name="username" id="login" placeholder="Username" style="width:100%;" />
                            <i class="ace-icon fa fa-user"></i>
                        </span>

                        <div class="space-2"></div>

                        <span class="block input-icon input-icon-right">
                            <input type="password" class="input" placeholder="Password" name="password" id="password" required style="width:100%;" />
                            <i class="ace-icon fa fa-eye"></i>
                        </span>
                        <div class="space"></div>
                        <button name="login" class="width-35 pull-right btn btn-sm btn-primary" type="submit">
                            <i class="ace-icon fa fa-key"></i>
                            <span class="bigger-110">Login</span>
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>

</html>