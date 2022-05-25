class Search {
  // Initiate object
  constructor() {
    this.openOverlayBtn = document.getElementById('search-icon');
    this.closeOverlayBtn = document.getElementById('search-close-btn');
    this.searchOverlay = document.querySelector('.search-overlay');
    this.searchInput = document.getElementById('search-input');
    this.events();
    this.isOverlayOpen = false;
  }
  // Create events
  events() {
    this.openOverlayBtn.addEventListener('click', this.openOverlay.bind(this));
    this.closeOverlayBtn.addEventListener(
      'click',
      this.closeOverlay.bind(this)
    );
    document.addEventListener('keydown', this.keyPressed.bind(this));
  }

  openOverlay() {
    this.searchOverlay.classList.add('search-overlay--active');
    this.searchInput.focus();
    document.body.style.overflow = 'hidden';
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove('search-overlay--active');
    document.body.style.overflow = '';
    this.isOverlayOpen = false;
  }

  keyPressed(e) {
    let key = e.keyCode;
    if (key === 83 && !this.isOverlayOpen) {
      this.openOverlay();
    }

    if (key === 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }
}

export default Search;
