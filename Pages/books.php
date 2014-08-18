<br>
<?php
$broinastranica = 5;
$pageNum = 1;
if (isset($_GET['page'])) {
    $pageNum = $_GET['page'];
}
$redove = ($pageNum - 1) * $broinastranica;

$query = "SELECT * FROM `books` LIMIT $redove, $broinastranica";

$result = mysql_query($query) or die('Error, query failed');
$res_auth = mysql_query("SELECT name FROM publisher") or die("querito1!");
$res_genr = mysql_query("SELECT * FROM genres") or die("querito!");
?>
<form action="" method="get"><input type="hidden" name="pages" value="books">
<table border="1" width="90%" align="center">
    <tr>
        <td align="center"><b>
            <select name="sort_genre">
                <option><?php echo $lang['book']['subject']; ?></option>
                <?php while ($genr = mysql_fetch_array($res_genr))
                  echo "<option value=".$genr['id'].">".$genr['genre_name']."</option>"; ?>
            </select>
        </b></td>
        <td align="center"><b>
            <select name="sort_class">
                <option><?php echo $lang['book']['class']; ?></option>
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
                <option>12</option>
            </select>
        </b></td>
        <td align="center"><b>
            <select name="sort_author">
                <option><?php echo $lang['book']['publisher']; ?></option>
                <?php while($auth = mysql_fetch_array($res_auth))
                  echo "<option>" . $auth[0] . "</option>"; ?>
            </select>
        </b></td>
        <td align="center"><b><?php echo $lang['book']['authors']; ?></b></td>
        <td align="center"><b><?php echo $lang['all_books']['seller']; ?></b></td>
        <td align="center"><input type="submit" name="sort_sub" value="<?php echo $lang['all_books']['search']; ?>"></td>
    </tr>
