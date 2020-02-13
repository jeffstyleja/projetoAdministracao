<h1>Clientes - Adicionar Clientes</h1>
<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warning">
        <?php echo $error_msg; ?>
    </div>
<?php endif; ?>
<form method="post">
    <?php foreach ($inventory_info as $i) : ?>
    <label for="name">Nome</label><br />
    <input type="text" name="name" required value="<?php echo $i['name'] ?>"> <br/><br />

    <label for="price">Preço</label><br />
    <input type="text" name="price" value="<?php echo number_format($i['price'],2,',','.') ?>"> <br/><br />

    <label for="quant">Quantidade</label><br />
    <input type="number" name="quant" value="<?php echo $i['quant'] ?>"> <br/><br />

    <label for="min_quant">Qtd Minima em Estoque</label><br />
    <input type="number" name="min_quant" value="<?php echo $i['min_quant'] ?>"> <br/><br />
<?php endforeach; ?>
    <input type="submit" value="Editar">
</form>
<script type="text/javascript" src="<?php echo str_replace('index.php','',BASE_URL) ; ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo str_replace('index.php','',BASE_URL) ; ?>assets/js/inventory.js"></script>

