<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false){
	echo 'welcome guest';
	echo '<a href="member_login.php">login</a><br>';
	echo '<br>';
}else{
	echo 'welcome ';
	echo $_SESSION['member_name'];
	echo '<a href="member_logout.php">logout</a><br>';
}
?>

<body>
<?php
try{
	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$dbpassword = '';
	$dbh = new PDO($dsn, $user, $dbpassword);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = 'select code, name, price from mst_product';
	$stmt = $dbh->prepare($sql);
	$stmt->execute();

	$dbh = null;

	print 'product<br><br>';

	while(true){
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		if($rec == false){
			break;
		}
		print '<a href="shop_product.php?procode='.$rec['code'].'">';
		print $rec['name'].'---';
		print $rec['price'].'yen</a><br><br>';
	}

	print '<a href="shop_cartlook.php">go cart';
}catch(Exception $e){
	print 'error';
	exit();
}
?>
</body>