<?php

class Crud {



public function verif_log_in(){
    if(isset($_SESSION["user"])&&! empty($_SESSION["user"])){
        return true;
    }else {
        return false;
    }
}



public function add_new_cat($conn,$user_id,$titel,$desc,$staus){

$q="INSERT INTO categories
( added_by ,cat_name , cat_desc , cat_status)
VALUES
(:added_by,:cat_name,:cat_desc,:cat_status)";
$stat=$conn->prepare($q);
$stat->bindValue(':added_by',$user_id);
$stat->bindValue(':cat_name',$titel);
$stat->bindValue(':cat_desc',$desc);
$stat->bindValue(':cat_status',$staus,PDO::PARAM_INT);
if( $stat->execute()){
return 'New Category Added Sussecfully';}
}



 public function add_new_item($conn,$user_id){
// need to make constraint here
$img_name=$_FILES["image"]["name"];

$img_name_no_type=explode(".",$_FILES["image"]["name"])[0];

$ay=explode("/",$_FILES["image"]["type"]);
$img_type=end($ay);

$img_size=$_FILES["image"]["size"]; 

$titel=filter_var($_POST['prod_name'],FILTER_SANITIZE_STRING);
$desc=filter_var($_POST['prod_desc'],FILTER_SANITIZE_STRING);
$price=filter_var($_POST['prod_price'],FILTER_SANITIZE_NUMBER_INT);
$cat=filter_var($_POST['categorie'],FILTER_SANITIZE_NUMBER_INT);
$currency=filter_var($_COOKIE["currency"],FILTER_SANITIZE_STRING);

        $dir="../Users_Info/Id_User_Nr".$user_id."/images";
        $new_photo_link=$dir."/".str_shuffle($img_name_no_type).rand(1,1000000000000).".".$img_type;
        $file_tmp=$_FILES["image"]["tmp_name"];
        // move_uploaded_file($file_tmp,$new_photo_link);
        $q="INSERT INTO items
             ( user_id ,cat_id, item_titel , item_desc, item_price,item_currency, item_photo, item_status)
             VALUES
             (:user_id,:cat_id, :item_titel, :item_desc,:item_price,:item_currency,:item_photo, :item_status)";
        $stat=$conn->prepare($q);
        $stat->bindValue(':user_id',$user_id);
        $stat->bindValue(':cat_id',$cat);
        $stat->bindValue(':item_titel',$titel);
        $stat->bindValue(':item_desc',$desc);
        $stat->bindValue(':item_price',$price);
        $stat->bindValue(':item_currency',$currency);
        $stat->bindValue(':item_photo',$new_photo_link);
        $stat->bindValue(':item_status',1);
        if( $stat->execute()){
            if (  !is_dir( $dir ) ) {
            mkdir("../Users_Info/Id_User_Nr".$user_id,0766 ); 
            mkdir("../Users_Info/Id_User_Nr".$user_id."/images",0766 );   
           }
           move_uploaded_file($file_tmp,$new_photo_link);
           echo '<div class="alert alert-success text-center mt-5 mb-5 p-5" role="alert">New Item Added Sussecfully</div>';
        }
    
    }






