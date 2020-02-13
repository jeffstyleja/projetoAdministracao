<?php

/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 29/04/2019
 * Time: 14:28
 */
class Inventory extends model
{
    public function getList($offset, $idCompany)
    {
        $array = array();
        $query = 'SELECT  * FROM inventory where id_company = :idCompany order by id offset ' . $offset . ' rows  fetch next 10 rows only';
        $sql = $this->db->prepare($query);
        $sql->bindValue(':idCompany', $idCompany);
        $sql->execute();
        $row = $sql->fetchAll();
        if ($row > 0) {
            $array = $row;
        }
        return $array;
    }

    public function getProd($id, $idCompany)
    {
        $array = array();
        $query = 'SELECT  * FROM inventory where id_company = :idCompany and id = :id';
        $sql = $this->db->prepare($query);
        $sql->bindValue(':idCompany', $idCompany);
        $sql->bindValue(':id', $id);
        $sql->execute();
        $row = $sql->fetchAll();
        if ($row > 0) {
            $array = $row;
        }
        return $array;
    }

    public function getCount($idCompany)
    {
        $r = 0;
        $sql = $this->db->prepare('select count(id) as C from inventory where id_company = :idCompany');
        $sql->bindValue(':idCompany', $idCompany);
        $sql->execute();
        $row = $sql->fetch();
        $r = $row['C'];
        return $r;
    }

    public function searchProductsByName($name, $idCompany)
    {
        $array = array();
        $query = "select TOP 20  * from inventory where id_company = :idCompany and [name] like '%" . $name . "%'";
        $sql = $this->db->prepare($query);
        $sql->bindValue(':idCompany', $idCompany);
        $sql->execute();
        $row = $sql->fetchAll();
        if ($row > 0) {
            $array = $row;
        }
        return $array;
    }

    public function setLog($id_product,$id_user,$idCompany,$act){
        $sql = $this->db->prepare('insert into inventory_history (id_product, id_user, "action", date_action, id_company) 
VALUES (:id_product,:id_user,:action_do,getdate(),:idCompany)');
        $sql->bindValue(':id_product',$id_product);
        $sql->bindValue(':id_user',$id_user);
        $sql->bindValue(':action_do',$act);
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
    }

    public function add($name, $price, $quant, $min_quant, $idCompany,$id_user)
    {
        $sql = $this->db->prepare('INSERT into inventory ([name], price, quant, min_quant, id_company) 
        VALUES (:name_prod,:price,:quant,:min_quant,:idCompany)');
        $sql->bindValue(':name_prod', iconv('ISO8859-1', 'UTF-8', $name));
        $sql->bindValue(':price', $price);
        $sql->bindValue(':quant', $quant);
        $sql->bindValue(':min_quant', $min_quant);
        $sql->bindValue(':idCompany', $idCompany);
        $sql->execute();

        $id_product = $this->db->lastInsertId();

        $this->setLog($id_product,$id_user,$idCompany,'add');
    }

    public function edit($id, $name, $price, $quant, $min_quant, $idCompany,$id_user)
    {
        $sql = $this->db->prepare('update inventory set [name] = :name_prod , price = :price,
          quant = :quant , min_quant = :min_quant where id = :id and id_company = :idCompany');
        $sql->bindValue(':name_prod', iconv('ISO8859-1', 'UTF-8', $name));
        $sql->bindValue(':price', $price);
        $sql->bindValue(':quant', $quant);
        $sql->bindValue(':min_quant', $min_quant);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':idCompany', $idCompany);
        $sql->execute();

        $this->setLog($id,$id_user,$idCompany,'edit');

    }

    public function delete($id, $idCompany,$id_user)
    {
        $sql = $this->db->prepare('delete from inventory where id = :id and id_company = :idCompany');
        $sql->bindValue(':id',$id);
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();

        $this->setLog($id,$id_user,$idCompany,'del');

    }

    public function updateInventory($id,$quant,$operation,$id_user,$idCompany){
        $sql = $this->db->prepare('update inventory set  quant = :quant , min_quant = :min_quant where id = :id and id_company = :idCompany');
        if($operation  == 'Inp'){
            $sql->bindValue(':quant', $quant);
        }elseif ($operation  == 'Out'){
            $sql->bindValue(':quant', $quant * (-1));
        }
        $sql->bindValue(':id', $id);
        $sql->bindValue(':idCompany', $idCompany);
        $sql->execute();

        $this->setLog($id,$id_user,$idCompany,'update');
    }

}

?>