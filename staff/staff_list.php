<?php
session_start();
if(isset($_SESSION['user_id'])){
	echo $_SESSION['user_id'].' login';
	echo '<form action="staff_logout.php"><input type="submit" value="logout"></form>';
}else{
	echo '<a href="staff_login.php">login</a><br>';
}
try {
	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$password = '';
	$dbh = new PDO ( $dsn, $user, $password );
	$dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$sql = 'select * from mst_staff';
	$stmt = $dbh->prepare ( $sql );
	$stmt->execute ();

	$dbh = null; // 데이터베이스의 연결을 끊는다.

	echo '<form method="post" action="staff_branch.php">';
	while ( true ) {
		$rec = $stmt->fetch ( PDO::FETCH_ASSOC );
		if ($rec == false) {
			break;
		}
		echo '<input type="radio" name="staffcode" value="' . $rec ['code'] . '">';
		echo $rec ['name'];
		echo '<br>';
	}
	print '<input type="submit" name="disp" value="disp">';
	print '<input type="submit" name="add" value="add">';
	print '<input type="submit" name="edit" value="edit">';
	print '<input type="submit" name="delete" value="delete">';
	print '<input type="submit" name="login" value="login">';
	echo '</form>';
} catch ( Exception $e ) {
	echo 'error';
	exit ();
}