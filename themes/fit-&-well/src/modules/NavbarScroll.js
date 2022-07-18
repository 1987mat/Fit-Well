class Navbar {
  constructor() {
    this.navBar = document.querySelector('.site-header');
    this.events();
  }

  events() {
    window.addEventListener('scroll', () => {
      this.navBar.style.display = 'none';
    });
  }
}

export default Navbar;
