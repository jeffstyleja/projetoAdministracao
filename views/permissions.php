<h1>Permiss�es</h1>
<div class="tabarea">
    <div class="tabitem activetab">Grupos de permiss�es</div>
    <div class="tabitem">Permiss�es</div>
</div>
<div class="tabcontent">
    <div class="tabbody" style="display: block">
        <a href="<?php echo BASE_URL; ?>/permissions/add_group/"><div class="button">Adicionar Grupo de Permiss�es</div></a>
        <table border="0" width="100%" align="left">
            <tr>
                <th>Nome do Grupo de Permiss�o</th>
                <th>Par�metros</th>
                <th>A��es</th>
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
                               onclick="return confirm('Deseja mesmo excluir o Grupo de Permiss�o?')">Excluir
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
    <div class="tabbody">
        <a href="<?php echo BASE_URL; ?>/permissions/add/"><div class="button">Adicionar Permiss�o</div></a>
        <table border="0" width="100%" align="left">
            <tr>
                <th>Nome da Permiss�o</th>
                <th>A��es</th>
            </tr>
            <?php foreach ($permissions_list as $p) : ?>
            <tr>
                <td><?php echo $p['name'] ?></td>
                <td width="50px"><a href="<?php echo BASE_URL; ?>/permissions/delete/<?php echo $p['id']; ?>"
                                    onclick="return confirm('Deseja mesmo excluir a permiss�o?')">
                        <div class="button button_small button_del">Excluir</div></a> </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>