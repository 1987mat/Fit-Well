class Navbar {
  constructor() {
    this.navBar = document.querySelector('.site-header');
    this.hamburger = document.querySelector('.hamburger');
    this.events();
  }

  events() {
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
      let currentScroll = window.scrollY;
      if (currentScroll - lastScroll > 0) {
        // Scroll Down
        this.navBar.classList.add('hide');
        this.hamburger.classList.add('hide');
      } else {
        // Scroll Up
        this.navBar.classList.remove('hide');
        this.hamburger.classList.remove('hide');
      }
      lastScroll = currentScroll;
    });
  }
}

export default Navbar;
