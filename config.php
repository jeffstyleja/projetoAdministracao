<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 13/06/2018
 * Time: 09:09
 */

require "enviroment.php";
global $config;
$config=array();

if(ENVIROMENT == "development"){
    $config['srv']="192.168.3.249";
    $config['db'] = "ZeusRetail_Jeferson";
    $config['dbuser'] ="sa";
    $config['dbpass']="zanthus";
}else {
    $config['srv']="192.168.3.249";
    $config['db'] = "ZeusRetail_Jeferson";
    $config['dbuser'] ="sa";
    $config['dbpass']="zanthus";
}
?>