<h1>Permiss�es - Adicionar Permiss�es</h1>
<form method="post">
    <label for="name">Nome da permiss�o</label><br />
    <input type="text" name="name"><br/><br/>
    <input type="submit" value="Adicionar">
</form>
<script>
    $(window).on('load',function () {
        $('input[name=name]').focus();
    })
</script>