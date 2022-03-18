<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/user_class.php';
    $userobj = new user();
    if (!empty($_POST['forenames']) && !empty($_POST['surname']) && !empty($_POST['addressone'])  && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['country']) &&  !empty($_POST['email']) && !empty($_POST['contactnumber']) &&!empty($_POST['password']) && !empty($_POST['avatar'])) {
        $forenames = trim(htmlspecialchars($_POST['forenames']));
        $surname = trim(htmlspecialchars($_POST['surname']));
        $adressone = trim(htmlspecialchars($_POST['addressone']));
        $addresstwo = trim(htmlspecialchars($_POST['addresstwo']));
        $city = trim(htmlspecialchars($_POST['city']));
        $state = trim(htmlspecialchars($_POST['state']));
        $country = trim(htmlspecialchars($_POST['country']));
        $postcode = trim(htmlspecialchars($_POST['postcode']));
        $email = trim(htmlspecialchars($_POST['email']));
        $contactnumber = trim(htmlspecialchars($_POST['contactnumber']));
        $password = trim(htmlspecialchars($_POST['password']));
        $avatar = trim(htmlspecialchars($_POST['avatar']));
        $notification = trim(htmlspecialchars($_POST['notification']));
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	    if ($email === false) {
            $data=array();
            $data["message"]= "Email is Invalid";
            $data["code"]= 0;
            echo  json_encode($data);
	    }
        else{
            $userobj->user_signup($forenames,$surname,$adressone,$addresstwo,$city,$state,$country,$postcode,$email,$contactnumber,$password,$avatar,$notification);
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