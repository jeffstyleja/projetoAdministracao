<?php
/**
 * Created by PhpStorm.
 * User: jeferson.santos
 * Date: 04/05/2018
 * Time: 09:56
 */

class Core {

    public function run(){
        $url= explode("index.php",$_SERVER['PHP_SELF']);
        $url=end($url);

        if(!empty($url)){
            $url = explode('/',$url);
            array_shift($url);

            $currentController = $url[0].'Controller';
            array_shift($url);

            if(!empty($url[0])){
                $currentAction = $url[0];
                array_shift($url);
            }else{
               $currentAction = 'index';
            }

            if($url > 0){
                $params = $url;
            }
        }else{
            $currentController = 'homeController';
            $currentAction = 'index';
            $params = array();
        }

        $c= new $currentController();
        call_user_func_array(array($c,$currentAction),$params);

    }
}
?>