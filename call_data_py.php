<?php
    if (!isset($_SESSION)){
        session_start();
    }
        
    $pyscript = '.\py\data2.py';
    $python = 'C:\Python27\python.exe';
    $cmd = "$python $pyscript " . base64_encode($_POST["json"]);
    $output = shell_exec("$cmd");
    echo base64_decode($output);
?>
