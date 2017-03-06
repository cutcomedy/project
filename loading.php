<?php
    if (!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION["id"])){
      header("Location: price.php");
    }
?>
<html lang="zh">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <meta charset="utf-8">
    <title>LOADING</title>
    <?php
        function unit($val, $num){
            switch($val){
                case "0":
                    break;
                case "1":
                    $tmp = (float)$num * 1000000 + "克";
                    break;
                case "2":
                    $tmp = (float)$num * 1000 + "克";
                    break;
                case "3":
                    $tmp = (float)$num + "克";
                    break;
                case "4":
                    $tmp = (float)$num/1000 + "克";
                    break;
                case "5":
                    $tmp = (float)$num*1000;
                    break;
                case "6":
                    $tmp = (float)$num;
                    break;
                case "7":
                    $tmp = (float)$num*10;
                    break;
                case "8":
                    $tmp = (float)$num*1000000;
                    break;
                case "9":
                    break;
                case "10":
                    $tmp = (float)$num*12;
                    break;
                case "11":
                    $tmp = (float)$num;
                    break;
                case "12":
                    $tmp = (float)$num/1024;
                    break;
                case "13":
                    $tmp = (float)$num;
                    break;
                case "14":
                    $tmp = (float)$num*1024;
                    break;

            }
            return $tmp;
        }
    ?>
</head>

<body>


    <?php
     $json = '{';
     $product_name = '';
     $array = $_POST["array"];
     $array = explode(',', $array);
     for($i = 0; $i < count($array); $i=$i+3){
         if($i!=0)
             $json = $json.',';
         $json = $json.'"'.$_POST["condition_input_".$array[$i]].'":';
         $json = $json.'{"importance":'.$_POST["condition_imp_".$array[$i]].',';
         $j = 0;
         $count = 0;
         while($j < $array[$i+2]){
             try{
                 $tmp = @$_POST["conform_in_".$array[$i]."-".$j];
                 $unit = @$_POST["unit_".$array[$i]."-".$j];
             }
             catch(Exception $e){
                 $tmp="zz";
             }
             if($tmp != NULL || $unit != NULL){
                 if($array[$i] == "16"){
                     $true_value = $unit;
                 }
                 else if(@$_POST["unit_".$array[$i]."-".$j] != "0"){
                     $true_value = unit($unit, $tmp);
                 }

                 else{
                     $true_value = $tmp;
                 }
                 $json = $json.'"'.$true_value.'":'.$_POST["conform_imp_".$array[$i]."-".$j].',';
                 if($i == 0)
                     $product_name = $product_name.$true_value.',';
                 $j += 1;
             }
         }

         if($array[$i+1] == "1")
             $json = $json.'"discrete":"True"}';
         else
             $json = $json.'"discrete":"False"}';

     }
     $json = $json."}";


     echo "<input type='hidden' id='json' value='".$json."'>";
     echo "<input type='hidden' id='product_name' value='".$product_name."'>";
     echo "<input type='hidden' id='id' value='".$_SESSION['id']."'>";
     echo "<input type='hidden' id='account' value='".$_SESSION['account']."'>";
/*     $pyscript = 'C:\xampp\htdocs\project\data2.py';
     $python = 'C:\Python27\python.exe';
     $cmd = "$python $pyscript " . base64_encode($json);
     $output = shell_exec("$cmd");
     $result = json_decode(base64_decode($output));
     echo "<input type='hidden' id='result' value='".base64_decode($output)."'>";*/

?>

        <script type="text/javascript">
            $(document).ready(function() {
                $.ajax({
                    url: "call_data_py.php",
                    type: 'POST',
                    dataType: "text",
                    async: false,
                    data: {
                        json:$("#json").val()
                    },
                    success: function(msg) {
                        window.localStorage.product = msg;
                        window.localStorage.product_name = $("#product_name").val();
                        //$("#json").val(msg);
                    },
                    error: function() {
                        alert("error");
                    }
                });
            })
            if($("#id").val() != ""){
                $.ajax({
                    url: "call_similarity_py.php",
                    type: 'POST',
                    dataType: "text",
                    async: false,
                    data: {
                        name:$("#product_name").val(),
                        id:$("#id").val()
                    },
                    success: function(msg) {
                        window.localStorage.similarity = msg;
                        //$("#json").val(msg);
                    },
                    error: function() {
                        alert("error");
                    }
                });
            }
            //localStorage.clear();
            //window.localStorage.product = $("#result").val();
            window.location.href="reason.php?sort=0&type=0&page=1&mode=search";
        </script>
</body>
