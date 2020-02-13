<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 29/04/2019
 * Time: 14:25
 */

class inventoryController extends controller
{
    public function __construct()
    {
        parent::__construct();
        $user = new Users();
        if ($user->isLogged() == false) {
            header("Location: " . BASE_URL . "/login");
        }
    }

    public function index()
    {
        $data = array();
        $user = new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if ($user->hasPermission('inventory_view')) {
            $inventory = new Inventory();
            $data['inventory_add'] = $user->hasPermission('inventory_add');
            $data['inventory_edit'] = $user->hasPermission('inventory_edit');
            $data['p'] = 1;
            if (isset($_GET['p']) && !empty($_GET['p'])) {
                $data['p'] = intval(addslashes($_GET['p']));
                if ($data['p'] == 0) {
                    $data['p'] = 1;
                }
            }
            $offset = (10 * ($data['p'] - 1));
            $data['inventory_count'] = $inventory->getCount($user->getCompany());
            $data['p_count'] = (ceil($data['inventory_count'] / 10));
            $data['inventory_info'] = $inventory->getList($offset, $user->getCompany());
            $this->loadTemplate('inventory', $data);
        } else {
            header('Location: ' . BASE_URL);
        }
    }

    public function add()
    {
        $data = array();
        $user = new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if ($user->hasPermission('inventory_add')) {
            $inventory = new Inventory();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $quant = addslashes($_POST['quant']);
                $min_quant = addslashes($_POST['min_quant']);
                $price= str_replace('.', '', $_POST['price']);
                $price = str_replace(',','.',$price);
                $inventory->add($name, $price, $quant, $min_quant, $user->getCompany(),$user->getID());
                header('Location: ' . BASE_URL . '/inventory');
            }
            $this->loadTemplate('inventory_add', $data);
        } else {
            header('Location: ' . BASE_URL . '/inventory/');
        }
    }

    public function edit($id)
    {
        $data = array();
        $user = new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if ($user->hasPermission('inventory_edit')) {
            $inventory = new Inventory();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $quant = addslashes($_POST['quant']);
                $min_quant = addslashes($_POST['min_quant']);
                $price= str_replace('.', '', $_POST['price']);
                $price = str_replace(',','.',$price);
                $inventory->edit($id, $name, $price, $quant, $min_quant, $user->getCompany(),$user->getID());
                header('Location: ' . BASE_URL . '/inventory');
            }
            $data['inventory_info'] = $inventory->getProd($id,$user->getCompany());
                $this->loadTemplate('inventory_edit', $data);
        } else {
            header('Location: ' . BASE_URL . '/inventory/');
        }
    }

    public function delete($id){
        $data = array();
        $user = new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if ($user->hasPermission('inventory_delete')) {
            $inventory = new Inventory();
            $inventory->delete($id,$user->getCompany(),$user->getID());
            header('Location: ' . BASE_URL . '/inventory/');
        }else{
            header('Location: ' . BASE_URL . '/inventory/');
        }
    }
}

?>