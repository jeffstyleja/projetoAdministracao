<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 08/03/2019
 * Time: 15:44
 */

class permissionsController extends controller{
    public function __construct()
    {
        parent::__construct();
        $user = new Users();
        if($user->isLogged() == false){
            header("Location: ". BASE_URL ."/login");
        }
    }
    public function index(){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if ($user->hasPermission('permissions_view')){
            $permission = new Permissions();
            $data['permissions_list'] = $permission->getList($user->getCompany());
            $data['permissions_group_list']= $permission->getGroupList($user->getCompany());
            $this->loadTemplate('permissions',$data);
        }else{
            header('Location: ' . BASE_URL);
        }
    }

    public function add(){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if ($user->hasPermission('permissions_view')){
            $permission = new Permissions();
            $this->loadTemplate('permissions_add',$data);
            if(isset($_POST['name']) && !empty($_POST['name'])){
                $pname=addslashes($_POST['name']);
                $permission->add($pname,$user->getCompany());
                header('Location: ' . BASE_URL ."/permissions");
            }
        }else{
            header('Location: ' . BASE_URL);
        }
    }

    public function add_group(){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if ($user->hasPermission('permissions_view')){
            $permission = new Permissions();
            if(isset($_POST['name']) && !empty($_POST['name'])){
                $pname=addslashes($_POST['name']);
                $plist= $_POST['permissions'];
                $permission->add_group($pname,$plist,$user->getCompany());
                header('Location: ' . BASE_URL ."/permissions");
            }
            $data['permissions_list'] = $permission->getList($user->getCompany());
            $this->loadTemplate('group_add',$data);
        }else{
            header('Location: ' . BASE_URL);
        }
    }

    public function edit_group($id){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if ($user->hasPermission('permissions_view')){
            $permission = new Permissions();
            if(isset($_POST['name']) && !empty($_POST['name'])){
                $pname=addslashes($_POST['name']);
                $plist= $_POST['permissions'];
                $permission->update_group($id,$pname,$plist,$user->getCompany());
                header('Location: ' . BASE_URL ."/permissions");
            }
            $data['permissions_list'] = $permission->getList($user->getCompany());
            $data['group_info'] = $permission->getGroup($id,$user->getCompany());
            $this->loadTemplate('edit_group',$data);
        }else{
            header('Location: ' . BASE_URL);
        }
    }

    public function delete($id){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if ($user->hasPermission('permissions_view')){
            $permission = new Permissions();
            if(isset($id) && !empty($id)){
                $pid=$id;
                $permission->delete($pid,$user->getCompany());
                header('Location: ' . BASE_URL ."/permissions");
            }
        }else{
            header('Location: ' . BASE_URL);
        }
    }

    public function delete_group($id){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if ($user->hasPermission('permissions_view')){
            $permission = new Permissions();
            if(isset($id) && !empty($id)){
                $pid=$id;
                $permission->delete_group($pid,$user->getCompany());
                header('Location: ' . BASE_URL ."/permissions");
            }
        }else{
            header('Location: ' . BASE_URL);
        }
    }

}
?>