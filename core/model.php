<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 13/06/2018
 * Time: 09:34
 */
class model {
    protected $db;

    public function __construct()
    {
        try {
            global $config;
 //           var_dump($config);
 //           die;
            //$this->db= new PDO("sqlsrv:Server=192.168.3.249;Database=ZeusRetail_jeferson;","sa","zanthus");
            $this->db = new PDO("sqlsrv:Server=".$config['srv'].";Database=".$config['db'].";", $config['dbuser'], $config['dbpass']);
        }catch (PDOException $e){
            echo "Falhou: ".$e->getMessage();
        }
    }
}

?>