<?php
    $link=mysqli_connect("localhost", "root", "123456", "data") or die("can't connect to sql");
    mysqli_query($link, 'SET CHARTACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $account = $_POST['account'];

    if(strlen($account) > 7 && strlen($account) < 21){
        $sql = "select * from account where account='$account'";
        if ( $result = mysqli_query($link, $sql) ) { 
            if( $row = mysqli_fetch_assoc($result) ) 
                echo "This account is already used!"; 
            else 
                echo"OK!";
            mysqli_free_result($result); 
        }
    }
    mysqli_close($link); 
?>