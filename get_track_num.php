<?php

    if (!isset($_SESSION))
        session_start();
    if(!isset($_SESSION["id"])){
        header("Location: price.php");
    }
    $link=mysqli_connect("localhost", "root", "123456", "data") or die("can't connect to sql");
    mysqli_query($link, "set names 'utf8'");
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $result_user = mysqli_query($link, 'SELECT * FROM track WHERE ID = "'.$_SESSION['id'].'" ');
    echo mysqli_num_rows($result_user);


?>
