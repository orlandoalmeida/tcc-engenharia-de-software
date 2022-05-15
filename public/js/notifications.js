/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/notifications.js ***!
  \***************************************/
window.msgDefault = function () {
  var title = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
  var msg = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
  Lobibox.notify('default', {
    sound: false,
    icon: false,
    size: 'mini',
    position: 'top right',
    title: title,
    msg: msg
  });
};

window.msgInfo = function () {
  var title = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
  var msg = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
  Lobibox.notify('info', {
    sound: false,
    icon: false,
    size: 'mini',
    position: 'top right',
    title: '<i class="fa fa-info-circle"></i> ' + title,
    msg: msg
  });
};

window.msgWarning = function () {
  var title = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
  var msg = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
  Lobibox.notify('warning', {
    sound: false,
    icon: false,
    position: 'top right',
    title: '<i class="fa fa-warning"></i> ' + title,
    msg: msg
  });
};

window.msgError = function () {
  var title = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
  var msg = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
  Lobibox.notify('error', {
    sound: false,
    icon: false,
    position: 'top right',
    title: '<i class="fa fa-times-circle"></i> ' + title,
    msg: msg
  });
};

window.msgSuccess = function () {
  var title = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
  var msg = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
  Lobibox.notify('success', {
    sound: false,
    icon: false,
    position: 'top right',
    title: '<i class="fa fa-check-circle"></i> ' + title,
    msg: msg
  });
};
/******/ })()
;