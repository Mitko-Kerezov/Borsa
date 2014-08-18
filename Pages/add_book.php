<?php 
if(!$_SESSION['user']){
echo $lang['login_error'];
?>
    <script type='text/javascript'>setTimeout('window.location="index.php"', '3000')</script>
<?php
}
else{
?>
<form action="" method="post">
    <table width="90%" border="0">
        <tr><td align="right"><?php echo $lang['book']['subject']; ?></td><td><select name="genre_id">
                        <?php
    $res_auth = mysql_query("SELECT * FROM publisher") or die("querito!");
    $res_genr = mysql_query("SELECT * FROM genres") or die("querito!");

    while ($genr = mysql_fetch_array($res_genr)) {
        echo "<option value=" . $genr['id'] . ">" . $genr['genre_name'] . "</option>";
    }
?>
                </select></td></tr>
        <tr><td align="right"><?php echo $lang['book']['class']; ?></td><td><select name="learnt_class">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option></select></td></tr>
        <tr><td align="right"><?php echo $lang['book']['publisher']; ?></td><td><select name="pub">
                        <?php
    while ($auth = mysql_fetch_array($res_auth)) {
        echo "<option value=" . $auth['id'] . ">" . $auth['name'] . "</option>";
    }
?>
                </select></td></tr>
        <tr><td align="right"><?php echo $lang['book']['authors']; ?></td><td><input type="text" name="authors"></td></tr>
        <tr><td align="right"><?php echo $lang['book']['year']; ?></td><td><input type="text" name="year"></td></tr>
        <tr><td align="right"><?php echo $lang['book']['specifics']; ?></td><td><textarea name="specmarks"></textarea></td></tr>
    </table><input type="submit" name="addbookbtn" value="<?php echo $lang['addbook']['add']; ?>"/></form>
    <?php
    if ($_POST['addbookbtn']) {
        $genre = $_POST['genre_id'];
        $class = $_POST['learnt_class'];
        $pub = $_POST['pub'];
        $authors = $_POST['authors'];
        $authors = addslashes(htmlspecialchars($authors));
        $year = $_POST['year'];
        $year = addslashes(htmlspecialchars($year));       
        $marks = $_POST['specmarks'];
        $marks = addslashes(htmlspecialchars($marks));
        $user_id = $_SESSION['id'];
        if (!$authors || !$year)
            echo $lang['addbook']['fill_all_error'];
        else {
            if (!$marks)
                $marks = "-";
            mysql_query("INSERT INTO books (`genre_id`, `seller_id`, `class`, `year`, `specifics`, `authors`, `publisher_id`, `date`)
                                VALUES ('".$genre."', '".$user_id."', '".$class."', '".$year . "', '".$marks."', '".$authors."', '".$pub."', '".date('Y-M-d H:i:s')."') ") or die(mysql_error());
            echo $lang['addbook']['added'];
        }
    }
}
?>