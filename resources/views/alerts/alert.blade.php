<script src="/js/sweetalert2.all.min.js"></script>
<script>
    let status = {{session('status')}};
    console.log(111);
    let opcao = ['cadastrado', 'editado', 'eliminado', 'criado', 'removido'];
    let error_opcao = ['cadastrar', 'editar', 'eliminar', 'criar', 'remover'];
    console.log(status);
    if(status == 1) {
        Swal.fire( `{{session('message')}} ${opcao[{{session('opcao')}}]} com sucesso`
, '', 'success' )
    }else if(status == 0) {
        Swal.fire( `Erro ao ${error_opcao[{{session('opcao')}}]} {{session('message')}}`
    , '', 'error' )
    }
</script>
