function checkPrincipal() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "Script/PHP/checkPrincipal.php", false);
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      var result = xhttp.responseText;
      if(result === "falso") {
        window.location.assign("index.html");
      }
    }
  };
  xhttp.send();
}

function newConversation() {
  event.preventDefault();

  var receiverEmail = document.getElementById('receiverEmail').value;
  var text = document.getElementById('text').value;

  if (receiverEmail !== "" && text !== "") {
    var query = "";
    query = query.concat("receiverEmail=", receiverEmail, "&text=", text);

    var xhttp = new XMLHttpRequest();

    xhttp.open("POST", "Script/PHP/newConversation.php", true);
    xhttp.onreadystatechange = function(){
      if(xhttp.readyState == 4 && xhttp.status == 200){
        alert(xhttp.responseText);
        document.getElementById('modalSend').click();
        document.getElementById('tabPersonal').click();
      }
    };
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(query);
  }
  else {
    alert("Ni email ni mensaje pueden ser vacíos.");
  }
}

function showProfile() {
  var xhttp = new XMLHttpRequest();

  xhttp.open("GET", "Script/PHP/showProfile.php", false);
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      document.getElementById('fillSession').innerHTML = xhttp.responseText;
    }
  };
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();

  showAdmin();
}

function showAdmin() {
  if (isAdmin()) {
    var html = "<button type='button' onclick='goToAdmin();' id='adminbtn'>Administración</button>";
    var innerHTML = document.getElementById('containerAdmin').innerHTML;
    document.getElementById('containerAdmin').innerHTML = innerHTML + html;
  }
}

function goToAdmin() {
  window.location.assign("admin.html");
}
