<?php
//Genearale variable
$deny_log_in_time=86400;//24 houres
$allcurrency=["TND","EURO","USA"];



//routers
$js_path="../layout/js/";
$css_path="../layout/css/";
$tmplate_path="../includes/tamplates/";
$connect_to_database_path="../includes/connect_to_database/";
$Classes_path="../includes/Classes/";
$lang_path="../includes/languages/";

include $connect_to_database_path."connect.php";
include $Classes_path."CustomClassOfFunction.php";
include $Classes_path."class_sql.php";

$mycrud = new Crud();
$function = new AllFunction();






//make the choosen Lunaguage in the cokies + security

if(isset($_GET["lang"])){
    switch($_GET["lang"]){
     case "english": $language_is=$_GET["lang"];setcookie("language",$_GET["lang"],time()+3600 );break;
     case "germany": $language_is=$_GET["lang"];setcookie("language",$_GET["lang"],time()+3600 );break;
     //add other lunguage here
     default:if( isset($_COOKIE["language"])){$language_is=$_COOKIE["language"];}break;
    }
}else{if(isset($_COOKIE["language"])){$language_is=$_COOKIE["language"];}else{$language_is="english";}}





// include the language file depending on the variabel and set up the lungauge
if(isset($language_is)){

    switch($language_is){
    case "english":  include $lang_path."english.php";
    break;
    case "germany":  include $lang_path."germany.php";
    break;
    }

}else{
 include $lang_path."english.php";
}   
//end including lunguage file




if(isset($setheader)){
// include the first section of page like header and navbar
include $tmplate_path."header.php";
}
// if(isset($set_navbar)){include $tmplate_path."navbar.php";}









//set type currency in a cookie
$function->set_currency_in_cookies();
//end

















?>