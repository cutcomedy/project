
<?php

    if (!isset($_SESSION))
        session_start();
    $link=mysqli_connect("localhost", "root", "123456", "data") or die("can't connect to sql");
    mysqli_query($link, 'SET CHARTACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $account = $_POST['account'];
    $password = $_POST['password'];
    $sql = "select * from account where account='$account'";
    if ( $result = mysqli_query($link, $sql) ) {
        $row_user =  mysqli_fetch_assoc($result);
        if($row_user['password'] == $password){
            $_SESSION['account'] = $account;
            $_SESSION['id'] = $row_user['ID'];
            echo "success";
        }
        else{
            $_SESSION['account'] = "";
            $_SESSION['id'] = "";
            echo "fail";    
        }
    }
    mysqli_close($link);
?>