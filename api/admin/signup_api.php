<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/admin_class.php';
    $userobj = new admin();
    if (!empty($_POST['forename'])   &&  !empty($_POST['email']) && !empty($_POST['contactnumber']) &&!empty($_POST['password'])) {
        $forename = trim(htmlspecialchars($_POST['forename']));
        
        $email = trim(htmlspecialchars($_POST['email']));
        $contactnumber = trim(htmlspecialchars($_POST['contactnumber']));
        $password = trim(htmlspecialchars($_POST['password']));
       
      
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	    if ($email === false) {
            $data=array();
            $data["message"]= "Email is Invalid";
            $data["code"]= 0;
            echo  json_encode($data);
	    }
        else{
            $userobj->admin_signup($email,$password,$forename,$contactnumber);
        }
        
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