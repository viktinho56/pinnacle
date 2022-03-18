<?php
require __DIR__. '/db_class.php';

class transaction{
	protected $_con;

	/**
	 * it will initalize DBclass
	 */
	public function __construct()

	{
        $db = new db_class();
		$this->_con = $db->con;
	}
   
	public function create($id,$trantype,$amount)
	{
        $limit = 100;
        $data=array();
        $bal = 0;
        $created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		$tracking_number='';
        $status =0;
        $insertstmt = $this->_con->prepare(
			'INSERT INTO transaction
			(
				businessid,transactiontype,amount,status,created,updated
			)
		 VALUES(?,?,?,?,?,?)');
		$insertstmt->bind_param('ssssss',
		$id,$trantype,$amount,$status,$created,$updated); 
		// 's' specifies the variable type => 'string'
		if($insertstmt->execute()){
			
		   // $this->update_item_count($storeid);
			$data["message"]= "Added Successfully";
			$data["code"]= 1;
			$data["id"]= $insertstmt->insert_id;
			$msg = "Thank you, Your Transaction was successfull";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);
session_start();
// send email
mail($_SESSION['email'],"Notification",$msg);
$this->update_balance($id,$amount);
		}
		else{
			$data["message"]= "An Error has Occurred";
			$data["code"]= 0;
		}
      echo  json_encode($data);

    }
	public function update_balance($id,$amount)
	{
        $data=array();
		$stmt = $this->_con->prepare('SELECT * FROM wallet WHERE businessid = ?');
 		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$status = 1;
		$created = date('Y-m-d');
		$updated = date('Y-m-d');
		$tracking_number='';
		if ($count > 0) {
            $row = $result->fetch_assoc();
            $cur =  $row["current_balance"];
            $int = (int)$cur;
            $mnt = (int)$amount+$int = (int)$cur;
			$updatestmt = $this->_con->prepare('UPDATE wallet SET current_balance =? WHERE businessid = ?');
			$updatestmt->bind_param('si',$mnt,$id); // 's' specifies the variable type => 'string'
			if($updatestmt->execute()){
				// $this->update_item_count($storeid);
				 $data["message"]= "Updated Successfully";
				 $data["code"]= 1;
			 }
			 else{
				 $data["message"]= "An Error has Occurred";
				 $data["code"]= 0;
			 }
			}
		else {
         
			$data["message"]= "Wallet Not Found";
			$data["code"]= 0;
		}
		//echo  json_encode($data); 
    }

	public function view_transaction($id)
	{
        $data=array();
		$tra = "";
		$stmt = $this->_con->prepare('SELECT * FROM transaction where businessid = ? order by transactionid desc');
 		$stmt->bind_param('i',$id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"trantype" => $row["transactiontype"],
					"businessid" => $row["businessid"],
                    "amount" => $row["amount"],
                    "created" => $row["created"],
				
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
    }
   




}
