<h1>Permiss�es - Adicionar Grupo de Permiss�es</h1>
<form method="post">
    <label for="name">Nome do Grupo de Permiss�o</label><br />
    <input type="text" name="name"> <br/><br />
    <label>Permiss�es:</label><br /> <br />
    <div class="p_item">
    <?php foreach($permissions_list as $p) : ?>
        <input type="checkbox" name="permissions[]" value="<?php echo $p['id']?>" id="<?php echo $p['id']?>">
        <label for="<?php echo $p['id']?>"><?php echo $p['name'] ?></label><br />
    <?php endforeach; ?>
        <br/><input type="submit" value="Adicionar">
    </div>
</form>