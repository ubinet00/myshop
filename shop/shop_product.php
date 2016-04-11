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

try{
	$pro_code = $_GET['procode'];

	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$dbpassword = '';
	$dbh = new PDO($dsn, $user, $dbpassword);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = 'select name, price, gazou from mst_product where code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $pro_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$pro_name = $rec['name'];
	$pro_price = $rec['price'];
	$pro_gazou_name = $rec['gazou'];

	$dbh = null;

	if($pro_gazou_name == ''){
		$disp_gazou = '';
	}else{
		$disp_gazou = '<img src="	../product/gazou/'.$pro_gazou_name.'">';
	}
	print '<a href="shop_cartin.php?procode='.$pro_code.'">put into cart</a><br><br>';
}catch(Exception $e){
	print 'error';
	exit();
}
?>
商品情報参照<br />
<br />
商品コード<br />
<?php print $pro_code; ?>
<br />
商品名<br />
<?php print $pro_name; ?>
<br />
価格<br />
<?php print $pro_price; ?>円
<br />
<?php print $disp_gazou; ?>
<br />
<br />
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>