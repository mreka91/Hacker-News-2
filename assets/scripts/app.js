const sidenav = document.getElementById("side-menu");

const hamburger = document.querySelector(".fas");

const closemenu = document.querySelector(".btn-close");

hamburger.addEventListener("click", function () {
  sidenav.style.width = 100 + "px";
});

closemenu.addEventListener("click", function () {
  sidenav.style.width = 0 + "px";
});
