/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/validations.js ***!
  \*************************************/
window.validateCPF = function (cpf) {
  cpf = cpf.replace(/[^\d]+/g, '');
  if (cpf == '') return false; // Elimina CPFs invalidos conhecidos

  if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999") return false; // Valida 1o digito

  add = 0;

  for (i = 0; i < 9; i++) {
    add += parseInt(cpf.charAt(i)) * (10 - i);
  }

  rev = 11 - add % 11;
  if (rev == 10 || rev == 11) rev = 0;
  if (rev != parseInt(cpf.charAt(9))) return false; // Valida 2o digito

  add = 0;

  for (i = 0; i < 10; i++) {
    add += parseInt(cpf.charAt(i)) * (11 - i);
  }

  rev = 11 - add % 11;
  if (rev == 10 || rev == 11) rev = 0;
  if (rev != parseInt(cpf.charAt(10))) return false;
  return true;
};

window.validateEmail = function (value) {
  var valid = true;
  var email = value.replace(';', ',').split(",");
  jQuery.each(email, function () {
    if (jQuery.trim(this) != '') {
      if (!jQuery.trim(this).match(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i)) valid = false;
    }
  });
  return valid;
};

window.cpfMask = function (val) {
  return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-009';
}, cpfOptions = {
  onKeyPress: function onKeyPress(val, e, field, options) {
    field.mask(cpfMascara.apply({}, arguments), options);
  }
};

if ($('.documento').length) {
  $('.documento').mask(cpfMascara, cpfOptions);
}

$('.data').mask('99/99/9999', {
  placeholder: "__/__/____"
});
$('.cep').mask('99999-999');
$('.rg').mask('99.999.999-A');
$('.cpf').mask('999.999.999-99');
$('.money').mask("#.##0,00", {
  reverse: true
});
$('.telefone').mask("(99) 99999-9999").focusout(function (event) {
  var target, phone, element;
  target = event.currentTarget ? event.currentTarget : event.srcElement;
  phone = target.value.replace(/\D/g, '');
  element = $(target);
  element.unmask();

  if (phone.length > 10) {
    element.mask("(99) 99999-9999");
  } else {
    element.mask("(99) 9999-9999");
  }
});
/******/ })()
;