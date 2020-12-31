<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>
    <div class="card card-body shadow p-3 mb-5 bg-white rounded mt-1 text-center" id="cam">
        <div class="d-flex flex-row h-75">
            <div class="camera  mx-5 w-50 bg-light shadow" id="vi">
                <video class="shadow w-100 h-100" id="video" autoplay></video>
            </div>
            <div class="image  w-50 mx-5 bg-light shadow">
                <canvas id="pic" width="500" height="400" class="mx-1"></canvas>
            </div>
        </div>
        <div class="options my-4 d-flex flex-row">
            <div class="filters d-flex justify-content-center">
                <div class="border rounded mx-1 shadow ml-auto">
                    <input class="d-none" type="radio" name="filter" id="mask" value="mask" onclick="choose_filter()">
		  			<label for="mask"><img src="../public/img/mask.png" width="100" height="100"></label>
                </div>
                <div class="border rounded mx-1 shadow">
                    <input class="d-none" type="radio" name="filter" id="covid" value="covid" onclick="choose_filter()">
                    <label for="covid"><img src="../public/img/covid.png" width="100" height="100"></label>
                </div>
                <div class="border rounded mx-1 shadow">
                    <input class="d-none" type="radio" name="filter" id="ball" value="ball" onclick="choose_filter()">
		  			<label for="ball"><img src="../public/img/ball.png" width="100" height="100"></label>
                </div>
                <div class="border rounded mx-1 shadow">
                    <input class="d-none" type="radio" name="filter" id="hat" value="hat" onclick="choose_filter()">
		  			<label for="hat"><img src="../public/img/hat.png" width="100" height="100"></label>
                </div>
            </div>
            <div class="buttons d-flex justify-content-end mt-5">
                <button class="btn btn-light shadow mx-1"><i class="fa fa-camera" id="take"> Take photo</i></button>
                <button class="btn btn-success shadow mx-1"><i class="fa fa-camera"> Save photo</i></button>
                <button class="btn btn-danger shadow mx-1"><i class="fa fa-camera" id="clear"> Delete photo</i></button>
                <button class="btn btn-secondary shadow mx-1"><i class="fa fa-camera"> Upload photo</i></button>
            </div>
        </div>
    </div>

<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>