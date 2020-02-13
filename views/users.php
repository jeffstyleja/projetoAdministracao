<h1>Usuários</h1>
<div class="button"><a href="<?php echo BASE_URL ;?>/users/add">Adicionar Usuário</a> </div>
<table border="0" width="100%">
    <tr>
        <th>Usuário</th>
        <th>Grupo de Permissões</th>
        <th>Empresa</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($user_list as $us): ?>
        <tr>
            <td><?php echo $us['email'] ?></td>
            <td><?php echo $us['name_group'] ?></td>
            <td><?php echo $us['id_company'] ?></td>
            <td width="160px">
                <div class="button button_small button_edit">
                    <a href="<?php echo BASE_URL; ?>/users/edit_users/<?php echo $us['id']; ?>">
                        Editar
                    </a>
                </div>
                <div class="button button_small button_del">
                    <a href="<?php echo BASE_URL; ?>/users/delete_users/<?php echo $us['id']; ?>"
                       onclick="return confirm('Deseja mesmo excluir o Usuário?')">Excluir
                    </a>
                </div>
            </td>
        </tr>
    <?php endforeach;?>
</table>