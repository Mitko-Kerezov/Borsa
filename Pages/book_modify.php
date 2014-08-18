<?php 
if(!$_SESSION['user']){
echo $lang['login_error'];
?>
    <script type='text/javascript'>setTimeout('window.location="index.php"', '3000')</script>
<?php
}
else{
    $id = $_GET['modify_id'];
    $book = mysql_fetch_array(mysql_query("SELECT * FROM books WHERE id=" . $id));
    if (($book['seller_id'] != $_SESSION['id']) AND ($_SESSION['type'] == "USER"))
        echo $lang['modify']['id_error'];
    else {
        if ($_POST['delete']) {
            print '<h3 style="color:darkred;">'.$lang['modify']['del_confirm'].'</h3>';
            print '<form action="" method="post">';
            print '<input type="submit" value="'.$lang['yes'].'" name="yes">';
            print '<input type="submit" value="'.$lang['no'].'" name="no">';
            print '</form>';
        } else
            if (isset($_POST['yes'])) {
                mysql_query("DELETE FROM books WHERE id='" . $id . "'");
                mysql_query("DELETE FROM book_comments WHERE book_id='" . $id . "'");
                print '<h3 style="color:darkred;">'.$lang['modify']['del_success'].'</h3>';
                print "<meta http-equiv='refresh' content='2;url=index.php?pages=my_books'>";
            } else
                if (isset($_GET['no']))
                    print "<meta http-equiv='refresh' content='0;url=index.php?pages=users'>";
                else {
                    $genre = mysql_fetch_array(mysql_query("SELECT genre_name FROM genres WHERE id=" .
                        $book['genre_id']));
                    $publisher = mysql_fetch_array(mysql_query("SELECT name FROM publisher WHERE id=" .
                        $book['publisher_id']));
                    echo '<br><center><img src="' . $book['img'] . '" height="200px"></center>';
                    echo '<form action="" method="post"><table border="0" width="90%">
<tr><td align="center">Снимка</td><td>'.$lang['book']['subject'].'</td><td align="right"><select name="genre">';
                    $genre_select_query = mysql_query("SELECT * FROM genres");
                    while ($genre_select = mysql_fetch_array($genre_select_query)) {
                        if ($genre_select['genre_name'] == $genre[0])
                            echo '<option selected>' . $genre_select['genre_name'] . '</option>';
                        else
                            echo '<option>' . $genre_select['genre_name'] . '</option>';
                    }
                    echo '
</select></td></tr><tr><td rowspan="2" width="50%"><textarea name="img" cols="45">' .
                        $book['img'] . '</textarea></td>
<td>'.$lang['book']['publisher'].'</td><td align="right"><select name="publisher">';
                    $pub_select_query = mysql_query("SELECT * FROM publisher");
                    while ($pub_select = mysql_fetch_array($pub_select_query)) {
                        if ($pub_select['name'] == $publisher[0])
                            echo '<option selected>' . $pub_select['name'] . '</option>';
                        else
                            echo '<option>' . $pub_select['name'] . '</option>';
                    }
                    echo '</select></td></tr>
<tr><td>'.$lang['book']['authors'].'</td><td align="right"><input type="text" name="authors" size="35" value="' .
                        $book['authors'] . '"></td></tr>
<tr><td align="center">'.$lang['book']['specifics'].'</td><td>'.$lang['book']['class'].'</td><td align="right"><select name="class">';
                    for ($class = 1; $class <= 12; $class++) {
                        if ($class == $book['class'])
                            echo '<option selected>' . $class . '</option>';
                        else
                            echo '<option>' . $class . '</option>';
                    }
                    echo '</select></td></tr>
<tr><td rowspan="2"><textarea name="specifics" cols="45">' . $book['specifics'] .
                        '</textarea></td>
<td>'.$lang['book']['year'].'</td><td align="right"><input type="text" name="year" maxlength="4" size="5" value="' .
                        $book['year'] . '"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="delete" value="'.$lang['modify']['delete'].'" style="float: left;"><input type="submit" name="change" value="'.$lang['modify']['save'].'" style="float: right;"></td></tr></table></form>';
                }
    }
    if ($_POST['change']) {
        $specifics = addslashes(htmlspecialchars($_POST['specifics']));
        $img = addslashes(htmlspecialchars($_POST['img']));
        $genre = $_POST['genre'];
        $authors = addslashes(htmlspecialchars($_POST['authors']));
        $year = addslashes(htmlspecialchars($_POST['year']));
        $publisher = $_POST['publisher'];
        $class = $_POST['class'];

        $result = mysql_query("SELECT id FROM genres WHERE genre_name='" . $genre . "'");
        $genre_id = mysql_fetch_array($result);

        $result1 = mysql_query("SELECT id FROM publisher WHERE name='" . $publisher .
            "'");
        $publisher_id = mysql_fetch_array($result1);

        $insert_result = mysql_query("UPDATE `books`
                         SET `genre_id` = '" . $genre_id[0] . "',
                             `class` = '" . $class . "',
                             `year` = '" . $year . "',
                             `specifics` = '" . $specifics . "',
                             `authors` = '" . $authors . "',
                             `publisher_id` = '" . $publisher_id[0] . "',
                             `img` = '" . $img . "'
                         WHERE `id` =" . $id . " ;
                        ") or die(mysql_error());
        echo $lang['modify']['save_success'];
        echo '<meta http-equiv="refresh" content="2;url=index.php?pages=my_books">';
    }
}
?>