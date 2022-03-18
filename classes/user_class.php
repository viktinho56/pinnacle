<?php
 ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require __DIR__. '/db_class.php';
require __DIR__. '/email_class.php';
class user extends email{
	protected $_con;

	/**
	 * it will initalize DBclass
	 */
	public function __construct()

	{
        $db = new db_class();
		$this->_con = $db->con;
		
		//$this->_con = mysqli_connect("localhost","root","","akesisdb_leave");
	}
	public function user_login($email,$password)
	{
        $data=array();
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('Y-m-d H:i:s');
		$stmt = $this->_con->prepare('SELECT * FROM users WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			if (password_verify($password, $row["password"])) {
				$updatestmt = $this->_con->prepare('UPDATE  users SET lastlogin = ? WHERE email = ?');
				$updatestmt->bind_param('ss', $lastlogin,$email); // 's' specifies the variable type => 'string'
				$updatestmt->execute();
				session_start();
				$_SESSION['forenames'] = $row['forenames'];
				$_SESSION['surname'] = $row['surname'];
				$_SESSION['addressone'] = $row['addressone'];
				$_SESSION['addresstwo'] = $row['addresstwo'];
				$_SESSION['city'] = $row['city'];
				$_SESSION['state'] = $row['state'];
				$_SESSION['country'] = $row['country'];
				$_SESSION['postcode'] = $row['postcode'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['contactnumber'] = $row['contactnumber'];
				$_SESSION['notification'] = $row['notification'];
				$_SESSION['avatar'] = $row['avatar'];
				$_SESSION['userid'] = $row['userid'];
				
				$data["message"]= "Validated Successfully";
            	$data["code"]= 1;
				
			}
			else{
				$data["message"]= "Incorrect Email and/or Password!";
            	$data["code"]= 0;
			}
			}
		else {
            $data["message"]= "Incorrect Email and/or password!";
            $data["code"]= 0;
		}
      echo  json_encode($data);
 		
	}
	public function user_signup($forenames,$surname,$adressone,$addresstwo,$city,$state,$country,$postcode,$email,$contactnumber,$password,$avatar,$notification)
	{
        $data=array();
		$hashed= password_hash($password, PASSWORD_DEFAULT);
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('Y-m-d H:i:s');
		$status =0;
		$stmt = $this->_con->prepare('SELECT * FROM users WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$data["message"]= "Duplicate Account Found";
			$data["code"]= 0;
			}
		else {
			$insertstmt = $this->_con->prepare('INSERT INTO users(forenames,surname,addressone,addresstwo,city,state,country,postcode,email,contactnumber,password,avatar,created, updated, lastlogin, status,notification)
			 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
			$insertstmt->bind_param('sssssssssssssssii',$forenames,$surname,$adressone,$addresstwo,$city,$state,$country,$postcode,$email,$contactnumber,$hashed,$avatar,$created,$updated,$lastlogin,$status,$notification); 
			// 's' specifies the variable type => 'string'
			if($insertstmt->execute()){
				$data["message"]= "Registered Successfully";
				$data["code"]= 1;
				$this->SendWelcomeEmailToClient($email,$password);
			}
			else{
				$data["message"]= "An Error has Occurred";
				$data["code"]= 0;
			}
		}
      echo  json_encode($data);
	}
	public function user_password_reset($email,$password)
	{
        $data=array();
		
		$updated = date('Y-m-d H:i:s');
	
		date_default_timezone_set('Africa/Lagos');
		
		$stmt = $this->_con->prepare('SELECT * FROM users WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			$hashed= password_hash($password, PASSWORD_DEFAULT);
			$updatestmt = $this->_con->prepare('UPDATE  users SET password = ? ,updated = ? WHERE email = ?');
			$updatestmt->bind_param('sss', $hashed,$updated,$email); // 's' specifies the variable type => 'string'
			$updatestmt->execute();
			$data["message"]= "Updated Successfully";
				$data["code"]= 1;
			}
		else {
            $data["message"]= "Email does not exist";
            $data["code"]= 0;
		}
      echo  json_encode($data);
 		
	}

	public function user_profile_update($email,$forenames,$surname,$adressone,$addresstwo,$city,$state,$country,$postcode,$contactnumber,$avatar,$notification)
	{
        $data=array();
		
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('Y-m-d H:i:s');
		$status =0;
		$stmt = $this->_con->prepare('SELECT * FROM users WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$insertstmt = $this->_con->prepare('UPDATE users SET forenames = ?,surname = ?,addressone = ?,addresstwo = ?,city = ?,state = ?,country = ?,postcode = ?,contactnumber = ?,avatar = ?, updated =?, notification = ? WHERE email =?');
			$insertstmt->bind_param('sssssssssssis',$forenames,$surname,$adressone,$addresstwo,$city,$state,$country,$postcode,$contactnumber,$avatar,$updated,$notification,$email); 
			// 's' specifies the variable type => 'string'
			if($insertstmt->execute()){
				$data["message"]= "Updated Successfully";
				$data["code"]= 1;
			}
			else{
				$data["message"]= "An Error has Occurred";
				$data["code"]= 0;
			}
			}
		else {
				$data["message"]= "User Not Found";
				$data["code"]= 0;
		}
      echo  json_encode($data);
	}


}

?>