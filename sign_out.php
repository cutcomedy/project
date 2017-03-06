<?php
    if (!isset($_SESSION))
        session_start();
    $_SESSION['account'] = NULL;
    $_SESSION['id'] = NULL;
    echo "success";
?>
