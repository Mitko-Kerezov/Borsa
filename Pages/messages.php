<?php 
if(!$_SESSION['user']){
echo $lang['login_error'];
?>
    <script type='text/javascript'>setTimeout('window.location="index.php"', '3000')</script>
<?php
}
else{
?>
<?php
class pagination{
    private $query, $perpage, $first, $last, $color, $total, $rows, $unread;
    
    function __construct($p, $q, $f, $l, $s, $u){
        $this->perpage = (int)$p;
        $this->first = $f;
        $this->last = $l;
        if($u=="1")
            $adition = " AND `messages`.`read`='NO'";
        $this->query = $q.$adition." ORDER BY `messages`.`id` DESC";
        $this->color = ($s) ? $s : "red";
        $this->total = $this->totalpages();
        $this->unread = ($u==1) ? "&unread=1" : "";
        
    }
    
	function totalpages(){
	   $result = mysql_query($this->query);
       $pages = mysql_num_rows($result);
       $pages = ceil($pages/$this->perpage);
       return $pages;
	}
    
    function pages($current){
        $current = (int)$current;
        if(!$current) $current = 1;
        for($i=1; $i<=$this->total; $i++){
            if($i==1) 
                $txt = $this->first;
            elseif($i==$this->total) 
                $txt = $this->last;
            else 
                $txt=$i;
            if($i!=$current)
                echo '<a style="margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;" href="index.php?pages=messages'.$this->unread.'&page='.$i.'">'.$txt.'</a>';
            else
                echo '<font style="margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: '.$this->color.';">'.$txt.'</font>';
        }
    }
    
    function display($page){
        $page = (int)$page;
        $page = (($page>=1) && ($page<=$this->total)) ? $page : 1;
        $start = $this->perpage*($page-1);
        $query = $this->query." LIMIT ".$start.", ".$this->perpage;
        $result = mysql_query($query);
        while($row = mysql_fetch_array($result)){
            $img = ($row['read']=='YES') ? "tick" : "cross";
            echo '
                <tr>
                <td align="center"><img src="pics/'.$img.'.gif" border="0" alt=""></td>
                <td align="center"><a href="index.php?pages=profile&amp;user_id='.$row[7].'">'.$row['username'].'</a></td>
                <td align="center">'.$row['date'].'</td>
                <td align="center"><a href="index.php?pages=messages&amp;delete='.$row[0].'"><img src="pics/cross.gif" height="10px" border="0" alt=""></a></td>
                <td><a href="Pages/read_msg.php?msg_id='.$row[0].'" target="readbench"><img src="pics/arrow.png" height="17px" border="0" alt=""></a></td>
                </tr>
                ';
        }
    }
    
    function delete($id){
        $query = "DELETE FROM messages WHERE id='".$id."' AND reciever_id='".(int)$_SESSION['id']."'";
        $result = mysql_query($query);
        if($result==1)
            return '<meta http-equiv="refresh" content="0">';
        else
            return "error!";
    }

}
?>
<?php
if($_GET['delete']) pagination::delete((int)$_GET['delete']);
$own_id = (int)$_SESSION['id'];
$unread = (int)$_GET['unread'];
$query = "
    SELECT messages.*, users.username, users.id
    FROM messages 
    JOIN `users` ON `users`.`id`=`messages`.`sender_id`
    WHERE `reciever_id`='".$own_id."'";
$per_page = "5";
$lang1 = $lang['paging']['first'];
$langlast = $lang['paging']['last'];
$color = basename($_SESSION['design']);
$pagination = new pagination($per_page, $query, $lang1, $langlast, $color, $unread);
?>
<table width="90%" border="0">
<tr>
<td width="50%" valign="top" align="center">
<?php echo $lang['messages']['messages'].":"; ?>
<table width="100%" border="1">
<tr>
<td align="center" width="1%"><img src="pics/read.png" alt="" border="0"></td>
<td align="center" width="35%"><?php echo $lang['messages']['sender']; ?></td>
<td align="center" width="63%"><?php echo $lang['messages']['date']; ?></td>
<td><img src="pics/cross.gif" height="10px" border="0" alt=""></td>
<td align="center" width="1%"><img src="pics/arrow.png" height="17px" border="0" alt=""></td>
</tr>
<?php $pagination->display($_GET['page']); ?>
</table>
<td width="50%" valign="top" align="center">
<?php echo $lang['messages']['message'].":"; ?>
<iframe name="readbench" width="100%" scrolling="auto" style="border: 1px solid <?php echo $_SESSION['design']; ?>;" height="80px"></iframe>
<br><br>
<?php $pagination->pages($_GET['page']); ?>
</td>
</tr>
</table>
<?php } ?>