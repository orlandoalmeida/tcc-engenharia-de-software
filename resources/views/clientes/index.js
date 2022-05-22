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
    }).then(function (
        t
    ) {
        $.ajax({
            url: baseUri + '/cliente/' + user.id,
            type: 'DELETE',
            data: {
                "id": user.id,
                "_token": token,
            },
            success: function () {
                t.value && Swal.fire("Deletado!", "cliente deletado com sucesso.", "success").then(()=>{
                    setTimeout(()=>{
                        window.location.reload();
                    }, 550);
                });
                msgSuccess('cliente deletado com sucesso.', '');
                let $user_remove = '#cliente-'+user.id;
                $($user_remove).remove();
            }
        });
    });
}