class Navbar {
  constructor() {
    this.navBar = document.querySelector('.site-header');
    this.events();
  }

  events() {
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
      let currentScroll = window.scrollY;
      if (currentScroll - lastScroll > 0) {
        // Scroll Down
        this.navBar.classList.add('hide');
      } else {
        // Scroll Up
        this.navBar.classList.remove('hide');
      }
      lastScroll = currentScroll;
    });
  }
}

export default Navbar;
