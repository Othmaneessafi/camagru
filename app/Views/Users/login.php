<?php require_once CAMAGRU_ROOT . '/Views/inc/header.php'; ?>

<div class="col-md-6 mx-auto">
        <div class="card card-body shadow p-3 mb-5 bg-white rounded mt-5 text-center">
            <?php pop_up('signup_ok'); ?>
            <h1><a class="blog-header-logo text-dark" href="<?php echo URL_ROOT ?>" style="font-family: Billabong; font-size: 70px; text-decoration:none;">Camagru</a></h1>
            <p><strong>Sign in</strong></p>
            <form action="<?php echo URL_ROOT; ?>/users/login" method="post">
                <div class="form-group mb-3 w-75 m-auto">
                    <input type="text" name="username" class="form-control form-control-lg 
                        <?php echo (!empty($data['err_username'])) ? 'is-invalid' : ''; ?>" placeholder="username" value="<?php echo $data['username']; ?>">
                    <span class="invalid-feedback"><?php echo $data['err_username'] ?></span>
                </div>
                <div class="form-group mb-3 w-75 m-auto">
                    <input type="password" name="password" class="form-control form-control-lg 
                        <?php echo (!empty($data['err_password'])) ? 'is-invalid' : ''; ?>" placeholder="password" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['err_password'] ?></span>
                </div>
                <div class="row mb-4 w-75 ml-5 m-auto">
                    <input type="submit" value="Log in" class="btn btn-primary btn-block">
                </div>
                <div class="row">
                    <p>You don't have an account? <a href="<?php echo URL_ROOT ?>/users/signup" style="text-decoration: none;">sign up</a></p>
                </div>
            </form>
        </div>
    </div>

<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>