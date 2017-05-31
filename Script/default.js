 function closeModal() {
  var modal = document.getElementById('modal');
  var cancel = document.getElementById('cancelbtn');

  window.onclick = function(event) {
    if (event.target == modal || event.target == cancel) {
      modal.style.display = "none";
    }
  };
}

function showModal() {
  var modal = document.getElementById('modal');
  var registrate = document.getElementById('modalBtn');

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

    loadConvers(getCurrentTarget(evt));

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
}

function openChat(evt, chat) {
    event.preventDefault();

    loadChat(getCurrentTarget(evt));

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

function getCurrentTarget(evt) {
  return evt.currentTarget;
}

function loadConvers(element) {
  var type = element.id;
  var divConvers = "";

  if(type !== "tabGlobal") {
    if (type === "tabGroup") divConvers = "group";
    else if (type === "tabPersonal") divConvers = "personal";

    var query = "";
    query = query.concat("type=", divConvers);

    var xhttp = new XMLHttpRequest();

    xhttp.open("POST", "Script/PHP/loadConvers.php", true);
    xhttp.onreadystatechange = function(){
      if(xhttp.readyState == 4 && xhttp.status == 200){
        //alert(xhttp.responseText);
        //window.location.assign("index.html");
        document.getElementById(divConvers).innerHTML = xhttp.responseText;
      }
    };
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(query);
  }
}

function loadChat(element) {
  var id = element.id;
  var divMessages = element.id + "Messages";
  var type = element.parentElement.parentElement.id;

  var query = "";
  query = query.concat("type=", type, "&id=", id);

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "Script/PHP/loadChat.php", true);
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      //alert(xhttp.responseText);
      //window.location.assign("index.html");
      document.getElementById(divMessages).innerHTML = xhttp.responseText;
    }
  };
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(query);
}

function sendMessage() {
  event.preventDefault();

  var type = document.getElementsByClassName('active');

  if(type.length === 2) {
    var message = document.getElementById('messageTextArea').value;

    if(message !== "") {
      var query = "";
      query = query.concat("text=", message, "&type=", type[0].id, "&chat=", type[1].id);

      var xhttp = new XMLHttpRequest();

      xhttp.open("POST", "Script/PHP/sendMessage.php", false);
      xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
          //alert(xhttp.responseText);
          //window.location.assign("index.html");
          document.getElementById('messageTextArea').value = "";
        }
      };
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send(query);

      loadChat(type[1]);
    }
    else {
      alert("El mensaje no puede estar vacío.");
    }
  }
  else {
    alert("Debe seleccionar una conversación.");
  }
}
