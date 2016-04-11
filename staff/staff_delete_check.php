<?php
try {
	$code = $_POST ["code"];
	$name = $_POST ["name"];
	$checkpassword = $_POST ["password"];

	echo $code;

	if ($checkpassword == "") {
		echo 'no password';
	}

	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$dbpassword = '';
	$dbh = new PDO ( $dsn, $user, $dbpassword );
	$dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$sql = 'select * from mst_staff where code=?';
	$stmt = $dbh->prepare ( $sql );
	$data [] = $code;

	$stmt->execute ( $data );

	$res = $stmt->fetch ( PDO::FETCH_ASSOC );

	$password = $res ['password'];

	echo $password.$checkpassword."<br>";

	if ($checkpassword != $password) {
		echo 'password is wrong';
	} else {
		$sql = 'delete from mst_staff where code=?';
		$stmt = $dbh->prepare($sql);
		$newdata[] = $code;
echo 'code:::'.$data[0].'<br>';
		$stmt->execute($newdata);
echo 'b<br>';
		$dbh = null; // 데이터베이스의 연결을 끊는다.

		echo 'delete success';
	}
} catch ( Exception $e ) {
	echo 'error';
	exit ();
}
?>