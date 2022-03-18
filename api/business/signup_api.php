<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/business_class.php';
    $businessobj = new business();
    if (!empty($_POST['nameofcompany']) && !empty($_POST['maincontactperson']) && !empty($_POST['addressone'])  && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['country']) &&  !empty($_POST['email']) && !empty($_POST['contactnumber']) &&!empty($_POST['password']) && !empty($_POST['avatar']) && !empty($_POST['p1']) &&!empty($_POST['p2']) &&!empty($_POST['p3']) &&!empty($_POST['p4'])) {
        $p1 = trim(htmlspecialchars($_POST['p1']));
        $p2 = trim(htmlspecialchars($_POST['p2']));
        $p3 = trim(htmlspecialchars($_POST['p3']));
        $p4 = trim(htmlspecialchars($_POST['p4']));
       
        $nameofcompany = trim(htmlspecialchars($_POST['nameofcompany']));
        $maincontactperson = trim(htmlspecialchars($_POST['maincontactperson']));
        $companytype = trim(htmlspecialchars($_POST['companytype']));
        $typeofcompany = trim(htmlspecialchars($_POST['typeofcompany']));
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
            $pin = $p1.$p2.$p3.$p4;
            $businessobj->business_signup($nameofcompany,$maincontactperson,$companytype,$typeofcompany,$adressone,$addresstwo,$city,$state,$country,$postcode,$email,$contactnumber,$password,$avatar,$notification,$pin);
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