<?php

    if (!isset($_SESSION))
        session_start();
    
    $link=mysqli_connect("localhost", "root", "123456", "data") or die("can't connect to sql");
    mysqli_query($link, "set names 'utf8'");
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    $result_user = mysqli_query($link, 'SELECT * FROM track WHERE ID = "'.$_SESSION['id'].'" ');
    
    $nums = mysqli_num_rows($result_user);
    mysqli_data_seek ($result_user, $_POST['page']);
    $row_result_user = mysqli_fetch_assoc($result_user);

    #track.url >> product.url
    $result = mysqli_query($link, "SELECT * FROM product WHERE url ='".$row_result_user['url']."'" );
    $row_product =  mysqli_fetch_assoc($result);
    #product.id >> attribute.id
    $conn = mysqli_query($link, "SELECT * FROM attribute WHERE product_id ='".$row_product['product_id']."' AND attribute_key='價格'" );
    $row_price = mysqli_fetch_assoc($conn);
    #normal_url >> fb_share_url
    $fb_share = $row_product["url"];
    str_replace(":", "%3A", $fb_share);
    str_replace("%", "%25", $fb_share);
    $fb_share = "https://www.facebook.com/sharer/sharer.php?u=".$fb_share;
    #print html
    if($_POST['page'] < $nums){
        if($_POST['print_type'] == "0"){
            echo '<div class="well" style="background:#dff0d8;" id="'.$row_product['product_id'].'">
                        <div class="row">
                            <div class="col-sm-4"><img class="img" src = '.$row_product["pic"].'></div>
	   			             <div class="col-sm-6">
                                <h3 style="word-break:break-all">'.$row_product["name"].'</h3>
                                <br>
                                <h3>NT : '.$row_price["value"].'</h3>
                             </div>
                             <div class="col-sm-2">
                                <button type="button" style="margin:4px;" id="'.$row_product["product_id"].'"  class="btn btn-info shop"  onclick="javascript:location.href=\''.$row_product["url"].'\'">'.$row_product["shop"].'<span class="glyphicon glyphicon-chevron-right"></span></button>
                                <button type="button" style="margin:4px;" class="btn btn-danger notrack" id="'.$row_product["product_id"].'"  value="'.$row_result_user['url'].'">delete<span class="glyphicon glyphicon-remove"></span></button>
                                <button type="button" style="margin:4px;" class="btn btn-primary share" id="'.$row_product["product_id"].'" value="'.$row_product["url"].'" onclick="javascript:location.href=\''.$fb_share.'\'">share   <span class="glyphicon glyphicon-share"></span></button>
                            </div>
                        </div>
                    </div>';
                    
        }
        else{
            ;
        }
    }
    else{
        echo "nothing";
    }
    mysqli_close($link);
?>