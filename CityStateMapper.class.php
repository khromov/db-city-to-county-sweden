<?php
/**
 * En hjälpklass som mappar städer till län inom Sverige
 */
class CityStateMapper
{
	var $pdo;
	
	public function __construct($dsn, $username, $password, $driver_options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"))
	{
		$this->pdo = new PDO($dsn, $username, $password, $driver_options);
	}
	
	public function city_to_county($city, $default_if_no_value_found = 'Ospecificerat')
	{
		$prepared_query = $this->pdo->prepare('SELECT * FROM city, state WHERE city_name=:city AND city.city_state_id=state.state_id LIMIT 1');
		$prepared_query->bindParam(':city', $city);
		$prepared_query->execute();
		
		$ret = $prepared_query->fetchAll(PDO::FETCH_ASSOC);
		
		if(sizeof($ret)>0)
			return $ret[0]['state_name'];
		else
			return $default_if_no_value_found;
	}
}
