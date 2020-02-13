<html>
<head>
    <meta charset="ISO8859-1">
    <title>Painel - <?php echo $viewData['company_name']; ?></title>
    <link rel="stylesheet" href="<?php echo str_replace('index.php','',BASE_URL); ?>assets/css/template.css">
    <script type="text/javascript" src="<?php echo str_replace('index.php','',BASE_URL); ?>assets/js/jquery-3.3.1.js"></script>
    <script type="text/javascript">var BASE_URL= '<?php echo BASE_URL?>'</script>
    <script type="text/javascript" src="<?php echo str_replace('index.php','',BASE_URL); ?>assets/js/template.js"></script>
</head>
<body>
<div class="leftmenu">
    <div class="company_name">
        <?php echo $viewData['company_name']; ?>
    </div>
    <div class="menuarea">
        <ul>
            <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/permissions/" >Permissões</a></li>
            <li><a href="<?php echo BASE_URL; ?>/users/" >Usuários</a></li>
            <li><a href="<?php echo BASE_URL; ?>/clients/" >Clientes</a></li>
            <li><a href="<?php echo BASE_URL; ?>/inventory/" >Inventário</a></li>
            <li><a href="<?php echo BASE_URL; ?>/sales/" >Vendas</a></li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="top">
        <div class="top_right"><a href="<?php echo BASE_URL . '/login/logout'?>">Sair</a></div>
        <div class="top_right"><?php echo $viewData['user_email']; ?></div>
    </div>
    <div class="area">
        <?php
        /**
         * Created by PhpStorm.
         * User: jeferson.santos
         * Date: 07/03/2019
         * Time: 11:26
         */
        $this->loadViewInTemplate($viewName,$viewData);
        ?>

    </div>
</div>






</body>
</html>