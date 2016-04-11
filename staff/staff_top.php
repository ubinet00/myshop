<?php
session_start();
if(isset($_SESSION['user_id'])){
	echo $_SESSION['user_id'].' login';
	echo '<form action="staff_logout.php"><input type="submit" value="logout"></form>';
}else{
	echo '<a href="staff_login.php">login</a><br>';
}
/*session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false)
{
	print 'ログインされていません。<br />';
	print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['staff_name'];
	print 'さんログイン中<br />';
	print '<br />';
}*/
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユビーネット</title>
</head>
<body>

ショップ管理トップメニュー<br />
<br />
<a href="staff_list.php">スタッフ管理</a><br />
<br />
<a href="../product/pro_list.php">商品管理</a><br />
<br />
<a href="staff_logout.php">ログアウト</a><br />

</body>
</html>