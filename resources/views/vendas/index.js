window.removeVenda = function (user, token) {
    Swal.fire({
        title: "Remover venda",
        text: "Você está prestes a remover um venda, tem certeza que deseja continuar?",
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
                url: baseUri + '/venda/' + user.id,
                type: 'DELETE',
                data: {
                    "id": user.id,
                    "_token": token,
                },
                success: function () {
                    t.value && Swal.fire("Deletado!", "venda deletado com sucesso.", "success").then(() => {
                        setTimeout(() => {
                            window.location.reload();
                        }, 550);
                    });
                    msgSuccess('venda deletado com sucesso.', '');
                    let $user_remove = '#venda-' + user.id;
                    $($user_remove).remove();
                }
            });
        }
    });
}