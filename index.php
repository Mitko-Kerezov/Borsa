<?php 
function za6titi($tekst){ 
	if ((int)$tekst)
		return $tekst; 
	else{ 
		$tekst = @addslashes($tekst);
		$tekst = @htmlspecialchars($tekst, ENT_NOQUOTES); 
		return $tekst; 
	} 
}
session_start();

$phpself = basename(__file__);
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],$phpself)).$phpself;
$_GET = array_map("za6titi", $_GET); 
$_POST = array_map("za6titi", $_POST); 
$_SESSION = array_map("za6titi", $_SESSION); 
$_COOKIE = array_map("za6titi", $_COOKIE); 
$_SERVER = array_map("za6titi", $_SERVER); 

include_once "config.php";
include "Header.php";
if ( isset($_GET["pages"]))
	$pages = $_GET["pages"];
if(isset($pages))
    $pages = str_replace(".","/",$pages);
else
    $pages = "last";

@include "Pages/".$pages.".php";
include "Footer.php"; 

?>