// Javascript per il contollo della sidenav a scompara

const navbar = document.getElementById("mySidenav");
const overlay = document.getElementById("overlay");


function openNav() {
    navbar.style.width = "40%";
    overlay.style.display = "block";
    overlay.style.opacity = "0.6";
  }
  
  function closeNav() {
    navbar.style.width = "0";
    overlay.style.display = "none";
    overlay.style.opacity = "0";
  }