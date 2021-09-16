<?php
ob_start();
session_start();
session_regenerate_id();
$setheader="";
$set_navbar_no="";
$language_is="";
$was = (isset($_GET["was"])) ? $_GET["was"]  : $was="default" ;
//if Default is already set need no condition 


if ($was=="Adduser"){
                     $page_titel="Add New User";
                     include "init.php";
                     $admins=$mycrud->fetch_tab($conn,"user",'1',"groupID");
                     ?>
                     <h1 class="edit-page-titel">Add Members Page</h1>
                        <form class="edit-form" action="?was=Adduser" method="post">
                        <div class="label-input">
                           <label for="">Email</label>
                           <input type="email" name="email" placeholder="<?php echo lang("email_placeholder") ?>" autocomplete="off" >
                        </div>
                        <div class="label-input">
                        <label for="">UserName</label>
                        <input type="text" name="username" placeholder="<?php echo lang("username_placeholder") ;?>"autocomplete="off" >
                        </div>
                        <div class="label-input">
                        <label for="">Password</label>
                        <input type="password" name="password" autocomplete="new-password" >
                        </div>
                        <div class="label-input">
                        <label for="">Verify Password</label>
                        <input type="password" name="verify_password" autocomplete="new-password" >
                        </div>
                        <div class="check-boxes">
                           <div class="form-check mb-2">
                              <input class="form-check-input" type="radio" name="who" id="admin" value="admin" >
                              <label class="form-check-label" for="admin">Admin</label>
                           </div>
                           <div class="form-check me-2">
                              <input class="form-check-input mb-3" type="radio" name="who" id="user" value="user" checked>
                              <label class="form-check-label" for="user">Working Under :</label>
                           </div>
                        </div>
                        <select name="stand_user" id="selcet_admin" class="myselect form-select form-select-sm" aria-label=".form-select-lg example">                        
                        <option value="none">No One</option>
                        <?php 
                              foreach($admins as $key => $value){
                                 echo '<option value="'.$value["id"].'">'.$value["username"].'</option>';
                              }
                           ?>
                        </select>                    
                        <input class="but-edit" type="submit" name="adduser" value="<?php echo lang("Add") ?>">
                     </form>

                     <?php
                      include "../includes/tamplates/footer.php";

                     if(($_SERVER['REQUEST_METHOD']==='POST') && isset($_POST["adduser"])){
                     
                     $email=filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
                     $username=filter_var($_POST["username"],FILTER_SANITIZE_SPECIAL_CHARS);
                     $selected_id_admin=filter_var($_POST["stand_user"],FILTER_SANITIZE_SPECIAL_CHARS);
                     $password= sha1(htmlspecialchars($_POST["password"]));
                     $error_add_account=array();
                     $error_add_account_duplicate=array();
// ========/>///fix select option here//


                     //deal with admin and user
                                 //get name of the choosed admin
                     foreach($admins as $key => $value){
                        if($selected_id_admin==$value["id"]){
                           $choosed=$value['username'];
                           break;
                        }else{ $choosed="No One";}
                     }
                              //check if id select option exisit and not missed up
                              $test_if_id_exisit=false;
                              foreach($admins as $index => $admin){
                                    if($selected_id_admin == $admin['id']){
                                       $test_if_id_exisit=true;
                                       break;
                                    }
                              }//end foreach
                              if($test_if_id_exisit==false && $selected_id_admin!="none" )
                              {$error_add_account [] = "Stop Missing Up With Me -__- !!!";}

                     //first way => to insiste
                     //  if($_POST['who']==="admin"&&$selected_id_admin==="none"){$groupid=1;$working_under=0;}

                     //  else if($_POST['who']==="user"&&$selected_id_admin!=="none"){$groupid=0;$working_under=intval($selected_id_admin);}

                     //  else if($_POST['who']==="user"&&$selected_id_admin==="none"){$error_add_account[]="You Must Choose An Admin";}

                     //  else{$error_add_account[]="You Can't be Admin and Working under ".$choosed." in the Same Time";}

                        //seconde way
                        if($_POST['who']==="admin"&&$selected_id_admin==="none"){$groupid=1;$working_under=0;}

                        else if($_POST['who']==="user"&&$selected_id_admin!=="none"){$groupid=0;$working_under=intval($selected_id_admin);}

                        else if($_POST['who']==="user"&&$selected_id_admin==="none"){$error_add_account[]="You Must Choose An Admin";}

                        elseif($_POST['who']==="admin"&&$selected_id_admin!=="none"){$groupid=1;$working_under=0;}
                        
                     

                     // ====================start check=====================
                     // //check if email and username are not empty
                     //if(empty($_POST["username"])){$error_add_account[]="UserName can't be empty"."<br>";}
                     //if(empty($_POST["email"])){$error_add_account[]="Email can't be empty"."<br>";}
                     //check if email is between 5 and 50 caracters   
                     if(!((strlen($_POST["email"])<50)&&strlen($_POST["email"])>5)){$error_add_account[]="Email Length Must Be Between 5 and 50 caracters"."<br>";}
                     //check if username is between 4 and 20 caracters   
                     if(!((strlen($_POST["username"])<20)&&strlen($_POST["username"])>4)){$error_add_account[]="Username Length Must Be Between 4 and 20 caracters"."<br>";}
                     //check if password match 
                     if(!($_POST["password"]===$_POST["verify_password"])){$error_add_account[]="Password Don't Match"."<br>";}
                     //check if password more than 8 caracters 
                     if(strlen($_POST["password"])<7){$error_add_account[]="Password Must be more than 8 caracteres"."<br>";}
                     // //check if password not empty
                     // if(strlen($_POST["password"])==0){$error_add_account[]="Password Can't Be Empty"."<br>";}
                     // ====================end check=====================

                     //if there is  error 
                     if(!empty($error_add_account)){

                           foreach ($error_add_account as $value) {
                                 echo $function->show_alert_div("alert-danger",$value);
                           }
                     }

                     //start test for  deplucate entry block
                     if($mycrud->check_if_in_db1($conn,"user","email",$email)){$error_add_account_duplicate[]= "This Email ".$email." is Used";};
                     if($mycrud->check_if_in_db1($conn,"user","username", $username)){$error_add_account_duplicate[]="This Username <b> ".$username." </b> is Used <br>";} 
                     //end test for  deplucate entry block




                     //start if finally there is no error
                     if(empty($error_add_account_duplicate)&&(empty($error_add_account))){
                     //"no error  ^__^ add new row
                     $msg=$mycrud->add_new_row_in_db2($conn,"user",$email,$password,$username,$working_under,$groupid);
                     $function->show_alert_div("alert-success",$msg);
                     header("Refresh:2;url=index.php");

                     
                     }

                     // if there is error
                     else{
                     foreach ($error_add_account_duplicate as $value) {
                     $function->show_alert_div("alert-danger",$value);
                     }   
                     }
                     //end if finally there is no error

                     }

//end adduser
}









