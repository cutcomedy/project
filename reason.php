<!DOCTYPE html>
<?php
    if (!isset($_SESSION))
        session_start();
    if($_GET["mode"] == "track" && $_SESSION["id"] == "")
        header("Location: price.php"); 
?>
    <html>

    <head>
            <?php include("include.php")?>
            <script type="text/javascript" src="js/reason.js"></script>
            <script type="text/javascript" src="js/track.js"></script>
            <link rel="stylesheet" type="text/css" href="css/reason.css">

            <title>搜尋結果</title>
    </head>

    <body>
        <?php include("Navigation.php"); ?>
            <div class="container">
                <div id="title" style="margin: 0 auto; width:986px; padding:5px">
                    <div class="row">
                        <h1 style="text-align:center;">搜尋結果</h1>
                    </div>
                    <div class="row">
                        <?php
                        if($_GET['mode'] == "search"){
                if($_GET['sort'] == 0){
                    if($_GET['type'] == 0)
                        echo '<a style="float:left;" class="chose_now" >&nbsp;依符合程度排序&nbsp;&nbsp;&nbsp;</a>';
                    else
                        echo '<a style="float:left;" class="chose_now" >&nbsp;&nbsp;&nbsp;依相似度排序&nbsp;&nbsp;&nbsp;&nbsp;</a>';
                    echo '<a style="float:left;" class="chose_no" href="reason.php?page=1&type='.$_GET['type'].'&sort=1&mode='.$_GET['mode'].'">&nbsp;依熱門評分排序&nbsp;</a>';
                }
                else{
                    if($_GET['type'] == 0)
                        echo '<a style="float:left;" class="chose_no" href="reason.php?page=1&type='.$_GET['type'].'&sort=0&mode='.$_GET['mode'].'">&nbsp;&nbsp;&nbsp;依相似度排序&nbsp;&nbsp;&nbsp;&nbsp;</a>';
                    else
                        echo '<a style="float:left;" class="chose_no" href="reason.php?page=1&type='.$_GET['type'].'&sort=0&mode='.$_GET['mode'].'">&nbsp;依符合程度排序&nbsp;</a>';
                    echo '<a style="float:left;" class="chose_now" id="sort_hot">&nbsp;依熱門評分排序&nbsp;&nbsp;&nbsp;</a>';
                }
                if($_GET['type'] == 1){
                    echo '<a  style="float:right;" class="chose_no" href="reason.php?page=1&type=0&sort='.$_GET['sort'].'&mode='.$_GET['mode'].'">符合程度</a>';
                    echo '<a style="float:right;" class="chose_now">相似度</a>';
                }
                else{
                    echo '<a style="float:right;" class="chose_now">符合程度</a>';
                    echo '<a style="float:right;" class="chose_no" href="reason.php?page=1&type=1&sort='.$_GET['sort'].'&mode='.$_GET['mode'].'">相似度</a>';
                }
                
                        }
               
            ?>

                    </div>
                </div>
                <div id="list" style="margin: 0 auto; width:970px;">
                    <?php
                        echo "<input type='hidden' id='page' value='".$_GET["page"]."'>";
                        echo "<input type='hidden' id='type' value='".$_GET["type"]."'>";
                        echo "<input type='hidden' id='mode' value='".$_GET["mode"]."'>";
                        echo '<input type="hidden" id="sort" value="'.$_GET['sort'].'">';
                        if($_GET['mode'] != "track")
                            include("get_data.php");
				    ?>
                </div>
                <div style="margin:0 auto;width:500px;">
                    <ul class="pagination">
                        <script>
                            if ($("#type").val() == "0")
                                var data_string = window.localStorage.product;
                            else
                                var data_string = window.localStorage.popularity;
                            var data = JSON.parse(data_string);
                            var data_object = data["0"];
                            var page_end = Object.keys(data_object).length/10 + 1;
                            var page = parseInt($("#page").val());
                            var sort = $("#sort").val();
                            var type = $("#type").val();
                            var mode = $("#mode").val();
                            var prev = page - 1;
                            var next = page + 1;
                            $(".pagination").append("<li><a href='reason.php?page=" + prev + "&type=" + type + "&sort=" + sort + "&mode=" + mode + "'><span class='glyphicon glyphicon-chevron-left'></span></a></li>");
                            var i, j;
                            for (i = (page - 5), j = 0; j < 10 && (i) < page_end; i++) {
                                if (i < 1)
                                    continue;
                                if (i == page)
                                    $(".pagination").append("<li class='active'><a href='reason.php?page=" + i + "&type=" + type + "&sort=" + sort + "&mode=" + mode + "'>" + i + "</a></li>");
                                else
                                    $(".pagination").append("<li><a href='reason.php?page=" + i + "&type=" + type + "&sort=" + sort + "&mode=" + mode + "'>" + i + "</a></li>");
                                j++;
                            }
                            $(".pagination").append("<li><a href='reason.php?page=" + next + "&type=" + type + "&sort=" + sort + "&mode=" + mode + "'><span class='glyphicon glyphicon-chevron-right'></span></a></li>");

                        </script>
                    </ul>
                </div>

            </div>
            <?php include("login.php")?>
                <?php include("sign_up.php")?>
                    <?php include("state.php")?>
    </body>

    </html>
