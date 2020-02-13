<h1>Clientes - Editar Clientes</h1>
<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warning">
        <?php echo $error_msg; ?>
    </div>
<?php endif; ?>
<form method="post">
    <?php foreach ($clients_info as $i) : ?>
        <label for="name">Nome</label><br/>
        <input type="text" name="name" required value="<?php echo iconv('UTF-8','ISO8859-1',$i['name']) ?>" disabled> <br/><br/>

        <label for="email">Email usuário</label><br/>
        <input type="email" name="email" value="<?php echo $i['email'] ?>" disabled> <br/><br/>

        <label for="phone">Telefone</label><br/>
        <input type="text" name="phone" value="<?php echo $i['phone'] ?>" disabled> <br/><br/>

        <label for="stars">Estrelas</label><br/>
        <select name="stars" id="stars">
            <option value="1" <?php echo ($i['stars'] == '1')? 'selected="selected"' :'' ?> disabled>1 Estrela</option>
            <option value="2" <?php echo ($i['stars'] == '2')? 'selected="selected"' :'' ?> disabled>2 Estrelas</option>
            <option value="3" <?php echo ($i['stars'] == '3')? 'selected="selected"' :'' ?> disabled>3 Estrelas</option>
            <option value="4" <?php echo ($i['stars'] == '4')? 'selected="selected"' :'' ?> disabled>4 Estrelas</option>
            <option value="5" <?php echo ($i['stars'] == '5')? 'selected="selected"' :'' ?> disabled>5 Estrelas</option>
        </select><br/><br/>

        <label for="internal_obs">Observações Internas</label><br/>
        <textarea name="internal_obs" id="internal_obs" disabled><?php echo iconv('UTF-8','ISO8859-1',$i['internal_obs'])?></textarea> <br/><br/>

        <label for="address_zipcode">CEP</label><br/>
        <input type="text" name="address_zipcode" value="<?php echo $i['address_zipcode'] ?>" disabled> <br/><br/>

        <label for="address">Rua:</label><br/>
        <input type="text" name="address" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address']) ?>" disabled> <br/><br/>

        <label for="address_number">Número</label><br/>
        <input type="text" name="address_number" value="<?php echo $i['address_number'] ?>" disabled> <br/><br/>

        <label for="address2">Complemento</label><br/>
        <input type="text" name="address2" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address2']) ?>" disabled> <br/><br/>

        <label for="address_neighb">Bairro</label><br/>
        <input type="text" name="address_neighb" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address_neighb']) ?>" disabled> <br/><br/>

        <label for="address_city">Cidade</label><br/>
        <input type="text" name="address_city" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address_city']) ?>" disabled> <br/><br/>

        <label for="address_state">Estado</label><br/>
        <input type="text" name="address_state" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address_state']) ?>" disabled> <br/><br/>

        <label for="address_country">País</label><br/>
        <input type="text" name="address_country" value="<?php echo iconv('UTF-8','ISO8859-1',$i['address_country']) ?>" disabled> <br/><br/>

    <?php endforeach; ?>