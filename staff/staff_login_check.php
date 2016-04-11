<?php
$name = $_POST ['id'];
$pass = $_POST ['password'];
session_start();

if ($name == "") {
	echo 'no id';
} else if ($pass == "") {
	echo 'no password';
} else {
	try{
	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$password = '';
	$dbh = new PDO ( $dsn, $user, $password );
	$dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$sql = 'select * from mst_staff where name=? and password=?';
	$stmt = $dbh->prepare ( $sql );
	$data [] = $name;
	$data [] = $pass;

	$stmt->execute ( $data );

	$res = $stmt->fetch ( PDO::FETCH_ASSOC );

	if($res==false){
		echo 'login fail';
	}else{
		echo $name.'sama login success';
		$_SESSION['user_id'] = $name;
	}

	$dbh = null; // 데이터베이스의 연결을 끊는다.
	}catch(Exception $e){
		echo 'error';
		exit();
	}
}
?>
<form action="staff_top.php">
<input type="submit" value="home">
</form>