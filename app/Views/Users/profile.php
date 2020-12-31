<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>
<?php pop_up('updated'); ?>
<div class="information d-flex flex-row mx-auto">
    <div class="card mx-3 h-80" style="width: 18rem;">
        <img src="<?php echo $_SESSION['user_img'] ?>" class="card-img-top" alt="profile">
        <div class="card-body">
            <h5 class="card-title"><?php echo $_SESSION['user_username'] ?></h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Username: </strong><?php echo $_SESSION['user_username'] ?></li>
                <li class="list-group-item"><strong>Fullname: </strong><?php echo $_SESSION['user_fullname'] ?></li>
                <li class="list-group-item"><strong>Email: </strong><?php echo $_SESSION['user_email'] ?></li>
                <li class="list-group-item"><strong>Password: </strong>*******</li>
            </ul>
        </div>
    </div>
<div class="w-75">
    <div class="update card card-body shadow p-3 bg-white rounded  text-center h-70 m-2" id="updat">
        <form method="post" action="<?php echo URL_ROOT; ?>/users/update_user">
            <div class="us form-group my-2">
                <label for="update_username"><strong>Update username</strong></label>
                <div class="input-group mb-3 w-50 mx-auto">
                    <input type="text" class="form-control" name="new_username" placeholder="Update username" aria-label="Update username" aria-describedby="button-addon1">
                    <input type="submit" value="update" class="btn btn-outline-success" id="button-addon1">
                </div>
            </div>
            <div class="form-group my-2">
                <label for="update_fullname"><strong>Update fullname</strong></label>
                <div class="input-group mb-3 w-50 mx-auto">
                    <input type="text" class="form-control" placeholder="Update fullname" aria-label="Update fullname" aria-describedby="button-addon2">
                    <button class="btn btn-outline-success" type="button" id="button-addon2">Update</button>
                </div>
            </div>
            <div class="form-group my-2">
                <label for="update_email"><strong>Update Email</strong></label>
                <div class="input-group mb-3 w-50 mx-auto">
                    <input type="text" class="form-control" placeholder="Update email" aria-label="Update email" aria-describedby="button-addon1">
                    <button class="btn btn-outline-success" type="button" id="button-addon1">Update</button>
                </div>
                </div>
            <div class="form-group my-2">
                <label for="update_password"><strong>Update password</strong></label>
                <div class="input-group mb-3 w-50 mx-auto">
                    <input type="text" class="form-control" placeholder="Update password" aria-label="Update fullname" aria-describedby="button-addon2">
                    <button class="btn btn-outline-success" type="button" id="button-addon2">Update</button>
                </div>
            </div>
        </form>
    </div>
    <div class="update card card-body shadow p-3 bg-white rounded  text-center m-2" id="confirm_update">
        <form>
            <div class="form-group my-2">
                <label for="update_username"><strong>Enter your password to confirm</strong></label>
                <div class="input-group mb-3 w-50 mx-auto">
                    <input type="text" class="form-control" placeholder="your password" aria-label="your password" aria-describedby="button-addon1">
                    <button class="btn btn-outline-success" type="button" id="button-addon1">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>