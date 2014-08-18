<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php 
if(!isset($_SESSION['user'])){
    $_SESSION['design'] = "green";
    $_SESSION['lang'] = "bg";
}
include ("langs/lang.".$_SESSION['lang'].".php"); 
?>
<?php
function unread(){
    $own_id = (int)$_SESSION['id'];
    $query = mysql_query("SELECT id FROM messages WHERE `reciever_id`='".$own_id."' AND `read`='NO'") or die(mysql_error());
    $num = mysql_num_rows($query);
    return $num;
}
function messages(){
    $own_id = (int)$_SESSION['id'];
    $query = mysql_query("SELECT id FROM messages WHERE `reciever_id`='".$own_id."'") or die(mysql_error());
    $num = mysql_num_rows($query);
    return $num;
}
?>
<head>
<title><?php
switch($_GET['pages']){
    case "books":
        echo $lang['all_books']['title'];
        break;
    case "add_book":
        echo $lang['addbook']['title'];
        break;
    case "book_info":
        echo $lang['bookinfo']['title'];
        break;
    case "book_modify":
        echo $lang['modify']['title'];
        break;
    case "last":
        echo $lang['main']['title'];
        break;
    case "my_books":
        echo $lang['mybooks']['title'];
        break;
    case "messages":
        echo $lang['messages']['title'];
        break;
    case "profile":
        echo $lang['profile']['title'];
        break;
    case "user_profile":
        echo $lang['user_profile']['title'];
        break;
    case "users":
        echo $lang['users']['title'];
        break;
    case "registration":
        echo $lang['reg']['title'];
        break;
    case "write_message":
        echo $lang['write_message']['title'];
        break;
    default:
        echo $lang['title'];
        break;
}
?></title>
<meta http-equiv="content-type" content="text/html; charset=windows-1251">
<link rel="shortcut icon" href="pics/favicon.ico">
<link rel="alternate" type="application/rss+xml"  href="http://borsa.vkonov.info/rss.php" title="Оналйн борса за учебници">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<style type="text/css">
<?php include("design.php"); ?>
</style>
</head>
<body>
<center>
<div class="main">
	<div class="header">
    <table border="0px" width="100%"><tr>
    <td width="150px">
		<div class="login">
			<?php //---LogIn--Form--
if(isset($_SESSION['user'])) {
    echo '<form action="" method="get">'.$_SESSION['user'];
    echo '<br><input type="submit" value="'.$lang['login']['lgout'].'" name="lgout"></form>';
    echo "<br><a href='?pages=user_profile'>".$lang['login']['pprof']."</a>";
} else {
    echo '<form action="" method = "post" class="frm">';
    if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == 2)
        echo '<font color="darkred"><b>';
    echo $lang['login']['usernm'].':<br>
						<input type="text" name="usernm"><br>
						'.$lang['login']['pass'].':<br>';
    if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == 2)
        echo '</b></font>';
    echo '<input type="password" name="passwrd"><br>
						<input type="submit" name="btn" value="'.$lang['login']['login'].'">
						</form>';
}
//---LogIn--Form--end--
if($_POST['btn']) {
    $_SESSION['is_login'] = 2;
    $usernm = $_REQUEST['usernm'];
    $passwrd = $_REQUEST['passwrd'];
    $islogin = mysql_query("SELECT * FROM users WHERE username='".$usernm."' AND password='".md5($passwrd)."'");
    $usr = mysql_fetch_assoc($islogin);
    if($usr['id']) {
        $_SESSION['is_login'] = 1;
        $_SESSION['user'] = $usernm;
        $_SESSION['type'] = $usr['user_type'];
        $_SESSION['id'] = $usr['id'];
        $_SESSION['design'] = $usr['design'];
    }
    echo "<meta http-equiv='refresh' content='0, index.php'>";
}
if($_GET['lgout']) {
    session_destroy();
    echo "<meta http-equiv='refresh' content='0, index.php'>";
} ?>
		</div>
        </td>
        <td width="100%" align="center">
  <div class="title">
		<br>
        <font color="<?php echo $_SESSION['design']; ?>" size="8"><?php echo $lang['title']; ?></font>
