<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 11/03/2019
 * Time: 13:16
 */
class Permissions extends model{
    private $group;
    private $permissions;
    public function setGroup($id=array()){
        $this->group = $id['id'];
        $this->permissions = array();
        $sql= $this->db->prepare('SELECT params FROM permission_groups WHERE id = :id and id_company = :id_company');
        $sql->bindValue(':id',$id['id']);
        $sql->bindValue(':id_company',$id['id_company']);
        $sql->execute();
        $row = $sql->fetch();
        if(!empty($row)){
            if(empty($row['params'])){
                $params= 0;
            }
            $params = $row['params'];
            $sql = $this->db->prepare("SELECT name FROM permission_params where id in ({$params}) and id_company = :id_company");
            $sql->bindValue(':id_company',$id['id_company']);
            $sql->execute();
            $result=$sql->fetchAll();
            if(!empty($result)){
                foreach($result as $item){
                    $this->permissions[]=$item['name'];
                }
            }
        }
    }

    public function hasPermission($name){
        if(in_array($name,$this->permissions)){
            return true;
        }else{
            return false;
        }
    }

    public function getList($idCompany){
        $array = array();
        $sql = $this->db->prepare('SELECT * FROM permission_params WHERE id_company = :idCompany');
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
        $row = $sql->fetchAll();
        if(count($row) > 0){
            $array = $row;
        }
        return $array;
    }

    public function getGroupList($idCompany = ''){
        $array= array();
        $where = (!empty($idCompany))? " WHERE id_company = :idCompany" : '';
        $sql = $this->db->prepare('SELECT * FROM permission_groups' . $where);
        (!empty($idCompany))?$sql->bindValue(':idCompany',$idCompany) : '' ;
        $sql->execute();
        $row = $sql->fetchAll();
        if(count($row) > 0){
            $array = $row;
        }
        return $array;
    }

    public function getGroup($id,$idCompany){
        $array= array();
        $sql = $this->db->prepare('SELECT * FROM permission_groups WHERE id = :id and id_company = :idCompany');
        $sql->bindValue(':id',$id);
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
        $row = $sql->fetch();
        if(count($row) > 0){
            $array = $row;
        }
        return $array;
    }

    public function add($name,$company){
        $sql = $this->db->prepare("INSERT INTO permission_params (name, id_company) VALUES (:name_param , :company)");
        $sql->bindValue(':name_param',$name);
        $sql->bindValue(':company',$company);
        $sql->execute();
    }

    public function add_group($name,$plist,$company){
        $params = implode(',',$plist);
        $sql = $this->db->prepare("INSERT INTO permission_groups (name, id_company, params) VALUES (:name_param , :company , :params)");
        $sql->bindValue(':name_param',$name);
        $sql->bindValue(':company',$company);
        $sql->bindValue(':params',$params);
        $sql->execute();
    }

    public function update_group($id,$name,$plist,$idCompany){
        $params = implode(',',$plist);
        $sql = $this->db->prepare("UPDATE permission_groups set params = :params, name = :name_param where id = :id and id_company =:idCompany");
        $sql->bindValue(':params',$params);
        $sql->bindValue(':name_param',$name);
        $sql->bindValue(':id',$id);
        $sql->bindValue(':idCompany',$idCompany);
        $sql->execute();
    }

    public function delete($id,$company){
        $sql = $this->db->prepare("DELETE FROM permission_params WHERE id = :id");
        $sql->bindValue(':id',$id);
        $sql->bindValue(':company',$company);
        $sql->execute();
    }

    public function delete_group($id,$company){
        $active= new Users();
        if ($active->returnActiveGroups($id) == true) {
            $sql = $this->db->prepare("DELETE FROM permission_groups WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':company', $company);
            $sql->execute();
        }
        else{
            return false;
        }
    }
}