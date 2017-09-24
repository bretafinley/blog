<?php
include('Dao.php');
ini_set('max_execution_time', 10000);

$db = new Dao();
$numpages = 603;

$foo = true;

for($i = 1; $i <= $numpages; $i++)
{
	$steamfile =  file_get_contents("http://store.steampowered.com/search/?sort_by=&sort_order=0&page=".$i);
	$dom = new DomDocument();
	@$dom->loadHTML($steamfile);
	$finder = new DomXPath($dom);

	$IDClass = "search_result_row";
	$titleClass = "title";
	$priceClass = "search_price";

	$IDNodes = $finder->query("//a[contains(@class, '$IDClass')]");
	$titleNodes = $finder->query("//span[contains(@class, '$titleClass')]");
	$priceNodes = $nodes = $finder->query("//div[contains(@class, '$priceClass')]");

	$IDArray = iterator_to_array($IDNodes);
	$titleArray = iterator_to_array($titleNodes);
	$priceArray = iterator_to_array($priceNodes);

	$IDout = array();
	$titleout = array();
	$priceout = array();
	$achieveout = array();

	foreach($IDArray as $id)
	{
		$myappid = $db->parseAppID($id->getAttribute('href'));
		$achievefile = file_get_contents('http://steamcommunity.com/stats/' . $myappid . '/achievements');
		$dom1 = new DomDocument();
		@$dom1->loadHTML($achievefile);
		$finder1 = new DomXPath($dom1);
		$achieveClass = "achieveRow";
		$achieveNodes = $nodes = $finder1->query("//div[contains(@class, '$achieveClass')]");
		$achieveArray = iterator_to_array($achieveNodes);
		if(!empty($achieveArray))
			array_push($achieveout, 1);
		else
			array_push($achieveout, 0);

		array_push($IDout, $db->parseAppID($id->getAttribute('href')));
	}

	foreach($titleArray as $title)
	{
		array_push($titleout, $title->textContent);
	}

	$counter = 0;
	foreach($priceArray as $price)
	{
		if($counter++ % 2 == 1) continue;
		array_push($priceout, $db->parseAppPrice($price->textContent));
	}

	$db->saveAll($IDout, $titleout, $priceout, $achieveout);

}

echo "Done";
