<?php
require __DIR__. '/db_class.php';
class driver{
	protected $_con;

	/**
	 * it will initalize DBclass
	 */
	public function __construct()

	{
        $db = new db_class();
		$this->_con = $db->con;
	}
	public function driver_login($email,$password)
	{
        $data=array();
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('Y-m-d H:i:s');
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		$stmt = $this->_con->prepare('SELECT * FROM driver WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			if (password_verify($password, $row["password"])) {
				$updatestmt = $this->_con->prepare('UPDATE  driver SET lastlogin = ? WHERE email = ?');
				$updatestmt->bind_param('ss', $lastlogin,$email); // 's' specifies the variable type => 'string'
				$updatestmt->execute();
				session_start();
			
				$_SESSION['email'] = $row['email'];
				$_SESSION['driverid'] = $row['driverid'];
				$_SESSION['forename'] = $row['forename'];
				$_SESSION['phone'] = $row['contactnumber'];
				$data["message"]= "Validated Successfully";
            	$data["code"]= 1;
            	$data["adminid"]= $row['adminid'];
				$data["email"]= $row['email'];
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
	public function driver_signup($email,$password,$forename,$phone)
	{
        $data=array();
		$hashed= password_hash($password, PASSWORD_DEFAULT);
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		date_default_timezone_set('Africa/Lagos');
		$lastlogin =date('Y-m-d H:i:s');
		$status =2;
		$stmt = $this->_con->prepare('SELECT * FROM driver WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$data["message"]= "Duplicate Account Found";
			$data["code"]= 0;
			}
		else {
			$insertstmt = $this->_con->prepare('INSERT INTO driver(forename,email, password,contactnumber,created,lastlogin)
			 VALUES(?,?,?,?,?,?)');
			$insertstmt->bind_param('ssssss',$forename,$email,$hashed,$phone,$created,$lastlogin); 
			// 's' specifies the variable type => 'string'
			if($insertstmt->execute()){
				$data["message"]= "Registered Successfully";
				$data["code"]= 1;
			}
			else{
				$data["message"]= "An Error has Occurred";
				$data["code"]= 0;
			}
		}
      echo  json_encode($data);
	}
	public function driver_password_reset($email,$password)
	{
        $data=array();
		$updated = date('d-m-Y');
		$stmt = $this->_con->prepare('SELECT * FROM driver WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			$hashed= password_hash($password, PASSWORD_DEFAULT);
			$updatestmt = $this->_con->prepare('UPDATE  driver SET password = ?  WHERE email = ?');
			$updatestmt->bind_param('ss', $hashed,$email); // 's' specifies the variable type => 'string'
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
	public function ProfileUpdate($email,$phone,$forenames)
	{
        $data=array();
		
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('Y-m-d H:i:s');
		$status =0;
		$stmt = $this->_con->prepare('SELECT * FROM driver WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$insertstmt = $this->_con->prepare('UPDATE driver SET forename = ?,contactnumber = ? WHERE email =?');
			$insertstmt->bind_param('sss',$forenames,$phone,$email); 
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