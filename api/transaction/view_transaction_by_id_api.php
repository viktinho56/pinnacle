<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	
    require __DIR__. '/../../classes/transaction_class.php';
    $userobj = new transaction();
    if (!empty($_GET['businessid'])) {
        $id = trim(htmlspecialchars($_GET['businessid']));
        $userobj->view_transaction($id);
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