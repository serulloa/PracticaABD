 function closeModal() {
  var modal = document.getElementById('indexModal');
  var cancel = document.getElementById('cancelbtn');

  window.onclick = function(event) {
    if (event.target == modal || event.target == cancel) {
      modal.style.display = "none";
    }
  }
}

function showModal() {
  var modal = document.getElementById('indexModal');
  var registrate = document.getElementById('indexButtonSignup');

  window.onclick = function(event) {
    if (event.target == registrate) {
      modal.style.display = "block";
    }
  }
}
