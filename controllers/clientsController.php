<?php

/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 15/04/2019
 * Time: 14:10
 */
class clientsController extends controller
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
        if ($user->hasPermission('clients_view')) {
            $clients = new Clients();
            $data['p'] = 1;
            if (isset($_GET['p']) && !empty($_GET['p'])) {
                $data['p'] = intval($_GET['p']);
                if ($data['p'] == 0) {
                    $data['p'] = 1;
                }
            }
            $offset = (10 * ($data['p'] - 1));
            $data['client_list'] = $clients->getList($offset, $user->getCompany());
            $data['clients_count'] = $clients->getCount($user->getCompany());
            $data['p_count'] = (ceil($data['clients_count'] / 10));
            $data['edit_permissions'] = $user->hasPermission('clients_edit');
            $this->loadTemplate('clients', $data);
        } else {
            header("Location: " . BASE_URL);
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
        if ($user->hasPermission('clients_edit')) {
            $clients = new Clients();

            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $stars = addslashes($_POST['stars']);
                $internalobs = addslashes($_POST['internal_obs']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address = addslashes($_POST['address']);
                $address_number = addslashes($_POST['address_number']);
                $address2 = addslashes($_POST['address2']);
                $address_neighb = addslashes($_POST['address_neighb']);
                $address_city = addslashes($_POST['address_city']);
                $address_state = addslashes($_POST['address_state']);
                $address_country = addslashes($_POST['address_country']);
                $clients->add($user->getCompany(), $name, $email, $phone, $stars, $internalobs, $address_zipcode, $address,
                    $address_number, $address2, $address_neighb, $address_city, $address_state, $address_country);

                header("Location: " . BASE_URL . "/clients");
            }
            $this->loadTemplate('clients_add', $data);
        } else {
            header("Location: " . BASE_URL . "/clients");
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
        if ($user->hasPermission('clients_edit')) {
            $clients = new Clients();

            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $stars = addslashes($_POST['stars']);
                $internalobs = addslashes($_POST['internal_obs']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address = addslashes($_POST['address']);
                $address_number = addslashes($_POST['address_number']);
                $address2 = addslashes($_POST['address2']);
                $address_neighb = addslashes($_POST['address_neighb']);
                $address_city = addslashes($_POST['address_city']);
                $address_state = addslashes($_POST['address_state']);
                $address_country = addslashes($_POST['address_country']);
                $clients->edit($id, $user->getCompany(), $name, $email, $phone, $stars, $internalobs, $address_zipcode, $address,
                    $address_number, $address2, $address_neighb, $address_city, $address_state, $address_country);

                header("Location: " . BASE_URL . "/clients");
            }
            $data['clients_info'] = $clients->getInfo($id, $user->getCompany());
            $this->loadTemplate('clients_edit', $data);
        } else {
            header("Location: " . BASE_URL . "/clients");
        }
    }

    public function delete($id)
    {
        $user = new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        if ($user->hasPermission('clients_edit')) {
            $clients = new Clients();
            $clients->delete($id, $user->getCompany());

            header("Location: " . BASE_URL . "/clients");
        }
    }

    public function view($id)
    {
        $data = array();
        $user = new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if ($user->hasPermission('clients_view')) {
            $clients = new Clients();
            $offset = 0;
            $data['clients_info'] = $clients->getInfo($id, $user->getCompany());
            $this->loadTemplate('clients_view', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }
}

?>