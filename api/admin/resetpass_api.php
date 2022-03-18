<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/admin_class.php';
    $userobj = new admin();
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));
        $userobj->admin_password_reset($email,$password);
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