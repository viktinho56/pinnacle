<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	
    require __DIR__. '/../../classes/order_class.php';
    $orderobj = new order();
    if (!empty($_GET['email']))
        {
        $email = trim(htmlspecialchars($_GET['email']));
        $orderobj->view_ordersbyuseremail($email);
        }
       
    else {
        $data=array();
        $data["message"]= "Some Fields are Blank";
        $data["code"]= 0;
        echo  json_encode($data);
    
    }
  

} else {
    $data=array();
    $data["message"]= "Invalid  Request";
    $data["code"]= 0;
    echo  json_encode($data);

}
