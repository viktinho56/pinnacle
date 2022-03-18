<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/admin_class.php';
    $userobj = new admin();
    if (!empty($_POST['nameofcompany']) && !empty($_POST['maincontactperson']) && !empty($_POST['addressone'])  && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['country']) &&  !empty($_POST['email']) && !empty($_POST['contactnumber']) ) {
        $forenames = trim(htmlspecialchars($_POST['nameofcompany']));
        $surname = trim(htmlspecialchars($_POST['maincontactperson']));
        $adressone = trim(htmlspecialchars($_POST['addressone']));
        $addresstwo = trim(htmlspecialchars($_POST['addresstwo']));
        $city = trim(htmlspecialchars($_POST['city']));
        $state = trim(htmlspecialchars($_POST['state']));
        $country = trim(htmlspecialchars($_POST['country']));
       
        $email = trim(htmlspecialchars($_POST['email']));
        $contactnumber = trim(htmlspecialchars($_POST['contactnumber']));
       
       // $avatar = trim(htmlspecialchars($_POST['avatar']));
      //  $notification = trim(htmlspecialchars($_POST['notification']));
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	    if ($email === false) {
            $data=array();
            $data["message"]= "Email is Invalid";
            $data["code"]= 0;
            echo  json_encode($data);
	    }
        else{
            $userobj->BusinessProfileUpdate($email,$forenames,$surname,$adressone,$addresstwo,$city,$state,$country,$contactnumber);

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