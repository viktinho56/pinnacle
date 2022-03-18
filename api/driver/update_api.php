<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/driver_class.php';
    $userobj = new driver();
    if (!empty($_POST['forename']) && !empty($_POST['email']) && !empty($_POST['contactnumber'])) {
        $email = trim(htmlspecialchars($_POST['email']));
        $phone = trim(htmlspecialchars($_POST['contactnumber']));
        $forename = trim(htmlspecialchars($_POST['forename']));
        $userobj->ProfileUpdate($email,$phone,$forename);
    }
    else {
        $data=array();
        $data["message"]= "Email or Password Blank";
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