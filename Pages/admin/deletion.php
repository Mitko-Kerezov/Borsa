<title> <?php echo $lang['admin']['del_user_title']; ?> </title>
<?php
if (!$_SESSION['user'] || $_SESSION['type']=="USER"){
    echo "<meta http-equiv='refresh' content='3, index.php'>".$lang['login_error'];
}
else{
$del_user=$_GET['find_acc'];

if (isset($_GET['yes'])){
	$user = mysql_fetch_array(mysql_query("SELECT id FROM users WHERE username='".$del_user."'"));
    
    mysql_query("DELETE FROM users WHERE id='".$user[0]."'");
	mysql_query("DELETE FROM profiles WHERE user_id='".$user[0]."'");
    mysql_query("DELETE FROM book_comments WHERE user_id='".$user[0]."'");
    mysql_query("DELETE FROM books WHERE seller_id='".$user[0]."'");
    mysql_query("DELETE FROM messages WHERE sender_id='".$user[0]."'");
    mysql_query("DELETE FROM messages WHERE reciever_id='".$user[0]."'");

        print "<h3>".$del_user.$lang['admin']['usr_del_success']."</h3>";
}
else if (isset($_GET['no']))
    print "<meta http-equiv='refresh' content='0;url=index.php?pages=users'>";
else if(isset($_GET['del_btn'])){
 	if(does_the_user_exist($del_user)==false){
		print '<center><h3 style="color:red;">'.$lang['admin']['no_usr'].'</h3></center>';
        	print "<meta http-equiv='refresh' content='2;url=index.php?pages=users'>";
    	}
    	else if(authorization($del_user)==false){
		print '<center><h3 style="color:red;">'.$lang['admin']['cant_del'].'</h3></center>';
        	print "<meta http-equiv='refresh' content='2;url=index.php?pages=users'>";
    	}
    	else{
		print '<h3 style="color:blue;">'.$lang['admin']['usr_del_confirm'].'</h3><h3 style="color:red;">'.$del_user.' ?</h3><br>';
        	print '<form action="" method="get">';
        	print '<input type="hidden" name="pages" value="/admin/deletion">';
        	print "<input type='hidden' name='find_acc' value='".$del_user."'>";
        	print '<input type="submit" value="'.$lang['yes'].'" name="yes">';
        	print '<input type="submit" value="'.$lang['no'].'" name="no">';
    	}

}
else{
    print '<br><h3>'.$lang['admin']['usr_to_del'].'<br><br></h3>';
    print '<form action="" method="get">';
    print '<input type="hidden" name="pages" value="/admin/deletion">';
    print '<input type="text" name="find_acc">';
    print '<input type="submit" value="'.$lang['admin']['find'].'" name="del_btn">';
    print '</form>';
}
}
//-------------------------------------------
//-------------------------------------------
function does_the_user_exist($del_user){
    $result=mysql_query("SELECT id FROM users WHERE username='".$del_user."'") or die("f1 error");
    if (mysql_num_rows($result) == 0) {
        return false;
    } else {
        return true;
    }
}
function authorization($del_user){
    $result=mysql_query("SELECT id FROM users WHERE username='".$del_user."' AND user_type='USER'") or die("f2 error");
    if (mysql_num_rows($result) == 0) {
        return false;
    } else {
        return true;
    }
}
?>