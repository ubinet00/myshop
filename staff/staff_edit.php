<?php
try{
	$code = $_GET["staffcode"];

	echo $code."<br>";

	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$password = '';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = 'select * from mst_staff where code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $code;
	$stmt->execute($data);

	$res = $stmt->fetch(PDO::FETCH_ASSOC);

	$dbh = null; //데이터베이스의 연결을 끊는다.

	echo '<form method="post" action="staff_edit_check.php">';
	echo '<input type="hidden" name="code" value="'.$res['code'].'">';
	echo '<input type="text" name="name" value="'.$res['name'].'">';
	echo '<input type="password" name="password" value="'.$res['password'].'">';
	echo '<input type="password" name="password2">';
	echo '<input type="submit">';
}catch(Exception $e){
	echo 'error';
	exit();
}
?>