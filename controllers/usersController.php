<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 03/04/2019
 * Time: 09:04
 */
class usersController extends controller{
    public function __construct()
    {
        parent::__construct();
        $user = new Users();
        if($user->isLogged() == false){
            header("Location: " . BASE_URL ."/login");
        }
    }

    public function index(){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if($user->hasPermission('users_view')){
            $data['user_list'] = $user->getList($user->getCompany());

            $this->loadTemplate('users',$data);
        }else{
            header("Location: " . BASE_URL);
        }
    }

    public function add($id){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if($user->hasPermission('users_add')){
            $permissions = new Permissions();
            if(isset($_POST['email']) && !empty($_POST['email'])){
                $email=addslashes($_POST['email']);
                $password=addslashes($_POST['password']);
                $group=addslashes($_POST['group']);
                $return = $user->add($email,$password,$group);
                if($return == '1'){
                    header("Location: " . BASE_URL ."/users");
                }else{
                    $data['error_msg'] = "Usuário já existe no sistema";
                }
            }
            $data['group_list'] =  $permissions->getGroupList($user->getCompany());
            $this->loadTemplate('users_add',$data);
        }else{
            header("Location: " . BASE_URL);
        }
    }

    public function edit_users($id){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        $data['user_info'] = $user->getInfoUser($id,$user->getCompany());
        if($user->hasPermission('edit_users')){
            $permissions = new Permissions();
            if(isset($_POST['group']) && !empty($_POST['group'])){
                if(isset($_POST['password']) && !empty($_POST['password']) && $_POST['password']!= '******'){
                    $password=addslashes($_POST['password']);
                }else{
                    $password='';
                }
                if(isset($_POST['group']) && !empty($_POST['group'])){
                    $group=addslashes($_POST['group']);
                }
                $user->edit_users($id,$user->getCompany(),$password,$group);

                header("Location: " . BASE_URL ."/users");

            }
            $data['group_list'] =  $permissions->getGroupList($user->getCompany());
            $this->loadTemplate('edit_users',$data);
        }else{
            header("Location: " . BASE_URL);
        }
    }

    public function delete_users($id){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        $data['user_info'] = $user->getInfoUser($id,$user->getCompany());
        if($user->hasPermission('delete_users')){
            $user->delete_users($id,$user->getCompany());
            header("Location: " . BASE_URL ."/users");
        }else{
            header("Location: " . BASE_URL);
        }
    }
}

?>