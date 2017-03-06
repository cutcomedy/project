<?php
    if (!isset($_SESSION))
        session_start();
    $link=mysqli_connect("localhost", "root", "123456", "data") or die("can't connect to sql");
    mysqli_query($link, "set names 'utf8'");
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    mysqli_query($link, "insert into share(id, url) SELECT '$_SESSION[id]', '$_POST[product_url]' FROM DUAL WHERE NOT EXISTS (SELECT * FROM share WHERE id = '$_SESSION[id]' AND url = '$_POST[product_url]')" );
    if(mysqli_query($link, "UPDATE product SET count_share = count_share + 1 WHERE product_id ='".$_POST['product_id']."'" ))
        echo "success";
    else
        echo "fail!<br> 錯誤代碼：" . $sql . "<br>msg：" .mysqli_error($link); 
    mysqli_close($link);

?>