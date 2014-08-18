<meta http-equiv="content-type" content="text/html; charset=windows-1251">
<?php
if(!$daba)
	include("config.php");
function username($user){
    $query = "SELECT id FROM users WHERE username='".$user."'";
    $result = @mysql_query($query);
    $row = mysql_num_rows($result);
    if($row!=0)
	return 0;
    else
	return 1;
}
function mail_check($mail){
	if(preg_match('/^[a-z0-9\._]+@[a-z0-9-]+\.[a-z]{2,4}$/', $mail))
	     return 1;
	else
	     return 0;
}
function pass($pass1, $pass2){
	if($pass1 == $pass2)
		return 1;
	else
		return 0;
}
if($_POST['check']){
switch($_POST['check']){
case "user":
    	if(username(addslashes(htmlspecialchars($_POST['username']))))
		echo "Свободно";
	else
		echo "Заето";
	break;
case "email":
	if(mail_check(addslashes(htmlspecialchars($_POST['email']))))
		echo "Валиден";
	else
		echo "Невалиден";
	break;
case "pass":
	if(pass($_POST['pass1'], $_POST['pass2']))
		echo "Съвпадат";
	else
		echo "Не съвпадат";
	break;
	
}
}
?>