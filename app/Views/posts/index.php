<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>

    <?php foreach($data['posts'] as $post) : ?>
        <div class="post-container card card-body mb-3 shadow h-auto m-auto">
            <div class="d-flex justify-content-left h-auto mb-3 mx-2">
                <img class="post-user rounded  shadow my-auto" src="<?php echo $post->profile_img ?>" alt="profile">
                <h4 class="card-title mx-2 my-auto h-auto" style="font-size: 3vh;"><?php echo $post->username; ?></h4>
            </div>
            <div class="p-2">
                <img class="post-img card-img-top" src="<?php echo $post->content; ?>" alt="<?php echo $post->title; ?>">
            </div>
            <div class="create_date mx-2">
                <p><?php echo $post->create_at; ?></p>
            </div>
        </div>
    <?php endforeach;  ?>
<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>