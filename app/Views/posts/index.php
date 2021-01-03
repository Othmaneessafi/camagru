<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>

    <?php foreach($data['posts'] as $post) : ?>
        <div class="card card-body mb-3 w-50 h-auto m-auto">
            <div class="d-flex justify-content-left h-auto mb-3 mx-2">
                <img class="rounded-circle my-auto w-25 h-auto" src="<?php echo $post->profile_img ?>" alt="profile">
                <h4 class="card-title mx-2 my-auto h-auto"><?php echo $post->username; ?></h4>
            </div>
            <div class="bg-light p-2 mb-3">
                <img class="card-img-top" src="<?php echo $post->content; ?>" alt="<?php echo $post->title; ?>">
            </div>
            <div class="create_date mx-2">
                <p><?php echo $post->create_at; ?></p>
            </div>
        </div>
    <?php endforeach;  ?>
<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>