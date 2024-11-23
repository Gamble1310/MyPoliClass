// Javascript per il contollo della sidenav a scompara

const navbar = document.getElementById("mySidenav");
const overlay = document.getElementById("overlay");


function openNav() {
    overlay.style.display = "block";
    overlay.style.opacity = "0.6";

    if(innerWidth > 600){
      navbar.style.width = "400px";
    }else{
      navbar.style.width = "100%";
    }
    
  }
  
  function closeNav() {
    navbar.style.width = "0";
    overlay.style.display = "none";
    overlay.style.opacity = "0";
  }