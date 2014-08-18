<?php 
if(!$_SESSION['user']){
echo $lang['login_error'];
?>
    <script type='text/javascript'>setTimeout('window.location="index.php"', '3000')</script>
<?php
}
else{
    $query = "SELECT * FROM books WHERE seller_id=" . $_SESSION['id'];
    $result = mysql_query($query);
    $result_check = mysql_query($query);
    if (!mysql_fetch_array($result_check)) {
        echo "<h3>".$lang['mybooks']['no_books_error']."</h3>";
    } else {
        echo '<table border="1" width="90%" align="center"><tr>
  <td align=center><b>'.$lang['book']['subject'].'</b></td>
  <td align=center><b>'.$lang['book']['class'].'</b></td>
  <td align=center><b>'.$lang['book']['publisher'].'/'.$lang['book']['year'].'</b></td>
  <td align=center><b>'.$lang['book']['authors'].'</b></td>
  <td align=center><b>'.$lang['mybooks']['edit'].'</b></td></tr>';
        while ($row = mysql_fetch_array($result)) {
            $genre_query = "SELECT genre_name FROM genres WHERE id=" . $row['genre_id'];
            $genre_result = mysql_query($genre_query);
            $genre_name = mysql_fetch_array($genre_result);

            $publisher_query = "SELECT name FROM publisher WHERE id=" . $row['publisher_id'];
            $publisher_result = mysql_query($publisher_query);
            $publisher_name = mysql_fetch_array($publisher_result);

            echo '
        <tr>
		<td>' . $genre_name[0] . '</td>
		<td>' . $row['class'] . '</td>
		<td>' . $publisher_name[0] . '/' . $row['year'] . '</td>
		<td>' . $row['authors'] . '</td>
		
        <td align="center"><form action="index.php" method="get">
        <input type="hidden" name="pages" value="book_modify">
        <input type="hidden" value="'.$row['id'].'" name="modify_id">
        <input type="submit" value="'.$lang['mybooks']['confirm'].'">
        </form></td>
        </tr>';
        }
        echo '</table>';
    }
}
?>