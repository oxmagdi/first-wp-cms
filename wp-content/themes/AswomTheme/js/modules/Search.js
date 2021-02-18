import $ from 'jquery';

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

    $.getJSON(`${universityData.root_url}/index.php/wp-json/university/v1/search?term=${this.searchField.val()}`, results => {
      console.log(results)
      this.resultsDiv.html(`
            <div class="row">
              <div class="one-third">
                    <h1 class="search-overlay__section-title">Genral Information</h1>
                    ${results.genralInfo.length ? '<ul class="link-list min-list">' : '<p>No genral information matches that search</p>'}
                        ${results.genralInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.type == 'post' ? `By ${item.authorName}` : ''}</li>`).join('')}
                    ${results.genralInfo.length ? '</ul>' : ''}
              </div>
              <div class="one-third">
                    <h1 class="search-overlay__section-title">Programs</h1>
                    ${results.programs.length ? '<ul class="professor-cards">' : '<p>No programs match that search</p>'}
                        ${results.programs.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                    ${results.programs.length ? '</ul>' : ''}
                    <h1 class="search-overlay__section-title">Professors</h1>
                    ${results.professors.length ? '<ul class="link-list min-list">' : '<p>No professors match that search</p>'}
                        ${results.professors.map(item => `
                        <li class="professor-card__list-item">
                          <a class="professor-card" href="${item.permalink}">
                            <img src="${item.image}" alt="" class="professor-card__image">
                            <span class="professor-card__name">${item.title}</span>
                          </a>
                        </li>
                        `).join('')}
                    ${results.professors.length ? '</ul>' : ''}
              </div>
              <div class="one-third">
                    <h1 class="search-overlay__section-title">Events</h1>
                    ${results.events.length ? '' : '<p>No events match that search</p>'}
                        ${results.events.map(item => `
                        <div class="event-summary">
                            <a class="event-summary__date t-center" href="${item.permalink}">
                                <span class="event-summary__month">${item.month}</span>
                                <span class="event-summary__day">${item.day}</span>
                            </a>
                            <div class="event-summary__content">
                                <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                                <p>${item.description}. <a href="${item.permalink}" class="nu gray">Learn more</a></p>
                            </div>
                        </div>
                        `).join('')}
              </div>
            </div>
        `);
    });
    this.isSpinnerVisible = false;
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