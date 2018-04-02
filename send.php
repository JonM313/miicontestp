<?php
$macaddres = $_GET['macaddres']
$wiinumber = $_GET['wiinumber']
$KeyVersion = $_GET['KeyVersion']
$Version = $_GET['Version']
$Server = $_GET['Server']
$Country = $_GET['Country']
$Group = $_GET['Group']
$PopGroup = $_GET['PopGroup']
$Language = $_GET['Language']
$ConLanguage = $_GET['ConLanguage']
$Entry = $_GET['Entry']
$Chachedump = $_GET['Chachedump']

 if (!(
    isset($macaddres) &&
	isset($wiinumber) &&
	isset($KeyVersion) &&
	isset($Version) &&
	isset($Server) &&
	isset($Country) &&
	isset($Group) &&
	isset($PopGroup) &&
	isset($Language) &&
	isset($ConLanguage) &&
	isset($Entry) &&
 ))	{
	 error_log("Request for sendig data failed:. json_encode($_GET) . " Request: " . json_encode($_SERVER)");
	 die(500);
 }
 
 require config/config.php;
 
 // Setup sentry.io error logging
(new Raven_Client($sentryurl))->install();
$uuid = abs((new SnowFlake(1, 1))->generateID());
$conn = connectMySQL();

use DataDog\DogStatsd;
$statsd = new DogStatsd();

if ($stmt = $conn->prepare('INSERT INTO `contest` (
        'macaddres'
	'wiinumber'
	'KeyVersion'
	'Version'
	'Server'
	'Country'
	'Country'
	'Group'
	'PopGroup'
	'Language'
	'ConLanguage'
	'Entry
	'
) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `ansCNT` = `ansCNT` + VALUES(`ansCNT`)')) {
    $stmt->bind_param('iiiiiii', $macaddres, $wiinumber, $KeyVersion, $Version, $Server, $Country, $Group, $PopGroup, $Language, $ConLanguage, $Entry);
	
	
if ($stmt->execute())
        echo(100);
    else {
        error_log("SQL statement error on contest participate: " . $stmt->error);
        echo(500);
    }

