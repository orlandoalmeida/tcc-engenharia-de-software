window.completaEndereco=function(a){var l=a.replace(/\D/g,"");if(""!=l)if(/^[0-9]{8}$/.test(l)){$(".rua").val("..."),$(".bairro").val("..."),$(".cidade").val("..."),$(".uf").val("...");var o="//viacep.com.br/ws/"+l+"/json/";$.getJSON(o).then((function(a){a.erro?($("#cep-invalido").html(" CEP inválido."),$(".cep").focus(),limpa_formulário_cep()):($(".rua").val(a.logradouro),$(".bairro").val(a.bairro),$(".cidade").val(a.localidade),$(".uf").val(a.uf),$(".uf").trigger("change"),$(".numero").focus(),$("#cep-invalido").html(""))}))}else limpa_formulário_cep(),$("#cep-invalido").html(" Formato de CEP inválido."),$(".cep").focus();else limpa_formulário_cep(),$("#cep-invalido").html("")},window.limpa_formulário_cep=function(){$(".cep").val(""),$(".rua").val(""),$(".bairro").val(""),$(".cidade").val(""),$(".numero").val(""),$(".uf").val("")};