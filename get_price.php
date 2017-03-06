<?php
    $link=mysqli_connect("localhost", "root", "123456", "data") or die("can't connect to sql");
    mysqli_query($link, "set names 'utf8'");
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $conn = mysqli_query($link, "SELECT * FROM attribute WHERE product_id ='".$_POST['product_id']."' AND attribute_key='價格'" );
    $row_price = mysqli_fetch_assoc($conn);
    echo $row_price['value'];
    mysqli_close($link);
?>