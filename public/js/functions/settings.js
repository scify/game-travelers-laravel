/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***************************************************!*\
  !*** ./resources/js/settings/avatar-selection.js ***!
  \***************************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
/**
 * Avatar Selection Functions.
 * Requirements:
 * - Avatar <buttons> with the data-avatar=true and other data-attributes.
 * - A hidden input element with id=#selectedAvatarId.
 * - A submit button with the id=#submitButton.
 */
window.addEventListener("load", function () {
  var btnId;
  // Should only run on pages with avatarsContainer & for related buttons.
  var avatarsContainer = document.getElementById("avatarsContainer");
  // Let the fun begin!

  if (avatarsContainer) {
    var buttons = avatarsContainer.querySelectorAll('button[data-avatar="true"]');
    if (buttons) {
      (function () {
        /**
         * Form validation function.
         *
         * Allows submission of a form only if a valid avatar is selected.
         * Reads selected id value from a hidden #avatarsContainerInput input.
         * If an #playerNameInput input is on the same page, then it's value is
         * also take under consideration for validation.
         */
        // eslint-disable-next-line no-inner-declarations
        var updateSubmitButtonState = function updateSubmitButtonState() {
          var submitButton = document.getElementById("submitButton");
          var secondaryButton = document.getElementById("secondaryButton");
          var idValue = idInput ? parseInt(idInput.value) : 0;
          // Nothing to update if (primary) Submit Button does not exist.
          if (!submitButton) {
            return false;
          }
          // If nameInput, then we are on the create new profile page.
          if (nameInput) {
            var nameValue = nameInput.value;
            submitButton.disabled = !(nameValue.length >= 2 && !isNaN(idValue) && idValue > 0);
            // If !nameInput, then we are just updating an existing profile.
          } else {
            if (!isNaN(idValue) && idValue > 0) {
              submitButton.disabled = false;
              if (secondaryButton) {
                secondaryButton.disabled = false;
              }
            } else {
              submitButton.disabled = true;
              if (secondaryButton) {
                secondaryButton.disabled = true;
              }
            }
          }
        };
        /**
         * Avatar handler function.
         */
        // eslint-disable-next-line no-inner-declarations
        var handleAvatarState = function handleAvatarState(btn) {
          var id;
          // Get the button's role:
          var role = btn.getAttribute("data-role");
          if (role && role === "player") {
            id = btn.getAttribute("data-player-id");
          } else {
            id = btn.getAttribute("data-avatar-id");
          }
          // Get the selected avatar id and update the linked input field:
          idInput.value = id;
          // Add the faded class to all avatars:
          var _iterator = _createForOfIteratorHelper(buttons),
            _step;
          try {
            for (_iterator.s(); !(_step = _iterator.n()).done;) {
              var b = _step.value;
              b.classList.remove("selected");
              b.classList.add("faded");
              b.setAttribute("aria-checked", "false");
            }
            // Add the selected class to the clicked avatar:
          } catch (err) {
            _iterator.e(err);
          } finally {
            _iterator.f();
          }
          btn.classList.remove("faded");
          btn.classList.add("selected");
          btn.setAttribute("aria-checked", "true");
          updateSubmitButtonState();
        }; // TODO: Remove if not used.
        // function animateAvatarButtons(buttons) {
        // 	const reducedMotionQuery = window.matchMedia(
        // 		"(prefers-reduced-motion: reduce)"
        // 	);
        // 	if (
        // 		reducedMotionQuery.media !== "not all" &&
        // 		!reducedMotionQuery.matches
        // 	) {
        // 		for (let i = 0; i < buttons.length; i++) {
        // 			let anBtn = buttons[i];
        // 			const anDelay = 300 + i * 50;
        // 			setTimeout(() => {
        // 				anBtn.style.transform = "scale(1)";
        // 				anBtn.style.transition = "0.2s linear";
        // 				requestAnimationFrame(() => {
        // 					anBtn.style.transform = "scale(1.2)";
        // 				});
        // 				setTimeout(() => {
        // 					anBtn.style.transform = "scale(1)";
        // 				}, anDelay);
        // 			}, anDelay);
        // 		}
        // 	}
        // }
        // Form initialization:
        // Reset playerAvatarInput to either the filled or default state (0) &
        // set the proper classes to the initialized avatar buttons.
        // Variables for reading/validating/processing various form elements.
        var idInput = document.getElementById("avatarsContainerInput");
        var nameInput = document.getElementById("playerNameInput");
        var initialFormIdValue = idInput ? parseInt(idInput.value) : 0;
        if (initialFormIdValue === 0) {
          updateSubmitButtonState();
          // Animate on (initial) load!
          // animateAvatarButtons(buttons);
        } else {
          var _iterator2 = _createForOfIteratorHelper(buttons),
            _step2;
          try {
            for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
              var btn = _step2.value;
              var btnRole = btn.getAttribute("data-role");
              if (btnRole === "player") {
                btnId = btn.getAttribute("data-player-id");
              } else {
                btnId = btn.getAttribute("data-avatar-id");
              }
              if (parseInt(btnId) === initialFormIdValue) {
                btn.classList.remove("faded");
                btn.classList.add("selected");
                btn.setAttribute("aria-checked", "true");
              } else {
                btn.classList.add("faded");
                btn.classList.remove("selected");
                btn.setAttribute("aria-checked", "false");
              }
            }
          } catch (err) {
            _iterator2.e(err);
          } finally {
            _iterator2.f();
          }
          updateSubmitButtonState();
        }

        // Add event listeners:
        // Add an event listener to playerName input to trigger form validation.
        if (nameInput) {
          nameInput.addEventListener("input", updateSubmitButtonState);
        }
        // Add event listeners to the avatar buttons.
        var _iterator3 = _createForOfIteratorHelper(buttons),
          _step3;
        try {
          var _loop = function _loop() {
            var btn = _step3.value;
            btn.addEventListener("click", function () {
              return handleAvatarState(btn);
            });
          };
          for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
            _loop();
          }
        } catch (err) {
          _iterator3.e(err);
        } finally {
          _iterator3.f();
        }
      })();
    }
  }
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*************************************************!*\
  !*** ./resources/js/settings/dice-selection.js ***!
  \*************************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
