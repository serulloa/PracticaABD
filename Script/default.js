 function closeModal() {
  var modal = document.getElementById('indexModal');
  var cancel = document.getElementById('cancelbtn')

  window.onclick = function(event) {
    if (event.target == modal || event.target == cancel) {
      modal.style.display = "none";
    }
  }
}
