<?php
function message($id){
    $id = (int)$id;
    $include = @include("../config.php");
    if($include!="1")
        echo "Error!";
    else{
        $query = "SELECT message,reciever_id FROM messages WHERE id=".$id;
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_assoc($result);
        $message = base64_decode($row['message']);
        echo $message;
        $query = "UPDATE `messages` SET `read`='YES' WHERE id=".$id;
        mysql_query($query) or die(mysql_error());
}
}
?>
<center><?php message($_GET['msg_id']); ?></center>