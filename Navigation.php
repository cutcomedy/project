<?php
    if (!isset($_SESSION))
        session_start();
?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="price.php">首頁</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        if(@$_SESSION['account'] != ""){                       
                            echo'<li><a>'.$_SESSION["account"].'</a></li>';
                            echo'<li><a href="reason.php?sort=0&type=0&page=1&mode=track">追蹤清單</a></li>';
                            echo'<li><a id="signout">登出</a></li>';
                        }
                        else{
                            echo'<li><a data-toggle="modal" data-target="#sign_up_Modal">註冊</a></li>';
                            echo'<li><a data-toggle="modal" data-target="#login_Modal">登入</a></li>';
                            echo'<li><a data-toggle="modal" data-target="#login_Modal">追蹤清單</a></li>';
                        }
                    ?>
                    <li><a data-toggle="modal" data-target="#state_Modal">目前進度</a></li>
                </ul>
            </div>
            
        </div>
    </nav>
