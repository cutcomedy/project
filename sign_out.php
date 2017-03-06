<?php
    if (!isset($_SESSION))
        session_start();
    $_SESSION['account'] = "";
    $_SESSION['id'] = "";
    echo "success";
?>