<?php 
if(!$_SESSION['user']){
echo $lang['login_error'];
?>
    <script type='text/javascript'>setTimeout('window.location="index.php"', '3000')</script>
<?php
}
else{
                    if(isset($_POST['btn_chng'])) {
                        if($_POST['pass1'] != "") {
                            if($_POST['pass1'] == $_POST['pass2']) {
                                $passes = 1;
                                $addition = "`password` = '".md5($_POST['pass1'])."',";
                            }
                            else {
                                $addition = "";
                                $passes = 0;
                            }
                        }
                        else  $passes = 1;
                        if($_POST['skype'] == "") $skype = 1;
                        else  $skype = preg_match('/^[a-zA-Z0-9_\-\.]+$/', $_POST['skype']);

                        if($_POST['fname'] == "") $fname = 1;
                        else  $fname = preg_match('/^[a-zA-ZА-Яа-я\-]+$/', $_POST['fname']);

                        if($_POST['lname'] == "") $lname = 1;
                        else  $lname = preg_match('/^[a-zA-ZА-Яа-я\-]+$/', $_POST['lname']);

                        if($_POST['residence'] == "") $residence = 1;
                        else  $residence = preg_match('/^[a-zA-ZА-Яа-я ]+$/', $_POST['residence']);

                        if($_POST['email'] == "") $email = 1;
                        else  $email = preg_match('/^[a-z0-9\.]+@[a-z0-9-]+\.[a-z]{2,4}$/', $_POST['email']);

                        if($_POST['avatar'] == "") {
                            $avatar = 1;
                            $_POST['avatar'] = "pics/avatars/avatar_default.gif";
                        }
                        else  $avatar = preg_match('/^[a-zA-Z0-9\/\-_\.\:]+$/', $_POST['avatar']);

                        if($skype == 0 OR $fname == 0 OR $lname == 0 OR $residence == 0 OR $avatar == 0 OR $email == 0 OR $passes == 0) echo $lang['user_profile']['data_error'].
                                "<br>";
                        else {
                            if($_POST['viewable'] == NULL) $_POST['viewable'] = 'NO';
                            if($_POST['gsm_view'] == NULL) $_POST['gsm_view'] = 'NO';
                            $result = mysql_query("UPDATE `profiles`
                                                     SET `first_name` = '".$_POST['fname']."',
                                                         `last_name` = '".$_POST['lname']."',
                                                         `residence` = '".$_POST['residence']."',
                                                         `avatar` = '".$_POST['avatar']."'
                                                     WHERE `user_id` =".$_SESSION['id']." ;
                                                    ") or die(mysql_error());
                            $result = mysql_query("UPDATE `users`
                                                     SET `GSM` = '".$_POST['GSM']."',
                                            ".$addition."
                                                         `gsm_viewable` = '".$_POST['gsm_view']."',
                                                         `skype` = '".$_POST['skype']."',
                                                         `skype_viewable` = '".$_POST['viewable']."',
                                                         `e-mail` = '".$_POST['email']."'
                                                     WHERE `id` =".$_SESSION['id']." ;
                                                    ") or die(mysql_error());
                            echo $lang['user_profile']['done']."<br />";
                            echo "<meta http-equiv='refresh' content='2'>";
                        }
                    }
                    if($_POST['stylecolor']) {
                        $query = "UPDATE `users` SET `design` = '".$_POST['stylecolor']."' WHERE `id` = ".$_SESSION['id'];
                        $result = mysql_query($query) or die("cant change design: ".mysql_error());
                        $_SESSION['design'] = $_POST['stylecolor'];
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                    if($_POST['language']) {
                        $query = "UPDATE `users` SET `lang` = '".$_POST['language']."' WHERE `id` = ".$_SESSION['id'];
                        $result = mysql_query($query) or die("cant change language: ".mysql_error());
                        $_SESSION['lang'] = $_POST['language'];
                        echo '<meta http-equiv="refresh" content="0">';
                    }
                    //--------^-Промени//показване-v-------
                    $result = mysql_query("SELECT * FROM profiles WHERE user_id='".$_SESSION['id']."'");
                    $row = mysql_fetch_array($result);

                    $result = mysql_query("SELECT * FROM users WHERE id='".$_SESSION['id']."'");
                    $users_row = mysql_fetch_array($result);

                    if($_SESSION['user'] == $users_row['username']) {
                        $dim = @getimagesize($row['avatar']);
                        if($dim[1] > $dim[0]){
                        if($dim[1] > "400")
                            $dim2 = ' height="400px"';
                        }
                        else{
                        if($dim[0] > "350")
                            $dim2 = ' width="350px"';
                        }
                        echo '<font size="5"><b>'.$lang['user_profile']['profile_settings'].'</b></font><br />';
                        echo '<form action="" method = "post" class="frm">';
                        echo '<table border="0" width="90%">';
                        echo '<tr><td rowspan="10" width="50%" align="center"><img src="'.$row['avatar'].'"'.$dim2.' alt=""></img></td>';
                        echo '<td width="20%" align="right">'.$lang['profile']['fname'].'</td><td><input type="text" value="'.$row['first_name'].
                            '" name="fname"></td></tr>';
                        echo '<tr><td align="right">'.$lang['profile']['lname'].'</td><td><input type="text" value="'.$row['last_name'].'" name="lname"></td></tr>';
                        echo '<tr><td align="right">'.$lang['profile']['gsm'].'</td><td><input type="text" value="'.$users_row['GSM'].
                            '" name="GSM"><input type="checkbox" name="gsm_view" value="YES"';
                        if($users_row['gsm_viewable'] == YES) echo 'checked';
                        echo '>'.$lang['user_profile']['skype_viewable'].'</td></tr>';
                        echo '<tr><td align="right">'.$lang['profile']['email'].'</td><td><input type="text" value="'.$users_row['e-mail'].'" name="email"></td></tr>';
                        echo '<tr><td align="right">'.$lang['profile']['skype'].'</td><td><input type="text" value="'.$users_row['skype'].
                            '" name="skype"><input type="checkbox" name="viewable" value="YES"';
                        if($users_row['skype_viewable'] == YES) echo 'checked';
                        echo '>'.$lang['user_profile']['skype_viewable'].'</td></tr>';
                        echo '<tr><td align="right">'.$lang['profile']['residence'].'</td><td><input type="text" value="'.$row['residence'].
                            '" name="residence"></td></tr>';
                        echo '<tr><td align="right">'.$lang['user_profile']['avatar'].'</td><td><textarea name="avatar" cols="30">'.$row['avatar'].
                            '</textarea></td></tr>';
                        echo '<tr><td align="center">'.$lang['user_profile']['pass1'].'</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$lang['user_profile']['pass2'].'</td></tr>';
                        echo '<tr><td><input type="password" name="pass1" autocomplete="off"></td><td><input type="password" name="pass2" autocomplete="off">&nbsp;<input type="submit" value="'.$lang['user_profile']['change'].'" name="btn_chng"></td></tr>';
                        echo '</table>';
                        echo '</form>';
                        echo '<font size="5"><b>'.$lang['user_profile']['global_settings'].'</b></font><br /><br />';
                        echo '<form action="" method="post">'.$lang['user_profile']['color'].': 
                                            <select name="stylecolor" onchange="this.form.submit()" style="width: 100px;">
                                                <option value="blue"';
                        if($_SESSION['design'] == "blue") echo " selected";
                        echo '>'.$lang['user_profile']['blue'].'</option>
                                                <option value="green"';
                        if($_SESSION['design'] == "green") echo " selected";
                        echo '>'.$lang['user_profile']['green'].'</option>
                                                <option value="red"';
                        if($_SESSION['design'] == "red") echo " selected";
                        echo '>'.$lang['user_profile']['red'].'</option>
                                                <option value="black"';
                        if($_SESSION['design'] == "black") echo " selected";
                        echo '>'.$lang['user_profile']['black'].'</option>
                                                <option value="yellow"';
                        if($_SESSION['design'] == "yellow") echo " selected";
                        echo '>'.$lang['user_profile']['yellow'].'</option>
                                            </select><br>';
                        echo $lang['user_profile']['language'].': 
                                            <select name="language" onchange="this.form.submit()" style="width: 100px;">
                                                <option value="bg"';
                        if($_SESSION['lang'] == "bg") echo " selected";
                        echo '>'.$lang['user_profile']['bg'].'</option>
                                                <option value="en"';
                        if($_SESSION['lang'] == "en") echo " selected";
                        echo '>'.$lang['user_profile']['en'].'</option>
                                            </select>
                                          </form>';
                    }
                } ?>