    public function add_new_item_not_admin($conn,$user_id,$admin_id,$cat_id){
        // need to make constraint here
        
        $img_name=$_FILES["image"]["name"];
        
        $img_name_no_type=explode(".",$_FILES["image"]["name"])[0];
        
        $ay=explode("/",$_FILES["image"]["type"]);
        $img_type=end($ay);
        
        $img_size=$_FILES["image"]["size"]; 

        $titel=filter_var($_POST['prod_name'],FILTER_SANITIZE_STRING);
        $desc=filter_var($_POST['prod_desc'],FILTER_SANITIZE_STRING);
        $price=filter_var($_POST['prod_price'],FILTER_SANITIZE_NUMBER_INT);
        $currency=filter_var($_COOKIE["currency"],FILTER_SANITIZE_STRING);
        
                $dir="../Users_Info/Id_User_Nr".$user_id."/images";
                $new_photo_link=$dir."/".str_shuffle($img_name_no_type).rand(1,1000000000000).".".$img_type;
                $file_tmp=$_FILES["image"]["tmp_name"];
                $q="INSERT INTO items
                     ( user_id ,cat_id, this_user_works_under , item_titel , item_desc,item_price,item_currency, item_photo)
                     VALUES
                     (:user_id,:cat_id,:this_user_works_under, :item_titel, :item_desc,:item_price,:item_currency,:item_photo)";

                $stat=$conn->prepare($q);
                $stat->bindValue(':user_id',$user_id);
                $stat->bindValue(':cat_id',$cat_id);
                $stat->bindValue(':item_titel',$titel);
                $stat->bindValue(':item_desc',$desc);
                $stat->bindValue(':item_price',$price);
                $stat->bindValue(':this_user_works_under',$admin_id);
                $stat->bindValue(':item_currency',$currency);
                $stat->bindValue(':item_photo',$new_photo_link);
                
                if( $stat->execute()){
                    if (  !is_dir( $dir ) ) {
                    mkdir("../Users_Info/Id_User_Nr".$user_id,0766 ); 
                    mkdir("../Users_Info/Id_User_Nr".$user_id."/images",0766 );   
                   }
                   move_uploaded_file($file_tmp,$new_photo_link);
                   echo '<div class="alert alert-success text-center mt-5 mb-5 p-5" role="alert">New Item Added Sussecfully</div>';
                }
            
            }
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    
        
// here i can add any condition to $tab
    public function fetch_tab_admin($conn,$userid){
        $q="SELECT * FROM items WHERE  this_user_works_under= ".$userid." OR  user_id = " .$userid." ORDER BY user_id" ;
        $stat=$conn->prepare($q);
        $stat->execute();
        $data = $stat->fetchAll(PDO::FETCH_ASSOC); 
        return $data;  
    }

    public function fetch_tab_admin_item_categories($conn,$userid){
        $q="SELECT * FROM items
            INNER JOIN categories
            ON items.cat_id = categories.cat_id 
            AND  (items.this_user_works_under= ".$userid."
            OR  items.user_id = " .$userid.")
            ORDER BY items.user_id" ;
        $stat=$conn->prepare($q);
        $stat->execute();
        $data = $stat->fetchAll(PDO::FETCH_ASSOC); 
        return $data;  
    }

    public function fetch_tab_user_item_categories($conn,$userid){
        $q="SELECT * FROM items
            INNER JOIN categories
            ON items.cat_id = categories.cat_id 
            AND  items.user_id = ".$userid ; 
            
        $stat=$conn->prepare($q);
        $stat->execute();
        $data = $stat->fetchAll(PDO::FETCH_ASSOC); 
        return $data;  
    }


    public function fetch_tab($conn,$tab,$userid,$column_Userid="user_id",$witch_column="*"){
        $q="SELECT ".$witch_column." FROM ".$tab." WHERE ".$column_Userid." = :val" ;
        $stat=$conn->prepare($q);
        $stat->bindValue(":val",$userid );
        $stat->execute();
        $data = $stat->fetchAll(PDO::FETCH_ASSOC); 
        return $data;  
    }
    
