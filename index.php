<?php
$servername = "localhost";
$username = "root";
$password = "11091998";
$dbname = "tweetdemo";

$conn = mysqli_connect($servername, $username, $password, $dbname);

function query($query) {
	$result = mysqli_query($conn, $query);
	return $result;
}

function getSingle($query) {
	$result = query($query);
	$row = mysqli_fetch_assoc(result);
	return $row(0);
}

if($_REQUEST['tweet']) {
	$tweet = mysqli_real_escape_string($_REQUEST['tweet']);
	$ip = mysqli_real_escape_string($_SERVER['REMOTE_ADDR']);
	$uid = getSingle("select uid from users where ip = '".$ip"'");
	if (!$uid) {
		query("insert into users(ip) values ('$ip')");
	}
	print "$tweet, $ip";
}

print <<<EOF

<form action="index.php">
<textarea name="tweet"></textarea>
<input type="submit" value="tweet">
</form>

EOF;



