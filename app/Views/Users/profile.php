<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>
<?php pop_up('updated'); ?>


<div class="information d-flex flex-row mx-auto h-auto w-100">
    <div class=" mx-5 h-auto w-25">
        <img src="<?php echo $_SESSION['user_img'] ?>" class="card-img-top rounded-circle w-100 h-50" alt="profile">
        <div class="card-body">
            <span class="p-name vcard-fullname d-block overflow-hidden"><h3 class="profile-fullname"><strong><?php echo ucfirst($_SESSION['user_fullname']) ?></h3></strong></span>
            <span class="p-nickname vcard-username d-block"><h5 class="profile-username text-muted mx-2"><?php echo $_SESSION['user_username'] ?></h5></span><br>
            <span class="p-name vcard-email d-block overflow-hidden"><strong><small class="profile-email"><i class="fa fa-envelope"></i><?php echo '  '.$_SESSION['user_email'] ?></small></strong></span>
        </div>
        <button class="btn btn-outline-secondary w-100 mx-auto" id="edit_profile" onclick="editShow()">Edit profile</button>
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
                <div class="d-flex my-3 mx-auto">
                    <input type="submit" class="btn btn-outline-success mx-2" value="update">
                    <input type="button" class="btn btn-outline-danger" value="cancel" onclick="editHide()"></button>
                </div>
            </div>
        </form>
    </div>
    <div class="w-100 h-auto d-flex flex-inline border mr-5">
        <?php foreach($data['posts'] as $post) : ?>
            <div class="rounded mb-3 w-25 h-auto">
                <div class="bg-light p-2 mb-3">
                    <img class="card-img-top rounded" src="<?php echo $post->content; ?>" alt="<?php echo $post->title; ?>">
                    <div class="my-1 w-100">
                        <a href="<?php echo URL_ROOT; ?>/posts/edit_post/<?php echo $post->postId ?>"><input type="submit" value="Edit" name="edit" class="edit-btn btn btn-outline-info  h-auto"></a>
                        <a href="<?php echo URL_ROOT; ?>/posts/del_post/<?php echo $post->postId ?>"><input type="submit" value="Delete" name="delete" class="del-btn btn btn-outline-danger h-auto"></a>
                    </div>
                </div>
            </div>
        <?php endforeach;  ?>
    </div>
</div>

<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>