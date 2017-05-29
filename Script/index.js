
function register() {
  event.preventDefault();

  var uname = document.getElementById('reguname').value;
  var umail = document.getElementById('regumail').value;
  var uage = document.getElementById('reguage').value;
  var psw = document.getElementById('regpsw').value;
  var repeatpsw = document.getElementById('regrepeatPsw').value;
  var music = "";

  var ok = validateForm(uname, umail, uage, psw, repeatpsw);
  if (ok) {
    var aux = document.getElementsByName('music');

    for (var i = 0; i < aux.length; i++) {
      if(aux[i].checked) {
        if(music.length === 0) {
          music += aux[i].value;
        }
        else {
          music += "$" + aux[i].value;
        }
      }
    }

    var query = "";
    query = query.concat("uname=", uname, "&umail=", umail, "&uage=", uage, "&psw=", psw, "&music=", music);

    var xhttp = new XMLHttpRequest();

    xhttp.open("POST", "Script/PHP/register.php", true);
    xhttp.onreadystatechange = function(){
      if(xhttp.readyState == 4 && xhttp.status == 200){
        alert(xhttp.responseText);
        window.location.assign("index.html");
      }
    };
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(query);
  }
}

function validateForm(uname, umail, uage, psw, repeatpsw) {
  var ok = false;

  if(uname === "") {
    alert("Nombre no puede estar vacío");
  }
  else if (umail === "") {
    alert("Email no puede estar vacío");
  }
  else if (uage === "") {
    alert("Edad no puede estar vacío");
  }
  else if (isNaN(uage)) {
    alert("Edad tiene que ser un número");
  }
  else if (uage < 18) {
    alert("Tienes que tener más de 18 años");
  }
  else if (psw === "") {
    alert("Constraseña no puede estar vacía");
  }
  else if (psw != repeatpsw) {
    alert("Contraseña y repite contraseña deben coincidir");
  }
  else {
    ok = true;
  }

  return ok;
}

function login() {
  event.preventDefault();

  var umail = document.getElementById('logUname').value;
  var psw = document.getElementById('logPsw').value;

  var query = "";
  query = query.concat("&umail=", umail, "&psw=", psw);

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "Script/PHP/login.php", true);
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      //alert(xhttp.responseText);
      window.location.assign("principal.html");
    }
  };
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(query);
}

function checkIndex() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "Script/PHP/checkPrincipal.php", false);
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      var result = xhttp.responseText;
      if(result === "verdadero") {
        window.location.assign("principal.html");
      }
    }
  };
  xhttp.send();
}
