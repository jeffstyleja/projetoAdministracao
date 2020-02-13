<h1>Clientes - Editar Clientes</h1>
<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warning">
        <?php echo $error_msg; ?>
    </div>
<?php endif; ?>
<form method="post">
    <?php foreach ($clients_info as $i) : ?>
        <label for="name">Nome</label><br/>
        <input type="text" name="name" required value="<?php echo iconv('UTF-8','ISO8859-1',$i['name']) ?>"> <br/><br/>

        <label for="email">Email usuário</label><br/>
        <input type="email" name="email" value="<?php echo $i['email'] ?>"> <br/><br/>

        <label for="phone">Telefone</label><br/>
        <input type="text" name="phone" value="<?php echo $i['phone'] ?>"> <br/><br/>

        <label for="stars">Estrelas</label><br/>
        <select name="stars" id="stars">
            <option value="1" <?php echo ($i['stars'] == '1')? 'selected="selected"' :'' ?> >1 Estrela</option>
            <option value="2" <?php echo ($i['stars'] == '2')? 'selected="selected"' :'' ?> >2 Estrelas</option>
            <option value="3" <?php echo ($i['stars'] == '3')? 'selected="selected"' :'' ?> >3 Estrelas</option>
            <option value="4" <?php echo ($i['stars'] == '4')? 'selected="selected"' :'' ?> >4 Estrelas</option>
            <option value="5" <?php echo ($i['stars'] == '5')? 'selected="selected"' :'' ?> >5 Estrelas</option>
        </select><br/><br/>

        <label for="internal_obs">Observações Internas</label><br/>
        <textarea name="internal_obs" id="internal_obs" ><?php echo iconv('UTF-8','ISO8859-1',$i['internal_obs'])?></textarea> <br/><br/>

        <label for="address_zipcode">CEP</label><br/>
        <input type="text" name="address_zipcode" value="<?php echo $i['address_zipcode'] ?>"> <br/><br/>

        <label for="address">Rua:</label><br/>
        <input type="text" name="address" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address']) ?>"> <br/><br/>

        <label for="address_number">Número</label><br/>
        <input type="text" name="address_number" value="<?php echo $i['address_number'] ?>"> <br/><br/>

        <label for="address2">Complemento</label><br/>
        <input type="text" name="address2" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address2']) ?>"> <br/><br/>

        <label for="address_neighb">Bairro</label><br/>
        <input type="text" name="address_neighb" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address_neighb']) ?>"> <br/><br/>

        <label for="address_city">Cidade</label><br/>
        <input type="text" name="address_city" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address_city']) ?>"> <br/><br/>

        <label for="address_state">Estado</label><br/>
        <input type="text" name="address_state" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address_state']) ?>"> <br/><br/>

        <label for="address_country">País</label><br/>
        <input type="text" name="address_country" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address_country']) ?>"> <br/><br/>

    <?php endforeach; ?>
    <input type="submit" value="Editar">
</form>

<script type="text/javascript" src="<?php echo str_replace('index.php', '', BASE_URL); ?>assets/js/script_clients_add.js"></script>