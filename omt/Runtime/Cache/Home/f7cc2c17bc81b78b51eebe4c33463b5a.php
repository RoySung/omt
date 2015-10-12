<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="/omt/Public/js/modernizr.js"></script> <!-- Modernizr --> 
        <script src="/omt/Public/include/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="/omt/Public/include/jquery.mobile-1.4.5/css/jquery.mobile-1.4.5.css" />
        <script src="/omt/Public/include/jquery.mobile-1.4.5/js/jquery.mobile-1.4.5.js"></script>
        <link rel="stylesheet" href="/omt/Public/include/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="/omt/Public/css/reset.css"> <!-- CSS reset -->
        <link rel="stylesheet" href="/omt/Public/css/style.css"> <!-- Resource style -->
        <script src="/omt/Public/js/main.js"></script> <!-- Resource jQuery -->
        <!--Bootstrap-->
        <script src="/omt/Public/include/bootstrap/js/bootstrap.js"></script>
        <title>Ticket</title>
        <style>
            .cd-3d-nav a {
                font-size: 10px;
            }
            .ui-page-theme-a,body,
            .ui-page-theme-a .ui-panel-wrapper {
                background-color: 	rgba(30, 221, 133, 0.77) ;
                border-color:	#bbb;
                color: 	#333;
                text-shadow: 0  0px  0  ;
            }
            .form-control{
                font-size: 15px;
                background-color: rgba(52, 60, 85,1);
                color: #fff;
                border: : 1px outset;
            }
            .ui-btn {
                padding: 0px;
            }
            body{
                transition: background-color .8s ease-in-out;
                -moz-transition: background-color .8s ease-in-out;
                -webkit-transition: background-color .8s ease-in-out;
            }
            body{
                opacity: 0;
                transition: opacity .25s ease-in-out;
                -moz-transition: opacity .25s ease-in-out;
                -webkit-transition: opacity .25s ease-in-out;
            }
            body.visible {
                opacity: 1;
                transition: opacity .8s ease-in-out;
                -moz-transition: opacity .8s ease-in-out;
                -webkit-transition: opacity .8s ease-in-out;
            }
            .m_img{
                padding:0px;
            }
            .m_title{
                font-size:18px;
            }
            .m_content{
                font-size:9px;
                color: #ACA6AC;
                font-weight: lighter;
            }
        </style>
        <script>
            $(document).ready(function(){
                window.requestAnimationFrame(updateSelectedNav);
                $('body').toggleClass("visible");
                $(".nav_list").click(function(){
                    event.preventDefault();
                    // Sets the new destination to the href of the link
                    color = $(this).data("color");
                    $('body').css('background-color', color );
                    $('body').css('opacity','0' );
                    setTimeout("location.href='<?php echo U('index/"+this.id+"');?>'",850);
                });

                $(".list").click(function(){
                    $('.cd-3d-nav-trigger-user').trigger('click');
                    $('#send_title').empty();
                    $('#send_title').append($(this).find('.movie').html());
                    $('#myModal').attr('code',$(this).attr('code'));
                    //$('#myModal').modal('show');
                    $.mobile.changePage("#myModal", { transition: "pop",role: "dialog" });
                });
                $("#send").click(function(){
                    //alert($('#myModal').attr('code'));
                    window.demo.clickOnAndroid($('#myModal').attr('code'));
                });
            });
        </script>
    </head>
    <body>
        <div id="order_t" data-role="page">
            <header class="cd-header navbar-fixed-top" > 
                <a href="#0" class="cd-3d-nav-trigger " >
                    <img src="img/icon-user.svg" style="width:100%;height:100%;">
                    <span></span>
                </a>
                <a href="index.php" class="cd-3d-nav-trigger-home " data-ajax="false" >
                    <img src="img/icon-home.svg" style="width:100%;height:100%;">
                </a>
            </header> <!-- .cd-header -->
            <nav class="cd-3d-nav-container navbar-fixed-top">
                <ul class="cd-3d-nav">
                    <li>
                        <a class="nav_list" id="order_t" data-color="#4FE29E" >訂票去</a>
                    </li>

                    <li>
                        <a class="nav_list" id="order" data-color="#4FE29E">訂餐去</a>
                    </li>

                    <li id="nav_user" user="user">
                        <a class="nav_list" id="member" data-color="#485274" >個人資料</a>
                    </li>

                    <li class="cd-selected">
                        <a class="nav_list" id="ticket" data-color="#4FE29E" >我的票卷</a>
                    </li>

                    <li>
                        <a class="nav_list" id="order_t" data-color="#4FE29E">優惠收藏</a>
                    </li>
                </ul> <!-- .cd-3d-nav -->
                <span class="cd-marker color-4"></span> 
            </nav> <!-- .cd-3d-nav-container -->
            <!--Main-->
            <main>
                <div class="ui-content" style="position: relative;top: 80px;">
                    <div  class="content next">
                        <ul data-role="listview" data-inset="true" >
                            <!-- 沒有票劵 --> 
                            <li data-icon="false"> 
                                <div class="col-xs-8"> 
                                    <div class="m_title" style="text-align:center; font-family:微軟正黑體; font-size:24px;">你尚未購買票劵</div> 
                                </div> 
                            </li> 
                            <!-- 有票劵 -->
                            <li data-icon="false">
                                <a href="#" class="list" code= 12345 style="padding:0px 0px 1px;">
                                    <div class=" col-xs-4 m_img" ><img class=" img-responsive" src=img/4.jpg></div>
                                    <div class="col-xs-8">
                                        <!-- 電影名稱 -->
                                        <div class="m_title" style="text-align:center; font-family:微軟正黑體; font-size:24px;">新時代</div>
                                        <div class="m_content" style="font-family:微軟正黑體; font-size:14px; color:#000; padding:10px;">
                                            <h3 class="movie">片名: 多拉A夢 </h3>
                                            <h3>場次日期: 20150619 </h3>
                                            <h3>場次時間: 1 </h3>
                                            <h3>人數: 1 </h3> 
                                            <h3>場次位置: J10- </h3>
                                            <h3>票價: 180 </h3>
                                        </div>
                                    </div> 
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </main>
            </div>
            <!-- 感應付款 -->
            <div data-role="dialog" id="myModal" style="top: 10%;">
                <div id="header" data-role="header" style="height: 40px;">
                   <h1 id="send_title" class="d_title"></h1>
                </div>
                <div id="content" data-role="content">
                    <div class=" col-xs-12 m_img" ><image src="img/seat.gif" style="width:100%;"/></image>
                    <button id="send" style="height:50px;">感應位置</button>
                </div>
            </div>
    </body>
</html>