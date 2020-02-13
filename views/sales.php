<h1>Vendas</h1>
<?php if ($sales_add): ?>
<a href="<?php echo BASE_URL . '/sales/add' ?>">
    <div class="button" >Adicionar</div>
</a>
<?php endif; ?>
<table border="0" width="100%">
    <tr>
        <th>Nome do Cliente</th>
        <th>Data da Venda</th>
        <th>Status</th>
        <th>Valor</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($sales_list as $s) : ?>
        <tr>
            <td><?php echo iconv('UTF-8', 'ISO8859-1',$s['name']) ?></td>
            <td style="text-align: center"><?php echo date('d/m/Y',strtotime($s['date_sale'])) ?></td>
            <td style="text-align: center"><?php echo $statuses[$s['status']] ?></td>
            <td style="text-align: center"><?php echo number_format($s['total_price'],2,',','.') ?></td>
            <td width="160px">
                <?php if ($sales_edit): ?>
                    <div class="button button_small button_edit">
                        <a href="<?php echo BASE_URL; ?>/sales/edit/<?php echo $s['id']; ?>">
                            Editar
                        </a>
                    </div>
                    <div class="button button_small button_del">
                        <a href="<?php echo BASE_URL; ?>/sales/delete/<?php echo $s['id']; ?>"
                           onclick="return confirm('Deseja mesmo excluir o Cliente?')">Excluir
                        </a>
                    </div>
                <?php else: ?>
                    <div class="button button_small button_view">
                        <a href="<?php echo BASE_URL; ?>/sales/view/<?php echo $s['id']; ?>">Vizualizar</a>
                    </div>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="pagination">
    <?php for ($q = 1; $q <= $p_count; $q++) : ?>
        <a href="<?php echo BASE_URL; ?>/sales?p=<?php echo $q ?>">
            <div class="pag_item <?php echo ($q == $p) ? 'pag_ativo' : '' ?> <?php echo ($q == $p) ? 'pag_ativo' : '' ?>">
                <?php echo $q; ?>
            </div>
        </a>
    <?php endfor; ?>
</div>