else if ($was=="default" || $was=="check_log_in")  {
   // main log_in page    
   $show_body_color="yes";
   define("MAX_TRYES",3);///////////////////////////////set the Trys issue  which user can do 
   if (!isset($_SESSION['no_log_in_more'])){$_SESSION['no_log_in_more']=false;}
   if (!isset($_SESSION['wrong_trys'])){$_SESSION['wrong_trys']=0;}
   $page_titel="Log In";
   include "init.php"; 
   if(isset($_COOKIE["free_to_go"])) {
   $_SESSION['no_log_in_more']=true;
   }else{$_SESSION['no_log_in_more']=false;}

if(!isset($_SESSION['username'])){

               if(!$_SESSION['no_log_in_more']){
                  
                  ?>
           
<div class="log-in-body container  center-Y  ">
<div class="row">
   <div class="col-lg-3 col-md-2"></div>
   <div class="col-lg-6 col-md-8 login-box">
         <div class="col-lg-12 login-key">
            <i class="fa fa-key" aria-hidden="true"></i>
         </div>
         <div class="col-lg-12 login-title">
            ADMIN PANEL
         </div>
         <div class="col-lg-12 login-form">
            <div class="col-lg-12 login-form">
               <form method="post"  class="" action="?was=check_log_in">    
                     <div class="form-group">
                        <label   class="form-control-label">USERNAME</label>
                        <input name="username" type="text" class="form-control" required autocomplete="off">
                     </div>
                     <div class="form-group">
                        <label class="form-control-label">PASSWORD</label>
                        <input type="password" required autocomplete="new-password" name="password" class="form-control" i>
                     </div>

                     <div class="col-lg-12 loginbttm">
                        <div class="col-lg-6 login-btm login-text">
                           <!-- Error Message -->
                        </div>
                        <div class="col-lg-6 login-btm login-button">
                           <button class="btn btn-outline-primary"><a href="?was=Adduser">Sign Up</a></button>
                           <button type="submit" class="btn btn-outline-primary">LOGIN</button>
                        </div>
                        <a  class="mya" href="?was=forget_password">Forget Password ?</a>
                     </div>
               </form>
            </div>
         </div>
         <div class="col-lg-3 col-md-2"></div>
   </div>
</div>
</form>
<?php
}else{$function->show_alert_div("alert-danger mt-5","You Can't Log In Normaly But Only After ".($deny_log_in_time/3600)." H But Try With Forget Password Or Make New Account ");}
?>

<!-- // my work -->
<!-- 
<form method="post"  class="form-login center-Y" action="?was=check_log_in">
   <input type="text" name="username" id="" placeholder="" required autocomplete="off">  
   <input type="password" name="password" id="" placeholder=" required autocomplete="new-password">  
   <div class="all_btn">
      <button type="submit" class="color_white">></button>
      <button type="submit" class="mx-3"><a href="?was=Adduser">Sign Up</a></button>
   </div>
   <a href="?was=forget_password">Forget Password</a>
</form>    -->

<?php
      
      if($was=="check_log_in"){
               if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["username"]) && isset($_POST["password"])){
                     //filtration of the inputs field + hashing password  
                     $username =filter_var($_POST["username"],FILTER_SANITIZE_STRING);
                     $password= sha1(htmlspecialchars($_POST["password"]));
                     // fetch spezifische Spalten
                     define('USER_ROW',$mycrud->log_in_check($conn,"id,username,working_under","user","username","password",$username,$password));
                     var_dump(USER_ROW);

                     if( count(USER_ROW)>0){
                              $_SESSION["username"]=USER_ROW[0]["username"];
                              $_SESSION["userid"]=USER_ROW[0]["id"];
                              $_SESSION["showcolor"]="No";
                              // $_SESSION["approved"]=USER_ROW[0]["approved"];
                              // $_SESSION["user_group_id"]=USER_ROW[0]["groupID"];
                              if(USER_ROW[0]["working_under"]!='0'){$_SESSION["derman"]=USER_ROW[0]["working_under"];}
                              $_SESSION['wrong_trys']=0;
                              header("Location:log_in.php");
                              exit;
                           }else{
                              //wrong pass or username
                              $_SESSION['wrong_trys']++;
                              if(MAX_TRYES - $_SESSION['wrong_trys']<0){
                                 $function->show_alert_div("alert-danger","you probably forgot your account");
                                 setcookie("free_to_go","no", time() + ($deny_log_in_time), "/");
                                 $_SESSION['wrong_trys']=0;
                                 header("Refresh:2");
                              }else{
                                 $function->show_alert_div("alert-danger","Wrong Username or Password Left Tryes is ".MAX_TRYES-$_SESSION['wrong_trys']);}
                              
                              }
                              

                  
               }else {header("Location:log_in.php");}
               }
               
         
}else{
//You have Been logged in
header("Location:index.php");
                              }

