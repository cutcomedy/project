<?php
    $link=mysqli_connect("localhost", "root", "123456", "data") or die("can't connect to sql");
    mysqli_query($link, "set names 'utf8'");
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $sql = "insert into account(account, password, email) values('".$_POST["account"]."','".$_POST["password"]."','".$_POST["email"]."')";
    if ( $result = mysqli_query($link, $sql) ) {
        echo "success"; 
    }       
    else 
        echo "sign up fail!<br> 錯誤代碼：" . $sql . "<br>msg：" .mysqli_error($link); 
    mysqli_close($link);
?>