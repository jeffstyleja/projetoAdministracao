<h1>Permiss�es - Editar Grupo de Permiss�es</h1>
<form method="post">
    <label for="name">Nome do Grupo de Permiss�o</label><br />
    <input type="text" name="name" value="<?php echo $group_info['name']?>"> <br/><br />
    <label>Permiss�es:</label><br /> <br />
    <div class="p_item">
        <?php $params = explode(',',$group_info['params']); ?>
    <?php foreach($permissions_list as $p) : ?>
        <input type="checkbox" name="permissions[]"
               value="<?php echo $p['id']?>"
               id="<?php echo $p['id']?>"
        <?php echo (in_array($p['id'],$params))? 'checked="checked"' : ''?>
        >
        <label for="<?php echo $p['id']?>"><?php echo $p['name'] ?></label><br />
    <?php endforeach; ?>
        <br/><input type="submit" value="Atualizar">
    </div>
</form>