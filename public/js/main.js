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
});

document.getElementById('clear').addEventListener("click", function(){
   context.clearRect(0, 0, 500, 400);
});