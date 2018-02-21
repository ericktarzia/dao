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
	public function __construct()
	{
		$this->conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");
	}

/**
 * Definir colunas
 * @param type $statement 
 * @param type|array $params 
 * @return type
 */
	private function setParams($statement, $params = array())
	{

		foreach ($params as $key => $value) {
			
			$this->setParam($key, $value);
		}

	}

	/**
	 * Definir chave e valor
	 * @param type $statement 
	 * @param type $key 
	 * @param type $value 
	 * @return type
	 */

	private function setParam($statement,$key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
	}

	/**
	 * Description
	 * @param type $rawQuery 
	 * @param type|array $params 
	 * @return type
	 */

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->query($rawQuery,$params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}

?>
