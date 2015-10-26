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

                    add_discount('{"type":1,"type_name":"飲品","discount":10,"m_id":12,"start_date":"2015-10-20","end_date":"2015-10-30","enable":1}');
        		});
            function add_discount(from_android){
                from_android = JSON.parse(from_android);
                console.log(from_android);
                $.ajax({
                    url: "<?php echo U('Discount/discount_c');?>",
                    data:{
                        discount:from_android
                    },
                    type:"POST",
                    success: function(result){
                        console.log(result);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div id="easyin">
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
                        <li>
                            <a class="nav_list" id="order_t" data-color="#4FE29E" >訂票去</a>
                  			</li>

                  			<li>
                            <a class="nav_list" id="order" data-color="#4FE29E">訂餐去</a>
                  			</li>

                  			<li  id="nav_user" user="user">
                            <a class="nav_list" id="member" data-color="#485274" >個人資料</a>
                  			</li>

                  			<li >
                            <a class="nav_list" id="ticket" data-color="#4FE29E" >我的票卷</a>
                  			</li>

                  			<li class="cd-selected">
                            <a class="nav_list" id="discount" data-color="#4FE29E">優惠收藏</a>
                  			</li>
                		</ul> <!-- .cd-3d-nav -->
                    <span class="cd-marker color-4"></span> 
                </nav> <!-- .cd-3d-nav-container -->
                   <!--Main-->
                <main>
                    <div class="ui-content" style="position: relative;top: 80px;">
                     	  <!--<div  class="content next">-->
                          <!--     以下新增      -->
                        <div class="table-responsive" style="padding:10px; background-color:#FFF; font-size:20px; font-family:微軟正黑體; font-weight:bold; ">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php if($result == 1): ?><tr>
                                        <td style="width:33%;color:#006; text-align:center;">優惠類型</td>
                                        <td style="width:33%;color:#006; text-align:center;">折扣</td>
                                        <td style="width:33%;color:#006; text-align:center;">優惠期限</td>
                                    </tr>
                                    <?php if(is_array($discount)): $i = 0; $__LIST__ = $discount;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                                            <td style="width:33%;text-align:center;vertical-align: bottom;"><?php echo ($data["type_name"]); ?></td>
                                            <td style="width:33%;text-align:center;vertical-align: bottom;"><?php echo ($data["discount"]); ?></td>
                                            <td style="width:33%;text-align:center;font-size: 12px;vertical-align: bottom;">起始日：<?php echo ($data["start_date"]); ?></br>
                                            截止日：<?php echo ($data["end_date"]); ?></td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td style="width:33%;color:#006; text-align:center;">尚未有優惠項目</td>
                                    </tr><?php endif; ?>
                                </tbody>                                 
                            </table>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>