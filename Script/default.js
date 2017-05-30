 function closeModal() {
  var modal = document.getElementById('indexModal');
  var cancel = document.getElementById('cancelbtn');

  window.onclick = function(event) {
    if (event.target == modal || event.target == cancel) {
      modal.style.display = "none";
    }
  };
}

function showModal() {
  var modal = document.getElementById('indexModal');
  var registrate = document.getElementById('indexButtonSignup');

  window.onclick = function(event) {
    if (event.target == registrate) {
      modal.style.display = "block";
    }
  };
}

function topnav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

function openTab(evt, tabName) {
    event.preventDefault();

    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";

    //loadChat(evt);
}

function openChat(evt, chat) {
    event.preventDefault();

    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("verticalTabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("verticalTablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(chat).style.display = "block";
    evt.currentTarget.className += " active";
}

function loadChat(evt) {
  event.preventDefault();
  var type = evt.currentTarget.id;

  var query = "";
  query = query.concat("type=", type);

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "Script/PHP/loadChat.php", true);
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      //alert(xhttp.responseText);
      //window.location.assign("index.html");
      document.getElementById("global").innerHTML = xhttp.responseText;
    }
  };
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(query);
}
