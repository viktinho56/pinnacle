<?php
require __DIR__. '/db_class.php';
class order{
	protected $_con;

	/**
	 * it will initalize DBclass
	 */
	public function __construct()

	{
        $db = new db_class();
		$this->_con = $db->con;
	}
    public function add_order($s_destination,$s_forename,$s_addresslineone,$s_addresslinetwo,$s_city,$s_state,$s_country,$s_postcode,$r_forename,$r_contact,$r_addresslineone,$r_addresslinetwo,$r_city,$r_state,$r_country,$r_postcode,$p_destination,$p_forename,$p_addresslineone,$p_addresslinetwo,$p_city,$p_state,$p_country,$p_postcode,$deliverymethod,$seafreight,$airfreight,$weight,$items,$item_desc,$amount,$s_email,$r_email,$s_contact)
	{
        $data=array();
        $created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
        $stmt = $this->_con->prepare('SELECT * FROM orders WHERE created = ? and sender_forename = ? and delivery_method = ? and weight = ? and items = ?');
 		$stmt->bind_param('sssss', $created,$s_forename,$deliverymethod,$weight,$items); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		$tracking_number='';
        $status =0;
		if ($count > 0) {
            $data["message"]= "Duplicate Order Found";
			$data["code"]= 0;
        }
        else {
			$insertstmt = $this->_con->prepare(
				'INSERT INTO orders
				(
					sender_destination,sender_forename, sender_adresslineone,sender_adresslinetwo, 
					sender_city, sender_state,sender_country,sender_postcode,
					receiver_forename,receiver_contact,receiver_adresslineone,
					receiver_adresslinetwo,receiver_city,receiver_state,receiver_country,receiver_postcode,
					pickup_destination,pickup_forename,pickup_adresslineone,pickup_adresslinetwo,pickup_city,
					pickup_state,pickup_country,pickup_postcode,delivery_method,sea_freight,air_freight,weight,items,items_description,
					amount,created,updated,payment_status,order_status,tracking_number,sender_email,receiver_email,sender_contact
					
				)
			 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
			$insertstmt->bind_param('sssssssssssssssssssssssssssssssssssssss',
			$s_destination,$s_forename,$s_addresslineone,$s_addresslinetwo,$s_city,$s_state,
			$s_country,$s_postcode,$r_forename,$r_contact,$r_addresslineone,$r_addresslinetwo,
			$r_city,$r_state,$r_country,$r_postcode,$p_destination,$p_forename,$p_addresslineone,
			$p_addresslinetwo,$p_city,$p_state,$p_country,$p_postcode,$deliverymethod,$seafreight,$airfreight,
			$weight,$items,$item_desc,$amount,$created,$updated,$status,$status,$tracking_number,$s_email,$r_email,$s_contact); 
			// 's' specifies the variable type => 'string'
			if($insertstmt->execute()){
				
               // $this->update_item_count($storeid);
				$data["message"]= "Added Successfully";
				$data["code"]= 1;
				$data["order_id"]= $insertstmt->insert_id;
			}
			else{
				$data["message"]= "An Error has Occurred";
				$data["code"]= 0;
			}
		}
      echo  json_encode($data);

    }
	public function re_order($s_destination,$s_forename,$s_addresslineone,$s_addresslinetwo,$s_city,$s_state,$s_country,$s_postcode,$r_forename,$r_contact,$r_addresslineone,$r_addresslinetwo,$r_city,$r_state,$r_country,$r_postcode,$p_destination,$p_forename,$p_addresslineone,$p_addresslinetwo,$p_city,$p_state,$p_country,$p_postcode,$deliverymethod,$seafreight,$airfreight,$weight,$items,$item_desc,$amount,$s_email,$r_email,$s_contact)
	{
        $data=array();
        $created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		$tracking_number='';
        $status =0;
        $insertstmt = $this->_con->prepare(
			'INSERT INTO orders
			(
				sender_destination,sender_forename, sender_adresslineone,sender_adresslinetwo, 
				sender_city, sender_state,sender_country,sender_postcode,
				receiver_forename,receiver_contact,receiver_adresslineone,
				receiver_adresslinetwo,receiver_city,receiver_state,receiver_country,receiver_postcode,
				pickup_destination,pickup_forename,pickup_adresslineone,pickup_adresslinetwo,pickup_city,
				pickup_state,pickup_country,pickup_postcode,delivery_method,sea_freight,air_freight,weight,items,items_description,
				amount,created,updated,payment_status,order_status,tracking_number,sender_email,receiver_email,sender_contact
				
			)
		 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
		$insertstmt->bind_param('sssssssssssssssssssssssssssssssssssssss',
		$s_destination,$s_forename,$s_addresslineone,$s_addresslinetwo,$s_city,$s_state,
		$s_country,$s_postcode,$r_forename,$r_contact,$r_addresslineone,$r_addresslinetwo,
		$r_city,$r_state,$r_country,$r_postcode,$p_destination,$p_forename,$p_addresslineone,
		$p_addresslinetwo,$p_city,$p_state,$p_country,$p_postcode,$deliverymethod,$seafreight,$airfreight,
		$weight,$items,$item_desc,$amount,$created,$updated,$status,$status,$tracking_number,$s_email,$r_email,$s_contact); 
		// 's' specifies the variable type => 'string'
		if($insertstmt->execute()){
			
		   // $this->update_item_count($storeid);
			$data["message"]= "Added Successfully";
			$data["code"]= 1;
			$data["order_id"]= $insertstmt->insert_id;
		}
		else{
			$data["message"]= "An Error has Occurred";
			$data["code"]= 0;
		}
      echo  json_encode($data);

    }
	public function edit_order($id,$s_destination,$s_forename,$s_addresslineone,$s_addresslinetwo,$s_city,$s_state,$s_country,$s_postcode,$r_forename,$r_contact,$r_addresslineone,$r_addresslinetwo,$r_city,$r_state,$r_country,$r_postcode,$p_destination,$p_forename,$p_addresslineone,$p_addresslinetwo,$p_city,$p_state,$p_country,$p_postcode,$deliverymethod,$seafreight,$airfreight,$weight,$items,$item_desc,$amount,$s_email,$r_email,$s_contact)
	{
        $data=array();
        $created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
        $stmt = $this->_con->prepare('SELECT * FROM orders WHERE order_id = ?');
 		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$tracking_number='';
        $status =0;
		if ($count > 0) {
			$insertstmt = $this->_con->prepare(
				'UPDATE orders 
					SET sender_destination = ?,  sender_forename = ?,  sender_adresslineone = ?,
					 sender_adresslinetwo = ?,  sender_city = ?,
					 sender_state = ?,  sender_country = ?, sender_postcode = ?,
					 receiver_forename = ?, receiver_contact = ?,  receiver_adresslineone =?,
					 receiver_adresslinetwo = ?, receiver_city = ?, receiver_state = ?, receiver_country = ?, receiver_postcode = ?,
					 pickup_destination = ?,  pickup_forename = ?,  pickup_adresslineone = ?, pickup_adresslinetwo= ?, pickup_city = ?,
					 pickup_state = ?,  pickup_country = ?, pickup_postcode = ?, delivery_method = ?, sea_freight = ?, air_freight = ?, weight = ?, items = ?, items_description = ?,
					 amount = ?, updated = ?, payment_status = ?, order_status = ?, tracking_number =?, sender_email = ?, receiver_email = ?, sender_contact = ?');
					
				
			$insertstmt->bind_param('ssssssssssssssssssssssssssssssssssssss',
			$s_destination,$s_forename,$s_addresslineone,$s_addresslinetwo,$s_city,$s_state,
			$s_country,$s_postcode,$r_forename,$r_contact,$r_addresslineone,$r_addresslinetwo,
			$r_city,$r_state,$r_country,$r_postcode,$p_destination,$p_forename,$p_addresslineone,
			$p_addresslinetwo,$p_city,$p_state,$p_country,$p_postcode,$deliverymethod,$seafreight,$airfreight,
			$weight,$items,$item_desc,$amount,$updated,$status,$status,$tracking_number,$s_email,$r_email,$s_contact); 
			// 's' specifies the variable type => 'string'
			if($insertstmt->execute()){
				
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
			$data["message"]= "Order not Found";
			$data["code"]= 0;
		}
      echo  json_encode($data);

    }
    public function update_order_payment($id)
	{
        $data=array();
		for ($randomNumber = mt_rand(1, 9), $i = 1; $i < 12; $i++) {
			$randomNumber .= mt_rand(0, 9);
		}
	   $fulltrackingnumber = "PNM".$randomNumber."Sd";
		$stmt = $this->_con->prepare('SELECT * FROM orders WHERE order_id = ?');
 		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$status = 1;
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		$tracking_number = $fulltrackingnumber; 
		if ($count > 0) {
            $row = $result->fetch_assoc();
			$updatestmt = $this->_con->prepare('UPDATE orders SET payment_status =?, tracking_number =? ,updated =? WHERE order_id = ?');
			$updatestmt->bind_param('issi',$status,$tracking_number,$updated,$id); // 's' specifies the variable type => 'string'
			if($updatestmt->execute()){
				// $this->update_item_count($storeid);
				 $data["message"]= "Updated Successfully";
				 $data["code"]= 1;
				 $data["trackingnumber"]=$fulltrackingnumber;
			 }
			 else{
				 $data["message"]= "An Error has Occurred";
				 $data["code"]= 0;
			 }
			}
		else {
         
			$data["message"]= "Order Not Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
    }

	public function update_order_assignment($id)
	{
        $data=array();
		
		$stmt = $this->_con->prepare('SELECT * FROM orders WHERE order_id = ?');
 		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$status = 1;
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		
		if ($count > 0) {
            $row = $result->fetch_assoc();
			$updatestmt = $this->_con->prepare('UPDATE orders SET order_status =?,updated =? WHERE order_id = ?');
			$updatestmt->bind_param('isi',$status,$updated,$id); // 's' specifies the variable type => 'string'
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
         
			$data["message"]= "Order Not Found";
			$data["code"]= 0;
		}
      //  echo  json_encode($data); 
    }
	public function update_order_status($id,$status)
	{
        $data=array();
		
		$stmt = $this->_con->prepare('SELECT * FROM orders WHERE order_id = ?');
 		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		
		$created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
		
		if ($count > 0) {
            $row = $result->fetch_assoc();
			$updatestmt = $this->_con->prepare('UPDATE orders SET order_status =?,updated =? WHERE order_id = ?');
			$updatestmt->bind_param('isi',$status,$updated,$id); // 's' specifies the variable type => 'string'
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
         
			$data["message"]= "Order Not Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
    }
    public function all_orders()
	{
        $data=array();
		$stmt = $this->_con->prepare('SELECT * FROM orders order by order_id desc');
 	//	$stmt->bind_param('i', $storeid); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"itemid" => $row["itemid"],
					"storeid" => $row["storeid"], 
					"itemname" => $row["itemname"],
					"categoryname" => $row["categoryname"], 
					"price" => $row["price"], 
					"description" => $row["description"],
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

	public function delete_orderbyid($id)
	{
        $data=array();
		$stmt = $this->_con->prepare('DELETE  FROM orders where order_id = ?');
 		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
		if($stmt->execute()){
			// $this->update_item_count($storeid);
			 $data["message"]= "Deleted Successfully";
			 $data["code"]= 1;
		 }
		 else{
			 $data["message"]= "An Error has Occurred";
			 $data["code"]= 0;
		 }
		
        echo  json_encode($data); 
    }
   
	public function view_ordersbyid($id)
	{
        $data=array();
		$stmt = $this->_con->prepare('SELECT * FROM orders where order_id = ?');
 		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"order_id" => $row["order_id"],
					"sender_forename" => $row["sender_forename"],
					"sender_addresslineone" => $row["sender_adresslineone"], 
					"sender_email" => $row["sender_email"], 
					"receiver_email" => $row["receiver_email"], 
					"receiver_country" => $row["receiver_country"], 
					"receiver_state" => $row["receiver_state"], 
					"receiver_city" => $row["receiver_city"], 
					"receiver_forename" => $row["receiver_forename"],
					"receiver_addresslineone" => $row["receiver_adresslineone"], 
					"receiver_contact" => $row["receiver_contact"], 
					"pickup_forename" => $row["pickup_forename"],
					"pickup_addresslineone" => $row["pickup_adresslineone"], 
					"pickup_contact" => $row["sender_contact"], 
					"pickup_country" => $row["pickup_country"], 
					"pickup_state" => $row["pickup_state"], 
					"pickup_city" => $row["pickup_city"], 
					"pickup_destination" => $row["pickup_destination"], 

					"pickup_state" => $row["pickup_state"], 
					"pickup_city" => $row["pickup_city"], 
					"pickup_destination" => $row["pickup_destination"], 

					"created" => $row["created"],
					"items" => $row["items"], 
					"description" => $row["items_description"], 
					"delivery_method" => $row["delivery_method"],
					"weight" => $row["weight"], 
					"amount" => $row["amount"], 
					"seafreight" => $row["sea_freight"], 
					"airfreight" => $row["air_freight"], 
					"trackingnumber" => $row["tracking_number"], 
				
					
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
    }
	public function view_ordersbytracking($track)
	{
        $data=array();
		$stmt = $this->_con->prepare('SELECT * FROM orders where tracking_number = ?');
 		$stmt->bind_param('s', $track); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$stat="";
		if ($count > 0) {
			
            while ($row = $result->fetch_assoc()) {
				switch ($row["order_status"]) {
					case '0':
						$stat = "Awaiting Assignment";
						break;
					case '1':
							$stat = "Awaiting Pickup";
						break;
					case '2':
							$stat = "In Transit";
							break;
					case '3':
							$stat = "Delivered";
							break;
					default:
						# code...
						break;
				}
                $data[] = array(
					"order_status" => $stat, 
					"order_id" => $row["order_id"],
					"sender_forename" => $row["sender_forename"],
					"sender_addresslineone" => $row["sender_adresslineone"], 
					"sender_email" => $row["sender_email"], 
					"receiver_email" => $row["receiver_email"], 
					"receiver_country" => $row["receiver_country"], 
					"receiver_state" => $row["receiver_state"], 
					"receiver_city" => $row["receiver_city"], 
					"receiver_forename" => $row["receiver_forename"],
					"receiver_addresslineone" => $row["receiver_adresslineone"], 
					"receiver_contact" => $row["receiver_contact"], 
					"pickup_forename" => $row["pickup_forename"],
					"pickup_addresslineone" => $row["pickup_adresslineone"], 
					"pickup_contact" => $row["sender_contact"], 
					"pickup_country" => $row["pickup_country"], 
					"pickup_state" => $row["pickup_state"], 
					"pickup_city" => $row["pickup_city"], 
					"pickup_destination" => $row["pickup_destination"], 

					"pickup_state" => $row["pickup_state"], 
					"pickup_city" => $row["pickup_city"], 
					"pickup_destination" => $row["pickup_destination"], 

					"created" => $row["created"],
					"items" => $row["items"], 
					"description" => $row["items_description"], 
					"delivery_method" => $row["delivery_method"],
					"weight" => $row["weight"], 
					"amount" => $row["amount"], 
					"seafreight" => $row["sea_freight"], 
					"airfreight" => $row["air_freight"], 
					"trackingnumber" => $row["tracking_number"], 
				
					
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
    }
	public function view_assignedordersbyid($id)
	{
        $data=array();
		$stmt = $this->_con->prepare('SELECT * FROM assigned_orders a, orders o where o.order_id = a.orderid and a.driverid =?');
 		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$stat="";
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
				switch ($row["order_status"]) {
					case '0':
						$stat = "Awaiting Assignment";
						break;
					case '1':
							$stat = "Awaiting Pickup";
						break;
					case '2':
							$stat = "In Transit";
							break;
					case '3':
							$stat = "Delivered";
							break;
					default:
						# code...
						break;
				}
                $data[] = array(
					"order_id" => $row["order_id"],
					"sender_forename" => $row["sender_forename"],
					"created" => $row["created"],
					"order_status" => $stat, 
					"amount" => $row["amount"],
					"trackingnumber" => $row["tracking_number"], 
					"delivery_method" => $row["delivery_method"],   
				
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
    }


	public function view_ordersbyuseremail($email)
	{
        $data=array();
		$tra = "";
		$stmt = $this->_con->prepare('SELECT * FROM orders where sender_email = ? and tracking_number !=?');
 		$stmt->bind_param('ss', $email,$tra); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$stat="";
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
				switch ($row["order_status"]) {
					case '0':
						$stat = "Awaiting Assignment";
						break;
					case '1':
							$stat = "Awaiting Pickup";
						break;
					case '2':
							$stat = "In Transit";
							break;
					case '3':
							$stat = "Delivered";
							break;
					default:
						# code...
						break;
				}
                $data[] = array(
					"order_id" => $row["order_id"],
					"sender_forename" => $row["sender_forename"],
					"sender_addresslineone" => $row["sender_adresslineone"], 
					"sender_email" => $row["sender_email"], 
					"receiver_email" => $row["receiver_email"], 
					"receiver_country" => $row["receiver_country"], 
					"receiver_state" => $row["receiver_state"], 
					"receiver_city" => $row["receiver_city"], 
					"receiver_forename" => $row["receiver_forename"],
					"receiver_addresslineone" => $row["receiver_adresslineone"], 
					"receiver_contact" => $row["receiver_contact"], 
					"pickup_forename" => $row["pickup_forename"],
					"pickup_addresslineone" => $row["pickup_adresslineone"], 
					"pickup_contact" => $row["sender_contact"], 
					"pickup_country" => $row["pickup_country"], 
					"pickup_state" => $row["pickup_state"], 
					"pickup_city" => $row["pickup_city"], 
					"pickup_destination" => $row["pickup_destination"], 

					"pickup_state" => $row["pickup_state"], 
					"pickup_city" => $row["pickup_city"], 
					"pickup_destination" => $row["pickup_destination"], 

					"created" => $row["created"],
					"items" => $row["items"], 
					"description" => $row["items_description"], 
					"delivery_method" => $row["delivery_method"],
					"weight" => $row["weight"]."Kg", 
					"amount" => $row["amount"], 
					"seafreight" => $row["sea_freight"], 
					"airfreight" => $row["air_freight"], 
					"tracking_number" => $row["tracking_number"], 
					"order_status" => $stat, 
					"url"=> 're-order?order_id='.$row["order_id"]
				
					
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
    }
	public function view_allordersbyuseremail($email)
	{
        $data=array();
		$tra = "";
		$stmt = $this->_con->prepare('SELECT * FROM orders where sender_email = ?');
 		$stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
					"order_id" => $row["order_id"],
					"sender_forename" => $row["sender_forename"],
					"sender_addresslineone" => $row["sender_adresslineone"], 
					"sender_email" => $row["sender_email"], 
					"receiver_email" => $row["receiver_email"], 
					"receiver_country" => $row["receiver_country"], 
					"receiver_state" => $row["receiver_state"], 
					"receiver_city" => $row["receiver_city"], 
					"receiver_forename" => $row["receiver_forename"],
					"receiver_addresslineone" => $row["receiver_adresslineone"], 
					"receiver_contact" => $row["receiver_contact"], 
					"pickup_forename" => $row["pickup_forename"],
					"pickup_addresslineone" => $row["pickup_adresslineone"], 
					"pickup_contact" => $row["sender_contact"], 
					"pickup_country" => $row["pickup_country"], 
					"pickup_state" => $row["pickup_state"], 
					"pickup_city" => $row["pickup_city"], 
					"pickup_destination" => $row["pickup_destination"], 

					"pickup_state" => $row["pickup_state"], 
					"pickup_city" => $row["pickup_city"], 
					"pickup_destination" => $row["pickup_destination"], 

					"created" => $row["created"],
					"items" => $row["items"], 
					"description" => $row["items_description"], 
					"delivery_method" => $row["delivery_method"],
					"weight" => $row["weight"], 
					"amount" => $row["amount"], 
					"seafreight" => $row["sea_freight"], 
					"airfreight" => $row["air_freight"], 
					"tracking_number" => $row["tracking_number"], 
					"order_status" => $row["order_status"], 
					"url"=> 're-order?order_id='.$row["order_id"]
				
					
					
					
				);
            }
			}
		else {
            $data["message"]= "No Item Found";
			$data["code"]= 0;
		}
        echo  json_encode($data); 
    }
	public function assign_order($driverid,$orderid,$email)
	{
        $data=array();
        $created = date('Y-m-d H:i:s');
		$updated = date('Y-m-d H:i:s');
        $stmt = $this->_con->prepare('SELECT * FROM assigned_orders WHERE driverid = ? and orderid = ?');
 		$stmt->bind_param('ii',$driverid,$orderid); // 's' specifies the variable type => 'string'
 		$stmt->execute();
		$result = $stmt->get_result();
		$count = mysqli_num_rows($result);
		$row = $result->fetch_assoc();
		$tracking_number='';
        $status =0;
		if ($count > 0) {
            $data["message"]= "Duplicate Order Found";
			$data["code"]= 0;
        }
        else {
			$insertstmt = $this->_con->prepare(
				'INSERT INTO assigned_orders
				(
					driverid,orderid,created
					
				)
			 VALUES(?,?,?)');
			$insertstmt->bind_param('iis',
			$driverid,$orderid,$created); 
			// 's' specifies the variable type => 'string'
			if($insertstmt->execute()){
				$this->update_order_assignment($orderid);
               // $this->update_item_count($storeid);
				$data["message"]= "Added Successfully";
				$data["code"]= 1;
				$msg = "Thank you for signin up on Pinnacle";
				// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($email,"Welcome",$msg);
				//$data["order_id"]= $insertstmt->insert_id;
			}
			else{
				$data["message"]= "An Error has Occurred";
				$data["code"]= 0;
			}
		}
      echo  json_encode($data);

    }




}
