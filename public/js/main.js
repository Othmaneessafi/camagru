var video = document.getElementById('video'),
    canvas = document.getElementById('pic'),
    context = canvas.getContext('2d');
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
{
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream)
    {
      try {
            video.src = window.URL.createObjectURL(stream);
      } catch (error) {
            video.srcObject = stream;
          }
        video.play();
        camera_allowed = 1;
    }
    );
} else if(navigator.webkitGetUserMedia) {
   navigator.webkitGetUserMedia({ video: true }, function(stream){
       try {
               video.src = window.URL.createObjectURL(stream);
           } catch (error) {
                video.srcObject = stream;
           }
       video.play();
       camera_allowed = 1;
   }, function(err) {
        console.log("The following error occurred: " + err.name);
     });
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
}

elem.addEventListener("mousedown", initialClick, false);
var moving = false;
function initialClick(e) {

    if(moving){
      document.removeEventListener("mousemove", move);
      moving = !moving;
      return;
    }
    
    moving = !moving;
    image = this;
  
    document.addEventListener("mousemove", move, false);
  
  }
function move(e){

    var newX = e.clientX - 300;
    var newY = e.clientY - 200;

    if (newY < 10) newY = 10;
    if (newX < 58) newX = 58;
    if (newY > 450) newY = 450;
    if (newX > 500) newX = 500;
    console.log(newY);
    elem.style.position = 'absolute';
    elem.style.top = newY  + 'px';
    elem.style.left = newX + 'px';
  }