    public function fetch_tab_with_join($conn,$tab,$userid,$column_Userid="user_id",$witch_column="*"){
        $q="SELECT ".$witch_column." FROM ".$tab." "." 
        INNER JOIN items 
        ON ".$tab.".cat_id = items.cat_id AND ( $tab.".$column_Userid." = :val 
        OR this_user_works_under = :val )" ;
        
        $stat=$conn->prepare($q);
        $stat->bindValue(":val",$userid );
        $stat->execute();
        $data = $stat->fetchAll(PDO::FETCH_ASSOC); 
        return $data;  
    }

public function fetch_tab_items($conn,$user_id,$witch_column="*"){
$q="SELECT * FROM items 
    INNER JOIN categories 
    ON items.cat_id = categories.cat_id 
    AND ( items.user_id = :val 
    OR items.this_user_works_under = :val)";

    $stat=$conn->prepare($q);
    $stat->bindValue(":val",$user_id);
    $stat->execute();
    $data = $stat->fetchAll(PDO::FETCH_ASSOC); 
    return $data;  
}

public function fetch_tab_items_user($conn,$user_id,$witch_column="*"){
    $q="SELECT * FROM items 
        INNER JOIN categories 
        ON items.cat_id = categories.cat_id 
        AND items.user_id = :val ";
    
        $stat=$conn->prepare($q);
        $stat->bindValue(":val",$user_id);
        $stat->execute();
        $data = $stat->fetchAll(PDO::FETCH_ASSOC); 
        return $data;  
    }
  


public function fetch_tab_user_managing($conn,$myid){
    $q="select * from user WHERE working_under=".$myid." AND groupID=0" ;
    $stat=$conn->prepare($q);
    $stat->execute();
    $data = $stat->fetchAll(PDO::FETCH_ASSOC); 
    return $data;  
}


public function fetch_tab_categories_user($conn,$admin_id){
    $q="select * from categories WHERE added_by= :myid ";
    $stat=$conn->prepare($q);
    $stat->bindValue(":myid",$admin_id);
    $stat->execute();
    $data = $stat->fetchAll(PDO::FETCH_ASSOC); 
    return $data;  
}




    // here i can add any condition to $tab
    public function fetch_tab2($conn,$tab,$userid,$item_id){
        $q="select * from ".$tab." WHERE (this_user_works_under= ".$userid." OR user_id = ". $userid.") AND item_id= ".$item_id ;
        $stat=$conn->prepare($q);
        $stat->execute();
        $data = $stat->fetchAll(PDO::FETCH_ASSOC); 
        return $data;  
    }

    

//================================================================================
    /*check for for duplicate entry function V 1.0
** $column=>>which column you want to find 
** $conn===>Your PDO object 
** $data==>the data to be checked
** $tabel====>the name of your Table
** you must filter all your input field
** if the entered informations are present then will give True
*/ 
public function check_if_in_db($conn,$tabel,$column,$data,$userid=0){
    $query="SELECT * FROM ".$tabel." WHERE ".$column."= :data AND user_id = ". $userid;
    $get=$conn->prepare($query);
    $get->bindValue(':data', $data);
    $get->execute();
    $row=$get->rowCount();
    if($row==0){return false;}
    else{return true ;}
    
}

public function check_column_in_db_2_condition($conn,$tabel,$column,$data,$column_userid,$userid,$msg="You Inserted Somthing Like This"){
    $query="SELECT * FROM ".$tabel." WHERE ".$column."= :data AND ". $userid." = :id";
    $get=$conn->prepare($query);
    $get->bindValue(':data', $data);
    $get->bindValue(':id',$userid);
    $get->execute();
    $row=$get->rowCount();
    if($row==0){return "";}
    else{return $msg ;}
    
}




public function check_if_in_db_admin($conn,$tabel,$column,$data,$userid=0){
$query="SELECT * FROM ".$tabel." WHERE ".$column."= :data AND (this_user_works_under= ".$userid." OR user_id = ". $userid.")";
$get=$conn->prepare($query);
$get->bindValue(':data', $data);
$get->execute();
$row=$get->rowCount();
if($row==0){return false;}
else{return true ;}
}


public function check_if_column_in_db_admin($conn,$tabel,$column,$data,$usercolumn,$user_id){
$query="SELECT * FROM ".$tabel." WHERE ".$column."= :data AND  ".$usercolumn." = :id";
$get=$conn->prepare($query);
$get->bindValue(':data', $data);
$get->bindValue(':id', $user_id);
$get->execute();
$row=$get->rowCount();
if($row==0){return false;}
else{return true ;}
}
    



public function check_if_user_in_db_admin($conn,$tabel,$column,$data,$userid){
    $query="SELECT * FROM ".$tabel." WHERE ".$column."= :data AND (working_under= ".$userid." OR id = ". $userid.")";
    $get=$conn->prepare($query);
    $get->bindValue(':data', $data);
    $get->execute();
    $row=$get->rowCount();
    if($row==0){return false;}
    else{return true ;}
    
}




public function check_if_in_db1($conn,$tabel,$column,$data){
    $query="SELECT * FROM ".$tabel." WHERE ".$column."= :data";
    $get=$conn->prepare($query);
    $get->bindValue(':data', $data);
    $get->execute();
    $row=$get->rowCount();
    if($row==0){return false;}
    else{return true ;}
    
}

public function check_if_in_db_tow_condition($conn,$tabel,$column,$data,$column2,$data2){
    $query="SELECT * FROM ".$tabel." WHERE ".$column."= :data AND ".$column2." = :data2";
    $get=$conn->prepare($query);
    $get->bindValue(':data', $data);
    $get->bindValue(':data2', $data2);
    $get->execute();
    $row=$get->rowCount();
    if($row==0){return false;}
    else{return true ;}
    
}
//================================================================================


