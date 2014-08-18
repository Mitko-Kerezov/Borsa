<title> <?php echo $lang['admin']['admin_title']; ?></title>
<?php
if (!$_SESSION['user'] || $_SESSION['type']=="USER"){
    echo "<meta http-equiv='refresh' content='3, index.php'>".$lang['login_error'];
}
else {
    $result=mysql_query("SELECT * FROM users WHERE user_type='USER'");
    echo '
<form action="" method="post">
<table border="1px" width="20%">
<tr><td align="center"><select name="promote">';
    while($row=mysql_fetch_array($result)) {
        echo '<option>'.$row['username'].'</option>';
    }
    echo '</select></td><td align="center"><input type="submit" name="adminerate" value="'.$lang['admin']['promote'].'"></td></tr>';
    if($_SESSION['type'] == "SADMIN") {
        $result=mysql_query("SELECT * FROM users WHERE user_type='ADMIN'");
        echo '<td align="center"><select name="demote">';
        while($row=mysql_fetch_array($result)) {
            echo '<option>'.$row['username'].'</option>';
        }
        echo '</select></td><td align="center"><input type="submit" name="userate" value="'.$lang['admin']['demote'].'"></td></tr>';
    }

    echo '</table></form>';
    
    if($_POST['adminerate']) {
        $promote = $_POST['promote'];
        $query="UPDATE users SET user_type='ADMIN' WHERE username='".$promote."'";
        mysql_query($query) or die(mysql_error());
        echo '<meta http-equiv="refresh" content="1">';
        echo $promote.$lang['admin']['adminned'];
    }
    if($_POST['userate']) {
        $demote = $_POST['demote'];
        $query="UPDATE users SET user_type='USER' WHERE username='".$demote."'";
        mysql_query($query) or die(mysql_error());
        echo '<meta http-equiv="refresh" content="1">';
        echo $demote.$lang['admin']['usered'];
    }
}
?>