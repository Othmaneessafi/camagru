<?php require_once CAMAGRU_ROOT . '/Views/inc/header.php'; ?>

<div class="col-md-6 mx-auto">
        <div class="card card-body shadow p-3 mb-5 bg-white rounded mt-5 text-center">
            <?php pop_up('signup_ok'); ?>
            <?php pop_up('not_verified'); ?>
            <h1><a class="blog-header-logo text-dark" href="<?php echo URL_ROOT ?>" style="font-family: Billabong; font-size: 70px; text-decoration:none;">Camagru</a></h1>
            <p><strong>Enter yout new password</strong></p>
            <form action="<?php echo URL_ROOT; ?>/users/updatepass/<?php echo $data['id'] ?>" method="post">
                <div class="form-group mb-3 w-75 m-auto">
                    <input type="password" name="newPassword" class="form-control form-control-lg 
                        <?php echo (!empty($data['err_newPassword'])) ? 'is-invalid' : ''; ?>" placeholder="New password" value="<?php echo $data['newpassword']; ?>">
                    <span class="invalid-feedback"><?php if (!empty($data['err_newPassword'])) echo $data['err_newPassword'] ?></span>
                </div>
                <div class="row mb-4 w-75 ml-5 m-auto">
                    <input type="submit" value="Reset" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>

<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>