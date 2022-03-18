<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/email_class.php';
    $orderobj = new email();
    if (
       !empty($_POST['email']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])  && !empty($_POST['text'])
          )
        {
      
    
        $orderobj->SendContactEmail('info@pinnaclemachinery.co.uk',$_POST['firstname'],$_POST['email'],$_POST['lastname'],$_POST['text']);
       
        
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