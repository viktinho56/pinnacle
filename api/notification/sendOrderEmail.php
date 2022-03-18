<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/email_class.php';
    $orderobj = new email();
    if (
        !empty($_POST['user']) && !empty($_POST['status']) && !empty($_POST['email']) && !empty($_POST['amount']) && !empty($_POST['barcode'])  && !empty($_POST['trackingnumber']) && !empty($_POST['weight'])
          )
        {
        $status = trim(htmlspecialchars($_POST['status']));
    
        $orderobj->SendOrderEmailToClient($_POST['email'],$_POST['user'],$_POST['email'],$_POST['amount'],$_POST['trackingnumber'],$_POST['weight'],$status,$_POST['barcode']);
       
        
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