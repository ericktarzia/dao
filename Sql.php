<?php 

/**
* 
*/
class Sql extends PDO
{

	private $conn;


	/**
	 * Class Constructor
	 * @param    $conn   
	 */
	public function __construct($conn)
	{
		$this->conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "091105Sophi@");
	}

	private function setParams($statement, $params = array()){

		foreach ($params as $key => $value) {
			
			$this->setdParam($key, $value);
		}

	}

	private function ($statement,$key, $value){

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
	}

	public function select($rawQuery, $params = array()):array{
		
		$stmt = $this->query($rawQuery,$params);
		return $stmt->fetchAll(PDO:FETCH_ASSOC);

	}

}

?>