/**
  * Dice Selection Functions.
  */
window.addEventListener("load", function () {
  var diceImages = document.querySelectorAll("img[data-role='dice']");
  if (diceImages.length) {
    var _iterator = _createForOfIteratorHelper(diceImages),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var img = _step.value;
        img.addEventListener("click", function (event) {
          var checkboxId = event.target.getAttribute("data-for");
          if (checkboxId) {
            var checkbox = document.getElementById(checkboxId);
            if (checkbox) {
              checkbox.checked = true;
            }
          }
        });
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
  }
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***********************************************!*\
  !*** ./resources/js/settings/group-setter.js ***!
  \***********************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
/*
 * Group Setters Functions.
 */
window.addEventListener("load", function () {
  // First, select all of the input fields with the data-role="groupSetter" attribute
  var groupSetters = document.querySelectorAll("input[data-role='groupSetter']");
  if (groupSetters.length) {
    (function () {
      // Function
      // eslint-disable-next-line no-inner-declarations
      var setGroupSetterStates = function setGroupSetterStates(groupSetter) {
        var enables = groupSetter.getAttribute("data-enables");
        var disables = groupSetter.getAttribute("data-disables");
        var dataKeySelected;
        if (groupSetter.checked) {
          var enableEl = document.getElementById(enables);
          enableEl.classList.remove("opacity-50");
          enableEl.classList.add("opacity-100");
          var enableBtns = enableEl.getElementsByTagName("button");
          if (enableBtns) {
            var _iterator = _createForOfIteratorHelper(enableBtns),
              _step;
            try {
              for (_iterator.s(); !(_step = _iterator.n()).done;) {
                var enableBtn = _step.value;
                enableBtn.disabled = false;
                dataKeySelected = enableBtn.getAttribute("data-key-selected");
                if (dataKeySelected) {
                  enableBtn.textContent = enableBtn.getAttribute("data-key-selected");
                } else {
                  enableBtn.textContent = enableBtn.getAttribute("data-key-default");
                }
              }
            } catch (err) {
              _iterator.e(err);
            } finally {
              _iterator.f();
            }
          }
          var disableEl = document.getElementById(disables);
          disableEl.classList.remove("opacity-100");
          disableEl.classList.add("opacity-50");
          var disableBtns = disableEl.getElementsByTagName("button");
          if (disableBtns) {
            var _iterator2 = _createForOfIteratorHelper(disableBtns),
              _step2;
            try {
              for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
                var disableBtn = _step2.value;
                disableBtn.disabled = true;
                disableBtn.textContent = "όρισε πλήκτρο";
              }
            } catch (err) {
              _iterator2.e(err);
            } finally {
              _iterator2.f();
            }
          }
        }
      };
      var _iterator3 = _createForOfIteratorHelper(groupSetters),
        _step3;
      try {
        var _loop = function _loop() {
          var groupSetter = _step3.value;
          setGroupSetterStates(groupSetter);
          // Add listener
          groupSetter.addEventListener("change", function () {
            setGroupSetterStates(groupSetter);
          });
        };
        for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
          _loop();
        }
      } catch (err) {
        _iterator3.e(err);
      } finally {
        _iterator3.f();
      }
    })();
  }
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***************************************!*\
  !*** ./resources/js/settings/help.js ***!
  \***************************************/
/*
 * Help & Tooltips Functions.
 */
window.addEventListener("load", function () {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    // eslint-disable-next-line no-undef
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***********************************************!*\
  !*** ./resources/js/settings/key-assigner.js ***!
  \***********************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
/*
 * Key Assigner Functions.
 */
window.addEventListener("load", function () {
  // Get a reference to all the buttons with the 'keyAssigner' data-role
  var keyAssigners = document.querySelectorAll("button[data-role='keyAssigner']");
  var keyAssignersInputs = document.querySelectorAll("input[data-role='keyAssignerInput']");
  var returnKey = "Error";
  if (keyAssigners.length) {
    var _iterator = _createForOfIteratorHelper(keyAssigners),
      _step;
    try {
      var _loop = function _loop() {
        var keyAssigner = _step.value;
        // Initialize button values on forms, if not properly set based on
        // the actual Inputs. Hopefully it works as intended.
        if (keyAssignersInputs) {
          var _iterator2 = _createForOfIteratorHelper(keyAssignersInputs),
            _step2;
          try {
            for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
              var keyAssignerInput = _step2.value;
              if (keyAssignerInput.value) {
                var keyAssignerInputId = keyAssignerInput.getAttribute("id");
                var keyAssignerButton = document.querySelector("[data-sets-input=".concat(keyAssignerInputId, "]"));
                if (keyAssignerButton) {
                  keyAssignerButton.textContent = keyAssignerInput.value;
                  keyAssignerButton.setAttribute("data-key-selected", keyAssignerInput.value);
                }
              }
            }
          } catch (err) {
            _iterator2.e(err);
          } finally {
            _iterator2.f();
          }
        }
        // Add click events to all buttons in order to set-up keyup events.
        keyAssigner.addEventListener("click", function () {
          /** Removes active assignerKeyUpHandler events. */
          function assignerClickHandler(event) {
            // Should not abort if the click is on the actual trigger.
            if (event.target !== keyAssigner) {
              console.log("event logged");
              event.stopPropagation();
              console.log("aborted", event);
              keyAssigner.classList.remove("active");
              // Revert to default though :(
              keyAssigner.textContent = keyAssigner.getAttribute("data-key-default");
              window.removeEventListener("keyup", assignerKeyUpHandler);
              window.removeEventListener("click", assignerClickHandler);
            }
          }

          /** KeyUp event listener for Key Assigner. */
          function assignerKeyUpHandler(event) {
            // Override the default behavior of keys.
            event.preventDefault();
            // Click event listeners are not needed anymore.
            window.removeEventListener("click", assignerClickHandler);
            // When a key is pressed, get its key value.
            // Note: Even if extremely useful, `event.which` and
            // `event.keyCode` are deprecated. Instead we rely on
            // `.key` and `.code`.
            // @see https://www.toptal.com/developers/keycode/for/Space
            if (event.key.length) {
              var charCode = event.key.charCodeAt(0);
              // Further reading:
              // @see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/charCodeAt
              // @see https://stackoverflow.com/questions/67655744/get-key-value-of-key-pressed-with-javascriiipt/67656033#67656033
              if (event.key.length > 1 && charCode < 128) {
                // Named attribute (e.g. Enter)
                // Note that some named keys should be excluded as
                // they are used for controlling the browser (e.g.
                // the Win key on Windows, the Cmd & Option keys on
                // Mac, etc. etc. We might settle with a safe list.
                // In case of error, we simply revert to the default
                // key for each keyAssigner, passed via the
                // data-key-default attribute.
                // Forbidden list so far, contains buttons reserved
                // for accessibility (Escape, Tab, ShiftLeft). Note
                // that Space and Enter are also problematic...
                var forbiddenList = ["Escape", "Tab", "ShiftLeft"];
                if (forbiddenList.indexOf(event.code) !== -1) {
                  // Selected key is in the forbidden list!
                  // If we simply don't do anything in here,
                  // the key press will simply be ignored.
                  // If we return false, the key press will simply
                  // be ignored and we will keep on waiting for
                  // the next key press...
                  return false;
                } else {
                  returnKey = event.code;
                }
              } else {
                // Unicode character
                if (charCode === 32) {
                  // Believe it or not, " " is indeed NOT a name
                  // attribute. And it's not a Spacebar, but
                  // simply "Space". Regardless, we convert this
                  // to a named character to make back-end's life
                  // easier.
                  returnKey = "Space";
                } else {
                  returnKey = event.key;
                }
              }
            }
            if (returnKey === "Error") {
              returnKey = keyAssigner.getAttribute("data-key-default");
            }
            keyAssigner.textContent = returnKey;
            keyAssigner.setAttribute("data-key-selected", returnKey);
            var setInputId = keyAssigner.getAttribute("data-sets-input");
            var setInput = document.getElementById(setInputId);
            setInput.value = returnKey;
            keyAssigner.classList.remove("active");
            // Removes self (like once() used to do).
            window.removeEventListener("keyup", assignerKeyUpHandler);
          }
          keyAssigner.textContent = "όρισε πλήκτρο";
          keyAssigner.classList.add("active");
          // Cancel the whole thing by a single click of a button...
          window.addEventListener("click", assignerClickHandler);
          // When a button is clicked, ask user to press a key
          window.addEventListener("keyup", assignerKeyUpHandler);
        });
      };
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        _loop();
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
  }
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***********************************************!*\
  !*** ./resources/js/settings/range-labels.js ***!
  \***********************************************/
/*
 * Range Labels Functions.
 */
window.addEventListener("load", function () {
  var rangeElements = document.querySelectorAll('input[type="range"]');
  if (rangeElements.length) {
    var _loop = function _loop(i) {
      var element = rangeElements[i];
      var elementId = element.getAttribute("id");
      var label = document.querySelector("[for=\"".concat(elementId, "\"]"));
      if (parseInt(element.value) === 1) {
        label.textContent = "\u03BA\u03AC\u03B8\u03B5 ".concat(element.value, " \u03B4\u03B5\u03C5\u03C4\u03B5\u03C1\u03CC\u03BB\u03B5\u03C0\u03C4\u03BF");
      } else {
        label.textContent = "\u03BA\u03AC\u03B8\u03B5 ".concat(element.value, " \u03B4\u03B5\u03C5\u03C4\u03B5\u03C1\u03CC\u03BB\u03B5\u03C0\u03C4\u03B1");
      }
      element.addEventListener("change", function () {
        if (parseInt(element.value) === 1) {
          label.textContent = "\u03BA\u03AC\u03B8\u03B5 ".concat(element.value, " \u03B4\u03B5\u03C5\u03C4\u03B5\u03C1\u03CC\u03BB\u03B5\u03C0\u03C4\u03BF");
        } else {
          label.textContent = "\u03BA\u03AC\u03B8\u03B5 ".concat(element.value, " \u03B4\u03B5\u03C5\u03C4\u03B5\u03C1\u03CC\u03BB\u03B5\u03C0\u03C4\u03B1");
        }
        var ruler = document.querySelector("div[data-role=\"ruler\"][data-value=\"".concat(element.value, "\"]"));
        if (ruler) {
          ruler.classList.add("selected");
          // Remove the "selected" class after 2 seconds
          setTimeout(function () {
            ruler.classList.remove("selected");
          }, 2000);
        }
      });
    };
    for (var i = 0; i < rangeElements.length; i++) {
      _loop(i);
    }
  }
});
})();

/******/ })()
;