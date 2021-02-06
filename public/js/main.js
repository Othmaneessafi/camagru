list_toggle = document.getElementById('list-toggle');

if (window.location.href == server_name + "/posts/add")
{
    var video = document.getElementById('video'),
        canvas = document.getElementById('pic'),
        context = canvas.getContext('2d'),
        uploadImg = document.getElementById('upload');
        mask = document.getElementById('mask'),
        covid = document.getElementById('covid'),
        ball = document.getElementById('ball'),
        hat = document.getElementById('hat');    
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;
    
    
    
        function streamWebCam (stream) {
        video.srcObject = stream;
        video.play();
        width = stream.getTracks()[0].getSettings().width;
        height = stream.getTracks()[0].getSettings().height;
        canvas.width = width;
        canvas.height = height;
    }
    function throwError (e) {
        alert(e.name);
    }
    if(navigator.getUserMedia){
        navigator.getUserMedia({video:true}, streamWebCam, throwError);
    }

    
        
    document.getElementById('take').addEventListener("click", function(){
        if (mask.checked || covid.checked || ball.checked || hat.checked)
        {
            context.clearRect(0, 0, canvas.width, canvas.height);
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            if (mask.checked == true)
                context.drawImage(elem, 10, 10, 140, 140);
            if (covid.checked == true)
                context.drawImage(elem1, 470, 10, 140, 140);
            if (ball.checked == true)
                context.drawImage(elem2, 10, 320, 140, 140);
            if (hat.checked == true)
                context.drawImage(elem3, 470, 320, 140, 140);
            document.getElementById('save').disabled = false;
        }
        
    });

    document.getElementById('clear').addEventListener("click", function(){
        context.clearRect(0, 0, canvas.width, canvas.height);
        if (document.getElementById('filters') != null)
        {
            mask.checked = false;
            document.getElementById('vi').removeChild(elem);
        }
        if (document.getElementById('filters1') != null)
        {
            covid.checked = false;
            document.getElementById('vi').removeChild(elem1);
        }
        if (document.getElementById('filters2') != null)
        {
            ball.checked = false;
            document.getElementById('vi').removeChild(elem2);
        }
        if (document.getElementById('filters3') != null)
        {
            hat.checked = false;
            document.getElementById('vi').removeChild(elem3);
        }
        document.getElementById('save').disabled = true;
        document.getElementById('take').disabled = true;
    });

    var elem = document.createElement('img');
    elem.setAttribute("height", "50");
    elem.setAttribute("width", "50");
    elem.setAttribute("id", "filters");

    var elem1 = document.createElement('img');
    elem1.setAttribute("height", "50");
    elem1.setAttribute("width", "50");
    elem1.setAttribute("id", "filters1");

    var elem2 = document.createElement('img');
    elem2.setAttribute("height", "50");
    elem2.setAttribute("width", "50");
    elem2.setAttribute("id", "filters2");

    var elem3 = document.createElement('img');
    elem3.setAttribute("height", "50");
    elem3.setAttribute("width", "50");
    elem3.setAttribute("id", "filters3");

    function choose_filter()
    {
        if (mask.checked == true)
        {
            elem.src = "../public/img/mask.png";
            document.getElementById('vi').appendChild(elem);
        }
        else if (document.getElementById('filters') != null)
            document.getElementById('vi').removeChild(elem);
        if (covid.checked == true)
        {
            elem1.src = "../public/img/covid.png";
            document.getElementById('vi').appendChild(elem1);
        }
        else if (document.getElementById('filters1') != null)
            document.getElementById('vi').removeChild(elem1);
        if (ball.checked == true)
        {
            elem2.src = "../public/img/ball.png";
            document.getElementById('vi').appendChild(elem2);
        }
        else if (document.getElementById('filters2') != null)
            document.getElementById('vi').removeChild(elem2);
        if (hat.checked == true)
        {
            elem3.src = "../public/img/hat.png";
            document.getElementById('vi').appendChild(elem3);
        }
        else if (document.getElementById('filters3') != null)
            document.getElementById('vi').removeChild(elem3);

        
        document.getElementById('take').disabled = false;
    }
    
    function isImage(file)
    {
        const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
        const fileType = file['type'];
        if (validImageTypes.includes(fileType))
            return true;
        else
            return false;
    }

    function uploadImage(){
        uploadImg.addEventListener('change', function(event) {
        var file = event.target.files[0];
        var img = new Image;
        img.onload = function () {
            context.clearRect(0, 0, canvas.width, canvas.height);
            context.drawImage(img, 0, 0, canvas.width, canvas.height);
            if (mask.checked == true)
                context.drawImage(elem, 10, 10, 140, 140);
            if (covid.checked == true)
                context.drawImage(elem1, 470, 10, 140, 140);
            if (ball.checked == true)
                context.drawImage(elem2, 10, 320, 140, 140);
            if (hat.checked == true)
                context.drawImage(elem3, 470, 320, 140, 140);
        }
        if(file && isImage(file))
        {
            console.log("ok");
            img.src = URL.createObjectURL(file);
            if (uploadImg.files.length != 0){
                document.getElementById('save').disabled = false;
            }
        }
        });
    }

    window.addEventListener('DOMContentLoaded', uploadImage);

}