 /*delete from database function V 1.0
** $column=>>which column you want to find 
** $conn===>Your PDO object 
** $condition==>under witch condion will delete 
** $tabel====>the name of your Table
** you must filter all your input field
*/ 
    public function delete_form_db($conn,$table,$condition_column,$condition_data,$userid){
        $query="DELETE  FROM ".$table." WHERE ".$condition_column."= :data AND user_id= ".$userid;
        $get=$conn->prepare($query);
        $get->bindValue(':data', $condition_data);
        if($get->execute()){return true;}


}

public function delete_form_db_admin($conn,$table,$condition_column,$condition_data,$userid){
    $query="DELETE  FROM ".$table." WHERE ".$condition_column."= :data AND (this_user_works_under= ".$userid." OR user_id = ". $userid.")";
    $get=$conn->prepare($query);
    $get->bindValue(':data', $condition_data);
    if($get->execute()){return true;}

}

public function delete_user_form_db($conn,$table,$condition_column,$condition_data){
    $query="DELETE  FROM ".$table." WHERE ".$condition_column."= :data" ;
    $get=$conn->prepare($query);
    $get->bindValue(':data', $condition_data);
    if($get->execute()){return true;}
}

public function delete_column_form_db_2_condition($conn,$table,$condition_column,$condition_data,$user_column,$user_id){
    $query="DELETE  FROM ".$table." WHERE ".$condition_column."= :data AND ".$user_column." = :id " ;
    $get=$conn->prepare($query);
    $get->bindValue(':data', $condition_data);
    $get->bindValue(':id',$user_id);
    if($get->execute()){return true;}
}


//================================================================================

    public function add_new_row_in_db($conn,$tabel,$email,$password,$username){
    $query='INSERT INTO '.$tabel.' ( email, password, username) VALUES (:e,:p,:username)';
    $get=$conn->prepare($query);
    $get->bindValue(":e",$email);
    $get->bindParam(":p",$password);
    $get->bindParam(":username",$username);
    if($get->execute()){return "Row is inserted Sucessfully";}else{return "there is a problem";}
    

}

