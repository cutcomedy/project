<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
</head>
<body>
<?php
    $pyscript = '.\py\test.py';
    $python = 'C:\Python27\python.exe';
    $cmd = "$python $pyscript " . "123" . " 456";
    $output = shell_exec("$cmd");
    echo $output;
?>


</body>
</html>