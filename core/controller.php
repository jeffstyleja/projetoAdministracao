<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 11/05/2018
 * Time: 10:00
 */
class controller{
    protected $db;
    public function __construct()
    {
        try {
            global $config;
            //           var_dump($config);
            //           die;
            //$this->db= new PDO("sqlsrv:Server=192.168.3.249;Database=ZeusRetail_jeferson;","sa","zanthus");
            $this->db = new PDO("sqlsrv:Server=".$config['srv'].";Database=".$config['db'].";", $config['dbuser'], $config['dbpass'],array('charset'=>'utf8'));
            $this->db->query('SET CHARACTER SET utf8');
        }catch (PDOException $e){
            echo "Falhou: ".$e->getMessage();
        }

    }

    public function loadView($viewName,$viewData=array()){
        extract($viewData);
        include 'views/'.$viewName.'.php';
    }

    public function loadTemplate($viewName,$viewData=array()){
        include 'views/template.php';

    }

    public function loadViewInTemplate($viewName,$viewData=array())
    {
        extract($viewData);
        include 'views/' . $viewName . '.php';
    }
}

?>