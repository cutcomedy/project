<?php
    if (!isset($_SESSION))
        session_start();
    if($_SESSION['account'] == "")
        echo "0";
    else
        echo "1";
?>
