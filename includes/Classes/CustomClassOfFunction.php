<?php

class AllFunction{




public function set_currency_in_cookies() {
                    
                $jageld=array("TND","USA","EURO"); 
                if (isset($_GET["currency"])&&(in_array($_GET["currency"],$jageld))){
                setcookie("currency", $_GET["currency"], time()+9999); 
                header("Refresh:0; url=?was=add");
                }else if (!isset($_COOKIE['currency'])) { 
                setcookie("currency", "TND", time()+9999); 
                }

}


/*get and set page titel for the page function V 1.0
**Deufault Page
** write  Your prefered Titel of the page on the top of page in this variabel
** =====> $page_titel
*/ 
function getTitel($page_titel){if (isset($page_titel)){echo $page_titel;}else{echo "write page titel Page";}}



 function formatSizeUnits($bytes){
    if      ($bytes >= 1073741824) { $bytes = ($bytes / 1073741824).toFixed(2) . " GB"; }
    else if ($bytes >= 1048576)    { $bytes = ($bytes / 1048576).toFixed(2) . " MB"; }
    else if ($bytes >= 1024)       { $bytes = ($bytes / 1024).toFixed(2) . " KB"; }
    else if ($bytes > 1)           { $bytes = $bytes . " bytes"; }
    else if ($bytes == 1)          { $bytes = $bytes . " byte"; }
    else                          { $bytes = "0 bytes"; }
    return $bytes;
}








// return array of errros
public function Controle_upload_file($file_field_name,$max_photo_uploading_size=10485760,$allow_exts=["JPG","GIF","PNG","JPEG"],$request_type="POST"){
    //fix bytes shows
    $errors=array();
    if($_SERVER['REQUEST_METHOD'] == $request_type && isset($_FILES[$file_field_name])){
                $name=$_FILES[$file_field_name]["name"];
                $size=$_FILES[$file_field_name]["size"];
                $type_file=explode("/",$_FILES[$file_field_name]["type"]);
                $type=strtoupper(end($type_file));
                    $tmp_name=$_FILES[$file_field_name]["tmp_name"];
    //check if user choosed a photo
    if(empty($size)){
    $errors[]="You Must Choose A Photo ";

    }
    else{
                    if(! in_array($type,$allow_exts)){
                        $errors[]="Invalid File Format Must Be ".implode(",",$allow_exts);
                    }
                    if($size>$max_photo_uploading_size){
                        // $errors[]="Too Large File the Size Must be under ".formatSizeUnits($max_photo_uploading_size)." Your File is ".formatSizeUnits($size);
                        $errors[]="Too Large File the Size Must be under ". $max_photo_uploading_size." Bytes";

                    }

                    
        }

    }else{$errors[]="Somthing Went Wrong";}
    
    return $errors;
//end function
}

// return array of errros
public function check_required_input_fields ($inputs,$msg="You Must Fill In All Fields")  {
    $errors=array();
     foreach($inputs as $input){
        
        if(empty($input)){
            $errors[]=$msg;
            break;
        }
}  
 return $errors;  

}







// return string of errro
public function check_required_input_fields_return_string($inputs,$msg="You Must Fill In All Fields")  {
    $error="";
    foreach($inputs as $input){
        if(empty($input)){
            $error=$msg;
            break;}
    }  
 return $error;  

}





    public function show_alert_div($alert_class,$msg){
  echo '<div class="alert '.$alert_class.' text-center" role="alert">'.$msg.'</div>';
}




public function get_id_colmn($id){
  return  (isset($id) && is_numeric($id)) ? intval($id) : -103 ; 
} 

public function password_check($a,$b){
    $r=($a==$b) ?   true :  false ;
    return $r;
  } 
  


//return msg error if switch is value that i don't expect
//** $values must be an array
public function check_if_switch_btn_misssed_up($switch_input,$values,$msg="Switch Input Was Missed up"){
    $test=false;
    foreach($values as $value){
        if($switch_input != $value){
            $test = true ;
            break ;
        }
    }//end for each
    if($test){return $msg;}else{return "";}
} 
  











//end class
}







