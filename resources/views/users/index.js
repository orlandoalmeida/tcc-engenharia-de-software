window.removeUser = function (user, token) {
    Swal.fire({
        title: "Remover usuário",
        text: "Você está prestes a remover um usuário, tem certeza que deseja continuar?",
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
            url: baseUri + '/usuario/' + user.id,
            type: 'DELETE',
            data: {
                "id": user.id,
                "_token": token,
            },
            success: function () {
                t.value && Swal.fire("Deletado!", "Usuário deletado com sucesso.", "success").then(()=>{
                    setTimeout(()=>{
                        window.location.reload();
                    }, 550);
                });
                msgSuccess('Usuário deletado com sucesso.', '');
                let $user_remove = '#usuario-'+user.id;
                $($user_remove).remove();
            }
        });
    });
}