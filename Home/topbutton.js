// Prendo il bottone
let mybutton = document.getElementById("topbutton");

// Dopo che l'utente va giù di 20px appare il bottone
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// Quando l'utente clicca sul bottone viene ripotatoro in cima
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}