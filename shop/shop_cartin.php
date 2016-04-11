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

		if(isset($_SESSION['cart'])==true){
		$cart = $_SESSION['cart'];
		//$cart[] = $_SESSION['cart'];
		$kazu = $_SESSION['kazu'];
		if(in_array($pro_code, $cart)==true){
			print 'その商品はすでにカートに入っています。<br />';
			print '<a href="shop_list.php">商品一覧に戻る</a>';
			exit();
		}
	}
	$cart[] = $pro_code;
	$kazu[] = 1;
	$_SESSION['cart'] = $cart;
	$_SESSION['kazu'] = $kazu;
}catch(Exception $e){
	print 'error';
	exit();
}
?>

カートに追加しました。<br />
<br />
<a href="shop_list.php">商品一覧に戻る</a>

</body>
</html>