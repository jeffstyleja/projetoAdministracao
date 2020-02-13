<h1>Permissões</h1>
<div class="tabarea">
    <div class="tabitem activetab">Grupos de permissões</div>
    <div class="tabitem">Permissões</div>
</div>
<div class="tabcontent">
    <div class="tabbody" style="display: block">
        <a href="<?php echo BASE_URL; ?>/permissions/add_group/"><div class="button">Adicionar Grupo de Permissões</div></a>
        <table border="0" width="100%" align="left">
            <tr>
                <th>Nome do Grupo de Permissão</th>
                <th>Parâmetros</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($permissions_group_list as $p) : ?>
                <tr>
                    <td><?php echo $p['name'] ?></td>
                    <td><?php echo $p['params'] ?></td>
                    <td width="160px">
                        <div class="button button_small button_edit">
                            <a href="<?php echo BASE_URL; ?>/permissions/edit_group/<?php echo $p['id']; ?>">
                                Editar
                            </a>
                        </div>
                        <div class="button button_small button_del">
                            <a href="<?php echo BASE_URL; ?>/permissions/delete_group/<?php echo $p['id']; ?>"
                               onclick="return confirm('Deseja mesmo excluir o Grupo de Permissão?')">Excluir
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
    <div class="tabbody">
        <a href="<?php echo BASE_URL; ?>/permissions/add/"><div class="button">Adicionar Permissão</div></a>
        <table border="0" width="100%" align="left">
            <tr>
                <th>Nome da Permissão</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($permissions_list as $p) : ?>
            <tr>
                <td><?php echo $p['name'] ?></td>
                <td width="50px"><a href="<?php echo BASE_URL; ?>/permissions/delete/<?php echo $p['id']; ?>"
                                    onclick="return confirm('Deseja mesmo excluir a permissão?')">
                        <div class="button button_small button_del">Excluir</div></a> </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>