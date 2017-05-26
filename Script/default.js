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

function registro() {
  event.preventDefault();

  var uname = document.getElementsByName('reguname');
  var umail = document.getElementsByName('regumail');
  var uage = document.getElementsByName('reguage');
  var psw = document.getElementsByName('regpsw');
  var repeatpsw = document.getElementsByName('regrepeatPsw');
  var music = "";

  var aux = document.getElementsByClass('checkbox');

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

  var query = "uname=" + uname + "&umail=" + umail + "&uage=" + uage + "&psw=" + psw;

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "PHP/registro.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(query);
}

function validateForm(uname, umail, uage, psw, repeatpsw) {
  if(uname === "") {
    alert("Nombre no puede estar vacío");
  }
  else if (umail === "") {
    alert("Email no puede estar vacío");
  }
  else if (umail) {

  }
}
