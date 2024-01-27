/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./platform/themes/wowy/assets/js/popup.js ***!
  \*************************************************/
var popup_link = document.querySelectorAll('._popup-link');
var popups = document.querySelectorAll('.popup');
var unlock = true;
if (location.hash) {
  var hsh = location.hash.replace('#', '');
  if (document.querySelector('.popup_' + hsh)) {
    popup_open(hsh);
  } else if (document.querySelector('div.' + hsh)) {
    _goto(document.querySelector('.' + hsh), 500, '');
  }
}
var _loop = function _loop() {
  var el = popup_link[index];
  el.addEventListener('click', function (e) {
    if (unlock) {
      var item = el.getAttribute('href').replace('#', '');
      var video = el.getAttribute('data-video');
      popup_open(item, video);
    }
    e.preventDefault();
  });
};
for (var index = 0; index < popup_link.length; index++) {
  _loop();
}
for (var _index = 0; _index < popups.length; _index++) {
  var popup = popups[_index];
  popup.addEventListener("click", function (e) {
    if (!e.target.closest('.popup__body')) {
      popup_close(e.target.closest('.popup'));
    }
  });
}
function popup_open(item) {
  var video = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
  var activePopup = document.querySelectorAll('.popup._active');
  if (activePopup.length > 0) {
    popup_close('', false);
  }
  var curent_popup = document.querySelector('.popup_' + item);
  if (curent_popup && unlock) {
    if (video != '' && video != null) {
      var popup_video = document.querySelector('.popup_video');
      popup_video.querySelector('.popup__video').innerHTML = '<iframe src="https://www.youtube.com/embed/' + video + '?autoplay=1"  allow="autoplay; encrypted-media" allowfullscreen></iframe>';
    }
    curent_popup.classList.add('_active');
    history.pushState('', '', '#' + item);
  }
}
function popup_close(item) {
  var bodyUnlock = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
  if (unlock) {
    if (!item) {
      for (var _index2 = 0; _index2 < popups.length; _index2++) {
        var _popup = popups[_index2];
        var video = _popup.querySelector('.popup__video');
        if (video) {
          video.innerHTML = '';
        }
        _popup.classList.remove('_active');
      }
    } else {
      var _video = item.querySelector('.popup__video');
      if (_video) {
        _video.innerHTML = '';
      }
      item.classList.remove('_active');
    }
    history.pushState('', '', window.location.href.split('#')[0]);
  }
}
var popup_close_icon = document.querySelectorAll('.popup__close,._popup-close');
if (popup_close_icon) {
  var _loop2 = function _loop2() {
    var el = popup_close_icon[_index3];
    el.addEventListener('click', function () {
      popup_close(el.closest('.popup'));
    });
  };
  for (var _index3 = 0; _index3 < popup_close_icon.length; _index3++) {
    _loop2();
  }
}
document.addEventListener('keydown', function (e) {
  if (e.code === 'Escape') {
    popup_close();
  }
});
/******/ })()
;