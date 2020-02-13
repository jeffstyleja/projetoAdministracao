<h1>Clientes - Adicionar Clientes</h1>
<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warning">
        <?php echo $error_msg; ?>
    </div>
<?php endif; ?>
<form method="post">

    <label for="name">Nome</label><br />
    <input type="text" name="name" required> <br/><br />

    <label for="price">Preço</label><br />
    <input type="text" name="price"> <br/><br />

    <label for="quant">Quantidade</label><br />
    <input type="number" name="quant"> <br/><br />

    <label for="min_quant">Qtd Minima em Estoque</label><br />
    <input type="number" name="min_quant"> <br/><br />

    <input type="submit" value="Adicionar">
</form>
<script type="text/javascript" src="<?php echo str_replace('index.php','',BASE_URL) ; ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo str_replace('index.php','',BASE_URL) ; ?>assets/js/inventory.js"></script>