    public function add_new_row_in_db2($conn,$tabel,$email,$password,$username,$w_under,$grpid){
    $query='INSERT INTO '.$tabel.' ( email, password, username,working_under,groupID) VALUES (:e,:p,:username,:work_under,:groupID)';
    $get=$conn->prepare($query);
    $get->bindValue(":e",$email);
    $get->bindParam(":p",$password);
    $get->bindParam(":username",$username);
    $get->bindParam(":work_under",$w_under);
    $get->bindParam(":groupID",$grpid);
    if($get->execute()){return "Row is inserted Sucessfully";}else{return "there is a problem";}
    

}
//================================================================================
        
//return a array of the matched Row
public function log_in_check($conn,$select_columns,$table,$user_column,$password_column,$username,$password){

    $query="SELECT " .$select_columns." FROM " .$table." WHERE ".$user_column." =:e AND " .$password_column." =:p ";
    $get=$conn->prepare($query);
    $get->bindParam(":e",$username);
    $get->bindParam(":p",$password);
    $get->execute();
    $data = $get->fetchAll(PDO::FETCH_ASSOC); 
    return $data; 
    }
    
    



//================================================================================

public function modify_row_in_db($conn,$t,$d,$p,$cur,$id){  
    $titel=filter_var($t,FILTER_SANITIZE_STRING);
    $desc=filter_var($d,FILTER_SANITIZE_STRING);
    $price=filter_var($p,FILTER_SANITIZE_NUMBER_INT);
    $currency=filter_var($cur,FILTER_SANITIZE_STRING);

    $q="UPDATE items SET item_titel= :item_titel , item_desc= :item_desc , item_price = :item_price ,  item_currency = :item_currency WHERE item_id = ".$id;
    $stat=$conn->prepare($q);
    $stat->bindValue(':item_titel',$titel);
    $stat->bindValue(':item_desc',$desc);
    $stat->bindValue(':item_price',$price);
    $stat->bindValue(':item_currency',$currency);
    //    $stat->bindValue(':item_photo',$new_photo_link);
    if($stat->execute()){return "Row is Updated Sucessfully";}else{return "there is a problem";}
}



public function modify_row_in_db2($conn,$t,$d,$p,$cur,$id,$cat_id){  
    $titel=filter_var($t,FILTER_SANITIZE_STRING);
    $desc=filter_var($d,FILTER_SANITIZE_STRING);
    $price=filter_var($p,FILTER_SANITIZE_NUMBER_INT);
    $currency=filter_var($cur,FILTER_SANITIZE_STRING);

    $q="UPDATE items SET item_titel= :item_titel, cat_id= :cat_id , item_desc= :item_desc , item_price = :item_price ,  item_currency = :item_currency WHERE item_id = ".$id;
    $stat=$conn->prepare($q);
    $stat->bindValue(':item_titel',$titel);
    $stat->bindValue(':item_desc',$desc);
    $stat->bindValue(':item_price',$price);
    $stat->bindValue(':item_currency',$currency);
    $stat->bindValue(':cat_id',$cat_id);
    if($stat->execute()){return "Row is Updated Sucessfully";}else{return "there is a problem";}

}

public function modify_Category($conn,$name,$desc,$visibale,$get_cat_id,$user){

$q="UPDATE categories SET cat_name= :cat_name,cat_desc= :cat_desc , cat_status = :cat_status 
WHERE cat_id = :cat_id AND added_by = :user ";

$stat=$conn->prepare($q);
$stat->bindValue(':cat_name',$name);
$stat->bindValue(':cat_desc',$desc);
$stat->bindValue(':cat_status',$visibale);
$stat->bindValue(':cat_id',$get_cat_id);
$stat->bindValue(':user',$user);

if($stat->execute()){return "Row is Updated Sucessfully";}else{return "there is a problem";}

}









public function modify_column_in_db($conn,$table,$set,$value,$condition,$id){  
         $q="UPDATE ".$table." SET ".$set." =:val WHERE ".$condition." = :id";
            $stat=$conn->prepare($q);
            $stat->bindValue(':val',$value);
            $stat->bindValue(':id',$id);
            if($stat->execute()){return "Row is Updated Sucessfully";}else{return "there is a problem";}

}
//================================================================================
    public function change_value_of_column($conn,$tabel,$column,$val,$colname,$id){
            $q="UPDATE ".$tabel." SET ".$column."=".$val." WHERE ".$colname."= ".$id;
            $stat=$conn->prepare($q);
            if($stat->execute()){return "Row is Updated Sucessfully";}else{return "there is a problem";}
    }
//================================================================================

//================================================================================
public function change_Password($conn,$tabel,$newpass,$id){
    $q="UPDATE ".$tabel." SET password = :p , email_code = NULL WHERE email= :id";
    $stat=$conn->prepare($q);
    $stat->bindValue(':p',$newpass);
    $stat->bindValue(':id',$id);
    if($stat->execute()){return "Row is Updated Sucessfully";}else{return "there is a problem";}
}
//================================================================================











//end class
}







?>