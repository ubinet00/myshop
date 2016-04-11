<?php
try{
	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$password = '';
	$dbh = new PDO ( $dsn, $user, $password );
	$dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$code = $_GET['staffcode'];

	$sql = 'select * from mst_staff where code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $code;
	$stmt->execute($data);

	$res = $stmt->fetch ( PDO::FETCH_ASSOC );

	echo 'code:::'.$res['code'].'<br>';
	echo 'name:::'.$res['name'].'<br>';
	echo 'password:::'.$res['password'].'<br>';
}catch(Exception $e){
	echo 'error';
	exit();
}
?>