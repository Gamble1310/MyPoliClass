function  toggleDropdown(){
  let menu = document.getElementById("dropdownMenu");
  // Se il menu è visibile, nascondilo, altrimenti mostralo
  if (menu.style.display == "block") {
      menu.style.display = "none";
      document.getElementById("dropArrow").style.transform = "rotate(0deg)"
  } else {
      menu.style.display = "block";
      document.getElementById("dropArrow").style.transform = "rotate(180deg)"
  }
}