<h1>Clientes</h1>
<?php if ($edit_permissions) {
    echo '<div class="button"><a href="' . BASE_URL . '/clients/add">Adicionar Cliente</a></div>';
}
?>
<input type="text" id="search" data-type="searchClients">
<table border="0" width="100%">
    <tr>
        <th>Nome do Cliente</th>
        <th>Telefone</th>
        <th>Cidade</th>
        <th>Estrelas</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($client_list as $c) : ?>
        <tr>
            <td><?php echo iconv('UTF-8', 'ISO8859-1', $c['name']); ?></td>
            <td><?php echo $c['phone']; ?></td>
            <td><?php echo iconv('UTF-8', 'ISO8859-1', $c['address_city']); ?></td>
            <td style="text-align: center"><?php echo $c['stars']; ?></td>
            <td width="160px" style="text-align: center">
                <?php if ($edit_permissions): ?>
                    <div class="button button_small button_edit">
                        <a href="<?php echo BASE_URL; ?>/clients/edit/<?php echo $c['id']; ?>">
                            Editar
                        </a>
                    </div>
                    <div class="button button_small button_del">
                        <a href="<?php echo BASE_URL; ?>/clients/delete/<?php echo $c['id']; ?>"
                           onclick="return confirm('Deseja mesmo excluir o Cliente?')">Excluir
                        </a>
                    </div>
                <?php else: ?>
                    <div class="button button_small button_view">
                        <a href="<?php echo BASE_URL; ?>/clients/view/<?php echo $c['id']; ?>">Vizualizar</a>
                    </div>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="pagination">
    <?php for ($q = 1; $q <= $p_count; $q++) : ?>
        <a href="<?php echo BASE_URL; ?>/clients?p=<?php echo $q ?>">
            <div class="pag_item <?php echo ($q == $p) ? 'pag_ativo' : '' ?> <?php echo ($q == $p) ? 'pag_ativo' : '' ?>">
                <?php echo $q; ?>
            </div>
        </a>
    <?php endfor; ?>
</div>
<div style="clear: both"></div>