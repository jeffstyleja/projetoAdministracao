<h1>Usuários - Adicionar Usuário</h1>
<?php if (isset($error_msg) && !empty($error_msg)) : ?>
<div class="warning">
    <?php echo $error_msg; ?>
</div>
<?php endif; ?>
<form method="post">
    <label for="name">Email usuário</label><br />
    <?php echo $user_info['email']; ?>
    <br /><br />
    <label for="password">Senha usuario</label><br />
    <input type="password" name="password" value="******"> <br/><br />
    <label for="group">Grupo:</label><br />
    <select name="group" id ="group">
        <?php foreach($group_list as $p) : ?>
            <option value="<?php echo $p['id']?>" <?php echo ($p['id'] == $user_info['group'])? 'selected=selected':'' ?>><?php echo $p['name'] ?></option><?php endforeach; ?>
    </select><br/><br />
    <input type="submit" value="Salvar">
</form>