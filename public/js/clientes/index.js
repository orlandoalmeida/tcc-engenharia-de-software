/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/views/clientes/index.js ***!
  \*******************************************/
window.removeUsuario = function (user, token) {
  Swal.fire({
    title: "Remover cliente",
    text: "Você está prestes a remover um cliente, tem certeza que deseja continuar?",
    type: "warning",
    showCancelButton: !0,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sim, deletar"
  }).then(function (t) {
    if (t.value != undefined && t.value == true) {
      $.ajax({
        url: baseUri + '/cliente/' + user.id,
        type: 'DELETE',
        data: {
          "id": user.id,
          "_token": token
        },
        success: function success() {
          t.value && Swal.fire("Deletado!", "cliente deletado com sucesso.", "success").then(function () {
            setTimeout(function () {
              window.location.reload();
            }, 550);
          });
          msgSuccess('cliente deletado com sucesso.', '');
          var $user_remove = '#cliente-' + user.id;
          $($user_remove).remove();
        }
      });
    }
  });
};
/******/ })()
;