function logout() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "Script/PHP/logout.php", true);
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      window.location.assign("index.html");
    }
  };
  xhttp.send();

  return false;
}

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
        //window.location.assign("index.html");
        document.getElementById('modal').click();
      }
    };
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(query);
  }
  else {
    alert("Ni email ni mensaje pueden ser vacíos.");
  }
}