<?php
//-----------------------
if (isset($_GET['sort_sub'])) {
    if ($_GET['sort_genre'] != $lang['book']['subject']) {
        $sort_genre_id = $_GET['sort_genre'];
        $sort_genre_add = "genre_id=$sort_genre_id ";
    } else {
        $sort_genre_add = "";
    }

    if ($_GET['sort_class'] != $lang['book']['class']) {
        $sort_class = $_GET['sort_class'];
        if ($sort_genre_add != "") {
            $add = "AND ";
        } else {
            $add = "";
        }
        $sort_class_add = $add . "class=$sort_class ";
    } else {
        $sort_class_add = "";
    }

    if ($_GET['sort_author'] != $lang['book']['publisher']) {
        $sort_author = $_GET['sort_author'];
        $sth_query = "SELECT id FROM publisher WHERE name='" . $sort_author . "'";
        $author_array = mysql_query($sth_query) or die(mysql_error());
        $sort_author_id_row = mysql_fetch_array($author_array);
        $sort_author_id = $sort_author_id_row[0];
        if ($sort_class_add != "" || $sort_genre_add != "") {
            $add = "AND ";
        } else {
            $add = "";
        }
        $sort_author_add = $add . "publisher_id=$sort_author_id ";
    } else {
        $sort_author_add = "";
    }


    if ($sort_class_add == "" && $sort_genre_add == "" && $sort_author_add == "") {
        $query = "SELECT * FROM books LIMIT $redove, $broinastranica";
        $query_str = "SELECT COUNT(*) AS numrows FROM `books`";
    } else {
        $query = "SELECT * FROM books WHERE " . $sort_genre_add . $sort_class_add . $sort_author_add .
            "LIMIT $redove, $broinastranica";
        $query_str = "SELECT COUNT(*) AS numrows FROM books WHERE " . $sort_genre_add .
            $sort_class_add . $sort_author_add;
    }
    //echo $query;
    //-----------------------
    $result = mysql_query($query) or die(mysql_error());

    while ($row = mysql_fetch_array($result)) {
        $query = "SELECT genre_name FROM genres WHERE id=" . $row['genre_id'];
        $result_genre = mysql_query($query) or die('Error, query2 failed');
        $genre = mysql_fetch_array($result_genre);

        $query = "SELECT name FROM publisher WHERE id=" . $row['publisher_id'];
        $result_author = mysql_query($query) or die('Error, query3 failed');
        $author = mysql_fetch_array($result_author);


        $query = "SELECT username FROM users WHERE id=" . $row['seller_id'];
        $result_seller = mysql_query($query) or die('Error, query4 failed');
        $seller = mysql_fetch_array($result_seller);

        echo '<tr><td>' . $genre[0] . '</td><td>' . $row['class'] . '</td><td>' . $author[0] .
            ' / ' . $row['year'] . '</td><td>' . $row['authors'] . '</td><td>';
        if ($_SESSION['is_login'] == 1)
            echo '<a style="text-decoration: none;" href="?	pages=profile&amp;user_id=' . $row['seller_id'] .
                '">' . $seller[0] . '</td><td><a style="text-decoration: none;" href="?	pages=book_info&amp;book_id=' .
                $row['id'] . '">'.$lang['all_books']['preview'].'</a>';
        else
            echo $seller[0] . '</td><td>'.$lang['all_books']['preview'].'</a>';
        echo '</td></tr>';
    }
} else {
    $query_str = "SELECT COUNT(*) AS numrows FROM `books`";
    while ($row = mysql_fetch_array($result)) {
        $query = "SELECT genre_name FROM genres WHERE id=" . $row['genre_id'];
        $result_genre = mysql_query($query) or die('Error, query2 failed');
        $genre = mysql_fetch_array($result_genre);

        $query = "SELECT name FROM publisher WHERE id=" . $row['publisher_id'];
        $result_author = mysql_query($query) or die('Error, query3 failed');
        $author = mysql_fetch_array($result_author);


        $query = "SELECT username FROM users WHERE id=" . $row['seller_id'];
        $result_seller = mysql_query($query) or die('Error, query4 failed');
        $seller = mysql_fetch_array($result_seller);

        echo '<tr><td>' . $genre[0] . '</td><td>' . $row['class'] . '</td><td>' . $author[0] .
            ' / ' . $row['year'] . '</td><td>' . $row['authors'] . '</td><td>';
        if ($_SESSION['is_login'] == 1)
            echo '<a style="text-decoration: none;" href="?	pages=profile&amp;user_id=' . $row['seller_id'] .
                '">' . $seller[0] . '</td><td><a style="text-decoration: none;" href="?	pages=book_info&amp;book_id=' .
                $row['id'] . '">'.$lang['all_books']['preview'].'</a>';
        else
            echo $seller[0] . '</td><td>'.$lang['all_books']['preview'].'</td></tr>';
    }
}
echo "</table></form>";
//-----------------------
$result = mysql_query($query_str) or die(mysql_error());
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];

$maxPage = ceil($numrows / $broinastranica);

if ($_GET['sort_class']=="" && $_GET['sort_genre']=="" && $_GET['sort_author']=="")
    $self = "?pages=books";
else
    $self = "?pages=books&amp;sort_class=".$_GET['sort_class']."&amp;sort_genre=".$_GET['sort_genre']."&amp;sort_author=".$_GET['sort_author']."&amp;sort_sub=Sort";

$nomeranastranici = '';

for ($page = 1; $page <= $maxPage; $page++) {
    if ($page == $pageNum) {
        $nomeranastranici .= "<font style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;'>".$page."</font>";
    } else {
        $nomeranastranici .= "<a style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;' href='".$self."&amp;page=".$page."'>".$page."</a>";
    }
}

if ($pageNum > 1) {
    $page = $pageNum - 1;
    $predishna = "<a style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;' href='".$self."&amp;page=".$page."'><<<</a>";

    $parva = "<a style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;' href='".$self."&amp;page=1'>".$lang['paging']['first']."</a>";
} else {
    $predishna = ' ';
    $parva = ' ';
}

if ($pageNum < $maxPage) {
    $page = $pageNum + 1;
    $sledvashta = "<a style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;' href='".$self."&amp;page=".$page."'>>>></a>";

    $posledna = "<a style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;' href='".$self."&amp;page=".$maxPage."'>".$lang['paging']['last']."</a>";
} else {
    $sledvashta = ' ';
    $posledna = ' ';
}
if ($maxPage > 1)
    print "<br>";
    print $parva . $nomeranastranici . $posledna;

?>