<?php
require __DIR__. '/db_class.php';

class wallet{
	protected $_con;

	/**
	 * it will initalize DBclass
	 */
	public function __construct()

	{
        $db = new db_class();
		$this->_con = $db->con;
	}
	public function validate_charge($id,$amount)
	{
        $data=array();
		$stmt = $this->_con->prepare('SELECT * FROM wallet WHERE businessid = ?');
 		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$status = 1;
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		$tracking_number='';
		if ($count > 0) {
			$row = $result->fetch_assoc();
            $cur =  $row["current_balance"];
            $intb = (int)$cur;
          
            if( $amount > $intb){
				$data["message"]= "Wallet Balance Not Sufficient";
					 $data["code"]= 0;
			
			}
			else{
				$mnt = (int)$intb-(int)$amount;
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
			}
		else {
         
			$data["message"]= "Wallet Not Found";
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
			$updatestmt = $this->_con->prepare('UPDATE wallet SET current_balance =? WHERE businessid = ?');
			$updatestmt->bind_param('si',$amount,$id); // 's' specifies the variable type => 'string'
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
		echo  json_encode($data); 
    }
    public function update_limit($id,$amount)
	{
        $data=array();
		$stmt = $this->_con->prepare('SELECT * FROM wallet WHERE businessid = ?');
 		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$status = 1;
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		$tracking_number='';
		if ($count > 0) {
           // $row = $result->fetch_assoc();
			$updatestmt = $this->_con->prepare('UPDATE wallet SET spendinglimit =?, updated = ? WHERE businessid = ?');
			$updatestmt->bind_param('sss',$amount,$updated,$id); // 's' specifies the variable type => 'string'
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
		echo  json_encode($data); 
    }
	public function create($id)
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
      echo  json_encode($data);

    }
	

	public function view_wallet($id)
	{
        $data=array();
		$tra = "";
		$stmt = $this->_con->prepare('SELECT * FROM wallet where businessid = ?');
 		$stmt->bind_param('i',$id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"currentbalance" => "&#163 ".$row["current_balance"],
					"businessid" => $row["businessid"],
                    "limit" => $row["spendinglimit"],
				
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
