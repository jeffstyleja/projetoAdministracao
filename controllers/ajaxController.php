<?php

/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 26/04/2019
 * Time: 16:00
 */
class ajaxController extends controller
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
    }

    public function searchClients()
    {
        $data = array();
        $user = new Users();
        $user->setLoggedUser();
        $company = $user->getCompany();
        $clients = new Clients();
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = addslashes($_GET['q']);
            $array = $clients->searchClientsByName($q, $company);
            foreach ($array as $citem) {
                $data[] = array(
                    'name' => $citem['name'],
                    'link' => BASE_URL . '/clients/edit/' . $citem['id'] ,
                    'id' => $citem['id']
                );
            }

        }
        echo json_encode($data);
    }

    public function searchProducts()
    {
        $data = array();
        $user = new Users();
        $user->setLoggedUser();
        $company = $user->getCompany();
        $inventory = new Inventory();
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = addslashes($_GET['q']);
            $array = $inventory->searchProductsByName($q, $company);
            foreach ($array as $citem) {
                $data[] = array(
                    'id' => $citem['id'],
                    'name' => $citem['name'],
                    'link' => BASE_URL . '/inventory/edit/' . $citem['id'],
                    'price' => $citem['price']
                );
            }
        }
        echo json_encode($data);
    }

    public function addClient(){
        $data = array();
        $user = new Users();
        $user->setLoggedUser();
        $company = $user->getCompany();
        $clients = new Clients();
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = addslashes($_POST['name']);
            $data['id'] = $clients->add($company,$name);
        }
        echo json_encode($data);

    }
}

?>