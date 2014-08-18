<?php 
if(!$_SESSION['user']){
echo $lang['login_error'];
?>
    <script type='text/javascript'>setTimeout('window.location="index.php"', '3000')</script>
<?php
}
else{
function add_date($givendate,$day=7,$mth=0,$yr=0){
    $cd = strtotime($givendate);
    $newdate = date('Y-M-d H:i:s', mktime(date('H',$cd),
               date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
               date('d',$cd)+$day, date('Y',$cd)+$yr));
    return $newdate;
}
    if($_GET['com_del']) {
        print '<h3 style="color:darkred;">'.$lang['bookinfo']['del_confirm'].'</h3>';
        print '<form action="" method="get">';
        print '<input type="hidden" name="pages" value="book_info">';
        print '<input type="submit" value="'.$lang['yes'].'" name="yes">';
        print '<input type="submit" value="'.$lang['no'].'" name="no"></form>';
        $_SESSION['com_del'] = $_GET['com_del'];
    } else
        if($_GET['yes']) {
            mysql_query("DELETE FROM book_comments WHERE id='".$_SESSION['com_del']."'");
            print '<h3 style="color:darkred;">'.$lang['bookinfo']['del_success'].'</h3>';
            print "<meta http-equiv='refresh' content='2, index.php?pages=book_info&amp;book_id=".$_SESSION['book_id']."'>";
        } else
            if($_GET['no'])
                print "<meta http-equiv='refresh' content='0, index.php?pages=book_info&amp;book_id=".$_SESSION['book_id']."'>";
            else {
                $broinastranica = 3;
                if(isset($_GET['page'])) {
                    $pageNum = $_GET['page'];
                } else {
                    $pageNum = "1";
                }
                $redove = ($pageNum - 1) * $broinastranica;

                $book_id = $_GET['book_id'];
                $_SESSION['book_id'] = $_GET['book_id'];
                $query = "
                SELECT books.*,publisher.name,genres.genre_name 
                FROM books 
                JOIN publisher ON publisher.id=books.publisher_id
                JOIN genres ON genres.id=books.genre_id
                WHERE books.id=".$book_id;
                $result = mysql_query($query) or die(mysql_error());
                $row = mysql_fetch_assoc($result);

                echo '<table border="0" width="90%">';
                echo '<tr><td rowspan="8" width="50%"><center><img src="'.$row['img'].'" width="200px"></td><td colspan="2"><center>'.$row['specifics'].'</td></tr>';
                echo '<tr><td width="20%">'.$lang['book']['subject'].'</td><td>'.$row['genre_name'].'</td></tr>';
                echo '<tr><td>'.$lang['book']['class'].'</td><td>'.$row['class'].'</td></tr>';
                echo '<tr><td>'.$lang['book']['publisher'].'</td><td>'.$row['name'].'</td></tr>';
                echo '<tr><td>'.$lang['book']['authors'].'</td><td>'.$row['authors'].'</td></tr>';
                echo '<tr><td>'.$lang['book']['year'].'</td><td>'.$row['year'].'</td></tr>';
                echo '<tr><td>'.$lang['book']['date'].'</td><td>'.$row['date'].'</td></tr>';
                echo '<tr><td>'.$lang['book']['expire'].'</td><td>'.add_date($row['date']).'</td></tr>';
                echo '</table>';

                $comments_query = "SELECT * FROM book_comments WHERE book_id=".$book_id." ORDER BY id ASC LIMIT ".$redove.", ".$broinastranica;
                $comments_result = mysql_query($comments_query) or die("No comments yet");
                $comments_result2 = mysql_query($comments_query);
                if(!mysql_fetch_array($comments_result2)) {
                    echo $lang['bookinfo']['nocoms_error'];
                } else {
                    echo '<table border="0"><tr><td><table border=0 width=550px><tr><td colspan=3 align=center>'.$lang['bookinfo']['comments'].'</td></tr>';
                    while($comments_array = mysql_fetch_array($comments_result)) {
                        $comment_username_query = "SELECT username FROM users WHERE id=".$comments_array['user_id'];
                        $comment_username_result = mysql_query($comment_username_query);
                        $username = mysql_fetch_array($comment_username_result);
                        echo '<tr><td width=10px align=center><b>'.$username[0].'</b></td>';
                        //--------
                        //изтриване на коментари -----------
                        if($_SESSION['type'] == "SADMIN" || $_SESSION['type'] == "ADMIN") {
                            echo '<td rowspan="2" width="10px"><form action="" method="get">';
                            echo '<input type="hidden" name="pages" value="book_info">';
                            echo "<input src='pics/designs/".$_SESSION['design']."/del.jpg' type='image' width='10' height='10'><input type='hidden' name='com_del' value='".$comments_array['id']."'>";
                            echo '</form></td>';
                        }
                        //изтриване на коментари -----------
                        //--------
                        echo '<td rowspan=2 align=center>'.base64_decode($comments_array['comment']).'</td>';
                        echo '<tr><td><i>'.$comments_array['date'].'</i></td>';
                    }
                    $pages_query = "SELECT COUNT(comment) AS numrows FROM book_comments WHERE book_id=".$book_id;
                    $pages_result = mysql_query($pages_query) or die('Error, query failed');
                    $pages_row = mysql_fetch_array($pages_result);
                    $numrows = $pages_row['numrows'];
                    $maxPage = ceil($numrows / $broinastranica);

                    $nomeranastranici = '';

                    for($page = 1; $page <= $maxPage; $page++) {
                        if($page == $pageNum) {
                            $nomeranastranici .= "( ".$page." )";
                        } else {
                            $nomeranastranici .= ' <a href="'.$phpself.'?pages=book_info&amp;book_id='.$book_id.'&page='.$page.'">'.$page.'</a> ';
                        }
                    }
                    if($pageNum > 1) {
                        $page = $pageNum - 1;
                        $predishna = ' <a href="'.$phpself.'?pages=book_info&amp;book_id='.$book_id.'&amp;page='.$page.'"> [<<<] </a> ';

                        $parva = ' <a href="'.$phpself.'?pages=book_info&amp;book_id='.$book_id.'&amp;page=1">'.$lang['paging']['first'].'</a> ...';
                    } else {
                        $predishna = ' ';
                        $parva = ' ';
                    }

                    if($pageNum < $maxPage) {
                        $page = $pageNum + 1;
                        $sledvashta = ' <a href="'.$phpself.'?pages=book_info&amp;book_id='.$book_id.'&amp;page='.$page.'"> [>>>] </a> ';

                        $posledna = ' ...<a href="'.$phpself.'?pages=book_info&amp;book_id='.$book_id.'&amp;page='.$maxPage.'">'.$lang['paging']['last'].'</a> ';
                    } else {
                        $sledvashta = ' ';
                        $posledna = ' ';
                    } ?>
</table></td><td>
            <?php                     // показваме
                    echo $parva.$nomeranastranici.$posledna;
                }

                if(isset($_POST[b_btn])) {
                    $comment = $_POST['book_comment'];
                    $comment = htmlspecialchars($comment);
                    $comment = addslashes($comment);
                    $comment = base64_encode($comment);
                    if($comment) {
                        $date = date('Y-M-d H:i:s');
                        $query_insert = mysql_query("INSERT INTO book_comments (`user_id`, `book_id`, `comment`, `date`) VALUES ('".$_SESSION['id']."', '".$book_id."', '".$comment."', '".$date."') ");
                        echo "<meta http-equiv='refresh' content='0; ?pages=book_info&amp;book_id=".$book_id."'>";
                    } else
                        print '<h4 style="color:red;">'.$lang['bookinfo']['insert_comment_error'].'</h4>';
                }
                if($_SESSION['is_login'] == 1) {
                    echo '<form action="" method="post" name="b_frm">';
                    echo '<input type="hidden" name="pages" value="book_info">';
                    echo '<input type="hidden" name="book_id" value="'.$book_id.'">';
                    echo '<textarea name="book_comment" rows="4" cols="25" ></textarea>';
                    echo '<br><input type="submit" value="'.$lang['bookinfo']['post_comment'].'" name="b_btn">';
                    echo '</form>';
                }
            }
} ?>
</td></tr></table>