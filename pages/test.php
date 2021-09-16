<?php 
    $random = substr(md5(mt_rand()), 0, 7);
    echo substr(md5(date("h:m:s:d:M:Y")), 0, 7);
    echo str_shuffle(md5(date("h:m:s:d:M:Y").$random))
    
?>