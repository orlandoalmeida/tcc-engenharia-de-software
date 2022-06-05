window.removeConta = function (user, token) {
    Swal.fire({
        title: "Remover conta",
        text: "Você está prestes a remover uma contas, tem certeza que deseja continuar?",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Sim, deletar"
    }).then(function (
        t
    ) {
        if (t.value != undefined && t.value == true) {
            $.ajax({
                url: baseUri + '/conta/' + user.id,
                type: 'DELETE',
                data: {
                    "id": user.id,
                    "_token": token,
                },
                success: function () {
                    t.value && Swal.fire("Deletado!", "conta deletada com sucesso.", "success").then(() => {
                        setTimeout(() => {
                            window.location.reload();
                        }, 550);
                    });
                    msgSuccess('conta deletada com sucesso.', '');
                    let $user_remove = '#conta-' + user.id;
                    $($user_remove).remove();
                }
            });
        }
    });
}