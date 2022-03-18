<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/user_class.php';
    $userobj = new user();
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));
        $userobj->user_password_reset($email,$password);
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