</div>
</td>
<td width="230px">
		<div class="avatar">
			<?php 
//avatar---------------------------------
if(isset($_SESSION['user'])) {
    $avatar_query = mysql_query("SELECT avatar FROM profiles WHERE user_id=".$_SESSION['id']);
    $avatar = mysql_fetch_array($avatar_query);
    $avatar_dim = @getimagesize($avatar[0]);
    if($avatar_dim[1] > "100")
        $dimensions = ' height="125px"';

    elseif($avatar_dim[0] > "230")
        $dimensions = ' width="230px"';

    echo '<img src="'.$avatar[0].'"'.$dimensions.'></img>';
}
//--avatar-------------------------------
 ?>
</div>
</td>
</tr>
</table>
		</div>
        <div id="menu" class="menu"><br><img border="0" height="16px" src="pics/RightArrowGrey.png" style="position: static; margin-left: -10px; display:  none;" onclick="slidemenu()" alt="">
        <span id="menucontent">
			<?php
//user-panel-----------------------------
if($_SESSION['user']){
    echo "<a href='?pages=users' class='link'>".$lang['menu']['users']."</a>";
    echo "<a href='?pages=last' class='link'>".$lang['menu']['last']."</a><br>";
    echo '<a href="#" onclick="slidebook()" class="down">'.$lang['menu']['books'].'</a>';
    echo '<span id="bookpages">';
    echo '<hr style="margin-right: 5px; color: '.$_SESSION['design'].';">';
    echo '<a href="?pages=books" class="link">'.$lang['menu']['all'].'</a>';
    echo "<a href='?pages=my_books' class='link'>".$lang['login']['ownbooks']."</a>";
    echo "<a href='?pages=add_book' class='link'>".$lang['menu']['add_book']."</a>";
    echo '<hr style="margin-right: 5px; color: '.$_SESSION['design'].';">';
    echo "</span>";
}
else
    echo '<a href="?pages=books" class="link">'.$lang['menu']['books'].'</a>';
if($_SESSION['is_login'] != 1)
    echo '<a href="?pages=registration" class="link">'.$lang['menu']['reg'].'</a>';
//--user-panel---------------------------
//message-system-------------------------
if(isset($_SESSION['user'])){
    echo '<a href="#" onclick="slidemsg()" class="down">'.$lang['messages']['messages'].'</a>
            <span id="msgs">';
    echo '<hr style="margin-right: 5px; color: '.$_SESSION['design'].';">';
    echo '<font color="'.$_SESSION['design'].'">'.
        '<a href="index.php?pages=messages&unread=1" class="link">'.$lang['messages']['unread'].': '.unread().'</а>'.
        '<a href="index.php?pages=messages" class="link">'.$lang['messages']['all'].': '.messages().'</a>'.
        '<a href="index.php?pages=write_message" class="link">'.$lang['messages']['new'].'</a>'.
        '</font>';
    echo '<hr style="margin-right: 5px; color: '.$_SESSION['design'].';">';
    echo '</span>';
}
//--message-system-----------------------
//admin-panel----------------------------
if($_SESSION['type'] == "ADMIN" || $_SESSION['type'] == "SADMIN"){
    echo '<a href="#" onclick="slideadm()" class="down">'.$lang['menu']['admin_manage'].'</a>
            <span id="administration">';
    echo '<hr style="margin-right: 5px; color: '.$_SESSION['design'].';">
            <a href="?pages=/admin/add_subject" class="link">'.$lang['menu']['admin_subject'].'</a>
            <a href="?pages=/admin/add_publisher" class="link">'.$lang['menu']['admin_publisher'].'</a>
            <a href="?pages=/admin/reg_admin" class="link">'.$lang['menu']['admin_admin'].'</a>
            <hr style="margin-right: 5px; color: '.$_SESSION['design'].';"></span>';
}
//--admin-panel--------------------------
 ?>
        </span>
		</div>
	<div class="right" id="right">
