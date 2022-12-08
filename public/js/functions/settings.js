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
/*
 * Avatar Selection Functions.
 */
window.addEventListener("load", function () {
  // Functions for New Profile form, Step 1.
  var thisPage = document.getElementById("profileNewStep1");
  if (thisPage) {
    (function () {
      var updateSubmitButtonState = function updateSubmitButtonState() {
        var playerName = playerNameInput.value;
        var playerAvatarId = parseInt(playerAvatarInput.value);
        if (playerName.length >= 2 && !isNaN(playerAvatarId) && playerAvatarId > 0) {
          submitButton.disabled = false;
        } else {
          submitButton.disabled = true;
        }
      };
      var buttons = document.querySelectorAll("button[data-avatar='true']");
      var playerNameInput = document.getElementById("playerName");
      var playerAvatarInput = document.getElementById("playerAvatarId");
      var submitButton = document.getElementById("submitButton");
      if (buttons.length) {
        // Reset playerAvatarInput to either the filled or default state (0)
        filledAvatarId = parseInt(playerAvatarInput.value);
        if (filledAvatarId === 0) {
          updateSubmitButtonState();
        } else {
          console.log(playerAvatarInput.value);
          var _iterator = _createForOfIteratorHelper(buttons),
            _step;
          try {
            for (_iterator.s(); !(_step = _iterator.n()).done;) {
              var btn = _step.value;
              var avatarId = btn.getAttribute("data-avatar-id");
              if (parseInt(avatarId) === filledAvatarId) {
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
            _iterator.e(err);
          } finally {
            _iterator.f();
          }
          updateSubmitButtonState();
        }
        // Add listeners to the buttons
        playerNameInput.addEventListener('input', updateSubmitButtonState);
        var _iterator2 = _createForOfIteratorHelper(buttons),
          _step2;
        try {
          var _loop = function _loop() {
            var btn = _step2.value;
            btn.addEventListener("click", function () {
              // Get the selected avatar id:
              var avatarId = btn.getAttribute("data-avatar-id");
              var input = document.getElementById("playerAvatarId");
              input.value = avatarId;
              // Add the faded class to all avatars:
              var _iterator3 = _createForOfIteratorHelper(buttons),
                _step3;
              try {
                for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
                  var b = _step3.value;
                  b.classList.remove("selected");
                  b.classList.add("faded");
                  b.setAttribute("aria-checked", "false");
                }
                // Add the selected class to the clicked avatar:
              } catch (err) {
                _iterator3.e(err);
              } finally {
                _iterator3.f();
              }
              btn.classList.remove("faded");
              btn.classList.add("selected");
              btn.setAttribute("aria-checked", "true");
              updateSubmitButtonState();
            });
          };
          for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
            _loop();
          }
        } catch (err) {
          _iterator2.e(err);
        } finally {
          _iterator2.f();
        }
      }
    })();
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
window.addEventListener('load', function () {
  // First, select all of the input fields with the data-role="groupSetter" attribute
  var groupSetters = document.querySelectorAll("input[data-role='groupSetter']");
  if (groupSetters) {
    (function () {
      // Function
      var setGroupSetterStates = function setGroupSetterStates(groupSetter) {
        var enables = groupSetter.getAttribute("data-enables");
        var disables = groupSetter.getAttribute("data-disables");
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
          groupSetter.addEventListener('change', function () {
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
  var keyAssigners = document.querySelectorAll("[data-role='keyAssigner']");
  var keyAssignersInputs = document.querySelectorAll("[data-role='keyAssignerInput']");
  var returnKey = "Error";
  if (keyAssigners) {
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
          function abortByClick(event) {
            // Abort only if the click is NOT triggered by clicking
            // the actual keyAssigner.
            if (event.target !== keyAssigner) {
              event.stopPropagation();
              console.log("aborted", event);
              keyAssigner.classList.remove("active");
              // Revert to default though :(
              keyAssigner.textContent = keyAssigner.getAttribute("data-key-default");
              // Cancel just one thing, not EVERYTHING.
              window.removeEventListener("click", abortByClick);
            }
          }
          keyAssigner.textContent = "όρισε πλήκτρο";
          keyAssigner.classList.add("active");
          // Cancel the whole thing by a single click of a button...
          window.addEventListener("click", abortByClick);
          // When a button is clicked, ask user to press a key
          window.addEventListener("keyup", function (event) {
            // Override default browser's behavior for keys as e.g. Tab
            // would cause the selection of the next input element.
            event.preventDefault();
            // If we still run an active click listener, abort it...
            window.removeEventListener("click", abortByClick);
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
              // console.log('key: "', event.key, '" code: ', event.code, ' charcode: ', charCode);
            }

            if (returnKey === "Error") {
              returnKey = keyAssigner.getAttribute("data-key-default");
            }
            // Sets and returns button's input to form.
            keyAssigner.textContent = returnKey;
            keyAssigner.setAttribute("data-key-selected", returnKey);
            setInputId = keyAssigner.getAttribute("data-sets-input");
            setInput = document.getElementById(setInputId);
            setInput.value = returnKey;
            keyAssigner.classList.remove('active');
          });
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
window.addEventListener('load', function () {
  var rangeElements = document.querySelectorAll('[type="range"]');
  if (rangeElements.length > 0) {
    var _loop = function _loop(i) {
      var element = rangeElements[i];
      var elementId = element.getAttribute('id');
      var label = document.querySelector("[for=\"".concat(elementId, "\"]"));
      if (parseInt(element.value) === 1) {
        label.textContent = "".concat(element.value, " \u03B4\u03B5\u03C5\u03C4\u03B5\u03C1\u03CC\u03BB\u03B5\u03C0\u03C4\u03BF");
      } else {
        label.textContent = "".concat(element.value, " \u03B4\u03B5\u03C5\u03C4\u03B5\u03C1\u03CC\u03BB\u03B5\u03C0\u03C4\u03B1");
      }
      element.addEventListener('change', function (event) {
        if (parseInt(element.value) === 1) {
          label.textContent = "".concat(element.value, " \u03B4\u03B5\u03C5\u03C4\u03B5\u03C1\u03CC\u03BB\u03B5\u03C0\u03C4\u03BF");
        } else {
          label.textContent = "".concat(element.value, " \u03B4\u03B5\u03C5\u03C4\u03B5\u03C1\u03CC\u03BB\u03B5\u03C0\u03C4\u03B1");
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