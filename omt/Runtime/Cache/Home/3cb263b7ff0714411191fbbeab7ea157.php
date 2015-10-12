<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <!-- Export CSS  -->
        <link rel="stylesheet" href="/omt/Public/include/jquery.mobile-1.4.5/css/jquery.mobile-1.4.5.css" />
        <script src="/omt/Public/include/jquery-1.11.1.min.js"></script>
        <script src="/omt/Public/include/jquery.mobile-1.4.5/js/jquery.mobile-1.4.5.js"></script>
        <script type="text/javascript" src="/omt/Public/js/jqm-spinbox.min.js"></script>
        <link rel="stylesheet" href="/omt/Public/include/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="/omt/Public/css/reset.css"> <!-- CSS reset -->
        <link rel="stylesheet" href="/omt/Public/css/style.css"> <!-- Resource style -->
        <script src="/omt/Public/js/main.js"></script> <!-- Resource jQuery -->
        <!--Bootstrap-->
        <script src="/omt/Public/include/bootstrap/js/bootstrap.js"></script>
        
        <style>
            .cd-3d-nav a {
                font-size: 10px;
            }
            .input_type1{
                position: relative;right:10px;
                float:right; 
                margin:0; 
                -webkit-border-radius:5px;
            }
            .input_type2{
                float:right; margin:0; 
                -webkit-border-radius:5px;
            }
            .ui-controlgroup{
                //display: inline;
            }
            .list{
                display: block;
                height: 50px;
                background-color: rgb(49, 171, 252);
                color: #fff;
                font-family:Microsoft JhengHei;
                padding-top: 10px;
                font-size: 24px;
            }
            .ui-page-theme-a,body,
            .ui-page-theme-a .ui-panel-wrapper {
                background-color:   rgba(30, 221, 133, 0.77) ;
                border-color: #bbb;
                color:  #333;
                text-shadow: 0  0px  0  ;
            }
            #drink_list li{
                text-align: center;
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
                    setTimeout("location.href='"+this.id+".html'",850);
                });
                $('#pay_btn').click(function(){
                    $('#pay_message').modal('show');
                });
            });

            var name, tel, add, orderList;
            $(document).on("pageinit", "#home", function () {
            $('.user_input').keydown(function () {
                if ($('#text-1').val() && $('#text-2').val() && $('#text-3').val()) {
                    $('#start_order').attr('class', 'ui-btn');
                }
                else {
                    $('#start_order').attr('class', 'ui-btn ui-state-disabled');
                }
            });

            $('.user_input').blur(function () {
                if ($('#text-1').val() && $('#text-2').val() && $('#text-3').val()) {
                    $('#start_order').attr('class', 'ui-btn');
                        name = $('#text-1').val();
                        tel = $('#text-2').val();
                        add = $('#text-3').val();
                    } 
                    else {
                        $('#start_order').attr('class', 'ui-btn ui-state-disabled');
                        name = "";
                        tel = "";
                        add = "";
                    }
                });
            });

            $(document).on("pageshow", "#order", function () {
                $('#user_name').text(name);
                var drinkNum = $('#drink_list li').length;
                var orderList = new Array(drinkNum);
                $('.input_type1').change(function () {
                    var num1 = $(this).val();

                    if (num1) {
                        $(this).parents('li').attr('M', num1);
                    } 
                    else {
                        $(this).parents('li').removeAttr('M');
                    }
                });

                $('.input_type2').change(function () {
                    var num2 = $(this).val();
                    if (num2) {
                        $(this).parents('li').attr('L', num2);
                    } 
                    else {
                        $(this).parents('li').removeAttr('L');
                    }
                });

                $('#drink_list input').change(function () {
                    var L_num = $('#drink_list li[L]').length;
                    var M_num = $('#drink_list li[M]').length;
                    if ((L_num + M_num) > 0) {
                        $('#lets_order').removeAttr('class').attr('class', 'ui-btn ui-btn-right ');
                    } 
                    else {
                        $('#lets_order').removeAttr('class').attr('class', 'ui-btn ui-btn-right ui-state-disabled');
                    }
                });

                $('#lets_order').on('click', function () {
                    orderList = "";
                    var sum=0;
                    var img01='<img src="/omt/Public/images/';
                    var img02='.png" width="40px" height="40px">';
                    var tab1='<tr><td>';
                    var tab2='</tr></td>';
                    for (var ii = 0; ii < $('#drink_list li').length; ii++) {
                        var item1=$('div');
                        var meal=$('#drink_list li').eq(ii).find('span').text();
                        if((meal=="紅茶")||(meal=="可樂")||(meal=="咖啡")){meal='drinks';}else{meal='food';}
                        if ($('#drink_list li').eq(ii).attr('L')) {
                            orderList = orderList  + img01 +  meal + img02 + $('#drink_list li').eq(ii).find('span').text() +
                            " (L) $" +$('#drink_list li').eq(ii).find(item1).text().substring(143,145)+"元："+ $('#drink_list li').eq(ii).attr('L') + "份 " + "</br>";
                            
                            sum=sum+parseInt($('#drink_list li').eq(ii).find(item1).text().substring(143,145))*$('#drink_list li').eq(ii).attr('L');
                        }
                        if ($('#drink_list li').eq(ii).attr('M')) {
                        	console.log($('#drink_list li').eq(ii).find(item1).text().search("M"));
                            orderList = orderList + img01 + meal + img02 +  $('#drink_list li').eq(ii).find('span').text() +
                            " (M) $" +$('#drink_list li').eq(ii).find(item1).text().substring(36,38)+"元："+ $('#drink_list li').eq(ii).attr('M') + "份" + "<br/>";
                            console.log("test"+$('#drink_list li').eq(ii).find(item1).text());
                            sum=sum+parseInt($('#drink_list li').eq(ii).find(item1).text().substring(36,38))*$('#drink_list li').eq(ii).attr('M');
                        }//$('#order_content').html(orderList+"總共 $"+sum)
                    }
                    var sum_style='<div style="padding-left:10px;">';
                    $('#order_content').html(orderList+"</br>"+sum_style+"總共 $"+sum+"</div></br></br>");
                });
            });

            $(document).on("pageshow", "#ListPage", function () {
                $('#s1').text(name);
                $('#s2').text(tel);
                $('#s3').text(add);
            });

            $(document).on('pageinit', '#payhome', function () {
                var t1, t2, t3;
                $('.btn1').on('click', function () {
                    $('.btn1').addClass('btn1-show');
                    $('#bg').addClass('bg-blur');
                    $('h2').addClass('text-show1');
                    $('h3').addClass('text-show2');
                    $('h4').addClass('btn-back-show');
                    $("#money").html("已扣除金額$"+sum);
                });

                $('.btn-back').on('click', function () {
                    $('h2').removeClass('text-show1');
                    $('h3').removeClass('text-show2');
                    $('h4').removeClass('btn-back-show');
                    $('.btn1').removeClass('btn1-show');
                    $('#bg').removeClass('bg-blur');
                    window.location.assign("../index.html");
                });
            });
        </script>

        <title>EZo App</title>
    </head>
    <body>
        <!-- Page: order  -->
        <div id="order" data-role="page">
            <header class="cd-header navbar-fixed-top" > 
                <a href="#0" class="cd-3d-nav-trigger " >
                <img src="/omt/Public/images/icon-user.svg" style="width:100%;height:100%;">
                <span></span>
                </a>

                <a href="index" class="cd-3d-nav-trigger-home " data-ajax="false" >
                <img src="/omt/Public/images/icon-home.svg" style="width:100%;height:100%;">
                </a>
            </header> <!-- .cd-header -->

            <nav class="cd-3d-nav-container navbar-fixed-top">
                <ul class="cd-3d-nav">
                    <li >
                        <a class="nav_list" id="order_t" data-color="#4FE29E" >訂票去</a>
                    </li>

                    <li class="cd-selected">
                        <a class="nav_list" id="order" data-color="#4FE29E">訂餐去</a>
                    </li>

                    <li >
                        <a class="nav_list" id="index" data-color="#485274" >member</a>
                    </li>

                    <li>
                        <a class="nav_list" id="ticket" data-color="#4FE29E" >我的票卷</a>
                    </li>

                    <li>
                        <a class="nav_list" id="order_t" data-color="#4FE29E">收藏優惠</a>
                    </li>
                </ul> <!-- .cd-3d-nav -->
                <span class="cd-marker color-2"></span> 
            </nav> <!-- .cd-3d-nav-container -->

            <!--Main-->
            <main>
                <div class="ui-content" style="position: relative;top: 80px;">
                    <div style="font-size:20px;font-family:Microsoft JhengHei; text-align:center;">
                        <span id="user_name" ></span>
                        阿松菌您好！<br><br>
                        請選擇您欲訂購的餐點：
                    </div>

                    <ul data-role="listview"  id="drink_list" data-inset="true" >
                        <?php if(is_array($food)): $i = 0; $__LIST__ = $food;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li style="  padding: 8px;border: 0;">
                                <span class="list"><?php echo ($data["food"]); ?></span><br/>
                                <div class=" col-xs-6"><img style="position: relative;left:10px;width:165px;" src="/omt/Public/images/drink.png"></div>
                                <div class="col-xs-6">
                                    <div style="display:inline-block;">(<?php echo ($data["size"]); ?>)<?php echo ($data["price"]); ?></div>
                                    <input type="text" class="input_type1" data-role="spinbox" name=""  data-options='{"type":"horizontal"}' value="0" min="0" max="100">
                                    <br/>
                                </div>                            
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <li style="height: 100px; background-color: #8BC3D4;">
                            <div><a class="btn ui-state-disabled" href="#ListPage" data-transition="flip" id="lets_order" style="width:100%;height:100%;top:0;margin:0;color:#000000;font-size:14px;">訂購</a></div>
                        </li>
                    </ul>
                </div>
            </main>  
        </div>
        <!-- Page: ListPage  -->
        <div id="ListPage" data-role="page" style="background-color: white;">
                <div data-role="header" data-position="fixed" data-theme="b">
                    <h3>您的訂購清單</h3>
                    <a class="ui-btn ui-btn-right" href="#order" data-transition="slide" data-direction="reverse"> X </a>
                    <!--<a class="ui-btn ui-btn-right" href="#payhome" data-transition="flip" >確認</a>-->
                </div>
                <div class="ui-content">
                    <div>訂購單號： 001
                        <span id="s1"></span>
                    </div>
                    <div style="font-family:微軟正黑體; font-size:20px; padding:10px; font-weight:bold;">
                        <div style="text-align:center; font-size:24px; padding:5px; ">購買清單：</div>
                        <div class="col-xs-1"></div>
                        <div class="col-xs-10">
                            <div id="order_content"></div>
                        </div>
                        <div class="col-xs-1"></div>
                        <!--<a  id="pay_bt" href="#pay" data-transition="flip" >確認</a>-->
                        <div  style="text-align:center;">
                            <a id="pay_btn"  class="btn btn-info" style="width:50%;font-weight:bold;font-size:20px;padding:8px; background-color:#2f889a; color:#FFF;">確認</a> 
                        </div>
                    </div>
                </div>
        </div>
        <!-- pay_message  -->
        <div class="modal fade" id="pay_message"  role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="width:300px;">
                <div class="modal-content" style="text-align:center; font-family:微軟正黑體; font-weight:bold;">
                    <div class="modal-header" style="background-color:#FF5959; color:#FFFFFF;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: auto;"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">訊　息</h4>
                    </div>
                    <div class="modal-body">
                        </br>
                        <div id="message" style="font-size:20px;">
                            <h3 class="content3">請依訂單號碼取餐</h3>
                            <h3 class="content4">感謝您的光臨</h3>
                            </br>
                            <h3 class="content5" style="font-size:14px;">如您有任何問題，歡迎至「聯絡我們」留下您寶貴的意見。</h3>
                        </div>
                        </br>       
                    </div>
                    <div class="modal-footer" style="text-align:center;">       
                        <button id="message_btn" class="btn btn-default" data-dismiss="modal" style="width:47%;" onclick="location.href='<?php echo U('index/index');?>'">回首頁</button>
                    </div>
                </div>
            </div>
        </div>   
    </body>
</html>