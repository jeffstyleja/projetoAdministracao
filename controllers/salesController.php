<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 06/05/2019
 * Time: 13:29
 */

class salesController extends controller{
    public function __construct()
    {
        return parent::__construct();
        $user = new Users();
        if($user->isLogged() == false){
            header("Location: " . BASE_URL ."/login");
        }
    }

    public function index()
    {
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if($user->hasPermission('sales_view')){
            $sales=new Sales();
            $data['p'] = 1;
            if(isset($_GET['p']) && !empty($_GET['p'])){
                $data['p'] = intval($_GET['p']);
                if($data['p']==0){
                    $data['p'] = 1;
                }
            }
            $offset = (10 * ($data['p']-1));
            $data['statuses'] = array(
                '0' => 'Aguardando Pagamento',
                '1' => 'Pago',
                '2' => 'Cancelado'
            );
            $data['sales_add'] = $user->hasPermission('sales_add');
            $data['sales_edit'] = $user->hasPermission('sales_edit');
            $data['sales_list'] = $sales->getList($offset,$user->getCompany());
            $data['sales_count'] = $sales->getCount($user->getCompany());
            $data['p_count'] = ceil($data['sales_count']/10);
            $this->loadTemplate('sales',$data);
        }else{
            header('Location: '.BASE_URL);
        }
    }

    public function add(){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if($user->hasPermission('sales_add')){
            $sales = new Sales();
            if(isset($_POST['client_id']) && !empty($_POST['client_id'])){
                $client_id = addslashes($_POST['client_id']);
                $status = addslashes($_POST['status']);
                $quant = $_POST['quant'];
                $sales->addSale($user->getCompany(),$client_id,$user->getID(),$quant,$status);
                header('Location: ' . BASE_URL . '/sales');
            }
            $this->loadTemplate('sales_add',$data);
        }else{
            header('Location: ' . BASE_URL . '/sales');
        }
    }

    public function delete($id){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if($user->hasPermission('sales_delete')){
            $sales = new Sales();
            if(isset($id) && !empty($id)){
                $sales->deleteSale($user->getCompany(),$id);
            }
            header('Location: ' . BASE_URL . '/sales');
        }else{
            header('Location: ' . BASE_URL . '/sales');
        }
    }

    public function edit($id){
        $data =array();
        $user= new Users();
        $user->setLoggedUser();
        $company = new Companies($user->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $user->getEmail();
        if($user->hasPermission('sales_edit')){
            $sales = new Sales();
            if($_POST['sales_id'] && !empty($_POST['sales_id'])){
                $id_sale = addslashes($_POST['sales_id']);
                $client_id = addslashes($_POST['client_id']);
                $status = addslashes($_POST['status']);
                $price= str_replace('.', '', $_POST['total_price']);
                $total_price = str_replace(',','.',$price);
                $sales->editSale($id_sale,$user->getCompany(),$client_id,$user->getID(),$total_price,$status);
                header('Location: ' . BASE_URL . '/sales');
            }
            $data['sale_info'] = $sales->getSale($id,$user->getCompany());
            $this->loadTemplate('sales_edit',$data);
        }else{
            header('Location: ' . BASE_URL . '/sales');
        }
    }

}
?>