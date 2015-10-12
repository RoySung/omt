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
        <script src="/omt/Public/include/bootstrap/js/bootstrap.js"></script>
        <link rel="stylesheet" href="/omt/Public/css/reset.css"> <!-- CSS reset -->
        <link rel="stylesheet" href="/omt/Public/css/style.css"> <!-- Resource style -->
        <script src="/omt/Public/js/main.js"></script> <!-- Resource jQuery -->
        <!--select ajax-->
        <script type="text/javascript" src="/omt/Public/js/selectboxes.js"></script>
        <script type="text/javascript" src="/omt/Public/js/public.js"></script>
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
                color: #000;
                border: : 1px outset;
            }
            .ui-select{
                padding: 0px;
            }
            .img{
                width: 100%;
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
            var code="";
            var price;
            $(document).ready(function(){
                //load theater data
                $.ajax({
                    url:"<?php echo U('OrderTicket/theater_r');?>",
                    async:false,
                    type:"POST",
                    success:function(result){
                        for (i=0 ; i<result.length ;i++) {
                            $("#theater").append($("<option></option>").attr("value", result[i].t_id).text(result[i].theater_name));
                        }
                    }
                });
                $('#theater').prop("selectedIndex",0);
                $('#theater').selectmenu('refresh');
                //set date is today
                $('#date').val(today());
                //load movie
                load_movie();
                //when movie change
                $('#movie').change(function(){
                    $('#movie_img').attr('src',"/omt/Public/images/"+$('#movie').val()+".jpg");

                    $('#session').html('');
                    $("#session").append($("<option></option>").attr("value",'').text("請選擇"));
                    $("#session").selectmenu('refresh');
                    if($('#movie').val()) {
                        $.ajax({
                            url:"<?php echo U('OrderTicket/session_r');?>",
                            data:{
                                t_id:$('#theater').val(),
                                date:$('#date').val(),
                                mo_id:$('#movie').val()
                            },
                            async:false,
                            type:"POST",
                            success:function(result){
                                for (i=0 ; i<result.length ;i++) {
                                    $("#session").append($("<option></option>").attr("value", result[i].s_id).text(result[i].time));
                                }
                            }
                        });
                    }
                });
                //when theater change
                $('#theater').change(function(){
                    $('#movie').html('');
                    $("#movie").append($("<option></option>").attr("value",'').text("請選擇"));
                    $('#movie').selectmenu('refresh');
                    load_movie();
                    $('#session').html('');
                    $("#session").append($("<option></option>").attr("value",'').text("請選擇"));
                    $('#session').selectmenu('refresh');
                });
                //when date change
                 $('#date').change(function(){
                    $('#movie').html('');
                    $("#movie").append($("<option></option>").attr("value",'').text("請選擇"));
                    $("#movie").selectmenu('refresh');
                    load_movie();
                    $('#session').html('');
                    $("#session").append($("<option></option>").attr("value",'').text("請選擇"));
                    $("#session").selectmenu('refresh');
                });

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
                //至位置頁面
                $('#send').click(function(){
                    if(!$("#movie").val()||!$("#session").val()||!$('#date').val())
                        alert('請完整填寫');
                    else{
                        //price of ticket
                        $.ajax({
                            url:"<?php echo U('OrderTicket/ticketPrice_r');?>",
                            data:{
                                t_id:$('#theater').val(),
                                mo_id:$('#movie').val()
                            },
                            type:"POST",
                            async:false,
                            success:function(result){
                                price = parseInt(result[0].price);
                            }
                        });
                        set_seat();
                        $.mobile.changePage($("#oreder_seat"),{transition:"slide"});
                        $("#movie_title").empty();
                        $("#movie_title").append($('#movie-button span').html());
                        $("#movie_session").empty();
                        $("#movie_session").append($('#date').val()+"  "+$('#session-button span').html().substr(0,5));
                    }
                });
                $('#buy').click(function(){
                    //alert(code);
                    if($("#selected-seats li").length>0){
                        //seat
                        var seat = "";
                        $("#selected-seats").find('li').each(function(i){
                            seat = seat + $(this).attr('value')+"-";
                        });
                        //以下新增 ajax
                        console.log($('#movie').val()+" "+$('#session').val()+" "+seat.substr(0,seat.length-1)+" "+parseInt($('#counter').html()));
                        $.ajax({
                            url: "<?php echo U('OrderTicket/orderticket_c');?>",
                            data:{
                                mo_id:$('#movie').val(),
                                s_id:$('#session').val(),
                                seat:seat.substr(0,seat.length-1),
                                quantity:parseInt($('#counter').html())
                            },
                            type:"POST",
                            async:false,
                            success: function(result){
                                console.log(result);
                            },
                        });
                    }  else {
                        alert("請選擇位子");
                    }
                });
            });
            function load_movie(){
                $.ajax({
                    url:"<?php echo U('OrderTicket/movie_r');?>",
                    data:{
                        t_id:$('#theater').val(),
                        date:$('#date').val()
                    },
                    async:false,
                    type:"POST",
                    success:function(result){
                        for (i=0 ; i<result.length ;i++) {
                            $("#movie").append($("<option></option>").attr("value", result[i].mo_id).text(result[i].movie_name));
                        }
                    }
                });
            }
        </script>
        <!--seat-->
        <style type="text/css">
            .demo{width:100%; margin:40px auto 0 auto; min-height:450px;}
            @media screen and (max-width: 360px) {.demo {width:340px}}
            .front{width: 300px;margin: 5px 32px 45px 32px;background-color: #f0f0f0; color: #666;text-align: center;padding: 3px;border-radius: 5px;}
            .booking-details {float: left;position: relative;width:200px;height: 450px; }
            .booking-details h3 {margin: 5px 5px 0 0;font-size: 16px;}
            .booking-details p{line-height:26px; font-size:16px; color:#999}
            .booking-details p span{color:#666}
            div.seatCharts-cell {color: #182C4E;height: 25px;width: 25px;line-height: 25px;margin: 3px;float: left;text-align: center;outline: none;font-size: 13px;}
            div.seatCharts-seat {color: #fff;cursor: pointer;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;width:6%;}
            div.seatCharts-row {height: 35px;}
            div.seatCharts-seat.available {background-color: rgba(177, 177, 177, 0.81);}
            div.seatCharts-seat.focused {background-color: #76B474;border: none;}
            div.seatCharts-seat.selected {background-color: #FF0000;}
            div.seatCharts-seat.unavailable {background-color: #472B34;cursor: not-allowed;}
            div.seatCharts-container {width: 100%;padding: 0px;float: left;z-index: 0;}
            div.seatCharts-legend {padding-left: 0px;position: relative;bottom: 16px;}
            ul.seatCharts-legendList {padding-left: 0px;}
            .seatCharts-legendItem{float:left; width:90px;margin-top: 10px;line-height: 2;}
            span.seatCharts-legendDescription {margin-left: 5px;line-height: 30px;}
            .checkout-button {display: block;width:80px; height:24px; line-height:20px;margin: 10px auto;border:1px solid #999;font-size: 14px; cursor:pointer}
            #selected-seats {max-height: 150px;overflow-y: auto;overflow-x: none;width: 200px;}
            #selected-seats li{float:left; width:72px; height:26px; line-height:26px; border:1px solid #d3d3d3; background:#f7f7f7; margin:6px; font-size:14px; font-weight:bold; text-align:center}
            .ui-content{padding: 0px;}
        </style>
    </head>
    <body>
        <div id="order_t" data-role="page">
            <header class="cd-header navbar-fixed-top" > 
                <a href="#0" class="cd-3d-nav-trigger " >
                    <img src="/omt/Public/images/icon-user.svg" style="width:100%;height:100%;">
                    <span></span>
                </a>
                <a href="index.php" class="cd-3d-nav-trigger-home " data-ajax="false" >
                    <img src="/omt/Public/images/icon-home.svg" style="width:100%;height:100%;">
                </a>
            </header> <!-- .cd-header -->
            <nav class="cd-3d-nav-container navbar-fixed-top">
                <ul class="cd-3d-nav">
                    <li class="cd-selected">
                        <a class="nav_list" id="order_t" data-color="#4FE29E" >訂票去</a>
                    </li>

                    <li>
                        <a class="nav_list" id="order" data-color="#4FE29E">訂餐去</a>
                    </li>

                    <li id="nav_user" user="user">
                        <a class="nav_list" id="member" data-color="#485274" >個人資料</a>
                    </li>

                    <li>
                        <a class="nav_list" id="ticket" data-color="#4FE29E" >我的票卷</a>
                    </li>

                    <li>
                        <a class="nav_list" id="order_t" data-color="#4FE29E">優惠收藏</a>
                    </li>
                </ul> <!-- .cd-3d-nav -->
                <span class="cd-marker color-1"></span> 
            </nav> <!-- .cd-3d-nav-container -->
            <!--Main-->
            <main>
                <div class="ui-content" style="position: relative;">
                    <div>
                        <img id="movie_img" class="img" src="/omt/Public/images/0.jpg">
                    </div>
                    <div>
                        <label>戲院</label>
                        <select id="theater" class=" form-control ">
                        </select>
                    </div>
                        <div>
                        <label>電影</label>
                        <select id="movie" class=" form-control">
                            <option value="">請選擇</option>
                        </select>
                    </div>
                    <div>
                        <label>日期</label>
                        <input id="date" type="date">
                    </div>
                    <div>
                        <label>場次</label>
                        <select id="session" class=" form-control">
                            <option value="">請選擇</option>
                        </select>
                    </div>
                    <div>
                        <a id="send" class="ui-btn">確認訂票</a>
                    </div>
                    <br/>
                </div>
            </main>
            </div>

            <div id="oreder_seat" data-role="page">
                <header class="cd-header navbar-fixed-top" > 
                    <a href="#0" class="cd-3d-nav-trigger " >
                        <img src="/omt/Public/images/icon-user.svg" style="width:100%;height:100%;">
                        <span></span>
                    </a>
                    <a class="ui-btn ui-btn-left ui-btn-icon-left ui-icon-back" href="#order_t" data-transition="slide" data-direction="reverse" style="font-size: 12px;margin-top: 18px;">Back</a>
                </header> <!-- .cd-header -->
                <nav class="cd-3d-nav-container navbar-fixed-top">
                    <ul class="cd-3d-nav">
                        <li class="cd-selected">
                            <a class="nav_list" id="order_t" data-color="#4FE29E" >訂票去</a>
                        </li>

                        <li>
                            <a class="nav_list" id="order" data-color="#4FE29E">訂餐去</a>
                        </li>

                        <li >
                            <a class="nav_list" id="index" data-color="#485274" >User</a>
                        </li>

                        <li>
                            <a class="nav_list" id="ticket" data-color="#4FE29E" >My票卷</a>
                        </li>

                        <li>
                            <a class="nav_list" id="order_t" data-color="#4FE29E">My最愛</a>
                        </li>
                    </ul> <!-- .cd-3d-nav -->
                    <span class="cd-marker color-1"></span> 
                </nav> <!-- .cd-3d-nav-container -->
                <!--Main-->
                <main>
                    <div class="ui-content" style="position: relative;">
                        <div id="main">
                            <div class="demo">
                                <div id="seat-map">
                                    <div class="front">螢幕</div>         
                                </div>
                                <HR color="#000000" width="100%" style="border-top: 5px dashed #4FE29E;">
                                <div class="booking-details">
                                    <p>電影名稱 : <span id="movie_title">星际穿越</span></p>
                                    <p>時間 : <span id="movie_session">11月14日 21:00</span></p>
                                    <p>座位 : </p>
                                    <ul id="selected-seats"></ul>
                                    <p>票數 : <span id="counter">0</span></p>
                                    <p>金額總計 : <b>$<span id="total">0</span></b></p>
                                    <button id="buy">確定購買</button>
                                    <div id="legend"></div>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                            <br/>
                        </div>
                    </div>
                </main>
            </div>

        <!--seat-->
        <script type="text/javascript" src="/omt/Public/js/jquery.seat-charts.min.js"></script>
        <script type="text/javascript">
            function set_seat(){
                //reset selected seat
                $(".selected").click();
                var eng=["","A","B","C","D","E","F","G","H","I","J"];
                var $cart = $('#selected-seats'), //座位区
                $counter = $('#counter'), //票数
                $total = $('#total'); //总计金额
                var sc = $('#seat-map').seatCharts({
                    map: [  //座位图
                        'aaaaaaaaaa',
                        'aaaaaaaaaa',
                        'aaaaaaaaaa',
                        'aaaaaaaa__',
                        'aaaaaaaaaa',
                        'aaaaaaaaaa',
                        'aaaaaaaaaa',
                        'aaaaaaaaaa',
                        'aaaaaaaaaa',
                        'aa__aa__aa'
                    ],
                    naming : {
                        top : false,
                        getLabel : function (character, row, column) {
                            return column;
                        }
                    },
                    legend : { //定义图例
                        node : $('#legend'),
                        items : [
                            [ 'a', 'available',   '空位' ],
                            [ 'a', 'unavailable', '已售出']
                        ]         
                    },
                    click: function () { //点击事件
                        if (this.status() == 'available') { //可选座
                            $('<li>'+eng[(this.settings.row+1)]+this.settings.label+'</li>')
                            .attr('id', 'cart-item-'+this.settings.id)
                            .attr('value',eng[(this.settings.row+1)]+this.settings.label)
                            .data('seatId', this.settings.id)
                            .appendTo($cart);
                            $counter.text(sc.find('selected').length+1);
                            $total.text(recalculateTotal(sc)+price);

                            return 'selected';
                        } else if (this.status() == 'selected') { //已选中
                            //更新数量
                            $counter.text(sc.find('selected').length-1);
                            //更新总计
                            $total.text(recalculateTotal(sc)-price);
                            //删除已预订座位
                            $('#cart-item-'+this.settings.id).remove();
                            //可选座
                            return 'available';
                        } else if (this.status() == 'unavailable') { //已售出
                            return 'unavailable';
                        } else {
                          return this.style();
                        }
                    }
                });
                //已售出的座位
                sc.get(['4_4','4_5','6_6','6_7','8_5','8_6','8_7','8_8', '10_1', '10_2']).status('unavailable');
            }
            //計算訂票總金額
            function recalculateTotal(sc) {
                var total = 0;
                sc.find('selected').each(function () {
                    total += price;
                });
              return total;
            }
        </script>
    </body>
</html>