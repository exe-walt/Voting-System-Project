const activePage = window.location;
const navLinks = document.querySelectorAll('.nav-link');
forEach(link => { 
  if(link.href.includes(`${activePage}`)) {
    link.classList.add('active');
  }
})