// end log_in page   
}





//if forgert password
else if ($was=="forget_password"){
$setheader="";
$set_navbar_no="";
$language_is="";
$page_titel="Password Recovery";
include "init.php";
echo ' <div class="container"> 
         <form class="myform flex-derection-v row mt-5" action="?was=forget_password" method="post">
               <div class="col-lg-5 mb-3">
                  <input required type="email" class=" form-control" name="email" placeholder="Write Your Email To Get New Pasword">
               </div>
               <div class="col-lg-5 mb-3">
                  <input type="submit" value="Sent Code" class="color_white btn btn-info form-control" name="submite" >
               </div>
         </form>
      <div>';   

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               // $_SESSION["show_forget_password"]="No";
                  $email=filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
                  //check if email is empty
                  $empty_eroor=$function->check_required_input_fields ([$email],"Write Your Email !");
                     if(count($empty_eroor)!=0){ $function->show_alert_div("alert-danger mt-5",$empty_eroor[0]);
                     }else{               
                           $req=$mycrud->fetch_tab($conn,"user",$email,"email");
                              if(count($req)!=0){
                                 //if every Things is fine
                                 require_once "../MailPackage/mailer.php";
                                 $random = substr(md5(mt_rand()), 0, 7);
                                 //set random string in db
                                 $mycrud->modify_column_in_db($conn,"user","email_code",$random,"email",$email);
                                 $body="Your Access Code is : <b>".$random."</b>";
                                 echo $function->show_alert_div("alert-success mt-5",mailing([$email,"saifxt0000@gmail.com"],$body));
                                 $_SESSION["change_email"]=$email;
                                 header( "refresh:2 ;url=?was=verify_code" );
                                    
                              }else{
                                 echo $function->show_alert_div("alert-danger mt-5","Worng Email !");
                                 }
                                       
                     }
               



         //end if post
            }
//end forget password
}





