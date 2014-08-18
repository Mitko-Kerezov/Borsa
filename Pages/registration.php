<?php 
if($_SESSION['user']){
echo $lang['login_error'];
?>
    <script type='text/javascript'>setTimeout('window.location="index.php"', '3000')</script>
<?php
}
else{
    ?>
<script type="text/javascript" src="ajax.js"></script>
<?php
//----------------------------------
if($_POST['btn32']){
    $user = $_POST['user'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $email = $_POST['email'];
    $sub_form = true;
    @include("reg_check.php");
    if(username($user)==false){
        $err_msg = $lang['reg']['error_usrnm'];
        $user = "";
        $sub_form = false;
    }
    if(pass($pass1, $pass2)==false){
        $err_msg = $lang['reg']['error_passwd'];
        $sub_form = false;
    }
    if(mail_check($email)==false){
        $err_msg = $lang['reg']['error_mail'];
        $sub_form = false;
    }
} 
else{
    $sub_form = false;
}

    if($sub_form==false){
        echo '<center><b>';
        if ($err_msg){
            echo '<center><h3 style="color:red;">'.$err_msg.'</h3></center>';
    	}
    ?>

        <form action="" method = "post" class="frm">
            <input type = "hidden" name="pages" value="registration">

	    <?php echo $lang['login']['usernm']; ?>: <span id="check_user"></span><br>
            	<input type="text" name="user" value="<?php print $user; ?>" id="username"><br>

	    <?php echo $lang['login']['pass']; ?>: <span id="check_pass"></span><br>
            	<input type="password" name="pass1" id="pass1"><br>

  	    <?php echo $lang['reg']['pass_confirm']; ?>:<br>
            	<input type="password" name="pass2" id="pass2"><br>

	    <?php echo $lang['profile']['email']; ?>: <span id="check_email"></span><br>
                <input type="text" name="email" value="<?php print $email; ?>" id="email"><br>

            <input type = "submit" value = "<?php echo $lang['reg']['register']; ?>" name="btn32">

        </form>
    </b>

<?php
} else {
    $result = mysql_query("INSERT INTO users (`username`, `password`, `user_type`, `e-mail`) 
			          VALUES ('".$user."', '".md5($pass1)."', 'USER', '".$email."') ") or die(mysql_error());
    $result = mysql_query("SELECT id FROM users WHERE username='".$user."'") or die(mysql_error());
    $res = mysql_fetch_array($result);
    
    $result = mysql_query("INSERT INTO profiles (`user_id`) VALUES ('".$res[0]."') ");
?>
<center>
    <h2><?php echo $lang['reg']['success']; ?></h2>
</center>
<?php } } ?>
</b>