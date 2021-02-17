import $, { post } from 'jquery';

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.addSearchHTML();
    this.resultsDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.events();
    this.previousValue;
    this.isSpinnerVisible = false;
    this.isOverlayOpen = false;
    this.typingTimer;
  }

  // 2. events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    $(document).on("keydown", this.keyPressdispatcher.bind(this));

    this.closeButton.on("click", this.closeOverlay.bind(this));

    this.searchField.on("keyup", this.typingLogic.bind(this));
  }


  // 3. methods (function, action...)
  typingLogic() {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);
      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.html("");
        this.isSpinnerVisible = false;
      }
    }
    this.previousValue = this.searchField.val();
  }

  getResults() {
    $.when(
      $.getJSON(`${universityData.root_url}/index.php/wp-json/wp/v2/posts?search=${this.searchField.val()}`),
      $.getJSON(`${universityData.root_url}/index.php/wp-json/wp/v2/pages?search=${this.searchField.val()}`),
    ).then((posts, pages) => {
      var combinedResults = posts[0].concat(pages[0]);
      this.resultsDiv.html(`
        <h1 class="search-overlay__section-title">Genral Information</h1>
        ${combinedResults.length ? '<ul class="link-list min-list">' : '<p>No genral information matches that search</p>'}
          ${combinedResults.map(post => `<li><a href="${post['link']}">${post['title']['rendered']}</a></li>`).join('')}
      ${combinedResults.length ? '</ul>' : ''}
      `);

      this.isSpinnerVisible = false;
    }, () => {
      this.resultsDiv.html('<p>Unexpected error; please try agian</p>');
    });


    $.getJSON(`${universityData.root_url}/index.php/wp-json/wp/v2/posts?search=${this.searchField.val()}`, posts => {
      // alert(posts[0]['title']['rendered']);
      this.resultsDiv.html(`
            <h1 class="search-overlay__section-title">Genral Information</h1>
            ${posts.length ? '<ul class="link-list min-list">' : '<p>No genral information matches that search</p>'}
              ${posts.map(post => `<li><a href="${post['link']}">${post['title']['rendered']}</a></li>`).join('')}
            ${posts.length ? '</ul>' : ''}
      `);

      this.isSpinnerVisible = false;
    });
  }

  keyPressdispatcher(e) {
    if (e.keyCode == 83 && !this.isOverlayOpen && !$('input, textarea').is(':focus')) {
      this.openOverlay();
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $('body').addClass('body-no-scroll');
    this.searchField.val('');
    setTimeout(() => this.searchField.focus(), 301);
    console.log('opened');
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $('body').removeClass('body-no-scroll');
    console.log('closed');
    this.isOverlayOpen = false;
  }

  addSearchHTML() {
    $('body').append(`
    <div class="search-overlay">
    <div class="search-overlay__top">
      <div class="container">
        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
        <input type="text" class="search-term" id="search-term" placeholder="What are you looking for ?" /> 
        <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
      </div>
    </div>
    <div class="container">
      <div class="search-overlay__results" id="search-overlay__results">
      </div>
    </div>
  </div>
    `);
  }
}

export default Search;