<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 07/03/2019
 * Time: 16:34
 */
class Companies extends model{

    private $company_info;
    /**
     * Companies constructor.
     */
    public function __construct($id)
    {
        parent::__construct();

        $sql = $this->db->prepare('SELECT * FROM COMPANIES WHERE ID = :id ');
        $sql->bindValue(':id',$id);
        $sql->execute();
        $return = $sql->fetch();
        (!empty($return)) ? $this->company_info = $return : '';

    }

    public function getName(){
        if(isset($this->company_info['name'])){
            return $this->company_info['name'];
        }else{
            return '';
        }
    }

    public function getList(){
        $sql = $this->db->prepare('SELECT * FROM COMPANIES');
        $sql->execute();
        $return =array();
        $return = $sql->fetchAll();
        return $return;
    }
}
?>