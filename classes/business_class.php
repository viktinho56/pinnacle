<?php
require __DIR__ . '/db_class.php';
require __DIR__. '/email_class.php';
class business extends email
{
	protected $_con;

	/**
	 * it will initalize DBclass
	 */
	public function __construct()

	{
		$db = new db_class();
		$this->_con = $db->con;
		
	}
	public function createwallet($id)
	{
        $limit = 100;
        $data=array();
        $bal = 0;
        $created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		$tracking_number='';
        $status =0;
        $insertstmt = $this->_con->prepare(
			'INSERT INTO wallet
			(
				businessid,current_balance,spendinglimit,created,updated
			)
		 VALUES(?,?,?,?,?)');
		$insertstmt->bind_param('sssss',
		$id,$bal,$limit,$created,$updated); 
		// 's' specifies the variable type => 'string'
		if($insertstmt->execute()){
			
		   // $this->update_item_count($storeid);
			$data["message"]= "Added Successfully";
			$data["code"]= 1;
			$data["id"]= $insertstmt->insert_id;
		}
		else{
			$data["message"]= "An Error has Occurred";
			$data["code"]= 0;
		}
      //echo  json_encode($data);

    }
	public function business_login($email, $password)
	{
		$data = array();
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('Y-m-d H:i:s');
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		$stmt = $this->_con->prepare('SELECT * FROM business WHERE email = ?');
		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			if (password_verify($password, $row["password"])) {
				$updatestmt = $this->_con->prepare('UPDATE  business SET lastlogin = ? WHERE email = ?');
				$updatestmt->bind_param('ss', $lastlogin, $email); // 's' specifies the variable type => 'string'
				$updatestmt->execute();
				session_start();
				$_SESSION['nameofcompany'] = $row['nameofcompany'];
				$_SESSION['maincontactperson'] = $row['maincontactperson'];
				$_SESSION['companytype'] = $row['companytype'];
				$_SESSION['typeofbusiness'] = $row['typeofbusiness'];
				$_SESSION['addressone'] = $row['addressone'];
				$_SESSION['addresstwo'] = $row['addresstwo'];
				$_SESSION['city'] = $row['city'];
				$_SESSION['state'] = $row['state'];
				$_SESSION['country'] = $row['country'];
				$_SESSION['postcode'] = $row['postcode'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['contactnumber'] = $row['contactnumber'];
				$_SESSION['avatar'] = $row['avatar'];
				$_SESSION['businessid'] = $row['businessid'];
				$_SESSION['pin'] = $this->show_pin($row['businessid']);
				$_SESSION['notification'] = $row['notification'];
				$data["message"] = "Validated Successfully";
				$data["code"] = 1;
			} else {
				$data["message"] = "Incorrect Email and/or Password!";
				$data["code"] = 0;
			}
		} else {
			$data["message"] = "Incorrect Email and/or password!";
			$data["code"] = 0;
		}
		echo  json_encode($data);
	}
	public function business_signup($nameofcompany, $maincontactperson, $companytype, $typeofcompany, $adressone, $addresstwo, $city, $state, $country, $postcode, $email, $contactnumber, $password, $avatar, $notification, $pin)
	{
		$data = array();
		$hashed = password_hash($password, PASSWORD_DEFAULT);
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('Y-m-d H:i:s');
		$status = 0;
		$stmt = $this->_con->prepare('SELECT * FROM business WHERE email = ?');
		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$data["message"] = "Duplicate Account Found";
			$data["code"] = 0;
		} else {
			$insertstmt = $this->_con->prepare('INSERT INTO business(nameofcompany,maincontactperson,companytype,typeofbusiness,addressone,addresstwo,city,state,country,postcode,email,contactnumber,password,avatar,created, updated, lastlogin, status,notification)
			 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
			$insertstmt->bind_param('sssssssssssssssssii', $nameofcompany, $maincontactperson, $companytype, $typeofcompany, $adressone, $addresstwo, $city, $state, $country, $postcode, $email, $contactnumber, $hashed, $avatar, $created, $updated, $lastlogin, $status, $notification);
			if ($insertstmt->execute()) {
				$id = $insertstmt->insert_id;
				$data["message"] = "Registered Successfully";
				$data["code"] = 1;
				$data["id"] = $id;
			
				$this->create_pin($id, $pin);
				$this->createwallet($id);
				$this->SendWelcomeEmailToClient($email,$password);
			} else {
				$data["message"] = "An Error has Occurred";
				$data["code"] = 0;
			}
		}
		echo  json_encode($data);
	}
	public function business_profile_update($email,$nameofcompany, $maincontactperson, $companytype, $typeofcompany,$adressone,$addresstwo,$city,$state,$country,$postcode,$contactnumber,$avatar,$notification,$pin)
	{
        $data=array();
		
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('Y-m-d H:i:s');
		$status =0;
		$stmt = $this->_con->prepare('SELECT * FROM business WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$insertstmt = $this->_con->prepare('UPDATE business SET nameofcompany = ?,maincontactperson = ?,companytype = ?,typeofbusiness = ?,addressone = ?,addresstwo = ?,city = ?,state = ?,country = ?,postcode = ?,contactnumber = ?,avatar = ?, updated =?, notification = ? WHERE email =?');
			$insertstmt->bind_param('sssssssssssssss',$nameofcompany,$maincontactperson,$companytype,$typeofcompany,$adressone,$addresstwo,$city,$state,$country,$postcode,$contactnumber,$avatar,$updated,$notification,$email); 
			// 's' specifies the variable type => 'string'
			if($insertstmt->execute()){
				$data["message"]= "Updated Successfully";
				$data["code"]= 1;
				$upstmt = $this->_con->prepare('UPDATE businesspin SET pin = ? WHERE businessid =?');
				$id = $this->show_id_by_email($email);
			$upstmt->bind_param('ii',$pin,$id); 
			$upstmt->execute();
			
			}
			else{
				$data["message"]= "An Error has Occurred";
				$data["code"]= 0;
			}
			}
		else {
				$data["message"]= "Business Not Found";
				$data["code"]= 0;
		}
      echo  json_encode($data);
	}
	public function create_pin($businessid, $pin)
	{
		$data = array();
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('d-m-Y h:i:s a', time());
		$status = 0;
		$insertstmt = $this->_con->prepare('INSERT INTO businesspin(businessid,pin,created)
			 VALUES(?,?,?)');
			$insertstmt->bind_param('iis', $businessid, $pin, $created);
			// 's' specifies the variable type => 'string'
			if ($insertstmt->execute()) {
				$data["message"] = "Pin Created Successfully";
				$data["code"] = 1;
			} else {
				$data["message"] = "An Error has Occurred";
				$data["code"] = 0;
			}
		//echo  json_encode($data);
	}
	public function business_password_reset($email, $password)
	{
		$data = array();
		$updated = date('d-m-Y');
		$stmt = $this->_con->prepare('SELECT * FROM business WHERE email = ?');
		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			$hashed = password_hash($password, PASSWORD_DEFAULT);
			$updatestmt = $this->_con->prepare('UPDATE  business SET password = ? ,updated = ? WHERE email = ?');
			$updatestmt->bind_param('sss', $hashed, $updated, $email); // 's' specifies the variable type => 'string'
			$updatestmt->execute();
			$data["message"] = "Updated Successfully";
			$data["code"] = 1;
		} else {
			$data["message"] = "Email does not exist";
			$data["code"] = 0;
		}
		echo  json_encode($data);
	}
	public function show_pin($id)
	{
        $data=array();
		$stmt = $this->_con->prepare('SELECT * FROM businesspin where businessid = ?');
 		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		 $pin = '';
		 $result = $stmt->get_result();
		 $count = mysqli_num_rows($result);
		 $row = $result->fetch_assoc();
		if ($count > 0) {
			
			$pin = $row['pin'];
			}
		else {
            $data["message"]= "No Pin Found";
			$data["code"]= 0;
		}
        return $pin;
    }
	public function show_id_by_email($email)
	{
        $data=array();
		$stmt = $this->_con->prepare('SELECT businessid FROM business where email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		 $id = '';
		 $result = $stmt->get_result();
		 $count = mysqli_num_rows($result);
		 $row = $result->fetch_assoc();
		if ($count > 0) {
			
			$id = $row['businessid'];
			}
		else {
            $data["message"]= "No Pin Found";
			$data["code"]= 0;
		}
        return $id;
    }
}
