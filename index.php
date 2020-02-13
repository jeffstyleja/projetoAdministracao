<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 02/05/2018
 * Time: 11:40
 */
session_start();

require_once 'enviroment.php';
require_once 'config.php';
define('BASE_URL','http://127.0.0.1/projetoAdministracao/index.php');
spl_autoload_register(function ($class){
    if(strpos($class,'Controller') > -1){
        if(file_exists('controllers/'.$class.'.php')){
            require_once 'controllers/'.$class.'.php';
        }
    }elseif (file_exists('models/'.$class.'.php')){
        require_once 'models/'.$class.'.php';
    }elseif (file_exists('core/'.$class.'.php')){
        require_once 'core/'.$class.'.php';
    }
});

$core= new Core();
$core->run();

?>