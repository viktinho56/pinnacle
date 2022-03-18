<?php
class db_class
{
	/**
	 * @var $con will hold database connection
	 */
	public $con;

	/**
	 * This will create Database connection
	 */
	public function __construct()
	{
		require __DIR__. '/../config/settings.php';
	//	require("../config/settings.php");
		$this->con = mysqli_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
		if( mysqli_connect_error()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
       
	}
}
//$db = new db_class();


