<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>


    <div class="row">
        <div class="col-md-6">
            <h1>posts</h1>
        </div>
        <div class="col-md-6">
            <a href="<? echo URL_ROOT; ?>" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i> Add post
            </a>
        </div>
    </div>

    <?php foreach($data['posts'] as $post) : ?>
        <div class="card card-body mb-3">
            <h4 class="card-title"><?php echo $post->title; ?></h4>
        </div>
    <?php endforeach;  ?>
<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>