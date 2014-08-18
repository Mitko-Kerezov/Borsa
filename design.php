<?php
session_start();
?>
body{
  text-align: center;
  background-image:url("pics/designs/<?php echo $_SESSION['design']; ?>/backgr_div.jpg");
  background-attachment: fixed;
  background-position: bottom;
  background-repeat: no-repeat;
}
div.main{
  border: 0px solid <?php echo $_SESSION['design']; ?>;  
  width: 1000px;
}
div.header{
  background-image: url("pics/designs/<?php echo $_SESSION['design']; ?>/coltit.png");
  border: 0px solid;
  border-color: yellow;
  height: 140px;
  width: 100%;
  background-position: top;
  background-repeat: repeat-y;
  border-radius: 20px; 
  -moz-border-radius: 20px;
}
div.footer{
  float: left;
  margin-top: 5px;
  background-image:url("pics/designs/<?php echo $_SESSION['design']; ?>/coltit.png");
  border: 0px solid;
  border-color: red; 
  height: 80px; 
  width: 100%;
  background-position: top;
  background-repeat: repeat-y;  
  border-radius: 20px; 
  -moz-border-radius: 20px;
}
div.menu{
  text-align: left;
  text-indent: 10px;
  float: left;
  border: 0px solid aqua;
  color: #406624;
  width: 157px;
  height: 500px;
  margin-left: 0px;
  margin-top: 5px;
  padding-left: 5px;
  background-image:url("pics/designs/<?php echo $_SESSION['design']; ?>/div_menu.png");
  background-position: top;
  background-repeat: repeat-y;
  border-radius: 20px; 
  -moz-border-radius: 20px;
}
div.right{
  float: right;
  border: 0px solid blue;
  width: 833px;
  height: 500px;
  margin-right: 0px;
  margin-top: 5px;
  background-image: url("pics/designs/<?php echo $_SESSION['design']; ?>/div_right.png");
  background-position: top;
  background-repeat: repeat-y;
  border-radius: 20px; 
  -moz-border-radius: 20px;
}
a.link{
  text-decoration: none; 
  background-image: url(pics/designs/<?php echo $_SESSION['design']; ?>/menu.png); 
  font-size: 17px; 
  color: white; 
  display: block; 
  line-height: 32px;
  width: 150px;
}
a.link:hover{
  text-decoration: none; 
  background-image: url(pics/designs/<?php echo $_SESSION['design']; ?>/menu_h.png);  
  color: yellow; 
  display: block; 
  line-height: 32px; 
  width: 150px;
}
a.down{
  text-decoration: none; 
  background-image: url(pics/designs/<?php echo $_SESSION['design']; ?>/menu_d.png); 
  font-size: 17px; 
  color: white; 
  display: block; 
  line-height: 32px;
  width: 150px;
}
div.login  a{ 
  text-decoration: none; 
  background-image: url(pics/designs/<?php echo $_SESSION['design']; ?>/menu_l.png); 
  font-size: 17px; 
  color: white; 
  display: block; 
  line-height: 32px; 
  width: 150px;
}

div.login  a:hover{ 
  text-decoration: none; 
  color: yellow; 
  display: block; 
  line-height: 32px; 
  width: 150px;
}
td{
  border-color: <?php echo $_SESSION['design']; ?>;
}
table{
  border-color: <?php echo $_SESSION['design']; ?>;
}
div.avatar{
  border: 0px solid red;
  float: right;
  text-align: right;
  height: 120px;
  width: 230px;
  margin-top: 5px;
  margin-right: 10px;
}
div.login{
  border: 0px solid <?php echo $_SESSION['design']; ?>;
  text-align: center;
  float: left;
  height: 120px;
  width: 150px;
  margin-top: 5px;
  margin-left: 0px;
}
div.title{
    width: auto; 
    border: 0px solid red; 
    text-align: center;
}