<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 07/03/2019
 * Time: 11:02
 */

class Users extends model
{

    private $user_info;
    private $permissions;


    /**
     * @return mixed
     */

    public function getUserInfo()
    {
        return $this->user_info;
    }

    /**
     * @param mixed $user_info
     */
    public function setUserInfo($user_info)
    {
        $this->user_info = $user_info;
    }

    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function isLogged()
    {
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            return true;
        } else {
            return false;
        }
    }

    public function doLogin($email, $password)
    {
        $sql = $this->db->prepare("SELECT * FROM USERS WHERE EMAIL = :email AND password = :password");
        $sql->bindValue(':email', (string)$email);
        $sql->bindValue(':password', md5($password));
        $sql->execute();
        $row = $sql->fetch();
        if (!empty($row['id'])) {
            $_SESSION['ccUser'] = $row['id'];
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        unset($_SESSION['ccUser']);
    }

    public function hasPermission($name)
    {
        return $this->permissions->hasPermission($name);
    }


    public function setLoggedUser()
    {
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            $id = $_SESSION['ccUser'];
            $sql = $this->db->prepare("SELECT * FROM USERS WHERE ID = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            $this->setUserInfo($sql->fetch());
            $this->permissions = new Permissions();
            $this->permissions->setGroup(array('id' => $this->user_info['group'], 'id_company' => $this->user_info['id_company']));
        }
    }

    public function getCompany()
    {
        $company = $this->getUserInfo();
        if (isset($company['id_company'])) {
            return $company['id_company'];
        } else {
            return 0;
        }
    }

    public function getEmail()
    {
        $company = $this->getUserInfo();
        if (isset($company['email'])) {
            return $company['email'];
        } else {
            return 0;
        }
    }

    public function getID()
    {
        $id = $this->getUserInfo();
        if (isset($id['id'])) {
            return $id['id'];
        } else {
            return 0;
        }

    }

    public function getInfoUser($id, $idCompany)
    {
        $sql = $this->db->prepare('SELECT * FROM users where id = :id and id_company = :idCompany');
        $sql->bindValue(':id', $id);
        $sql->bindValue(':idCompany', $idCompany);
        $sql->execute();
        $row = $sql->fetchAll();
        if (count($row) > 0) {
            return $row[0];
        } else {
            return '';
        }
    }

    public function getList($idCompany)
    {
        $sql = $this->db->prepare('SELECT u.*,pg.name as name_group FROM users u left join  permission_groups pg on (u.[group] = pg.id) where u.id_company = :idCompany');
        $sql->bindValue(':idCompany', $idCompany);
        $sql->execute();
        $row = array();
        $row = $sql->fetchAll();
        if (count($row)) {
            return $row;
        }
        return $row;
    }

    public function returnActiveGroups($id)
    {
        $sql = $this->db->prepare('SELECT * FROM users where [group] = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();
        $row = $sql->fetchAll();
        if (count($row) > 0) {
            return false;
        } else {
            return true;
        }
    }

    private function existUser($email)
    {
        $sql = $this->db->prepare('SELECT * FROM users where email = :email');
        $sql->bindValue(':email', $email);
        $sql->execute();
        $row = $sql->fetchAll();
        if (count($row) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add($email, $password, $group)
    {
        if ($this->existUser($email) == false) {
            $sql = $this->db->prepare('INSERT into users (email, password, [group], id_company) 
                                    values (:email,:password,:group_user,:idCompany)');
            $sql->bindValue(':email', $email);
            $sql->bindValue(':password', md5($password));
            $sql->bindValue(':group_user', $group);
            $sql->bindValue(':idCompany', $this->getCompany());
            $sql->execute();
            return '1';
        } else {
            return '0';
        }
    }

    public function edit_users($id, $idCompany, $password, $group)
    {
        (!empty($password)) ? $param = ',password = :password' : $param = '';
        $sql = $this->db->prepare('UPDATE users set  "group" = :group_user ' . $param . ' where id = :id and id_company = :idCompany');
        $sql->bindValue(':group_user', $group);
        (!empty($password)) ? $sql->bindValue(':password', md5($password)) : '';
        $sql->bindValue(':id', $id);
        $sql->bindValue(':idCompany', $idCompany);
        $sql->execute();
    }

    public function delete_users($id, $idCompany)
    {
        $sql = $this->db->prepare('DELETE FROM users where id = :id and id_company = :idCompany');
        $sql->bindValue(':id', $id);
        $sql->bindValue(':idCompany', $idCompany);
        $sql->execute();
    }

}

?>