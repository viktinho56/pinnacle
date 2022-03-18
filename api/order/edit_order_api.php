<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
    require __DIR__. '/../../classes/order_class.php';
    $orderobj = new order();
    if (
        !empty($_POST['id']) && !empty($_POST['s_destination']) && !empty($_POST['s_forename']) && !empty($_POST['s_addressone'])  && 
        !empty($_POST['s_city']) && !empty($_POST['s_state']) && !empty($_POST['s_country']) && 
         !empty($_POST['s_email']) && !empty($_POST['r_forename']) && !empty($_POST['r_addressone'])  && 
         !empty($_POST['r_city']) && !empty($_POST['r_state']) && !empty($_POST['r_country']) && 
          !empty($_POST['s_email']) && !empty($_POST['r_email']) && !empty($_POST['p_forename']) && !empty($_POST['p_addressone'])  && 
          !empty($_POST['p_city']) && !empty($_POST['p_state']) && !empty($_POST['p_country'])
          && !empty($_POST['deliverymethod']) && !empty($_POST['weight']) && !empty($_POST['items'])
          )
        {
        $id = trim(htmlspecialchars($_POST['id']));
        $s_destination = trim(htmlspecialchars($_POST['s_destination']));
        $s_forename = trim(htmlspecialchars($_POST['s_forename']));
        $s_addresslineone = trim(htmlspecialchars($_POST['s_addressone']));
        $s_addresslinetwo = trim(htmlspecialchars($_POST['s_addresstwo']));
        $s_city = trim(htmlspecialchars($_POST['s_city']));
        $s_state = trim(htmlspecialchars($_POST['s_state']));
        $s_country = trim(htmlspecialchars($_POST['s_country']));
        $s_postcode = trim(htmlspecialchars($_POST['s_postcode']));
        $s_contact = trim(htmlspecialchars($_POST['s_contact']));
     
        $r_forename = trim(htmlspecialchars($_POST['r_forename']));
        $r_contact = trim(htmlspecialchars($_POST['r_contact']));
        $r_addresslineone = trim(htmlspecialchars($_POST['r_addressone']));
        $r_addresslinetwo = trim(htmlspecialchars($_POST['r_addresstwo']));
        $r_city = trim(htmlspecialchars($_POST['r_city']));
        $r_state = trim(htmlspecialchars($_POST['r_state']));
        $r_country = trim(htmlspecialchars($_POST['r_country']));
        $r_postcode = trim(htmlspecialchars($_POST['r_postcode']));

        $p_destination = trim(htmlspecialchars($_POST['p_destination']));
        $p_forename = trim(htmlspecialchars($_POST['p_forename']));
        $p_addresslineone = trim(htmlspecialchars($_POST['p_addressone']));
        $p_addresslinetwo = trim(htmlspecialchars($_POST['p_addresstwo']));
        $p_city = trim(htmlspecialchars($_POST['p_city']));
        $p_state = trim(htmlspecialchars($_POST['p_state']));
        $p_country = trim(htmlspecialchars($_POST['p_country']));
        $p_postcode = trim(htmlspecialchars($_POST['p_postcode']));

        $deliverymethod = trim(htmlspecialchars($_POST['deliverymethod']));
        $seafreight = trim(htmlspecialchars($_POST['seafreight']));
        $airfreight = trim(htmlspecialchars($_POST['airfreight']));
        $weight = trim(htmlspecialchars($_POST['weight']));
        $items = trim(htmlspecialchars($_POST['items']));
        $items_desc = trim(htmlspecialchars($_POST['items_desc']));
        $amount = 0;
        switch ($deliverymethod) {
            case 'fast_delivery':
                $amount =  (int)$weight * 4.5;
                break;
            case 'standard_delivery':
                $amount =  (int)$weight * 3;
                    break;
            case 'sea_freight':
                if($seafreight == "FCL 20FT Container"){$amount = 690;}
                 elseif($seafreight == "FCL 40FT Container"){$amount = 955;}
                 elseif($seafreight == "LLC 1 CBM"){$amount = 204;}
                  elseif($seafreight == "LLC 5 CBM"){$amount = 499;} 
                  elseif($seafreight == "LLC 10 CBM"){$amount = 825;} 
               
                break;
                case 'air_freight':
                    if($airfreight == "50 Kilos"){$amount = 149;}
                     elseif($airfreight == "200 Kilos"){$amount = 380;}
                     elseif($airfreight == "500 Kilos"){$amount = 843;}
                    break;
            default:
                # code...
                break;
        }
        $s_email = filter_var($_POST['s_email'], FILTER_VALIDATE_EMAIL);
        $r_email = filter_var($_POST['r_email'], FILTER_VALIDATE_EMAIL);
	    if ($s_email === false || $r_email ===false) {
            $data=array();
            $data["message"]= "Email Not Invalid";
            $data["code"]= 0;
            echo  json_encode($data);
	    }
        else{
            $orderobj->edit_order($id,$s_destination,$s_forename,$s_addresslineone,$s_addresslinetwo,$s_city,$s_state,$s_country,$s_postcode,$r_forename,$r_contact,$r_addresslineone,$r_addresslinetwo,$r_city,$r_state,$r_country,$r_postcode,$p_destination,$p_forename,$p_addresslineone,$p_addresslinetwo,$p_city,$p_state,$p_country,$p_postcode,$deliverymethod,$seafreight,$airfreight,$weight,$items,$items_desc,$amount,$s_email,$r_email,$s_contact);
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