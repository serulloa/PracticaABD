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

function sendMessage() {
  event.preventDefault();

  var message = document.getElementById('messageTextArea').value;
  var query = "";
  query = query.concat("message=", message);

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "Script/PHP/sendMessage.php", true);
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      alert(xhttp.responseText);
      //window.location.assign("index.html");
    }
  };
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(query);
}
