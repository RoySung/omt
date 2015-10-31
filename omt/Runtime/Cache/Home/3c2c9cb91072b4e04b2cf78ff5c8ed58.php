<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<script src="/omt/Public/include/jquery-1.11.1.min.js"></script>
	  	<link rel="stylesheet" href="/omt/Public/include/jquery.mobile-1.4.5/css/jquery.mobile-1.4.5.css" />
		<script src="/omt/Public/include/jquery.mobile-1.4.5/js/jquery.mobile-1.4.5.js"></script>
		<link rel="stylesheet" href="/omt/Public/include/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="/omt/Public/css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="/omt/Public/css/style.css"> <!-- Resource style -->
		<script src="/omt/Public/js/modernizr.js"></script> <!-- Modernizr -->
		<script src="/omt/Public/js/main.js"></script> <!-- Resource jQuery -->
		<!--Bootstrap-->
		<script src="/omt/Public/include/bootstrap/js/bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="/omt/Public/css/tab.css">
		<!--star-->
		<link rel="stylesheet" href="/omt/Public/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
		<script src="/omt/Public/js/star-rating.js" type="text/javascript"></script>

		<title>Ticket</title>
		<style>
			.ui-input-text{
		  		border-width: 0px;
		  		border-style: none;
		  		-webkit-box-shadow: inset 0 0px 0px ;
			}
			.ui-page-theme-a,body,
			.ui-page-theme-a .ui-panel-wrapper {
				background-color: 	#485274 ;
				border-color:	#bbb;
				color: 	#333;
				text-shadow: 0  0px  0  ;
			}
			.tab{
				border-bottom: 1px solid #ddd;
	  			border-radius: 30px 30px 0 0;
				background-color: #45EDA6;	
				height: 25px;
			}
			.tab a{
				color: #055;
				font-weight: 600;

			}
			.tab-pane{
				padding-bottom: 20px;
			}
			.nav > li > a:hover,
			.nav > li > a:focus {
	 			text-decoration: none;
	  			background-color: #0C9;

			}
			.nav-tabs.nav-justified > li > a {
	  			border-bottom: 1px solid #ddd;
	  			border-radius: 15px 15px 0 0;
			}
			main h1{
				margin: 2em auto;
			}
			h2{
				text-align: center;
				font-size: 30px;
				color: white;
			}
			.nav > li > a {
	  			position: relative;
	  			display: block;
	  			padding: 8px 3px;
			}
			.cd-3d-nav a {
				font-size: 10px;
			}
			body  {
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
				$('body').toggleClass("visible");

				$(".nav_list").click(function(){
					event.preventDefault();
					// Sets the new destination to the href of the link
					color = $(this).data("color");
					$('body').css('background-color', color );
					$('body').css('opacity','0' );
					setTimeout("location.href='<?php echo U('index/"+this.id+"');?>'",850);
				});

				$("#b1").click(function(){
	 				$('.nav-tabs > .active').prev('li').find('a').trigger('click');
				});

				window.requestAnimationFrame(updateSelectedNav);
				$('.cd-3d-nav-trigger').click(function(){
					if($("#nav_user").attr('user')!=""){
						$(this).toggleClass('cd-3d-nav-trigger');
						$(this).toggleClass('cd-3d-nav-trigger-user');
					}
				});

				$(".link").click(function(){
					$('.cd-3d-nav-trigger-user').trigger('click');
					$('#myModalLabel').empty();
					$('#myModalLabel').append($(this).find('.m_title').html());
					$('#video').attr('src',$(this).attr('url'));
					$('#movie_info').modal('show');
				});

				$('#sign_send').click(function(){
					$.ajax({
		                url: "<?php echo U('index/signIn');?>",
		                data:$('#form_sing_in').serialize(),
		                type:"POST",
		                dataType:'text',
		                success: function(result){
		                	result = JSON.parse(result);
		                    console.log(result);
		                    if (result) {
		                    	$('#message').html("歡迎 "+result+" 先生/小姐");
		                    	$('#sign_info').modal('show');
		                    	$('#message_btn').attr("onclick","location.href='<?php echo U('index/index');?>'");
		                    } else {
		                    	$('#message').html("登入失敗!");
		                    	$('#sign_info').modal('show');
		                    }
		                },
		                error:function(result){ 
		                    console.log(result);
		                }
	            	});      	
				});

				$('#regist_send').click(function(){
					$.ajax({
		                url: "<?php echo U('index/signUp');?>",
		                data:$('#form_new_account').serialize(),
		                type:"POST",
		                dataType:'text',
		                success: function(result){
		                    result = JSON.parse(result);
		                    if (result==true) {
		                    	$("#message_btn").attr("onclick","");
		                    	$('#message').html("註冊成功!");
		                    	$('#sign_info').modal('show');
		                    	$('#message_btn').click(function(){
									$('.nav-tabs a[href="#Sign_in"]').tab('show');
						            $('#form_new_account')[0].reset();
								});
		                    } else {
		                    	$('#message').html(result);
		                    	$('#sign_info').modal('show');
		                    }
		                },
		                 error:function(result){ 
		                     console.log(result);
		                 }
	            	});
				});
				
			});
			//註冊時，偵測帳號是否存在
			function checkAccount(str) {
				if (str.length == 0) { 
					document.getElementById("txtHint").innerHTML = "";
				} else {
					$.ajax({
						url:"<?php echo U('index/checkAccount');?>",
						data:{
						    email:str
						},
		        		async: false,
						type:"POST",
						dataType:"json",
						success: function(result){
							if(result == true)
								document.getElementById("txtHint").innerHTML = "此帳號可使用";
							else
								document.getElementById("txtHint").innerHTML = result;
						}
					});
				}
			}
		</script>
	</head>
	<body>
		<div id="index" data-role="page">
			<header class="cd-header navbar-fixed-top" > 
				<a href="#0" class="cd-3d-nav-trigger " >
					<img src="/omt/Public/images/icon-user.svg" style="width:100%;height:100%;">
					<span></span>
				</a>
				<a href="<?php echo U('index/index');?>" class="cd-3d-nav-trigger-home " data-ajax="false" >
					<img src="/omt/Public/images/icon-home.svg" style="width:100%;height:100%;">
				</a>
			</header> <!-- .cd-header -->
			<nav class="cd-3d-nav-container navbar-fixed-top">
				<ul class="cd-3d-nav">
					<li >
						<a class="nav_list" id="order_t" data-color="#4FE29E">訂票去</a>
					</li>

					<li>
						<a class="nav_list" id="order" data-color="#4FE29E">訂餐去</a>
					</li>

					<li id="nav_user" user="<?php echo ($auth["email"]); ?>" class="cd-selected">
						<a class="nav_list" id="member"  data-color="#485274"><?php echo ($auth["name"]); ?></a>
					</li>

					<li>
						<a class="nav_list" id="ticket" data-color="#4FE29E">我的票卷</a>
					</li>

					<li>
						<a class="nav_list" id="discount" data-color="#4FE29E">優惠收藏</a>
					</li>
				</ul>
				<span class="cd-marker color-3" ></span>	
			</nav>
			<main>
				<div class="ui-content" data-role="content">
					<div id="p1" index='1' class="content pre">
						<h1>最新上映</h1>
			            <ul data-role="listview" data-inset="true" >
			            	<?php if(is_array($recent_movie)): $i = 0; $__LIST__ = $recent_movie;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li data-icon="false" style="font-family:微軟正黑體;">
					        		<a href="#" class="link" style="padding:0px 0px 1px;" url="<?php echo ($data["video"]); ?>">
						          		<div class=" col-xs-4 m_img" >　<img class=" img-responsive" src="/omt/Public/images/<?php echo ($data["mo_id"]); ?>.jpg"></div>
				                        <div class=" col-xs-8">
					                        <div style="padding:2px;"></div>
							          		<div class="m_title" style="text-align:center; font-size:20px;"><?php echo ($data["movie_name"]); ?></div> <!-- 片名 -->
							          		<div class="m_content" style="font-size:14px; color:#000;">上映日期：<?php echo ($data["start_date"]); ?></div>
					                        <div style="padding:2px;"></div>
					                        <div class="m_content" style="font-size:14px; color:#000;">下映日期：<?php echo ($data["end_date"]); ?></div>
					                        <div style="padding:2px;"></div>
							          		<div class="m_content" style="font-size:14px; color:#000;">類型：<?php echo ($data["movie_type"]); ?> </div>
					                        <div class="m_content" style="font-size:14px; color:#000;">片長：<?php echo ($data["film_length"]); ?> 分 </div>
					                        <div class="m_content" style="word-break: break-all; font-size:14px; white-space:normal;color:#000; text-align:center;">【關於電影】</div>
					                        <div class="m_content" style="word-break: break-all; font-size:14px; white-space:normal;color:#003;"> <?php echo ($data["synopsis"]); ?></div>
				                        </div>
					        		</a>
			      				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			  			</ul>
					</div>
					<div id="p2" index='2' class="content pre">
						<h1>即將上映</h1>
						<ul data-role="listview" data-inset="true" >
			            	<?php if(is_array($soon_movie)): $i = 0; $__LIST__ = $soon_movie;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li data-icon="false" style="font-family:微軟正黑體;">
					        		<a href="#" class="link" style="padding:0px 0px 1px;" url="<?php echo ($data["video"]); ?>">
						          		<div class=" col-xs-4 m_img" >　<img class=" img-responsive" src="/omt/Public/images/<?php echo ($data["mo_id"]); ?>.jpg"></div>
				                        <div class=" col-xs-8">
					                        <div style="padding:2px;"></div>
							          		<div class="m_title" style="text-align:center; font-size:20px;"><?php echo ($data["movie_name"]); ?></div> <!-- 片名 -->
							          		<div class="m_content" style="font-size:14px; color:#000;">上映日期：<?php echo ($data["start_date"]); ?></div>
					                        <div style="padding:2px;"></div>
					                        <div class="m_content" style="font-size:14px; color:#000;">下映日期：<?php echo ($data["end_date"]); ?></div>
					                        <div style="padding:2px;"></div>
							          		<div class="m_content" style="font-size:14px; color:#000;">類型：<?php echo ($data["movie_type"]); ?> </div>
					                        <div class="m_content" style="font-size:14px; color:#000;">片長：<?php echo ($data["film_length"]); ?> 分 </div>
					                        <div class="m_content" style="word-break: break-all; font-size:14px; white-space:normal;color:#000; text-align:center;">【關於電影】</div>
					                        <div class="m_content" style="word-break: break-all; font-size:14px; white-space:normal;color:#003;"> <?php echo ($data["synopsis"]); ?></div>
				                        </div>
					        		</a>
			      				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			  			</ul>
					</div>
					<div id="p3" index='3' class="content act">
						<h1>News</h1>
			            <div class="container">
			            	<?php if(is_array($news)): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><ul class="list-group-item">
				                <br />
				                    <span class="label label-info">news</span>
				                    <span class="news_left_padding_10" style="padding-left: 10px"></span>
				                    <span class="news_href">
										<a style='line-height:30px' href=""><?php echo ($data["title"]); ?></a>
				                        <span class="new_date" style="font-size:9px;position:relative;float:right;"><?php echo ($data["date"]); ?></span>
				                    </span>	
				                </ul><?php endforeach; endif; else: echo "" ;endif; ?>
			                <!-- 下方分頁連結 ex:1,2,3,4-->
			                <div style="text-align:center;">
				                <ul class='pagination'>
				                	<li><a data-ajax='false' href="<?php echo U('index/index');?>?page=1">最前頁</a></li>
				                	<?php $__FOR_START_19050__=1;$__FOR_END_19050__=$news_count+1;for($i=$__FOR_START_19050__;$i < $__FOR_END_19050__;$i+=1){ ?><li><a data-ajax='false' href="<?php echo U('index/index');?>?page=<?php echo ($i); ?>"><?php echo ($i); ?></a></li><?php } ?>
				                	<li><a data-ajax='false' href="<?php echo U('index/index');?>?page=<?php echo ($news_count); ?>">最後頁</a></li>
				                </ul>
			                </div>
			            </div>		
					</div>
					<div id="p4" index='4' class="content next">
						<h1>排行榜</h1>
                        <div class="table-responsive" style="background-color:#FFF; font-size:20px; font-family:微軟正黑體; font-weight:bold; text-align:center;">
                            <table class="table table-hover table-striped">
                                <thead>
                                	<tr>
	                                    <td>
	                                        <div style="font-size:14px; padding:5px;">本周排名</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:14px; padding:5px;">片名</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:14px; padding:5px;">下檔日期</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:14px; padding:5px;">滿意度</div>
	                                    </td>
                                	</tr>
                                </thead>
                                <tbody>
                                    <tr >
                                        <td>
                                        	<div style="font-size:20px; padding:5px;">1</div>
                                        </td>
	                                    <td>
	                                    	<div style="font-size:14px; padding:5px;">火影忍者</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:14px; padding:5px;">2015-10-25</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:18px; padding:5px; color:red;">★★★★★</div>
	                                    </td>
                                    </tr>
                                    <tr >
                                        <td>
	                                        <div style="font-size:20px; padding:5px;">2</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:14px; padding:5px;">多拉A夢</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:14px; padding:5px;">2015-10-31</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:18px; padding:5px; color:red;">★★★★☆</div>
	                                    </td>
                                    </tr>
                                    <tr >
                                        <td>
	                                        <div style="font-size:20px; padding:5px;">3</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:14px; padding:5px;">復仇者聯盟</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:14px; padding:5px;">2015-11-04</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:18px; padding:5px; color:red;">★★★★☆</div>
	                                    </td>
                                    </tr>
                                    <tr >
                                        <td>
	                                        <div style="font-size:20px; padding:5px;">4</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:14px; padding:5px;">侏儸紀公園</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:14px; padding:5px;">2015-11-10</div>
	                                    </td>
	                                    <td>
	                                        <div style="font-size:18px; padding:5px; color:red;">★★★★☆</div>
	                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
					</div>
				</div>
			</main>
			<div class="footer" data-role="footer" data-position="fixed" style="border-color: #485274;text-shadow: 0  5px  10px  #A70C1B ;font-weight: bolder;">
				<ul class="tab_list">
					<li  href="#p1" >最近上映</li>
					<li href="#p2" >即將上映</li>
					<li href="#p3" >NEWS</li>
					<li href="#p4" >排行榜</li>
					<li class="slider"></li>
				</ul>
			</div>
			<!-- sign Modal -->
			<div class="modal fade" id="sign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="background-color:#2f889a;">
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: auto;"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<ul class="nav nav-tabs" >
					            <li class="active" style="width:50%; text-align:center;">
					                <a href="#Sign_in" data-toggle="tab">
					                    <span style="line-height:50px; font-weight:bold; font-size:18px;">會員登入</span>
					                </a>
					            </li>
					            <li style="width:50%; text-align:center;">
					                <a href="#New_account" data-toggle="tab">
					                    <span style="line-height:50px; font-weight:bold;">會員註冊</span>
					                </a>
					            </li>
							</ul>
						    <!-- 頁籤內容 -->
						    <div class="tab-content">
						    	<!--  Sign_in頁籤內容 -->
						        <div class="tab-pane fade in active" id="Sign_in">
						            <form id="form_sing_in" action="" name="form_sing_in" method="post">
						            	<br />
						            	<div class="control-group"> 
										    <div class="form-group has-feedback">
											    <input type="text" name="email" style="padding-left: 35px; font-size:18px;" placeholder="信箱" />
											    <i class="form-control-feedback glyphicon glyphicon-user" style="left: 0px;"></i>
										    </div>
										</div>
										<div class="control-group">
										    <div class="form-group has-feedback">
											    <input type="password" name="password" style="padding-left: 35px; font-size:18px;" placeholder="密碼" />
											    <i class="form-control-feedback glyphicon glyphicon-lock" style="left: 0px;"></i>
										    </div>
										</div>
									    <div class="control-group">
								            <div class="controls">
									            <br />
									            <div  style="text-align:center;">
									            	<a id="sign_send"  class="btn btn-info" style="width:50%;font-weight:bold;font-size:20px;padding:8px; background-color:#2f889a; color:#FFF;">登入</a>	
									            </div>
								            </div>
							            </div>
									</form>
						        </div>
						        <!--  New_Account頁籤內容 -->
						        <div class="tab-pane fade" id="New_account">
						            <form id="form_new_account" action="" name="form_new_account" method="post">
						            	<br />
						            	<div class="control-group"> 
										    <div class="form-group has-feedback" >
											    <input type="text" name="email" style="padding-left: 35px; font-size:18px;" placeholder="信箱" onkeyup="checkAccount(this.value)"/>
											    <i class="form-control-feedback glyphicon glyphicon-user" style="left: 0px;"></i>
										    </div>
										    <!-- 偵測帳號是否重覆 -->
									        <p><span id="txtHint" style="color:#F00; font-size:16px; font-family:微軟正黑體;"></span></p>
										    <div class="form-group has-feedback">
											    <input type="text" name="password" style="padding-left: 35px; font-size:18px;" placeholder="密碼" />
											    <i class="form-control-feedback glyphicon glyphicon-lock" style="left: 0px;"></i>
										    </div>
										    <hr> <div style="text-align:center; background-color:#CCC; padding:8px;"><h3>以下請您填寫真實個人資料，以方便與您聯絡！</h3></div> 
										    <div class="form-group has-feedback">
											    <input type="text" name="name" style="padding-left: 35px; font-size:18px;" placeholder="姓名" />
											    <i class="form-control-feedback glyphicon glyphicon-user" style="left: 0px;"></i>
										    </div>
										    <div class="form-group has-feedback">
											    <input type="date" name="birthday" style="padding-left: 35px; font-size:18px;" placeholder="生日" />
											    <i class="form-control-feedback glyphicon glyphicon-gift" style="left: 0px;"></i>
										    </div>
										    <div class="form-group has-feedback">
											    <input type="text" name="phone" style="padding-left: 35px; font-size:18px;" placeholder="電話" />
											    <i class="form-control-feedback glyphicon glyphicon-phone" style="left: 0px;"></i>
										    </div>
										</div>
						            	<div class="control-group">
								            <div class="controls">
									            <br />
									            <div  style="text-align:center;">
									            	<a type="submit" id="regist_send" class="btn btn-info" style="width:50%;font-weight:bold;font-size:20px;padding:8px; background-color:#2f889a; color:#FFF;">註冊</a>
									            </div>
								            </div>
							            </div>
						            </form>
						        </div>
					      	</div>
				    	</div>
					</div>
				</div>  
			</div>
			<!-- movie_info Modal -->
			<div class="modal fade" id="movie_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="background-color: #DA4453">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: auto;"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">火影忍者</h4>
						</div>
						<div class="modal-body">
							<iframe id="video" width="100%" height="315" ></iframe>
							<input id="input-1" class="rating" data-min="0" data-max="5" data-step="0.1" data-size="xs">		
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" style="width:47%;">Close</button>
							<button type="button" class="btn btn-primary" style="width:47%;background-color: #9ADAE6;">立即訂票</button>
						</div>
					</div>
				</div>
			</div><!-- /.modal -->
			<!-- sign_info Message -->
			<div class="modal fade" id="sign_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" style="width:300px;">
					<div class="modal-content" style="text-align:center; font-family:微軟正黑體; font-size:16px;  font-weight:bold;">
						<div class="modal-header" style="background-color: #DA4453">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: auto;"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">訊　息</h4>
						</div>
						<div class="modal-body">
							</br>
							<div id="message" style="font-size:20px;"></div>
							</br>		
						</div>
						<div class="modal-footer" style="text-align:center;">
							
							<button id="message_btn" type="button" class="btn btn-default" data-dismiss="modal" style="width:47%;" onclick="">確認</button>
						</div>
					</div>
				</div>
			</div><!-- /.modal -->
		</div>
		<script src="/omt/Public/js/tab.js"></script>
	</body>
</html>