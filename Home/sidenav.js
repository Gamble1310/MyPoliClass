function openNav() {
    document.getElementById("mySidenav").style.width = "40%";
    document.getElementById("overlay").style.display = "block";
    document.getElementById("overlay").style.opacity = "0.6";
  }
  
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("overlay").style.display = "none";
    document.getElementById("overlay").style.opacity = "0";
  }