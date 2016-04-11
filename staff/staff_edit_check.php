<?php
try{
	$code = $_POST["code"];
	$name = $_POST["name"];
	$password = $_POST["password"];
	$password2 = $_POST["password2"];

	echo $name.'<br>'.$password.'<br>';

	if($name==""){
		echo 'no name';
	}else if($password==""){
		echo 'no password';
	}else if($password != $password2){
		echo 'password and password2 are different';
	}else{
	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$dbpassword = '';
	$dbh = new PDO($dsn, $user, $dbpassword);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = 'update mst_staff set name=?, password=? where code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $name;
	$data[] = $password;
	$data[] = $code;

	$stmt->execute($data);

	$dbh = null; //데이터베이스의 연결을 끊는다.

	echo 'update success';
	}
}catch(Exception $e){
	echo 'error';
	exit();
}
?>