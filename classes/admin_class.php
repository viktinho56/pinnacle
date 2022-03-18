<?php
require __DIR__. '/db_class.php';
class admin{
	protected $_con;

	/**
	 * it will initalize DBclass
	 */
	public function __construct()

	{
        $db = new db_class();
		$this->_con = $db->con;
	}
	public function admin_login($email,$password)
	{
        $data=array();
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('Y-m-d H:i:s');
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		$stmt = $this->_con->prepare('SELECT * FROM admin WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			if (password_verify($password, $row["password"])) {
				$updatestmt = $this->_con->prepare('UPDATE  admin SET lastlogin = ? WHERE email = ?');
				$updatestmt->bind_param('ss', $lastlogin,$email); // 's' specifies the variable type => 'string'
				$updatestmt->execute();
				session_start();
			
				$_SESSION['forename'] = $row['forename'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['phone'] = $row['contactnumber'];
				$_SESSION['adminid'] = $row['adminid'];
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
	public function admin_signup($email,$password,$forename,$phone)
	{
        $data=array();
		$hashed= password_hash($password, PASSWORD_DEFAULT);
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		date_default_timezone_set('Africa/Lagos');
		$lastlogin =date('Y-m-d H:i:s');
		$status =2;
		$stmt = $this->_con->prepare('SELECT * FROM admin WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$data["message"]= "Duplicate Account Found";
			$data["code"]= 0;
			}
		else {
			$insertstmt = $this->_con->prepare('INSERT INTO admin(forename,email, password,contactnumber,created,lastlogin)
			 VALUES(?,?,?,?,?,?)');
			$insertstmt->bind_param('ssssss',$forename,$email,$hashed,$phone,$created,$lastlogin); 
			// 's' specifies the variable type => 'string'
			if($insertstmt->execute()){
				$data["message"]= "Registered Successfully";
				$data["code"]= 1;
				$variables = array();
				$variables['email'] = $email;
				$variables['password'] = $password;
				$template = file_get_contents("../helpers/emails/staffemail.html");
				foreach($variables as $key => $value)
				{
    				
    				$template = str_replace('{{ '.$key.' }}', $value, $template);
				}
				$to = $email;  
				$subject = "Welcome";  
				//$message = "Hello! This is a simple email message.";  
				$from = "info@pinnacle-erp.xyz";  
				$headers = "From: $from";  
				mail($to,$subject,$template,$headers); 
				//echo $template;
			}
			else{
				$data["message"]= "An Error has Occurred";
				$data["code"]= 0;
			}
		}
      echo  json_encode($data);
	}
	public function admin_password_reset($email,$password)
	{
        $data=array();
		$updated = date('d-m-Y');
		$stmt = $this->_con->prepare('SELECT * FROM admin WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			$hashed= password_hash($password, PASSWORD_DEFAULT);
			$updatestmt = $this->_con->prepare('UPDATE  admin SET password = ?  WHERE email = ?');
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
	public function ViewUsersById($id){

		$data=array();
		$stmt = $this->_con->prepare('SELECT * FROM users where userid=?');
		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"id" => $row["userid"],
					"forenames" => $row["forenames"], 
					"surname" => $row["surname"], 
					"email" => $row["email"],
					"type" => "User", 
					"contactnumber" => $row["contactnumber"],
					"addressone" => $row["addressone"],
					"addresstwo" => $row["addresstwo"],
					"state" => $row["state"],
					"city" => $row["city"],
					"country" => $row["country"],
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
	}

	public function ViewBusinessById($id){

		$data=array();
		$stmt = $this->_con->prepare('SELECT * FROM business where businessid=?');
		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"id" => $row["businessid"],
					"nameofcompany" => $row["nameofcompany"], 
					"maincontactperson" => $row["maincontactperson"], 
					"email" => $row["email"],
					"type" => "Business", 
					"contactnumber" => $row["contactnumber"],
					"addressone" => $row["addressone"],
					"addresstwo" => $row["addresstwo"],
					"state" => $row["state"],
					"city" => $row["city"],
					"country" => $row["country"],
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
	}
	public function ViewAdminById($id){

		$data=array();
		$stmt = $this->_con->prepare('SELECT * FROM admin where adminid=?');
		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"id" => $row["adminid"],
					"forenames" => $row["forename"], 
					
					"email" => $row["email"],
					"type" => "Admin", 
					"contactnumber" => $row["contactnumber"],
					
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
	}
	public function ViewDriverById($id){

		$data=array();
		$stmt = $this->_con->prepare('SELECT * FROM driver where driverid=?');
		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"id" => $row["userid"],
					"forenames" => $row["forename"], 
					
					"email" => $row["email"],
					"type" => "Admin", 
					"contactnumber" => $row["contactnumber"],
					
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
	}
	public function ShowUsers()
	{
		$data=array();
		$stmt = $this->_con->prepare('SELECT * FROM users');
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"id" => $row["userid"],
					"name" => $row["forenames"], 

					"email" => $row["email"],
					"type" => "User", 
					"usertype" => true, 
					"businesstype" => false, 
					"admintype" => false, 
					"drivertype" => false, 
					"phone" => $row["contactnumber"],
					"url" => 'view-user?id='.$row["userid"].'&email='.$row["email"]
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
	}
	public function ShowBusiness()
	{
		$data=array();
		$stmt = $this->_con->prepare('SELECT * FROM business');
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"id" => $row["businessid"],
					"name" => $row["nameofcompany"], 
					"email" => $row["email"],
					"type" => "Business", 
					"usertype" => false, 
					"businesstype" => true, 
					"admintype" => false, 
					"drivertype" => false, 
					"phone" => $row["contactnumber"] 
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
	}
	public function ShowAdmin()
	{
		$data=array();
		$stmt = $this->_con->prepare('SELECT * FROM admin');
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"id" => $row["adminid"],
					"name" => $row["forename"], 
					"email" => $row["email"],
					"type" => "Admin", 
					"usertype" => false, 
					"businesstype" => false, 
					"admintype" => true, 
					"drivertype" => false, 
					"phone" => $row["contactnumber"] 
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
	}
	public function ShowDriver()
	{
		$data=array();
		$stmt = $this->_con->prepare('SELECT * FROM driver');
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"id" => $row["driverid"],
					"name" => $row["forename"], 
					"email" => $row["email"],
					"type" => "Driver", 
					"usertype" => false, 
					"businesstype" => false, 
					"admintype" => false, 
					"drivertype" => true, 
					"phone" => $row["contactnumber"] 
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
	}
	public function ShowOrders()
	{
		$data=array();
		$stmt = $this->_con->prepare('SELECT * FROM orders order by order_id desc');
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$stat="";
		$statlbl ="";
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
				if($row["order_status"] == 0){$stat = "New";$statlbl = "badge badge-success";}
				else{$stat = "Old";$statlbl = "badge badge-info";}
                $data[] = array(
                	"order_id" => $row["order_id"],
					"created" => $row["created"],
					"name" => $row["sender_forename"], 
					"status" => $stat,
					"tracking" =>  $row["tracking_number"],
					"amount" => $row["amount"],
					"statlabel" => $statlbl,
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
	}
	public function ShowAssignOrders()
	{
		$data=array();
		$e="";
		$i=0;
		$stmt = $this->_con->prepare('SELECT * FROM orders  where tracking_number !=? and order_status =? order by order_id desc');
		$stmt->bind_param('si', $e,$i); // 's' specifies the variable type => 'string'
		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$stat="";
		$statlbl ="";
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
				if($row["order_status"] == 0){$stat = "New";$statlbl = "badge badge-success";}
				else{$stat = "Old";$statlbl = "badge badge-info";}
                $data[] = array(
					"id" => $row["order_id"],
					"created" => $row["created"],
					"name" => $row["sender_forename"], 
					"status" => $stat,
					"tracking" =>  $row["tracking_number"],
					"amount" => $row["amount"],
					"statlabel" => $statlbl,
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
	}
	public function ShowTransactions()
	{
		$data=array();
		$stmt = $this->_con->prepare('SELECT * FROM transaction order by transactionid desc');
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"id" => $row["businessid"],
					"created" => $row["created"], 
					"amount" => $row["amount"],
					"type" => $row["transactiontype"], 
					"status" => $row["status"] 
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
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
		$stmt = $this->_con->prepare('SELECT * FROM admin WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$insertstmt = $this->_con->prepare('UPDATE admin SET forename = ?,contactnumber = ? WHERE email =?');
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


	public function DriverProfileUpdate($email,$phone,$forenames)
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

	public function UserProfileUpdate($email,$forenames,$surname,$adressone,$addresstwo,$city,$state,$country,$contactnumber)
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
			$insertstmt = $this->_con->prepare('UPDATE users SET forenames = ?,surname = ?,addressone = ?,addresstwo = ?,city = ?,state = ?,country = ?,contactnumber = ?,updated =?  WHERE email =?');
			$insertstmt->bind_param('ssssssssss',$forenames,$surname,$adressone,$addresstwo,$city,$state,$country,$contactnumber,$updated,$email); 
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

	public function BusinessProfileUpdate($email,$name,$main,$adressone,$addresstwo,$city,$state,$country,$contactnumber)
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
			$insertstmt = $this->_con->prepare('UPDATE business SET nameofcompany = ?,maincontactperson = ?,addressone = ?,addresstwo = ?,city = ?,state = ?,country = ?,contactnumber = ?,updated =?  WHERE email =?');
			$insertstmt->bind_param('ssssssssss',$name,$main,$adressone,$addresstwo,$city,$state,$country,$contactnumber,$updated,$email); 
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
