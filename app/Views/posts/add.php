<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>
    <div class="card card-body shadow p-3 mb-2 bg-white  rounded text-center" id="cam">
        <div class="d-flex flex-row h-auto ">
            <div class="camera h-auto bg-light  shadow" id="vi">
                <video class="w-100 h-100" id="video" autoplay></video>
            </div>
            <div class="image h-auto bg-light shadow">
                <canvas id="pic" class="align-self-center"></canvas>
            </div>
        </div>
        <div class="options my-4 row w-100 h-auto">
            <div class="filter row justify-content-start">
                <div class="column rounded shadow">
                    <input class="d-none" type="radio" name="filter" id="mask" value="mask" onclick="choose_filter()">
		  			<label for="mask"><img src="../public/img/mask.png" class="filter_img my-auto"></label>
                </div>
                <div class="column rounder shadow ">
                    <input class="d-none" type="radio" name="filter" id="covid" value="covid" onclick="choose_filter()">
                    <label for="covid"><img src="../public/img/covid.png" class="filter_img"></label>
                </div>
                <div class="column rounded shadow">
                    <input class="d-none" type="radio" name="filter" id="ball" value="ball" onclick="choose_filter()">
		  			<label for="ball"><img src="../public/img/ball.png" class="filter_img"></label>
                </div>
                <div class="column rounded shadow">
                    <input class="d-none" type="radio" name="filter" id="hat" value="hat" onclick="choose_filter()">
		  			<label for="hat"><img src="../public/img/hat.png" class="filter_img"></label>
                </div>
            </div>
            <div class="buttons row  d-flex justify-content-end my-auto">
                <input type="button" class="column btn btn-outline-info shadow w-auto h-auto mx-1" value="Take photo" id="take" disabled>
                <input type="button" class="column btn btn-outline-success shadow w-auto h-auto mx-1" value="Save photo" id="save" onclick="saveImage()" disabled>
                <input type="button" class="column btn btn-outline-danger shadow w-auto h-auto mx-1" value="Clear photo" id="clear">
                <input type="file" class="column form-control shadow w-auto h-auto mx-1" id="upload" accept="image/jpg, image/jpeg, image/png">
            </div>
        </div>
    </div>
    <div class="card card-body shadow bg-white  rounded" id="thum">
    <?php $i = 0; foreach($data['posts'] as $post) : if ($i++ < 5) :
            if($post->userId == $_SESSION['user_id']): ?>
                <div class="rounded" id="add-gallery">
                    <div class="mx-1">
                        <img class="rounded mb-1 shadow" style="height: 15vh;width:15vh; object-fit:fill;" src="<?php echo $post->content; ?>" alt="<?php echo $post->title; ?>">
                        <div class="w-100 h-auto">
                            <a href="<?php echo URL_ROOT; ?>/posts/del_post/<?php echo $post->postId ?>"><input type="submit" value="Delete" name="delete" class=" btn btn-outline-danger shadow h-auto"></a>
                        </div>
                    </div>
                </div>
        <?php endif;  endif; endforeach; ?>
    </div>

<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>