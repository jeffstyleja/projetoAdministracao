<h1>Adicionar Vendas</h1>
<form method="POST">
    <label for="client_name">Nome do Cliente</label><br/>
    <input type="text" name="client_name" id="client_name" data-type="searchClients" style="width: 350px">
    <button class="client_add_button">+</button>
    <input type="hidden" id="client_id" name="client_id"/>
    <br/><br/>
    <div style="clear:both"></div>
    <label for="status">Status da Venda</label><br/>
    <select name="status" id="status">
        <option value="0">Aguardando Pagto.</option>
        <option value="1">Pago</option>
        <option value="2">Cancelado</option>
    </select><br/>

    <label for="total_price">Preço da Venda</label><br/>
    <input type="text" name="total_price" readonly><br/><br/>

    <hr/>
    <h4>Produtos</h4>
    <fieldset>
        <legend>Adicionar Produto</legend>
        <input type="text" id="add_prod" data-type="searchProducts"/>

    </fieldset>
    <table borde="0" width="100%" id="products_table">
        <tr>
            <th>Nome do Produto</th>
            <th>Quantidade</th>
            <th>Preço Unit</th>
            <th>Sub-total</th>
            <th>Excluir</th>
        </tr>
    </table>
    <hr/>

    <input type="submit" value="Adicionar Venda">
</form>
<script type="text/javascript"
        src="<?php echo str_replace('index.php', '', BASE_URL); ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript"
        src="<?php echo str_replace('index.php', '', BASE_URL); ?>/assets/js/sales_add.js"></script>
