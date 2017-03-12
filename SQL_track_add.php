<?php

    if (!isset($_SESSION))
        session_start();
    $link=mysqli_connect("localhost", "root", "123456", "data") or die("can't connect to sql");
    mysqli_query($link, "set names 'utf8'");
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    mysqli_query($link, "UPDATE product SET count_track = count_track + 1 WHERE product_id ='".$_POST['product_id']."'" );
    $sql = "insert into track(id, url) SELECT '$_SESSION[id]', '$_POST[product_url]' FROM DUAL WHERE NOT EXISTS (SELECT * FROM track WHERE id = '$_SESSION[id]' AND url = '$_POST[product_url]')";
    if ( $result = mysqli_query($link, $sql) ) {
        echo "add success!";
    }

    else
        echo "sign up fail!<br>錯誤代碼：" . mysqli_errno($link) . "<br>msg：" .mysqli_error($link);
    mysqli_close($link);

?>
