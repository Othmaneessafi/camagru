<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>
    <div class="card card-body shadow p-3 mb-5 bg-white rounded mt-5 text-center" id="cam">
        <div class="d-flex flex-row h-75">
            <div class="camera  mx-5 w-50 bg-light ">
                <video id="video" autoplay></video>
            </div>
            <div class="image  w-50 mx-5 bg-light">
                <canvas id="image"></canvas>
            </div>
        </div>
        <div>
            <div class="bg-light"></div>
            <div class="d-flex justify-content-end my-5 mx-5">
                <button class="btn btn-light border"><i class="fa fa-camera"></i> Take photo</button>
            </div>
        </div>
    </div>

<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>