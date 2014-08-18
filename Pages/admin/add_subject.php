<title> <?php echo $lang['admin']['genres_title']; ?> </title>
<?php
function is_subject_free($name){
    $result=mysql_query("SELECT id FROM genres WHERE genre_name='".$name."'") or die(mysql_error());
    if (mysql_num_rows($result) == 0)
        return true;
    else
        return false;
}
if (!$_SESSION['user'] || $_SESSION['type']=="USER"){
    echo "<meta http-equiv='refresh' content='3, index.php'>".$lang['login_error'];
}
else{
?>
<center>
<form action="" method="post">
<?php echo $lang['admin']['genre']; ?>: <br/>
<input type="text" name="name"/><br/>
<input type="submit" value="<?php echo $lang['admin']['add']; ?>" name="btn1"/>
</form>
</center>
<form action="" method="post">
<select name="delpub">
<?php
$query = "SELECT * FROM genres";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
echo "<option>".$row['genre_name']."</option>";
}
?>
</select>
<input type="submit" name="del_but" value="<?php echo $lang['admin']['del']; ?>"/>
</form>
<?php
if($_POST['del_but']){
$todel = $_POST['delpub'];
$query = "DELETE FROM genres WHERE genre_name='".$todel."'";
mysql_query($query) or die(mysql_error());
echo $todel.$lang['admin']['del_success']."<meta http-equiv='refresh' content='2'>";
}
if($_POST['btn1']){
    $name = $_POST['name'];
    if($name){
        if(true == is_subject_free($name)){
            $res= mysql_query(" INSERT INTO genres (`genre_name`) VALUES ('".$name."') ") or die(mysql_error());
            print $lang['admin']['genre_added'].$name;
        }
        else
            print $lang['admin']['genre_exists'];
}
else 
    echo $lang['admin']['genre_name'];
}
}
?>