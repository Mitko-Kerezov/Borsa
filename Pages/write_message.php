<?php 
if(!$_SESSION['user']){
echo $lang['login_error'];
?>
    <script type='text/javascript'>setTimeout('window.location="index.php"', '3000')</script>
<?php
}
else{

function get_id($username){
    $query = @mysql_query("SELECT id FROM users WHERE username='".$username."'");
    $id = mysql_fetch_assoc($query);
    if($id[id]){
        if($id[id]!=$_SESSION['id'])
            return $id[id];
        else 
            return false;
    }
    else
        return false;
}
function message_send($sender, $reciever, $message){
    $date = date('Y-M-d H:i:s');
    $message = base64_encode($message);
    $query = "INSERT INTO messages SET `sender_id`='".$sender."', `reciever_id`='".$reciever."', `message`='".$message."', `date`='".$date."'";
    $result = mysql_query($query);
    return $result;
}

if($_POST['send']){
    $returnmsg = $_POST['message'];
    $sender_id=(int)$_SESSION['id'];
    $reciever_name=basename($_POST['sendto']);
    $reciever_id = get_id($reciever_name);
    $message = htmlspecialchars(addslashes($_POST['message']));
    if(!$reciever_id)
        echo $lang['messages']['no_such_user'];
    elseif(!$message)
        echo $lang['messages']['no_message'];
    else{  
       $success = (message_send($sender_id, $reciever_id, $message)==1) ? $lang['messages']['sent'] : $lang['messages']['send_error'];
       $returnmsg = "";
       echo $success;
    }
}
?>
<br>
<form action="" method="post">
<table border="0">
<tr>
<td><b><?php echo $lang['messages']['send_to']; ?></b>: </td><td><input type="test" name="sendto" value="<?php echo $_GET['reciever']; ?>"></td></tr>
<td><b><?php echo $lang['messages']['message']; ?></b>: </td><td><textarea name="message" cols="50" rows="5"><?php echo $returnmsg; ?></textarea></td></tr>
</table>
<input type="submit" name="send" value="<?php echo $lang['bookinfo']['post_comment']; ?>">
</form>
<?php } ?>