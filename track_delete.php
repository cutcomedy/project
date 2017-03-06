<?php

    if (!isset($_SESSION))
        session_start();
    $link=mysqli_connect("localhost", "root", "123456", "data") or die("can't connect to sql");
    mysqli_query($link, "set names 'utf8'");
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    $sql = "DELETE FROM track WHERE id = ".$_SESSION['id']." AND url = '".$_POST['product_url']."'";
    if ( $result = mysqli_query($link, $sql) ) {
        echo "delete success!"; 
        
    }
                
    else 
        echo "sign up fail!<br>錯誤代碼：" . mysqli_errno($link) . "<br>msg：" .mysqli_error($link)."DELETE FROM track WHERE id = ".$_SESSION['id']." AND url = '".$_POST['product_url']."'"; 
    mysqli_close($link);

?>