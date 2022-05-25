class Search {
  // Initiate object
  constructor() {
    this.resultsDiv = document.getElementById('search-results');
    this.openOverlayBtn = document.getElementById('search-icon');
    this.closeOverlayBtn = document.getElementById('search-close-btn');
    this.searchOverlay = document.querySelector('.search-overlay');
    this.searchInput = document.getElementById('search-input');
    this.events();
    this.isOverlayOpen = false;
    this.typerTimer;
    this.previousValue;
  }

  // Create events
  events() {
    this.openOverlayBtn.addEventListener('click', this.openOverlay.bind(this));
    this.closeOverlayBtn.addEventListener(
      'click',
      this.closeOverlay.bind(this)
    );
    document.addEventListener('keyup', this.keyPressed.bind(this));
    this.searchInput.addEventListener('keyup', this.typingLogic.bind(this));
  }

  // Methods
  openOverlay() {
    this.searchOverlay.classList.add('search-overlay--active');
    this.searchInput.focus();
    document.body.style.overflow = 'hidden';
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove('search-overlay--active');
    document.body.style.overflow = '';
    this.searchInput.value = '';
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
  }

  typingLogic() {
    // Hide loading spinner if the search value doesn't change
    if (this.searchInput.value != this.previousValue) {
      clearTimeout(this.typerTimer);

      // Empty results div and hide spinner if the search field is empty
      if (this.searchInput.value) {
        // Display loading spinner
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner"></div>';
          this.isSpinnerVisible = true;
        }
        // Display results
        this.typerTimer = setTimeout(this.displayResults.bind(this), 2000);
      } else {
        this.resultsDiv.innerHTML = '';
        this.isSpinnerVisible = false;
      }
    }
    // Update current input value
    this.previousValue = this.searchInput.value;
  }

  displayResults() {
    // Call the fetch function passing the url of the API as a parameter
    fetch(
      'http://localhost:10008/wp-json/wp/v2/posts?search=' +
        this.searchInput.value
    )
      .then((response) =>
        // Your code for handling the data you get from the API
        response.json()
      )
      .then((data) => alert(data[0].title.rendered));
  }

  keyPressed(e) {
    let key = e.keyCode;
    // Open search overlay only if the overlay is currently closed, the key pressed is 's' and there aren't any other input or textarea currently focused
    if (
      key === 83 &&
      !this.isOverlayOpen &&
      !document.querySelector('input:focus, textarea:focus')
    ) {
      this.openOverlay();
    }

    if (key === 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }
}

export default Search;
