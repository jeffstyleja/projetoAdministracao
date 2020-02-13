<h1>Permissões - Adicionar Permissões</h1>
<form method="post">
    <label for="name">Nome da permissão</label><br />
    <input type="text" name="name"><br/><br/>
    <input type="submit" value="Adicionar">
</form>
<script>
    $(window).on('load',function () {
        $('input[name=name]').focus();
    })
</script>