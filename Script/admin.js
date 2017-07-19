$(document).ready(function() { loadGroups(); });

function checkAdmin() {
  if(!isAdmin()) {
    window.location.assign("principal.html");
  }
}

function createGroup() {
  var name = document.getElementById('groupName').value;
  var genre = document.getElementById('groupGenre').value;
  var maxAge = document.getElementById('groupMaxAge').value;
  var minAge = document.getElementById('groupMinAge').value;

  if(name === "") {
    alert("Nombre del gurpo no puede estar vacío.");
  } else if (maxAge === "") {
    alert("Edad máxima no puede estar vacía.");
  } else if (minAge === "") {
    alert("Edad mínima no puede estar vacía.");
  } else if (minAge < 18) {
    alert("Edad mínima no puede estar por debajo de 18 años.");
  } else {
    var query = "";
    query = query.concat("name=", name, "&genre=", genre, "&maxAge=", maxAge, "&minAge=", minAge);

    var xhttp = new XMLHttpRequest();

    xhttp.open("POST", "Script/PHP/createGroup.php", false);
    xhttp.onreadystatechange = function(){
      if(xhttp.readyState == 4 && xhttp.status == 200){
        alert(xhttp.responseText);
        //window.location.assign("admin.html");
      }
    };
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(query);
  }
}

function loadGroups() {
  var xhttp = new XMLHttpRequest();

  var html = document.getElementById('group').innerHTML;

  xhttp.open("GET", "Script/PHP/loadGroups.php", true);
  xhttp.onreadystatechange = function(){
    if(xhttp.readyState == 4 && xhttp.status == 200){
      document.getElementById('group').innerHTML = html + xhttp.responseText;
    }
  };
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
}

function loadUsers(str) {
  if (str !== "") {
    var query = "name=";
    query = query.concat(str);
    var xhttp = new XMLHttpRequest();

    xhttp.open("POST", "Script/PHP/loadUsers.php", true);
    xhttp.onreadystatechange = function(){
      if(xhttp.readyState == 4 && xhttp.status == 200){
        //alert(xhttp.responseText);
        document.getElementById('user').innerHTML = xhttp.responseText;
      }
    };
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(query);
  }
}
