class MobileMenu {
  constructor() {
    this.hamburgerMenu = document.querySelector('.hamburger');
    this.mobileNav = document.querySelector('nav');
    this.events();
  }

  events() {
    this.hamburgerMenu.addEventListener('click', () => this.openMenu());

    // Close Mobile Menu when click outside of it
    window.addEventListener('click', (e) => {
      if (
        !e.target.closest('.hamburger') &&
        !e.target.closest('nav') &&
        this.mobileNav.classList.contains('show')
      ) {
        this.mobileNav.classList.toggle('show');
        this.hamburgerMenu.classList.toggle('clicked');
      }
    });
  }

  openMenu() {
    this.hamburgerMenu.classList.toggle('clicked');
    this.mobileNav.classList.toggle('show');
    // Prevent scrolling
    document.body.classList.toggle('no-scroll');
  }
}

export default MobileMenu;
