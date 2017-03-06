<?php
    if (!isset($_SESSION)){
        session_start();
    }
    if($_SESSION['id'] == ""){
         header("Location: price.php"); 
    }
        $pyscript = '.\py\similarity.py';
        $python = 'C:\Python27\python.exe';
        $cmd = "$python $pyscript";
        $name = $_POST['name'];
        $id = $_POST['id'];
        $cmd = "$python $pyscript ".$name." ".$id;
        $output = shell_exec("$cmd");
#        echo $output
        $result = json_decode(base64_decode($output));
        echo base64_decode($output);
    ?>