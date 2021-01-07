<?php
    require_once CAMAGRU_ROOT . '/Views/inc/header.php';
    require_once CAMAGRU_ROOT . '/Views/inc/nav.php';
?>
    <div class="card card-body shadow p-3 mb-5 bg-white  rounded mt-1 text-center" id="cam">
        <div class="d-flex flex-row h-auto ">
            <div class="camera w-50 h-auto bg-light mx-1 shadow" id="vi">
                <video class="w-100 h-100" id="video" autoplay></video>
            </div>
            <div class="image  w-50 h-auto bg-light shadow">
                <canvas id="pic" width="500" height="400" class="align-self-center h-auto w-auto"></canvas>
            </div>
            <div class="thum  w-25 h-auto bg-light mx-1 shadow">    
            </div>
        </div>
        <div class="options my-4 row w-100 h-auto">
            <div class="filter row">
                <div class="column rounded shadow mx-1">
                    <input class="d-none" type="radio" name="filter" id="mask" value="mask" onclick="choose_filter()">
		  			<label for="mask"><img src="../public/img/mask.png" class="filter_img my-auto"></label>
                </div>
                <div class="column rounder shadow ">
                    <input class="d-none" type="radio" name="filter" id="covid" value="covid" onclick="choose_filter()">
                    <label for="covid"><img src="../public/img/covid.png" class="filter_img"></label>
                </div>
                <div class="column rounded shadow mx-1">
                    <input class="d-none" type="radio" name="filter" id="ball" value="ball" onclick="choose_filter()">
		  			<label for="ball"><img src="../public/img/ball.png" class="filter_img"></label>
                </div>
                <div class="column rounded shadow">
                    <input class="d-none" type="radio" name="filter" id="hat" value="hat" onclick="choose_filter()">
		  			<label for="hat"><img src="../public/img/hat.png" class="filter_img"></label>
                </div>
            </div>
            <div class="buttons row  d-flex justify-content-center my-auto">
                <input type="button" class="column btn btn-outline-info shadow w-auto h-auto mx-1" value="Take photo" id="take" disabled>
                <input type="button" class="column btn btn-outline-success shadow w-auto h-auto mx-1" value="Save photo">
                <input type="button" class="column btn btn-outline-danger shadow w-auto h-auto mx-1" value="Clear photo" id="clear">
                <input type="button" class="column btn btn-outline-secondary shadow w-auto h-auto mx-1" value="Upload photo">
            </div>
        </div>
    </div>

<?php require_once CAMAGRU_ROOT . '/Views/inc/footer.php'; ?>