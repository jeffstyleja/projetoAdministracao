<h1>Clientes - Adicionar Clientes</h1>
<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warning">
        <?php echo $error_msg; ?>
    </div>
<?php endif; ?>
<form method="post">

    <label for="name">Nome</label><br />
    <input type="text" name="name" required> <br/><br />

    <label for="email">Email usu�rio</label><br />
    <input type="email" name="email"> <br/><br />

    <label for="phone">Telefone</label><br />
    <input type="text" name="phone"> <br/><br />

    <label for="stars">Estrelas</label><br />
    <select  name="stars" id="stars">
        <option value="1">1 Estrela</option>
        <option value="2">2 Estrelas</option>
        <option value="3" selected="selected">3 Estrelas</option>
        <option value="4">4 Estrelas</option>
        <option value="5">5 Estrelas</option>
    </select><br/><br />

    <label for="internal_obs">Observa��es Internas</label><br />
    <textarea name="internal_obs" id="internal_obs"></textarea> <br/><br />

    <label for="address_zipcode">CEP</label><br />
    <input type="text" name="address_zipcode"> <br/><br />

    <label for="address">Rua:</label><br />
    <input type="text" name="address"> <br/><br />

    <label for="address_number">N�mero</label><br />
    <input type="text" name="address_number"> <br/><br />

    <label for="address2">Complemento</label><br />
    <input type="text" name="address2"> <br/><br />

    <label for="address_neighb">Bairro</label><br />
    <input type="text" name="address_neighb"> <br/><br />

    <label for="address_city">Cidade</label><br />
    <input type="text" name="address_city"> <br/><br />

    <label for="address_state">Estado</label><br />
    <input type="text" name="address_state"> <br/><br />

    <label for="address_country">Pa�s</label><br />
    <input type="text" name="address_country"> <br/><br />


    <input type="submit" value="Adicionar">
</form>

<script type="text/javascript" src="<?php echo str_replace('index.php','',BASE_URL); ?>assets/js/script_clients_add.js"></script>