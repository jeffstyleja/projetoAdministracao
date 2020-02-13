<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 07/03/2019
 * Time: 11:15
 */
class loginController extends controller{
    public function index(){
        $data=array();
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email=addslashes($_POST['email']);
            $pass=addslashes($_POST['password']);
            $user = new Users();
            if($user->doLogin($email,$pass)){
                header("Location: ".BASE_URL);
            }else{
                $data['error'] = 'E-mail e/ou senha invalidos';
            }
        }
        $this->loadView('login',$data);
    }
    public function logout(){
        $user = new Users();
        $user->setLoggedUser();
        $user->logout();
        header("Location: ".BASE_URL);
    }
}
?>