<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> ユビーネット</title>
</head>
<body>

<?php
try{
$name = $_POST["name"];
$pass = $_POST["pass"];
echo $pass.'<br>';

$name = htmlspecialchars($name);
$pass = htmlspecialchars($pass);

$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'insert into mst_staff (name, password) values (?, ?)';
$stmt = $dbh->prepare($sql);
$data[] = $name;
$data[] = $pass;
$stmt->execute($data);

$dbh = null; //데이터베이스의 연결을 끊는다.

echo $name.' is added<br>';
}catch(Exception $e){
	echo 'error';
	exit();
}
?>

</body>
</html>