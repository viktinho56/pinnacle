<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/order_class.php';
    $orderobj = new order();
    if (
        !empty($_POST['status']) && !empty($_POST['orderid'])
          )
        {
        $status = trim(htmlspecialchars($_POST['status']));
        $id= trim(htmlspecialchars($_POST['orderid']));
        $orderobj->update_order_status($id,$status);
       
        
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


?>