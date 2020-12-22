<?php require_once CAMAGRU_ROOT . '/Views/inc/header.php'; ?>

    <div class="col-md-6 mx-auto">
        <div class="card card-body shadow p-3 mb-5 bg-white rounded mt-5 text-center">
            <h1><a class="blog-header-logo text-dark" href="<?php echo URL_ROOT ?>" style="font-family: Billabong; font-size: 70px; text-decoration:none;">Camagru</a></h1>
            <p><strong>Sign up to share your wolrd</strong></p>
            <form action="<?php echo URL_ROOT; ?>/users/signup" method="post">
                <div class="form-group mb-3 w-75 m-auto">
                    <input type="text" name="fullname" class="form-control form-control-lg 
                        <?php echo (!empty($data['err_fullname'])) ? 'is-invalid' : ''; ?>" placeholder="Full Name" value="<?php echo $data['fullname']; ?>">
                    <span class="invalid-feedback"> <?php echo($data['err_fullname']); ?></span>
                </div>
                <div class="form-group mb-3 w-75 m-auto">
                    <input type="email" name="email" class="form-control form-control-lg 
                        <?php echo (!empty($data['err_email'])) ? 'is-invalid' : ''; ?>" placeholder="Email" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['err_email'] ?></span>
                </div>
                <div class="form-group mb-3 w-75 m-auto">
                    <input type="text" name="username" class="form-control form-control-lg 
                        <?php echo (!empty($data['err_username'])) ? 'is-invalid' : ''; ?>" placeholder="Username" value="<?php echo $data['username']; ?>">
                    <span class="invalid-feedback"><?php echo $data['err_username'] ?></span>
                </div>
                <div class="form-group mb-3 w-75 m-auto">
                    <input type="password" name="password" class="form-control form-control-lg 
                        <?php echo (!empty($data['err_password'])) ? 'is-invalid' : ''; ?>" placeholder="Password" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['err_password'] ?></span>
                </div>
                <div class="form-group mb-3 w-75 m-auto">
                    <input type="password" name="confirmPwd" class="form-control form-control-lg 
                        <?php echo (!empty($data['err_confirmPwd'])) ? 'is-invalid' : ''; ?>" placeholder="Confirm Password" value="<?php echo $data['confirm_pwd']; ?>">
                    <span class="invalid-feedback"><?php echo $data['err_confirmPwd'] ?></span>
                </div>
                <div class="row mb-4 w-75 ml-5 w-75 m-auto">
                    <input type="submit" value="Sign up" class="btn btn-primary btn-block">
                </div>
                <div class="row">
                    <p>Already have an account? <a href="<?php echo URL_ROOT ?>/users/login" style="text-decoration: none;">Log in</a></p>
                </div>
            </form>
        </div>
    </div>


<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>
