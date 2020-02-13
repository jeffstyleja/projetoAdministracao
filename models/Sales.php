<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 06/05/2019
 * Time: 13:40
 */
class Sales extends model{

    public function getList($offset,$idCompany){
        $ret = array();
        $query = 'select 
            cli.name
            ,s.date_sale
            ,s.total_price
            ,s.status
            ,s.id
        from sales s left join clients cli 
        on (s.id_client = cli.id) 
        where s.id_company = :idCompany 
        order by s.id offset ' . $offset . ' rows fetch next 10 rows only';
        $sql = $this->db->prepare($query);
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
        $row = $sql->fetchAll();
        if (count($row) > 0 ){
            $ret = $row;
        }
        return $ret;
    }

    public function getSale($idSale,$idCompany){
        $ret = array();
        $query = 'select 
            cli.name
            ,s.date_sale
            ,s.total_price
            ,s.status
            ,s.id
            ,sp.id as id_product
            ,sp.sale_price as sale_price
        from sales s left join clients cli 
        on (s.id_client = cli.id) 
        left join sales_products sp 
        on(s.id = sp.id_sale)
        where s.id = :idSale and s.id_company = :idCompany';
        $sql = $this->db->prepare($query);
        $sql->bindValue(':idSale',$idSale);
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
        $row = $sql->fetchAll();
        if (count($row) > 0 ){
            $ret = $row;
        }
        return $ret;
    }

    public function getCount($idCompany)
    {
        $sql = $this->db->prepare('select count(id) as C from sales where id_company = :idCompany');
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
        $count = $sql->fetch();
        return $count['C'];

    }

    public function addSale($idCompany,$client_id,$user_id,$quant,$status){
        $total_price=0;
        $inventory = new Inventory();
        $sql = $this->db->prepare('insert into sales (id_client, id_user, date_sale, total_price,status, id_company) 
                                   values (:idClient,:idUser,GETDATE(),:totalPrice,:status,:idCompany)');
        $sql->bindValue(':idClient',$client_id);
        $sql->bindValue(':idUser',$user_id);
        $sql->bindValue(':totalPrice',$total_price);
        $sql->bindValue(':status',$status);
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
        $id_sale = $this->db->lastInsertId();
        foreach($quant as $id_prod => $quant_prod){
            $sql = $this->db->prepare('select price from inventory where id = :id and id_company = :idCompany');
            $sql->bindValue(':id',$id_prod);
            $sql->bindValue(':idCompany',$idCompany);
            $sql->execute();
            $row = $sql->fetch();
            if (count($row) > 0 ){
                $price = $row['price'];
                $total_price += $price * $quant_prod;
                $sql = $this->db->prepare('insert into sales_products (id, id_sale, quant, sale_price, id_company) 
                                          VALUES (:idProduct,:idSale,:quant,:priceSale,:idCompany) ');
                $sql->bindValue(':idProduct',$id_prod);
                $sql->bindValue(':idSale',$id_sale);
                $sql->bindValue(':quant',$quant_prod);
                $sql->bindValue(':priceSale',$price);
                $sql->bindValue(':idCompany',$idCompany);
                $sql->execute();
                $inventory->updateInventory($id_prod,$quant_prod,'Inp',$user_id,$idCompany);
            }
        }
        $sql = $this->db->prepare('update sales set total_price = :totalPrice where id = :idSale');
        $sql->bindValue(':totalPrice',$total_price);
        $sql->bindValue(':idSale',$id_sale);
        $sql->execute();
    }

    public function deleteSale($idCompany,$idSale){
        $sql = $this->db->prepare('delete from sales where id = :idSale and id_company = :idCompany');
        $sql->bindValue(':idSale',$idSale);
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
    }

    public function editSale($idSale,$idCompany,$idClient,$idUser,$totalPrice,$status){
        $sql = $this->db->prepare('update sales set id_client = :idClient , id_user = :idUser , total_price = :totalPrice,
                                   status = :status where id = :idSale and id_company = :idCompany');
        $sql->bindValue(':idClient',$idClient);
        $sql->bindValue(':idUser',$idUser);
        $sql->bindValue(':totalPrice',$totalPrice);
        $sql->bindValue(':status',$status);
        $sql->bindValue(':idSale',$idSale);
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
    }
}
?>