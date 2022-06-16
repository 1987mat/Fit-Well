/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _css_style_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../css/style.scss */ "./css/style.scss");
/* harmony import */ var _modules_Search__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/Search */ "./src/modules/Search.js");
/* harmony import */ var _modules_MyComments__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/MyComments */ "./src/modules/MyComments.js");
 // Our modules / classes
// import MobileMenu from './modules/MobileMenu';
// import HeroSlider from './modules/HeroSlider';


 // Instantiate a new object using our modules/classes
// const mobileMenu = new MobileMenu();
// const heroSlider = new HeroSlider();

const search = new _modules_Search__WEBPACK_IMPORTED_MODULE_1__["default"]();
const myComments = new _modules_MyComments__WEBPACK_IMPORTED_MODULE_2__["default"]();

/***/ }),

/***/ "./src/modules/MyComments.js":
/*!***********************************!*\
  !*** ./src/modules/MyComments.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
class MyComments {
  constructor() {
    this.editButton = document.querySelectorAll('.edit-comment');
    this.deleteButton = document.querySelectorAll('.delete-comment');
    this.events();
  }

  events() {
    this.editButton.forEach(item => {
      item.addEventListener('click', this.editComment);
    });
    this.deleteButton.forEach(item => {
      item.addEventListener('click', this.deleteComment);
    });
  } // Methods


  editComment(e) {
    // Get clicked comment
    let comment = e.target.parentElement.parentElement; // Remove readonly attribute

    comment.querySelectorAll('input, textarea').forEach(item => {
      item.readOnly = false;
      item.classList.add('edit-mode');
    }); // Show Save Button

    comment.querySelector('.update-comment').style.display = 'block'; // Send  request
    //   let url =
    //     siteData.root_url + '/wp-json/wp/v2/comment/' + comment.dataset.id;
    //   fetch(url, {
    //     headers: {
    //       'X-WP-Nonce': siteData.nonce,
    //     },
    //     method: 'PUT',
    //   })
    //     .then((response) => response.json())
    //     .then((data) => console.log(data))
    //     .catch((error) => console.log(err));
  }

  deleteComment(e) {
    // Get clicked comment
    let comment = e.target.parentElement.parentElement; // Send delete request

    let url = siteData.root_url + '/wp-json/wp/v2/comment/' + comment.dataset.id;
    fetch(url, {
      headers: {
        'X-WP-Nonce': siteData.nonce
      },
      method: 'DELETE'
    }).then(response => response.json()).then(data => {
      comment.remove();
      console.log('Congrats');
      console.log(data);
    }).catch(error => console.log(error));
  }

}

/* harmony default export */ __webpack_exports__["default"] = (MyComments);

/***/ }),

