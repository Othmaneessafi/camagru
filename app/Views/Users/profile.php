<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
    if (isset($_SESSION['user_id'])):
?>
<?php pop_up('updated'); ?>


<div class="information mx-auto h-auto w-100">
    <div class="infos h-auto">
        <img src="<?php echo $_SESSION['user_img'] ?>" class="profile-pic card-img-top shadow" alt="profile">
        <div class="card-body">
            <span class="p-name vcard-fullname d-block overflow-hidden"><h3 class="profile-fullname"><strong><?php echo ucfirst($_SESSION['user_fullname']) ?></h3></strong></span>
            <span class="p-nickname vcard-username d-block"><h5 class="profile-username text-muted mx-2"><?php echo $_SESSION['user_username'] ?></h5></span><br>
            <span class="row p-name vcard-email d-block overflow-hidden"><strong><small class="profile-email"><i class="fa fa-envelope"></i><?php echo '  '.$_SESSION['user_email'] ?></small></strong></span>
        </div>
        <input class="btn btn-outline-secondary shadow" id="edit_profile" onclick="editShow()" value="Edit profile">
        <form method="post" action="<?php echo URL_ROOT; ?>/users/update_user">
            <div class="card-body row" id="edit_div">
                <div class="d-flex my-2">
                    <i class="fa fa-edit my-auto"></i>
                    <input type="text" class="form-control" name="new_fullname" name="new_fullname" placeholder="Fullname">
                </div>
                <div class="d-flex my-2">
                    <i class="fa fa-user my-auto"></i>
                    <input type="text" class="form-control" name="new_username" placeholder="Username">
                </div>
                <div class="d-flex my-2">
                    <i class="fa fa-envelope my-auto"></i>
                    <input type="text" class="form-control" name="new_email" placeholder="Email">
                </div>
                <div class="d-flex my-2">
                    <i class="fa fa-key my-auto"></i>
                    <input type="password" class="form-control" name="new_password" placeholder="Password">
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="notifs" type="checkbox" <?php if ($_SESSION['notification']) echo 'checked'; ?>> Recieve email notifications
                </div>
                <div class="d-flex my-3 h-auto mx-auto">
                    <input type="submit" class="update-btn btn btn-outline-success h-auto mx-2 shadow" value="update">
                    <input type="button" class="cancel-btn btn btn-outline-danger h-auto shadow" value="cancel" onclick="editHide()"></button>
                </div>
            </div>
        </form>
    </div>
    <div class="gallery-container row border mr-5">
        <?php foreach($data['posts'] as $post) :
            if($post->userId == $_SESSION['user_id']): ?>
                <div class="gallery rounded mb-3 h-auto">
                    <div class="p-2 mb-3 w-auto h-100">
                        <img class="gallery-img card-img-top rounded w-100 mb-3 shadow" style="height: 20rem; object-fit:fill;" src="<?php echo $post->content; ?>" alt="<?php echo $post->title; ?>">
                        <div class="w-100 h-auto">
                            <a href="<?php echo URL_ROOT; ?>/posts/del_post/<?php echo $post->postId ?>/1"><input type="submit" value="Delete" name="delete" class="del-btn col-4 btn btn-outline-danger shadow h-auto"></a>
                            <a href="<?php echo URL_ROOT; ?>/users/set_pdp/<?php echo $post->postId ?>"><input type="submit" value="Set as profile" name="set" class="set-btn col-4 btn btn-outline-info shadow h-auto"></a>
                        </div>
                    </div>
                </div>
        <?php endif; endforeach; ?>
    </div>
</div>
<?php else : redirect('users/login');
        endif; ?>
<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>
