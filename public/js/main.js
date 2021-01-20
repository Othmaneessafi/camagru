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
    window.location.replace("https://192.168.99.113:8081/users/login");
    return ;
  }
  var xhttp = new XMLHttpRequest();
  xhttp.open('POST', 'https://192.168.99.113:8081/posts/like');
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
  var co = document.getElementsByName('comment_'+postid);
  var com = co[0].value;

  if(com.trim() == "" && userid != ""){
      co[0].placeholder = 'Please enter valid comment';
      return ;
  }
  if (userid == "") {
    window.location.replace("https://192.168.99.113:8081/users/login");
    return;
  }
  var xhttp = new XMLHttpRequest();
  var params = "c_post_id=" + postid + "&c_user_id=" + userid + "&content=" + com;
  xhttp.open('POST', 'https://192.168.99.113:8081/posts/comment');
  xhttp.withCredentials = true;
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(params);
  setInterval(function(){ window.location.reload(); }, 50);
}

function showComments() {
    var comment = document.getElementsByClassName("comment");
    if (comment.style.display === "none")
        comment.style.display = "block";
    else
        comment.style.display = "none";
  }