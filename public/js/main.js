var video = document.getElementById('video');

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