/***/ "./src/modules/Search.js":
/*!*******************************!*\
  !*** ./src/modules/Search.js ***!
  \*******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
class Search {
  // Initiate object
  constructor() {
    this.resultsDiv = document.querySelector('.results-container');
    this.openOverlayBtn = document.getElementById('search-icon');
    this.closeOverlayBtn = document.getElementById('search-close-btn');
    this.searchOverlay = document.querySelector('.search-overlay');
    this.searchInput = document.getElementById('search-input');
    this.events();
    this.isOverlayOpen = false;
    this.typerTimer;
    this.previousValue;
  } // Create events


  events() {
    this.openOverlayBtn.addEventListener('click', this.openOverlay.bind(this));
    this.closeOverlayBtn.addEventListener('click', this.closeOverlay.bind(this));
    document.addEventListener('keyup', this.keyPressed.bind(this));
    this.searchInput.addEventListener('keyup', this.typingLogic.bind(this));
  } // Methods


  openOverlay() {
    this.searchOverlay.classList.add('search-overlay--active');
    this.searchInput.focus();
    document.body.classList.add('no-scroll');
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove('search-overlay--active');
    document.body.classList.remove('no-scroll');
    this.searchInput.value = '';
    this.resultsDiv.innerHTML = '';
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
  }

  typingLogic() {
    // Hide loading spinner if the search value doesn't change
    if (this.searchInput.value != this.previousValue) {
      clearTimeout(this.typerTimer); // Empty results div and hide spinner if the search field is empty

      if (this.searchInput.value) {
        // Display loading spinner
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner"></div>';
          this.isSpinnerVisible = true;
        } // Display results


        this.typerTimer = setTimeout(this.displayResults.bind(this), 500);
      } else {
        this.resultsDiv.innerHTML = '';
        this.isSpinnerVisible = false;
      }
    } // Update current input value


    this.previousValue = this.searchInput.value;
  }

  displayResults() {
    fetch(siteData.root_url + '/wp-json/fitness/v1/search?term=' + this.searchInput.value).then(response => response.json()).then(results => {
      this.resultsDiv.innerHTML = `<div class="row">
          <div class="one-third">
            <h2>General Information</h2>
            <hr>
            ${results.generalInfo.length ? '<ul>' : '<p>No general information found.</p>'}
            ${results.generalInfo.map(item => `<li><a href="${item.url}">${item.title}</a> 
                  ${item.postType == 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}

          </div>
          <div class="one-third">
            <h2>Classes</h2>
            <hr>
            ${results.classes.length ? '<ul class="search-list">' : `<p>No class matches that search. <a href="${siteData.root_url}/classes">View all classes.</a></p>`}
            ${results.classes.map(item => `
                <li>
                  <a href="${item.url}" class="image-link">
                    <img src="${item.image}" alt="image-link">
                    <span>${item.title}</span>
                  </a>
                </li>
              `).join('')}
              ${results.classes.length ? '</ul>' : ''}
            <h2>Workouts</h2>
            <hr>
            ${results.workouts.length ? '<ul class="search-list">' : `<p>No class matches that search. <a href="${siteData.root_url}/workouts">View all workouts.</a></p>`}
            ${results.workouts.map(item => ` <li>
              <a href="${item.url}" class="image-link">
                <img src="${item.image}" alt="image-link">
                <span>${item.title}</span>
              </a>
            </li>`).join('')}
          </div>
          <div class="one-third">
            <h2>Events</h2>
            <hr>
            ${results.events.length ? '' : '<p>No event matches that search.</p>'}
            ${results.events.map(item => `
                <div class="single-event">
                  <div class="date-container">
                    <p>${item.date}</p>
                  </div>
                  <div class="event-info">
                    <h2><a href="${item.url}">${item.title}</a></h2>
                  </div>
                </div>
              `).join('')}
          </div>
        </div>`;
      this.isSpinnerVisible = false;
    }).catch(error => {
      this.resultsDiv.innerHTML = 'Something went wrong.';
      this.isSpinnerVisible = false;
    });
  }

  keyPressed(e) {
    let key = e.keyCode; // Open search overlay only if the overlay is currently closed, the key pressed is 's' and there aren't any other input or textarea currently focused

    if (key === 83 && !this.isOverlayOpen && !document.querySelector('input:focus, textarea:focus')) {
      this.openOverlay();
    }

    if (key === 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

}

/* harmony default export */ __webpack_exports__["default"] = (Search);

/***/ }),

/***/ "./css/style.scss":
/*!************************!*\
  !*** ./css/style.scss ***!
  \************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	!function() {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = function(result, chunkIds, fn, priority) {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var chunkIds = deferred[i][0];
/******/ 				var fn = deferred[i][1];
/******/ 				var priority = deferred[i][2];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every(function(key) { return __webpack_require__.O[key](chunkIds[j]); })) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	!function() {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"index": 0,
/******/ 			"./style-index": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = function(chunkId) { return installedChunks[chunkId] === 0; };
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = function(parentChunkLoadingFunction, data) {
/******/ 			var chunkIds = data[0];
/******/ 			var moreModules = data[1];
/******/ 			var runtime = data[2];
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some(function(id) { return installedChunks[id] !== 0; })) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkfit_well_theme"] = self["webpackChunkfit_well_theme"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	}();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["./style-index"], function() { return __webpack_require__("./src/index.js"); })
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=index.js.map