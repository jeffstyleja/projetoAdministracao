<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 15/04/2019
 * Time: 14:11
 */
class Clients extends model
{
    public function getList($offset,$idCompany)
    {
        $return=array();
        $query = 'SELECT  * FROM clients where id_company = :idCompany order by id offset '. $offset . 'rows  fetch next 10 rows only';
        $sql = $this->db->prepare($query);
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
        $row=$sql->fetchAll();
        if($row>0){
            $return= $row;
            return $return;
        }
    }

    public function getInfo($id,$idCompany)
    {
        $return=array();
        $sql = $this->db->prepare('SELECT  * FROM clients where id = :id and id_company = :idCompany');
        $sql->bindValue(':id',$id);
        $sql->bindValue('idCompany',$idCompany);
        $sql->execute();
        $row=$sql->fetchAll();
        if($row>0){
            $return= $row;
            return $return;
        }
    }

    public function getCount($idCompany){
        $r =0 ;
        $sql = $this->db->prepare('select count(id) as C from clients where id_company = :idCompany');
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
        $row = $sql->fetch();
        $r = $row['C'];
        return $r;
    }

    public function add($id_company, $name_cli, $email = '', $phone = '', $stars = '3', $internal_obs = ''
        , $address_zipcode = '', $address = '', $address_number = '', $address2 = '', $address_neighb = ''
        , $address_city = '', $address_state= '', $address_country = '')
    {
        $sql = $this->db->prepare("INSERT into clients (name, email, phone, address, address_neighb, address_city, address_state, address_country,
                     address_zipcode, stars, internal_obs, id_company, address_number, address2)
values (:name_cli, :email, :phone, :address, :neighb, :city, :state, :country,
        :zipcode, :stars, :internal_obs, :idCompany, :numberad, :anotherad)");
        $sql->bindValue(':name_cli', iconv('ISO8859-1','UTF-8',$name_cli));
        $sql->bindValue(':email', $email);
        $sql->bindValue(':phone', $phone);
        $sql->bindValue(':address', iconv('ISO8859-1','UTF-8',$address));
        $sql->bindValue(':neighb', iconv('ISO8859-1','UTF-8',$address_neighb));
        $sql->bindValue(':city', iconv('ISO8859-1','UTF-8',$address_city));
        $sql->bindValue(':state', iconv('ISO8859-1','UTF-8',$address_state));
        $sql->bindValue(':country', iconv('ISO8859-1','UTF-8',$address_country));
        $sql->bindValue(':zipcode', $address_zipcode);
        $sql->bindValue(':stars', $stars);
        $sql->bindValue(':internal_obs', iconv('ISO8859-1','UTF-8',$internal_obs));
        $sql->bindValue(':idCompany', $id_company);
        $sql->bindValue(':numberad', $address_number);
        $sql->bindValue(':anotherad', iconv('ISO8859-1','UTF-8',$address2));
        $sql->execute();
        return $this->db->lastInsertId();
    }

    public function edit($id,$id_company, $name_cli, $email, $phone, $stars, $internal_obs, $address_zipcode, $address,
                         $address_number, $address2, $address_neighb, $address_city, $address_state, $address_country){
        $sql = $this->db->prepare("UPDATE clients  set name = :name_cli, email = :email, phone = :phone, address = :address, 
                                  address_neighb = :neighb, address_city = :city, address_state = :state, address_country = :country,
                                  address_zipcode = :zipcode, stars = :stars, internal_obs = :internal_obs, id_company = :idCompany, 
                                  address_number = :numberad, address2 = :anotherad where id = :id and id_company = :idCompany2");
        $sql->bindValue(':name_cli', iconv('ISO8859-1','UTF-8',$name_cli));
        $sql->bindValue(':email', $email);
        $sql->bindValue(':phone', $phone);
        $sql->bindValue(':address', iconv('ISO8859-1','UTF-8',$address));
        $sql->bindValue(':neighb', iconv('ISO8859-1','UTF-8',$address_neighb));
        $sql->bindValue(':city', iconv('ISO8859-1','UTF-8',$address_city));
        $sql->bindValue(':state', iconv('ISO8859-1','UTF-8',$address_state));
        $sql->bindValue(':country', iconv('ISO8859-1','UTF-8',$address_country));
        $sql->bindValue(':zipcode', $address_zipcode);
        $sql->bindValue(':stars', $stars);
        $sql->bindValue(':internal_obs', iconv('ISO8859-1','UTF-8',$internal_obs));
        $sql->bindValue(':numberad', $address_number);
        $sql->bindValue(':anotherad', iconv('ISO8859-1','UTF-8',$address2));
        $sql->bindValue(':id',$id);
        $sql->bindValue(':idCompany', $id_company);
        $sql->bindValue(':idCompany2', $id_company);
        $sql->execute();
        $error_msg = $sql->errorCode() . " - " . var_export($sql->errorInfo(),true);
        return $error_msg;
    }

    public function delete($id,$idCompany){
     $sql = $this->db->prepare('DELETE FROM clients where id = :id and id_company = :idCompany');
     $sql->bindValue(':id',$id);
     $sql->bindValue(':idCompany',$idCompany);
     $sql->execute();

    }

    public function searchClientsByName($name,$idCompany){
        $array = array();
        $name = strtoupper($name);
        $query = "SELECT  TOP 20 * FROM clients where upper([name]) like '%".$name."%' and id_company = :idCompany";
        $sql = $this->db->prepare($query);
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
        $row = $sql->fetchAll();
        if ($row > 0){
            $array = $row;
        }
        return $array;
    }

}
?>