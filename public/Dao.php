<?php

class Dao
{
	private $host = "localhost";
	private $db = "steam";
	private $user = "forge";
	private $pass = "Zo9orKED563kemAYHTbA";

	public function __construct()
	{
		// no-op
	}

	private function getConnection()
	{
		return new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
	}

	public function parseAppID($href)
	{
		preg_match("/[0-9]+/", $href, $matches);
		return $matches[0];
	}

	public function parseAppPrice($html)
	{
		$didMatch = preg_match("\$[0-9]+.[0-9][0-9]$", $html, $matches);
		if($didMatch)
		{
			return $matches[0];
		}

		return 0;
	}

	public function save($appid, $appname, $price, $achievements)
	{
		$conn = $this->getConnection();
		$appid = $conn->quote($appid);
		$appname = $conn->quote($appname);
		$price = $conn->quote($price);
		$sql = "INSERT INTO steamapps
		                  (appid, appname, price, achievements)
		                  VALUES
		                  ($appid, $appname, $price, $achievements);";

		$q = $conn->prepare($sql);
		$q->execute();
	}

	public function saveAll($appidArray, $appnameArray, $priceArray, $achieveArray)
	{
		if(count($appidArray) != count($appnameArray) || count($appidArray) != count($priceArray) || count($appidArray) != count($achieveArray))
		{
			return False;
		}

		$length = count($appidArray);

		for($i = 0; $i < $length; $i++)
		{
			$this->save($appidArray[$i], $appnameArray[$i], $priceArray[$i], $achieveArray[$i]);
		}

		return True;
	}
}
