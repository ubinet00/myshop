<?php
session_start();
session_regenerate_id(true);

require_once('../common/common.php');

$post = sanitize($_POST);

$max = $post['max'];
for($i=0; $i<$max; $i++){
	if(preg_match("/^[0-9]+$/", $post['kazu'.$i])==0){
		print 'This is not number.';
		print '<a href="shop_cartlook.php">back</a>';
		exit();
	}
	if($post['kazu'.$i]<1 || 10<$post['kazu'.$i]){
		print 'please 1<=kazu<=10';
		print '<a href="shop_cartlook.php">back</a>';
		exit();
	}
	$kazu[] = $post['kazu'.$i];
}

$cart = $_SESSION['cart'];

for($i=$max;$i>=0;$i--){
	if(isset($_POST['sakujo'.$i])){
		array_splice($cart, $i, 1);
		array_splice($kazu, $i, 1);
	}
}

$_SESSION['cart'] = $cart;
$_SESSION['kazu'] = $kazu;

header('Location:shop_cartlook.php');
?>