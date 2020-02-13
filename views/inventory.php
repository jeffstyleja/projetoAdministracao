<h1>Estoque</h1>
<?php if ($inventory_add) {
    echo '<div class="button"><a href="' . BASE_URL . '/inventory/add">Adicionar Produto</a></div>';
}
?>
<input type="text" id="search" data-type="searchProducts">
<table border="0" width="100%">
    <tr>
        <th>Nome do Produto</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Qtd. Min</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($inventory_info

    as $i) : ?>
    <tr>
        <td><?php echo iconv('UTF-8', 'ISO8859-1', $i['name']); ?></td>
        <td style="text-align: center"><?php echo number_format($i['price'],2,',','.') ?></td>
        <td width="60px" style="text-align: center"><?php echo $i['quant'] ?></td>
        <td width="90px" style="text-align: center">
            <?php if ($i['quant'] < $i['min_quant']) {
                echo '<span style="color:red">' . $i['min_quant'] . '</span>';
            } else {
                echo $i['min_quant'];
            } ?>
        </td>
        <td width="160px" style="text-align: center">
            <?php if ($inventory_edit): ?>
                <div class="button button_small button_edit">
                    <a href="<?php echo BASE_URL; ?>/inventory/edit/<?php echo $i['id']; ?>">
                        Editar
                    </a>
                </div>
                <div class="button button_small button_del">
                    <a href="<?php echo BASE_URL; ?>/inventory/delete/<?php echo $i['id']; ?>"
                       onclick="return confirm('Deseja mesmo excluir o Produto?')">Excluir
                    </a>
                </div>
            <?php else: ?>
                <div class="button button_small button_view">
                    <a href="<?php echo BASE_URL; ?>/inventory/view/<?php echo $i['id']; ?>">Vizualizar</a>
                </div>
            <?php endif; ?>
        </td>
        <?php endforeach; ?>
</table>
<div class="pagination">
    <?php for ($q = 1; $q <= $p_count; $q++) : ?>
        <a href="<?php echo BASE_URL; ?>/inventory?p=<?php echo $q ?>">
            <div class="pag_item <?php echo ($q == $p) ? 'pag_ativo' : '' ?> <?php echo ($q == $p) ? 'pag_ativo' : '' ?>">
                <?php echo $q; ?>
            </div>
        </a>
    <?php endfor; ?>
</div>