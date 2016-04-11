<?php
session_start ();
session_regenerate_id ( true );
if (isset ( $_SESSION ['member_login'] ) == false) {
	echo 'welcome guest';
	echo '<a href="member_login.php">login</a><br>';
	echo '<br>';
} else {
	echo 'welcome ';
	echo $_SESSION ['member_name'];
	echo '<a href="member_logout.php">logout</a><br>';
}

try {
	if (isset ( $_SESSION ['cart'] ) == true) {
		$cart = $_SESSION ['cart'];
		$kazu = $_SESSION ['kazu'];
		$max = count ( $cart );
	} else {
		$max = 0;
	}

	if ($max == 0) {
		print 'カートに商品が入っていません。<br />';
		print '<br />';
		print '<a href="shop_list.php">商品一覧へ戻る</a>';
		exit ();
	}

	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$dbpassword = '';
	$dbh = new PDO ( $dsn, $user, $dbpassword );
	$dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	foreach ( $cart as $val ) {
		$sql = 'select code, name, price, gazou from mst_product where code=?';
		$stmt = $dbh->prepare ( $sql );
		$data [0] = $val;
		$stmt->execute ( $data );

		$rec = $stmt->fetch ( PDO::FETCH_ASSOC );

		$pro_name [] = $rec ['name'];
		$pro_price [] = $rec ['price'];
		if ($rec ['gazou'] == '') {
			$pro_gazou [] = '';
		} else {
			$pro_gazou [] = '<img src="../product/gazou/' . $rec ['gazou'] . '">';
		}
	}
	$dbh = null;
} catch ( Exception $e ) {
	print 'error';
	exit ();
}
?>

カートの中身
<br />
<br />
<form method="post" action="kazu_change.php">
	<table border="1">
		<tr>
			<td>商品</td>
			<td>商品画像</td>
			<td>価格</td>
			<td>数量</td>
			<td>小計</td>
			<td>削除</td>
		</tr>
<?php
for($i = 0; $i < $max; $i ++) {
	?>
<tr>
			<td><?php print $pro_name[$i];?></td>
			<td><?php print $pro_gazou[$i];?></td>
			<td><?php print $pro_price[$i];?>yen</td>
			<td><input type="text" name="kazu<?php print $i;?>"
				value="<?php print $kazu[$i];?>"></td>
			<td><?php print $pro_price[$i]*$kazu[$i];?>yen</td>
			<td><input type="checkbox" name="sakujo<?php print $i;?>"></td>
		</tr>
<?php
}
?>
</table>
	<input type="hidden" name="max" value="<?php print $max;?>"> <input
		type="submit" value="数量変更"><br> <input type="button"
		onClick="history.back()" value="back">
</form>
<br>
<a href="shop_form.html">ご購入手続きへ進む</a>

<?php
if(isset($_SESSION["member_login"])){
	print '<a href="shop_kantan_check.php">member order</a>';
}
?>
<a href="clear_cart.php">clear cart</a>
<br>