document.addEventListener('DOMContentLoaded', function() {
  const menuButton = document.getElementById('menuButton');
  const closeButton = document.getElementById('closeButton');
  const navMenu = document.getElementById('navMenu');

  menuButton.addEventListener('click', function() {
      navMenu.classList.toggle('open');
  });

  closeButton.addEventListener('click', function() {
      navMenu.classList.remove('open');
  });
});