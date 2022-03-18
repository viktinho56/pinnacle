<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	
    require __DIR__. '/../../classes/admin_class.php';
    $userobj = new admin();
    $userobj->ShowDriver();
  

} else {
    $data=array();
    $data["message"]= "Invalid Request";
    $data["code"]= 0;
    echo  json_encode($data);

}


?>