//verify code , that is sent per Email
else if ($was=="verify_code"){
//showing the verifying page Form
               if  (isset($_SESSION["change_email"]) && $_SESSION["change_email"]!=""){       
                           $page_titel="Verify Password";
                           include "init.php";
                           echo ' <div class="container"> 
                                    <form class="myform  flex-derection-v row mt-5" action="?was=check_code" method="post">
                                          <div class="col-lg-5 mb-3">
                                             <input required type="text" class=" form-control" name="code" placeholder="Type The Code...">
                                          </div>
                                          <div class="col-lg-5 mb-3">
                                             <input type="submit" value="Set New Passowrd" class="color_white btn btn-warning form-control" name="submite" >
                                          </div>
                                    </form>
                                 <div>';          
            }else{
                  header("Location:?was=forget_password");
               }
//end verify code , that is sent per Email  
}















else if ($was=="check_code"){
   if ($_SERVER['REQUEST_METHOD'] === 'POST' && ( isset($_SESSION["change_email"]) && $_SESSION["change_email"]!="")  && (isset($_POST["code"]) && $_POST["code"]!="" )) {
      $page_titel="Check Code";
                     include "init.php";
                     $code=filter_var($_POST["code"],FILTER_SANITIZE_STRING);
                     // check if code is in db
                        if($mycrud->check_if_in_db_tow_condition($conn,"user","email",$_SESSION["change_email"],"email_code",$code)){
                           echo ' <div class="container"> 
                                       <form class="myform  flex-derection-v row mt-5" action="?was=set_new_pass" method="post">
                                                <div class="col-lg-5 mb-3">
                                                   <input required type="text" class=" form-control" name="p1" placeholder="Set New Passowrd ">
                                                </div>
                                                <div class="col-lg-5 mb-3">
                                                   <input required type="text" class=" form-control" name="p2" placeholder="Verify Your Password">
                                                </div>
                                                <div class="col-lg-5 mb-3">
                                                   <input type="submit" value="Update" class="color_white btn btn-success form-control" name="submite" >
                                                </div>
                                             </form>
                                  <div>';       
                                    //if the submit of passwords is pressed      
                        }else{
                           //if code don't match
                           $function->show_alert_div("alert alert-danger mt-5 ","Wrong Code !");
                           header("Refresh:2; url = ?was=verify_code");
                        }
      //if not Post     
      }else{ header('Location:?was=forget_password');} 
}





else if ($was='set_new_pass'){
   if ( isset($_POST['p1']) && isset($_POST['p2']) && $_SERVER['REQUEST_METHOD'] === 'POST' && ( isset($_SESSION["change_email"]) && $_SESSION["change_email"]!="") ) {
      $page_titel="Set New Password";
         include "init.php";
   $p1=filter_var($_POST["p1"],FILTER_SANITIZE_STRING);
   $p2=filter_var($_POST["p2"],FILTER_SANITIZE_STRING);
         $error_add_pass=[];
         //check if password match 
         if(!($p1===$p2)){$error_add_pass[]="Password Doesn't Match";}
         //check if password more than 8 caracters 
         if(strlen($p1)<7||strlen($p2)<7){$error_add_pass[]="Password Must be more than 8 caracteres";}
      if(count($error_add_pass)==0){
         // change the passowrd
               $p1=sha1($p1);
               $msg=$mycrud->change_Password($conn,'user',$p1,$_SESSION["change_email"]);
               echo $function->show_alert_div("alert alert-success mt-5",$msg);      
               header('Refresh:2; url= log_out_page.php'); 
      }else{
        //if not matched password 
   echo ' <div class="container"> 
            <form class="myform  flex-derection-v row mt-5" action="?was=set_new_pass" method="post">
                     <div class="col-lg-5 mb-3">
                        <input required type="password" class=" form-control" name="p1" placeholder="Set New Passowrd ">
                     </div>
                     <div class="col-lg-5 mb-3">
                        <input required type="password" class=" form-control" name="p2" placeholder="Verify Your Password">
                     </div>
                     <div class="col-lg-5 mb-3">
                        <input type="submit" value="Update" class="color_white btn btn-success form-control" name="submite" >
                     </div>
                  </form>
           <div>';       
         foreach ($error_add_pass as $err){echo $function->show_alert_div("alert alert-danger mt-5",$err);}
 
      }

   //if somthing Wrong or is been missed
   }else{header('Location:log_out_page.php');}


//end set new password
}











//=================================================================================================
//end all  get checks
//if missing with the url
else{
header("Location:log_in.php");
}

// if want to show footer
// include $tmplate_path."footer.php";
ob_end_flush();

?>














