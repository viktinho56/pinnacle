<?php
require __DIR__. '/db_class.php';
class store{
	protected $_con;

	/**
	 * it will initalize DBclass
	 */
	public function __construct()

	{
        $db = new db_class();
		$this->_con = $db->con;
	}
	public function store_login($email,$password)
	{
        $data=array();
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('d-m-Y h:i:s a', time());
		$stmt = $this->_con->prepare('SELECT * FROM stores WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			if (password_verify($password, $row["password"])) {
				$updatestmt = $this->_con->prepare('UPDATE  stores SET lastlogin = ? WHERE email = ?');
				$updatestmt->bind_param('ss', $lastlogin,$email); // 's' specifies the variable type => 'string'
				$updatestmt->execute();
				session_start();
				$_SESSION['storename'] = $row['storename'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['storeid'] = $row['storeid'];
				$data["message"]= "Validated Successfully";
            	$data["code"]= 1;
				$data["storename"]=  $row['storename'];
            	$data["email"]= $row['email'];
				$data["storeid"]= $row['storeid'];
				$this->store_token($row['storeid']);
				$token=$this->return_token($row['storeid']);
				$data["storetoken"] = $token;
				$_SESSION['storetoken'] = $token;
				
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
	public function store_signup($storename,$email,$password,$mobile,$location)
	{
        $data=array();
		$hashed= password_hash($password, PASSWORD_DEFAULT);
		$created = date('d-m-Y');
		$updated = date('d-m-Y');
		date_default_timezone_set('Africa/Lagos');
		$lastlogin = date('d-m-Y h:i:s a', time());
		$status =2;
		$stmt = $this->_con->prepare('SELECT * FROM stores WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$data["message"]= "Duplicate Account Found";
			$data["code"]= 0;
			}
		else {
			$insertstmt = $this->_con->prepare('INSERT INTO stores(storename, email, password, mobile, location, created, updated, lastlogin, status)
			 VALUES(?,?,?,?,?,?,?,?,?)');
			$insertstmt->bind_param('ssssssssi',$storename,$email,$hashed,$mobile,$location,$created,$updated,$lastlogin,$status); 
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
	public function store_password_reset($email,$password)
	{
        $data=array();
		$updated = date('d-m-Y');
		$stmt = $this->_con->prepare('SELECT * FROM stores WHERE email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			$hashed= password_hash($password, PASSWORD_DEFAULT);
			$updatestmt = $this->_con->prepare('UPDATE  stores SET password = ? ,updated = ? WHERE email = ?');
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
	public function store_profile($storeid,$packageid,$logo,$about)
	{
        $data=array();
		$created = date('d-m-Y');
		$updated = date('d-m-Y');
		date_default_timezone_set('Africa/Lagos');
		$stmt = $this->_con->prepare('SELECT * FROM storeprofile WHERE storeid = ?');
 		$stmt->bind_param('i', $storeid); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$data["message"]= "Duplicate Record Found";
			$data["code"]= 0;
			}
		else {
			$insertstmt = $this->_con->prepare('INSERT INTO storeprofile(storeid, packageid, logo, about, created, updated)
			 VALUES(?,?,?,?,?,?)');
			$insertstmt->bind_param('isssss',$storeid,$packageid,$logo,$about,$created,$updated); 
			// 's' specifies the variable type => 'string'
			if($insertstmt->execute()){
				$data["message"]= "Created Successfully";
				$data["code"]= 1;
			}
			else{
				$data["message"]= "An Error has Occurred";
				$data["code"]= 0;
			}
		}
      echo  json_encode($data);
	}
	public function store_package_upgrade($storeid,$packageid)
	{
        $data=array();
		$updated = date('d-m-Y');
		$stmt = $this->_con->prepare('SELECT * FROM storeprofile WHERE storeid = ?');
 		$stmt->bind_param('i', $storeid); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			$updatestmt = $this->_con->prepare('UPDATE  storeprofile SET packageid = ? ,updated = ? WHERE storeid = ?');
			$updatestmt->bind_param('isi', $packageid,$updated,$storeid); // 's' specifies the variable type => 'string'
			$updatestmt->execute();
			$data["message"]= "Package Updated Successfully";
				$data["code"]= 1;
			}
		else {
            $data["message"]= "Profile does not exist";
            $data["code"]= 0;
		}
      echo  json_encode($data);
 		
	}
	public function store_about_update($storeid,$about)
	{
        $data=array();
		$updated = date('d-m-Y');
		$stmt = $this->_con->prepare('SELECT * FROM storeprofile WHERE storeid = ?');
 		$stmt->bind_param('i', $storeid); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			$updatestmt = $this->_con->prepare('UPDATE  storeprofile SET about = ? ,updated = ? WHERE storeid = ?');
			$updatestmt->bind_param('ssi', $about,$updated,$storeid); // 's' specifies the variable type => 'string'
			$updatestmt->execute();
			$data["message"]= "Profile Updated Successfully";
				$data["code"]= 1;
			}
		else {
            $data["message"]= "Profile does not exist";
            $data["code"]= 0;
		}
      echo  json_encode($data);
 		
	}
	public function store_logo_update($storeid,$logo)
	{
        $data=array();
		$updated = date('d-m-Y');
		$stmt = $this->_con->prepare('SELECT * FROM storeprofile WHERE storeid = ?');
 		$stmt->bind_param('i', $storeid); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		if ($count > 0) {
			$updatestmt = $this->_con->prepare('UPDATE  storeprofile SET logo = ? ,updated = ? WHERE storeid = ?');
			$updatestmt->bind_param('ssi', $about,$updated,$storeid); // 's' specifies the variable type => 'string'
			$updatestmt->execute();
			$data["message"]= "Profile Updated Successfully";
				$data["code"]= 1;
			}
		else {
            $data["message"]= "Profile does not exist";
            $data["code"]= 0;
		}
      echo  json_encode($data);
 		
	}
	public function store_token($storeid)
	{
        $data=array();
		$created = date('d-m-Y');
		$updated = date('d-m-Y');
		$token= password_hash(date('Y-m-d'), PASSWORD_DEFAULT);
		date_default_timezone_set('Africa/Lagos');
		$stmt = $this->_con->prepare('SELECT * FROM storetoken WHERE storeid = ?');
 		$stmt->bind_param('i', $storeid); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			$updatestmt = $this->_con->prepare('UPDATE storetoken SET token =?,updated =? WHERE storeid = ?');
			$updatestmt->bind_param('ssi',$token,$updated, $storeid); // 's' specifies the variable type => 'string'
			if($updatestmt->execute()){
				$data["message"]= "Updated Successfully";
				$data["code"]= 1;
			}
			else{
				$data["message"]= "An Error has Occurred";
				$data["code"]= 0;
			}
			}
		else {
			$insertstmt = $this->_con->prepare('INSERT INTO storetoken(storeid, token, created, updated)
			 VALUES(?,?,?,?)');
			$insertstmt->bind_param('isss',$storeid,$token,$created,$updated); 
			$insertstmt->execute();
			// 's' specifies the variable type => 'string'
			/*if($insertstmt->execute()){
				$data["message"]= "Created Successfully";
				$data["code"]= 1;
			}
			else{
				$data["message"]= "An Error has Occurred";
				$data["code"]= 0;
			}*/
		}
      //echo  json_encode($data);
	}
	public function show_token($storeid)
	{
		$data=array();
		$stmt = $this->_con->prepare('SELECT token FROM storetoken WHERE storeid = ?');
		$stmt->bind_param('i', $storeid); // 's' specifies the variable type => 'string'
		$stmt->execute();
	   	$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
		$data["token"]= $row['token'];
        $data["code"]= 1;
		
		}
		else{
			$data["token"]= NULL;
			$data["code"]= 0;
		}
		echo  json_encode($data);
	}
	public function return_token($storeid)
	{
		$data=array();
		$stmt = $this->_con->prepare('SELECT token FROM storetoken WHERE storeid = ?');
		$stmt->bind_param('i', $storeid); // 's' specifies the variable type => 'string'
		$stmt->execute();
	   	$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$count = mysqli_num_rows($result);
		return $row['token'];
	}

}

?>