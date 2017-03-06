<!DOCTYPE html>
<?php
    if (!isset($_SESSION))
        session_start();

?>
    <html lang="zh">

    <head>
        <?php include("include.php")?>
            <link rel="stylesheet" type="text/css" href="css/price.css">
            <script type="text/javascript" src="js/price.js"></script>


            <meta charset="utf-8">
            <title>商品查詢網站</title>
    </head>

    <body>
        <?php include("Navigation.php"); ?>
            <div style="margin:0px auto;width:300px; text-align:center;">
                <h1>商品查詢</h1>
            </div>
            <div class="container all">
                <form name="form1" method="POST" action="loading.php">
                    <div class="media">
                        <div class="media-left well well-sm" style="background:#f6b1cd">
                            <span style="font-size: 18px;">商品名稱
                            <input type="hidden" name="condition_input_0" value="商品名稱">
                        </div>
                        <div class="media-body" style="background:#f8cedf;">
                            <table class="table"  style="background:#f8cedf; margin:0px;" id="no_0">
                                <thead>
                                    <th>
                                        <div class="col-sm-5"></div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    重要程度                                          
                                                </span>
                            <select name="condition_imp_0" id="condition_imp_0" class="form-control input-sm">
                                <option selected=""></option>
                                <option value="6">最重要 </option>
                                <option value="5">非常重要 </option>
                                <option value="4">比較重要 </option>
                                <option value="3">普通 </option>
                                <option value="2">比較不重要 </option>
                                <option value="1">非常不重要 </option>
                                <option value="0">完全不重要 </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-success b_add_condition btn-sm" id="add_0-0">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                    </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">名稱</span>
                                            <input class="form-control input-sm" type="text" size="20"  name="conform_in_0-0" id="conform_in_0-0">
                                            <select name="unit_0-0" style="display: none;" id="unit_0-0">
                                                <option selected value="0"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">符合程度</span>
                                            <select class="form-control input-sm" name="conform_imp_0-0" id="conform_imp_0-0">
                                                <option></option>
                                                <option value="6">完全符合 </option>
                                                <option value="5">非常符合 </option>
                                                <option value="4">比較符合 </option>
                                                <option value="3">普通 </option>
                                                <option value="2">比較不符合 </option>
                                                <option value="1">非常不符合 </option>
                                                <option value="0">完全不符合 </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                    </table>
            </div>
            </div>
            <br>

            <!--            <table class="table well" id="no_0">
                <thead>
                    <tr>
                        <th>
                            <div class="row">
                                <div class="col-sm-6">
                                    <span style="font-size: 20px;">商品名稱
                                            <input type="hidden" name="condition_input_0" value="商品名稱">
                                        </span>
                                </div>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">重要程度</span>
                                        <select name="condition_imp_0" id="condition_imp_0" class="form-control">
                                            <option selected=""></option>
                                            <option value="6">最重要 </option>
                                            <option value="5">非常重要 </option>
                                            <option value="4">比較重要 </option>
                                            <option value="3">普通 </option>
                                            <option value="2">比較不重要 </option>
                                            <option value="1">非常不重要 </option>
                                            <option value="0">完全不重要 </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-success b_add_condition" id="add_0-0">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>

                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="conform_in_tr_0-0">
                        <td>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">名稱</span>
                                        <input class="form-control" type="text" size="20" placeholder="請輸入商品名稱" name="conform_in_0-0" id="conform_in_0-0">
                                        <select name="unit_0-0" style="display: none;" id="unit_0-0">
                                            <option selected value="0"></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <span class="input-group-addon">符合程度</span>
                                        <select class="form-control" name="conform_imp_0-0" id="conform_imp_0-0">
                                            <option></option>
                                            <option value="6">完全符合 </option>
                                            <option value="5">非常符合 </option>
                                            <option value="4">比較符合 </option>
                                            <option value="3">普通 </option>
                                            <option value="2">比較不符合 </option>
                                            <option value="1">非常不符合 </option>
                                            <option value="0">完全不符合 </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--<td style="background-color :coral;"></td>-->

            <div class="panel panel-info">
                <table class="table" style="background:#ff9933;">
                    <thead>
                        <tr>
                            <th>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">選擇分類<span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                <li role="presentation"><a role="menuitem" tabindex="-1" class="k">美妝</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" class="k">家用品</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" class="k">家電器</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" class="k">鞋款</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" class="k">服飾</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" class="k">傢俱</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" class="k">3C與周邊</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" class="k">食品與藥品</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" class="k">所有商品</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <p id="kind" style="font-size:18px;"></p>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="highlight div_add done dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="menu2" data-toggle="dropdown">新增條件<span class="caret"></span></button>
                                            <ul class="qwe dropdown-menu" role="menu" aria-labelledby="menu2">
                                                <li role="presentation" value="1" class="no" id="li_1"><a role="menuitem" tabindex="-1" href="#">品牌</a></li>
                                                <li role="presentation" value="2" class="no" id="li_2"><a role="menuitem" tabindex="-1" href="#">保固</a></li>
                                                <li role="presentation" value="3" class="no" id="li_3"><a role="menuitem" tabindex="-1" href="#">尺寸</a></li>
                                                <li role="presentation" value="4" class="no" id="li_4"><a role="menuitem" tabindex="-1" href="#">重量</a></li>
                                                <li role="presentation" value="5" class="no" id="li_5"><a role="menuitem" tabindex="-1" href="#">價格</a></li>
                                                <li role="presentation" value="8" class="no" id="li_8"><a role="menuitem" tabindex="-1" href="#">顏色</a></li>
                                                <li role="presentation" value="9" class="no" id="li_9"><a role="menuitem" tabindex="-1" href="#">螢幕尺寸</a></li>
                                                <li role="presentation" value="10" class="no" id="li_10"><a role="menuitem" tabindex="-1" href="#">長</a></li>
                                                <li role="presentation" value="11" class="no" id="li_11"><a role="menuitem" tabindex="-1" href="#">寬</a></li>
                                                <li role="presentation" value="12" class="no" id="li_12"><a role="menuitem" tabindex="-1" href="#">高</a></li>
                                                <li role="presentation" value="13" class="no" id="li_13"><a role="menuitem" tabindex="-1" href="#">畫素</a></li>
                                                <li role="presentation" value="14" class="no" id="li_14"><a role="menuitem" tabindex="-1" href="#">深</a></li>
                                                <li role="presentation" value="15" class="no" id="li_15"><a role="menuitem" tabindex="-1" href="#">材質</a></li>
                                                <li role="presentation" value="16" class="no" id="li_16"><a role="menuitem" tabindex="-1" href="#">SIZE</a></li>
                                                <li role="presentation" value="17" class="no" id="li_17"><a role="menuitem" tabindex="-1" href="#">鞋碼</a></li>
                                                <li role="presentation" value="18" class="no" id="li_18"><a role="menuitem" tabindex="-1" href="#">容量</a></li>
                                                <li role="presentation" value="19" class="no" id="li_19"><a role="menuitem" tabindex="-1" href="#">使用期限</a></li>
                                                <li role="presentation" value="20" class="no" id="li_20"><a role="menuitem" tabindex="-1" href="#">產地</a></li>
                                                <li role="presentation" class="triangle"><a href="#">自定義</a>
                                                    <li class="divider"></li>
                                                    <li class="dropdown-header">自定義</li>
                                                    <li value="6" class="no" id="li_6"><a href="#">離散型模糊條件</a></li>
                                                    <li value="7" class="no" id="li_7"><a href="#">數值型模糊條件</a></li>
                                                </li>
                                            </ul>
                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <span id="upup"></span>
            <div style="margin:0px auto; width:55px;">
                <input type="submit" id="submit" value="搜尋" class="btn btn-info">
            </div>

            <input type="hidden" name="array" id="array" value="">
            </table>
            </form>
            </div>
            <?php include("login.php")?>
                <?php include("sign_up.php")?>
                    <?php include("state.php")?>
    </body>

    </html>
