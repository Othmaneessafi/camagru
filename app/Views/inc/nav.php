<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="blog-header-logo text-dark" id="logo" href="<?php echo URL_ROOT ?>/posts">Camagru</a>
      </div>
      <div class="col-3 text-center">
        
      </div>
      <?php if (isset($_SESSION['user_id'])) : ?>
        <div class="menu col-4 d-flex justify-content-end align-items-center w-25 h-auto">
          <div onclick="menuToggle()">
            <img class="profile-btn profile  rounded-circle border border-dark h-auto mx-3" src="<?php echo $_SESSION['user_img'] ?>" alt="profile">
          </div>
            <a href="<?php echo URL_ROOT ?>/posts/add"><img class="cam-btn" src="../public/img/camera.png"></a>
            <a class="btn btn-sm mx-1" href="<?php echo URL_ROOT ?>/users/logout" ><img class="out-btn" src="https://www.flaticon.com/svg/static/icons/svg/1250/1250678.svg" ></a>
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
