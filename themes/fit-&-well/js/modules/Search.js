class Search {
  constructor() {
    this.resultsDiv = document.querySelector('#search-results');
    this.searchOverlay = document.querySelector('.search-overlay');
    this.searchBtn = document.querySelector('.fa-search');
    this.closeBtn = document.querySelector('.fa-window-close');
    this.searchField = document.querySelector('.search-input');
    this.isOverlayOpen = false;
    this.searchTimer;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.events();
  }

  // Events
  events() {
    this.searchBtn.addEventListener('click', () => this.openOverlay());
    this.closeBtn.addEventListener('click', () => this.closeOverlay());
    document.addEventListener('keyup', (e) => this.keyPress(e));
    this.searchField.addEventListener('keyup', () => this.typingEvent());
  }

  // Methods
  openOverlay() {
    this.searchOverlay.classList.add('search-overlay--active');
    this.searchOverlay.classList.add('transition');
    this.searchField.value = '';
    this.searchField.focus();
    document.body.classList.add('body-no-scroll');
    this.isOverlayOpen = true;
    this.resultsDiv.innerHTML = '';
  }

  closeOverlay() {
    this.searchOverlay.classList.remove('search-overlay--active');
    document.body.classList.remove('body-no-scroll');
    this.isOverlayOpen = false;
  }

  keyPress(e) {
    let keyPressed = e.keyCode;

    if (
      keyPressed == 83 &&
      !this.isOverlayOpen &&
      document.activeElement.tagName != 'INPUT' &&
      !document.activeElement.tagName != 'TEXTAREA'
    ) {
      this.openOverlay();
    }

    if (keyPressed == 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  typingEvent() {
    if (this.previousValue != this.searchField.value) {
      clearTimeout(this.searchTimer);

      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner"></div>';
          this.isSpinnerVisible = true;
        }
        this.searchTimer = setTimeout(this.getResults.bind(this), 2000);
      } else {
        this.resultsDiv.innerHTML = '';
        this.isSpinnerVisible = false;
      }
    }
    this.previousValue = this.searchField.value;
  }

  // AJAX request
  getResults() {
    let request = new XMLHttpRequest();
    request.open(
      'GET',
      'http://localhost:10008/wp-json/wp/v2/pages?search=' +
        this.searchField.value
    );

    request.onload = () => {
      let data = JSON.parse(request.responseText);
      // this.resultsDiv.innerHTML = `<p>${data}</p>`;
      console.log(data);
    };
    request.send();
  }
}

export default Search;
