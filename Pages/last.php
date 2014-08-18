<h2><?php echo $lang['main']['title']; ?></h2>
<br>
<table border="1" width="90%">
<tr><td align="center"><b><?php echo $lang['book']['subject']; ?></b></td><td align="center"><b><?php echo $lang['book']['class']; ?></b></td><td align="center"><b><?php echo $lang['book']['publisher']; ?> / <?php echo $lang['book']['year']; ?></b></td><td align="center"><b><?php echo $lang['book']['authors']; ?></b></td><td align="center"><b><?php echo $lang['all_books']['seller']; ?></b></td></tr>
<?php
$result = mysql_query("SELECT * FROM books ORDER BY id DESC LIMIT 0, 5");
while ($book = mysql_fetch_array($result)) {
    $genre = mysql_fetch_array(mysql_query("SELECT genre_name FROM genres WHERE id=" .
        $book['genre_id']));
    $publisher = mysql_fetch_array(mysql_query("SELECT name FROM publisher WHERE id=" .
        $book['publisher_id']));
    $seller = mysql_fetch_array(mysql_query("SELECT username FROM users WHERE id=" .
        $book['seller_id']));

    echo '<tr>
<td>' . $genre[0] . '</td>
<td>' . $book['class'] . '</td>
<td>' . $publisher[0] . ' / ' . $book['year'] . '</td>
<td>' . $book['authors'] . '</td>
<td>' . $seller[0] . '</td>
</tr>';
}
?>
</table>