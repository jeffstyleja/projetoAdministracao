<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo str_replace('index.php','',BASE_URL); ?>assets/css/login.css">
</head>
<body>
<div class="login">
    <div class="login_titulo">Saia do Vermelho<br />
        Login
    </div>
    <form class="login_interno" method="post" action="">
        <div class="interno_content">
            <input type="email" id="email"  name="email" placeholder="Email: Ex: teste@saiadovermelho.com">
            <input type="password" id="password" name="password" placeholder="*******">
            <input type="submit" value="Entrar" class="conteudo botao">
            <?php if(isset($error) && !empty($error)): ?>
                <div class="warning"><?php echo $error ?></div>
            <?php endif; ?>
        </div>
    </form>
</div>
</body>
</html>