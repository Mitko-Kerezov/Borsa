<?php 
if(!$_SESSION['user']){
echo $lang['login_error'];
?>
    <script type='text/javascript'>setTimeout('window.location="index.php"', '3000')</script>
<?php
}
else{
    $broinastranica = 5;
    $pageNum = 1;
    if (isset($_GET['page'])) {
        $pageNum = $_GET['page'];
    }
    $redove = ($pageNum - 1) * $broinastranica;
    $query = mysql_query("
    SELECT users.id, users.username, users.user_type, users.`e-mail`, users.GSM, users.gsm_viewable, profiles.residence
    FROM users 
    JOIN profiles ON users.id=profiles.user_id
    ORDER BY id ASC LIMIT ".$redove.", ".$broinastranica) or die(mysql_error());

    echo '<br><table border=1 width=90% align=center>';
    echo '<tr>';
    if ($_SESSION['type'] == "ADMIN" || $_SESSION['type'] == "SADMIN")
        echo '<td width="12px">Õ</td>';
    echo '<td align="center"><b>'.$lang['login']['usernm'].'</b></td>';
    echo '<td align="center"><b>'.$lang['users']['status'].'</b></td>';
    echo '<td align="center"><b>'.$lang['profile']['residence'].'</b></td>';
    echo '<td align="center"><b>'.$lang['profile']['email'].'</b></td>';
    echo '<td align="center"><b>'.$lang['profile']['gsm'].'</b></td>';
    echo '</tr>';

    while ($user = mysql_fetch_assoc($query)) {
        echo '<tr>';
        if ($_SESSION['type'] == "ADMIN" || $_SESSION['type'] == "SADMIN")
            echo '<td width="1px"><a href="?pages=%2Fadmin%2Fdeletion&find_acc=' . $user['username'] .
                '&del_btn=%CD%E0%EC%E5%F0%E8">Õ</a></td>';
        if (!$user['residence'])
            $user['residence'] = "<i>".$lang['profile']['hidden_c']."</i>";
        if ($user['gsm_viewable']=="NO")
            $user['GSM'] = "<i>".$lang['profile']['hidden_m']."</i>";

        echo '<td><a href="?pages=write_message&reciever='.$user['username'].'"><img src="pics/mail.png" border="0" alt=""></a> &raquo; 
		  <a href="?pages=profile&user_id='.$user['id'].'">'.$user['username'].'</a>
                  </td>';
        echo '<td>'.$user['user_type'].'</td>';
        echo '<td>'.$user['residence'].'</td>';
        echo '<td>'.$user['e-mail'].'</td>';
        echo '<td>'.$user['GSM'].'</td>';
        echo '</tr>';
    }
    echo '</table>';

    $query_str = "SELECT COUNT(*) AS numrows FROM users";
    $result = mysql_query($query_str) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $numrows = $row['numrows'];

    $maxPage = ceil($numrows / $broinastranica);

    $self = "?pages=users";
    $nomeranastranici = '';

    for ($page = 1; $page <= $maxPage; $page++) {
        if ($page == $pageNum) {
            $nomeranastranici .= "<font style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;'>$page</font>";
        } else {
            $nomeranastranici .= "<a style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;' href=\"$self&page=$page\">$page</a>";
        }
    }

    if ($pageNum > 1) {
        $page = $pageNum - 1;
        $predishna = "<a style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;' href=\"$self&page=$page\"><<<</a>";

        $parva = "<a style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;' href=\"$self&page=1\">".$lang['paging']['first']."</a>";
    } else {
        $predishna = ' ';
        $parva = ' ';
    }

    if ($pageNum < $maxPage) {
        $page = $pageNum + 1;
        $sledvashta = "<a style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;' href=\"$self&page=$page\">>>></a>";

        $posledna = "<a style='margin-left: 2px; border: 1px solid black; padding: 3px; text-decoration: none; color: black;' href=\"$self&page=$maxPage\">".$lang['paging']['last']."</a>";
    } else {
        $sledvashta = ' ';
        $posledna = ' ';
    }
    print "<br>";
    print $parva . $nomeranastranici . $posledna;
}
?>