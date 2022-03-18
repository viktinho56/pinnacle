<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/transaction_class.php';
    $userobj = new transaction();
    if (!empty($_POST['businessid']) && !empty($_POST['type']) && !empty($_POST['amount'])) {
        $id = trim(htmlspecialchars($_POST['businessid']));
        $trantype = trim(htmlspecialchars($_POST['type']));
        $amount = trim(htmlspecialchars($_POST['amount']));
        $userobj->create($id,$trantype,$amount);
    }
    else {
        $data=array();
        $data["message"]= "Id Blank";
        $data["code"]= 0;
        echo  json_encode($data);
    
    }
  

} else {
    $data=array();
    $data["message"]= "Invalid Request";
    $data["code"]= 0;
    echo  json_encode($data);

}


?>