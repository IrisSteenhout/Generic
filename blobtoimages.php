<?
//still needs some work :-)

$db = mysql_connect("localhost","user","password");
$database = "db";
$db_found = mysql_select_db($database);
$sql = "SELECT NewsItem.Date AS DATE, Images.NewsItemId AS NID, Images.ImageType AS ITYPE, Images.Image AS IMAGE FROM Images INNER JOIN NewsItem ON Images.NewsItemId=NewsItem.Id";
$result = mysql_query($sql);

// Throw error if something goes wrong
if (!$result) {
    die("Error: ".mysql_error()); 
}

// the path to save the exported images
$location = "images/"; 

while($row = mysql_fetch_assoc($result)) {
	//use 'AS' in mysql statement. Trust me, can save you an hour of wondering why you keep getting an error on indexing :s
	$filename = $location . $row['DATE'] . "-" . $row['NID'] . "." . $row['ITYPE'];
	echo $filename . "\n";
	file_put_contents ($filename,  $row['IMAGE']);
}
mysql_close($db);

?>
