window.removeUsuario = function (user, token) {
    Swal.fire({
        title: "Remover funcionário",
        text: "Você está prestes a remover um funcionário, tem certeza que deseja continuar?",
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
                url: baseUri + '/funcionario/' + user.id,
                type: 'DELETE',
                data: {
                    "id": user.id,
                    "_token": token,
                },
                success: function () {
                    t.value && Swal.fire("Deletado!", "funcionário deletado com sucesso.", "success").then(() => {
                        setTimeout(() => {
                            window.location.reload();
                        }, 550);
                    });
                    msgSuccess('funcionário deletado com sucesso.', '');
                    let $user_remove = '#funcionario-' + user.id;
                    $($user_remove).remove();
                }
            });
        }
    });
}