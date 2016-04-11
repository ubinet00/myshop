<?php
$name = $_POST["name"];
$pass = $_POST["pass"];
$pass2 = $_POST["pass2"];

if($name == ""){
	echo "no name";
}else{
	echo "name is".$name;
}

if($pass == ""){
	echo "no pass";
}else{
	echo "pass is".$pass;
}

if($pass != $pass2){
	echo "pass != pass2";
}

if($name == "" || $pass == "" || $pass != $pass2){
	echo "<form>";
	echo '<input type="button" onClick="history.back()" value="back" />';
	echo "</form>";
}else{
	$pass = md5($pass); //암호화하는 과정
	echo '<form action="staff_add_done.php" method="post">';
	echo '<input type="hidden" value="'.$name.'" name="name">';
	echo '<input type="hidden" value="'.$pass.'" name="pass">';
	echo '<br>';
	echo '<input type="submit" value="ok">';
	echo '<input type="button" onClick="history.back()" value="back">';
	echo '</form>';
}
?>