<h1>Editar Venda</h1>

<form method="POST">
    <?php foreach ($sale_info as $s) : ?>
        <label for="sales_id" style="font-weight: bold">Id : </label>
        <input type="text" id="sales_id" name="sales_id" value="<?php echo $s['id'] ?>" readonly><br/>
        <label for="client_name">Nome do Cliente</label><br/>
        <input type="text" name="client_name" id="client_name" data-type="searchClients" style="width: 350px"
               value="<?php echo $s['name'] ?>">
        <button class="client_add_button">+</button>
        <input type="hidden" id="client_id" name="client_id" value="<?php echo $s['id_client'] ?>"/>
        <br/><br/>
        <div style="clear:both"></div>
        <label for="status">Status da Venda</label><br/>
        <select name="status" id="status">
            <option value="0" <?php echo ($s['status'] == '0') ? 'selected="selected"' : '' ?> >Aguardando Pagto.
            </option>
            <option value="1" <?php echo ($s['status'] == '1') ? 'selected="selected"' : '' ?>>Pago</option>
            <option value="2" <?php echo ($s['status'] == '2') ? 'selected="selected"' : '' ?>>Cancelado</option>
        </select><br/>



        <label for="total_price">Preço da Venda</label><br/>
        <input type="text" name="total_price" value="<?php echo $s['total_price'] ?>"><br/><br/>
    <?php endforeach; ?>
    <input type="submit" value="Salvar Edição">
</form>
<script type="text/javascript"
        src="<?php echo str_replace('index.php', '', BASE_URL); ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript"
        src="<?php echo str_replace('index.php', '', BASE_URL); ?>/assets/js/sales_add.js"></script>