function editShow() {
    document.getElementById('edit_div').style.display = "block";
    document.getElementById('edit_profile').style.display = "none";
}

function editHide() {
    document.getElementById('edit_div').style.display = "none";
    document.getElementById('edit_profile').style.display = "block";
}

function saveImage()
{
    var dataURL = canvas.toDataURL("image/png");
    var params = "imgBase64=" + dataURL + "&emoticon=" + elem;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', server_name + '/posts/saveImage');

    xhr.withCredentialfull_canvas = true;
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(params);
    setInterval(function(){ window.location.reload(); }, 200);
}

function like(event)
{
  if( !event ) event = window.event;
  var postid = (event.target && event.target.getAttribute('data-post_id'));
  var userid = (event.target && event.target.getAttribute('data-user_id'));
  var like_nbr = (event.target && event.target.getAttribute('data-like_nbr'));
  var li = document.getElementById('l_'+postid);
  var c = li.getAttribute('class');
  var li_nb = document.getElementById('li_nb_'+postid);
  var sym = 0;
  if (userid == "") {
    window.location.replace(server_name + "/users/login");
    return ;
  }
  var xhttp = new XMLHttpRequest();
  xhttp.open('POST', server_name + '/posts/like');
  xhttp.withCredentials = true;
  if (event.target.className == "fa fa-heart-o")
  {
      event.target.className = "fa fa-heart";
      like_nbr++;
      li_nb.innerHTML = like_nbr;
      event.target.setAttribute('data-like_nbr', like_nbr);
  }
  else if (event.target.className == "fa fa-heart")
  {
      event.target.className = "fa fa-heart-o";
      if(like_nbr <= 0)
            sym = 1;
      like_nbr--;
      event.target.setAttribute('data-like_nbr', like_nbr);
      li_nb.innerHTML = like_nbr + sym;
  }
  var params = "post_id=" + postid + "&user_id=" + userid + "&c=" + c + "&like_nbr=" + like_nbr;
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(params);
}

function comment(event)
{

  if( !event ) event = window.event;
  var postid = (event.target && event.target.getAttribute('data-c-post_id'));
  var userid = (event.target && event.target.getAttribute('data-c-user_id'));
  var comment = document.getElementsByName('comment_'+postid);
  var commentVal = comment[0].value;

  if(commentVal.trim() == "" && userid != ""){
        comment[0].placeholder = 'Please enter valid comment';
      return ;
  }
  if (userid == "") {
    window.location.replace(server_name + "/users/login");
    return ;
  }
  var xhttp = new XMLHttpRequest();
  var params = "c_post_id=" + postid + "&c_user_id=" + userid + "&content=" + commentVal;
  xhttp.open('POST', server_name + '/posts/comment');
  xhttp.withCredentials = true;
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(params);
  setInterval(function(){ window.location.reload(); }, 200);
}

if (list_toggle != null)
{
    var i = false;
    list_toggle.addEventListener("click", function(){
        if (i == false)
        {
            document.getElementById('liste').style.display = "block";
            i = true;
        }
        else
        {
            document.getElementById('liste').style.display = "none";
            i = false;
        }
    });
}
