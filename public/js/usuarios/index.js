window.removeUsuario=function(e,o){Swal.fire({title:"Remover usuário",text:"Você está prestes a remover um usuário, tem certeza que deseja continuar?",type:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Cancelar",confirmButtonText:"Sim, deletar"}).then((function(t){$.ajax({url:baseUri+"/usuario/"+e.id,type:"DELETE",data:{id:e.id,_token:o},success:function(){t.value&&Swal.fire("Deletado!","Usuário deletado com sucesso.","success").then((function(){setTimeout((function(){window.location.reload()}),550)})),msgSuccess("Usuário deletado com sucesso.","");var o="#usuario-"+e.id;$(o).remove()}})}))};