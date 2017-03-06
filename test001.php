<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Untitled Document</title>
</head>
<body>
    <?php
        header("Content-Type:text/html; charset=utf-8");
        $pyscript = '.\py\similarity.py';
        $python = 'C:\Python27\python.exe';
        $cmd = "$python $pyscript";
        $name = "筆電,筆記型電腦,";
        $id = "9";
        $cmd = "$python $pyscript ".$name." ".$id;
        $output = shell_exec("$cmd");
        $result = json_decode(base64_decode($output));
        echo base64_decode($output);
    ?>
</body>
</html>
