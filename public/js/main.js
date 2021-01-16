if (window.location.href == "https://192.168.99.112:8081/posts/add")
{
    var video = document.getElementById('video'),
        canvas = document.getElementById('pic'),
        context = canvas.getContext('2d');
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;
        if(navigator.getUserMedia){
            navigator.getUserMedia({video:true}, streamWebCam, throwError);
        }
        function streamWebCam (stream) {
            video.srcObject = stream;
            video.play();
        }
        function throwError (e) {
            alert(e.name);
        }

    document.getElementById('take').addEventListener("click", function(){
        context.drawImage(video, 0, 0, 500, 400);
        context.drawImage(elem, 0, 0, 100, 100);
    });

    document.getElementById('clear').addEventListener("click", function(){
    context.clearRect(0, 0, 500, 400);
    });

    mask = document.getElementById('mask'),
    covid = document.getElementById('covid'),
    ball = document.getElementById('ball'),
    hat = document.getElementById('hat');

    var elem = document.createElement('img');
    elem.setAttribute("height", "100");
    elem.setAttribute("width", "100");
    elem.setAttribute("id", "filters");

    function choose_filter()
    {
        if (mask.checked == true)
            elem.src = "../public/img/mask.png";
        if (covid.checked == true)
            elem.src = "../public/img/covid.png";
        if (ball.checked == true)
            elem.src = "../public/img/ball.png";
        if (hat.checked == true)
            elem.src = "../public/img/hat.png";

        document.getElementById('vi').appendChild(elem);
        document.getElementById('take').disabled = false;
    }

}

function editShow() {
    document.getElementById('edit_div').style.display = "block";
    document.getElementById('edit_profile').style.display = "none";
}

function editHide() {
    document.getElementById('edit_div').style.display = "none";
    document.getElementById('edit_profile').style.display = "block";
}

function menuToggle(){

        const toggleMenu = document.querySelector('.mono');
        toggleMenu.classList.toggle('active');
}

function setImage()
{
    var reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById("tempImg").setAttribute("src", e.target.result);
    };
    reader.readAsDataURL(input.file[0]);
}
