class MobileMenu {
  constructor() {
    this.hamburgerMenu = document.querySelector('.hamburger');
    this.mobileNav = document.querySelector('.mobile-menu');
    this.events();
  }

  events() {
    this.hamburgerMenu.addEventListener('click', () => this.openMenu());
  }

  openMenu() {
    this.hamburgerMenu.classList.toggle('clicked');
    this.mobileNav.classList.toggle('show');
    document.body.classList.toggle('no-scroll');
  }
}

export default MobileMenu;
