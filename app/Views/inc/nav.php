<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="blog-header-logo text-dark" id="logo" href="<?php echo URL_ROOT ?>">Camagru</a>
      </div>
      <div class="col-3 text-center">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      </div>
      <?php if (isset($_SESSION['user_id'])) : ?>
        <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="username"><?php echo $_SESSION['user_username'] ?></a>
        <a class="btn btn-sm btn-outline-secondary mx-2" href="<?php echo URL_ROOT ?>/users/logout">Log Out</a>
      </div>
      <?php else : ?>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="btn btn-sm btn-outline-secondary mx-2" href="<?php echo URL_ROOT ?>/users/login">Log in</a>
        <a class="btn btn-sm btn-outline-secondary" href="<?php echo URL_ROOT ?>/users/signup">Sign up</a>
      </div>
      <?php endif; ?>
    </div>
  </header>
  <hr style="position:relative; top: -30px;">