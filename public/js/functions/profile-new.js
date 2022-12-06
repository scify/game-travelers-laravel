/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/functions/profile-new.js ***!
  \***********************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
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
/******/ })()
;