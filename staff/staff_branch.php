<?php
if(isset($_POST['disp'])){
	if(!isset($_POST['staffcode'])){
		header('location:staff_ng.php');
		exit();
	}
	$staffcode = $_POST['staffcode'];
	header('location:staff_disp.php?staffcode='.$staffcode);
}

if(isset($_POST['add'])){
	header('location:staff_add.php');
}

if(isset($_POST['edit'])){
	if(isset($_POST['staffcode'])==false){
		header('location:staff_ng.php');
		exit();
	}
	$staffcode = $_POST['staffcode'];
	header('location:staff_edit.php?staffcode='.$staffcode);
}

if(isset($_POST['delete'])){
	if(isset($_POST['staffcode'])==false){
		header('location:staff_ng.php');
		exit();
	}
	$staffcode = $_POST['staffcode'];
	header('location:staff_delete.php?staffcode='.$staffcode);
}

if(isset($_POST['login'])){
	header('location:staff_login.php');
}
?>