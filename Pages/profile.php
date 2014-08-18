<?php 
if(!$_SESSION['user']){
echo $lang['login_error'];
?>
    <script type='text/javascript'>setTimeout('window.location="index.php"', '3000')</script>
<?php
}
else{
    $result = mysql_query("
    SELECT users.username, users.`e-mail`, users.GSM, users.gsm_viewable, users.skype, users.skype_viewable, profiles.first_name, profiles.last_name, profiles.residence, profiles.avatar
    FROM users
    JOIN profiles ON users.id=profiles.user_id
    WHERE user_id='".$_GET['user_id']."'") or die(mysql_error());
    $row = mysql_fetch_assoc($result);

    if(!$row['first_name'])
        $row['first_name'] = "<i>".$lang['profile']['hidden_c']."</i>";
    if(!$row['last_name'])
        $row['last_name'] = "<i>".$lang['profile']['hidden_f']."</i>";
    if($row['gsm_viewable'] == "NO")
        $row['GSM'] = "<i>".$lang['profile']['hidden_m']."</i>";
    if(!$row['e-mail'])
        $row['e-mail'] = "<i>".$lang['profile']['hidden_m']."</i>";
    if(!$row['residence'])
        $row['residence'] = "<i>".$lang['profile']['hidden_c']."</i>";
    if($row['skype_viewable'] != "YES")
        $row['skype'] = "<i>".$lang['profile']['hidden_m']."</i>";

    $avatar2 = @getimagesize($row['avatar']);
    if($avatar2[1] > $avatar2[0]) {
        if($avatar2[1] > "432")
            $dimensions2 = ' height="432px"';
    } else {
        if($avatar2[0] > "432")
            $dimensions2 = ' width="432px"';
    }
    echo '<table border="0" width="90%" height="432px">';
    echo '<tr><td rowspan="8" width="50%" align="center"><img src="'.$row['avatar'].'"'.$dimensions2.' alt=""></td>';
    echo '<td align="right">'.$lang['profile']['username'].'<td align="center">'.$row['username'].' &raquo; <a href="?pages=write_message&amp;reciever='.$row['username'].'"><img src="pics/mail.png" border="0" alt=""></a></td></tr>';
    echo '<tr><td align="right">'.$lang['profile']['fname'].'</td><td align="center">'.$row['first_name'].'</td></tr>';
    echo '<tr><td align="right">'.$lang['profile']['lname'].'</td><td align="center">'.$row['last_name'].'</td></tr>';
    echo '<tr><td align="right">'.$lang['profile']['gsm'].'</td><td align="center">'.$row['GSM'].'</td></tr>';
    echo '<tr><td align="right">'.$lang['profile']['email'].'</td><td align="center">'.$row['e-mail'].'</td></tr>';
    echo '<tr><td align="right">'.$lang['profile']['skype'].'</td><td align="center">'.$row['skype'];
    if($row['skype_viewable'] == "YES")
        echo ' &raquo; <a href="skype:'.$row['skype'].'?userinfo"><img src="http://mystatus.skype.com/smallicon/'.$row['skype'].'" style="border: none;" width="16" height="16" alt=""></a>';
    echo '</td></tr>';
    echo '<tr><td align="right">'.$lang['profile']['residence'].'</td><td align="center">'.$row['residence'].'</td></tr>';
    echo '</table>';
} ?>