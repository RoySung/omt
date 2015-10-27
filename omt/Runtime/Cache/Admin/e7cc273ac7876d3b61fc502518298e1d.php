<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
	<link rel="stylesheet" type="text/css" href="/omt/Public/include/easyui.1.4.3/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="/omt/Public/include/easyui.1.4.3/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="/omt/Public/include/easyui.1.4.3/themes/color.css">
	<script type="text/javascript" src="/omt/Public/include/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/omt/Public/include/easyui.1.4.3/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="/omt/Public/include/easyui.1.4.3/jquery.edatagrid.js"></script>
</head>
<body>
	<img src="/omt/Public/images/title.png">

	<div id="dlg" class="easyui-dialog" title="News" closed="true" style="width:400px;height:350px;padding:10px;;"
			data-options="
				buttons: [{
					text:'Ok',
					iconCls:'icon-ok',
					handler:function(){
						alert('ok');
					}
				},{
					text:'Cancel',
					iconCls:'icon-cancel',
					handler:function(){
						$('#dlg').dialog('close');
					}
				}]
			">
		<div style="padding:10px 30px 20px 30px">
	    <form id="ff" method="post">
	    	<table cellpadding="5">
	    		<tr>
	    			<td>標題</td>
	    			<td><input class="easyui-textbox" type="text" name="title" data-options="required:true" style="width:250px;"></input></td>
	    		</tr>
	    		<tr>
	    			<td>類型</td>
	    			<td><input class="easyui-textbox" type="text" name="titletype" data-options="required:true" style="width:250px;"></input></td>
	    		</tr>
	    		<tr>
	    			<td>內容</td>
	    			<td><input class="easyui-textbox" type="text" name="content" data-options="multiline:true" style="width:250px;height:60px;"></input></td>
	    		</tr>
	    		<tr>
	    			<td>日期</td>
	    			<td><input class="easyui-datebox" name="data" data-options="required:true" style="width:250px;"></input></td>
	    		</tr>
	    		
	    	</table>
	    </form>
	    </div>
	</div>
    <div id="outlayout" class="easyui-layout" data-options="fit:true">
	
		<div id="westwindows" data-options="region:'west',split:true" title="功能表" style="width:200px;height:525px;">
			<div id="item" class="easyui-penal" style="padding:30px;">
				<a href="#" class="easyui-linkbutton c8" style="width:95%;" onclick="addTab('系統資訊')"><span style="font-size:12pt;">系統資訊</span></a>
				<div class="easyui-penal" style="padding:5px;width:100;"></div>
				<a href="#" class="easyui-linkbutton c8" style="width:95%;" onclick="addTab('會員資料','member.html')"><span style="font-size:12pt;">會員資料</span></a>
				<div class="easyui-penal" style="padding:5px;width:100;"></div>
				<a href="#" class="easyui-linkbutton c8" style="width:95%;" onclick="addTab('訂票資料','ticket.html')"><span style="font-size:12pt;">訂票資料</span></a>
				<div class="easyui-penal" style="padding:5px;width:100;"></div>
				<a href="#" class="easyui-linkbutton c8" style="width:95%;" onclick="addTab('訂餐資料','food.html')"><span style="font-size:12pt;">訂餐資料</span></a>
				<div class="easyui-penal" style="padding:5px;width:100;"></div>
				<a href="#" class="easyui-linkbutton c8" style="width:95%;" onclick="addTab('優惠資料','discount.html')"><span style="font-size:12pt;">優惠資料</span></a>
				<div class="easyui-penal" style="padding:5px;width:100;"></div>
				<a href="#" class="easyui-linkbutton c8" style="width:95%;" onclick="addTab('各電影院','theater.html')"><span style="font-size:12pt;">各電影院</span></a>
				<div class="easyui-penal" style="padding:5px;width:100;"></div>
				<a href="#" class="easyui-linkbutton c8" style="width:95%;" onclick="addTab('電影資訊','movie.html')"><span style="font-size:12pt;">電影資訊</span></a>
				<div class="easyui-penal" style="padding:5px;width:100;"></div>
				<a href="#" class="easyui-linkbutton c8" style="width:95%;" onclick="addTab('各片票價','ticketprice.html')"><span style="font-size:12pt;">各片票價</span></a>
				<div class="easyui-penal" style="padding:5px;width:100;"></div>
				<a href="#" class="easyui-linkbutton c8" style="width:95%;" onclick="addTab('電影場次','session.html')"><span style="font-size:12pt;">電影場次</span></a>
			</div>
		</div>

		<div data-options="region:'center'">
			<div id="insidelayout" class="easyui-layout" data-options="fit:true">
				<div data-options="region:'center',iconCls:'icon-ok'">
					<div id="tt" class="easyui-tabs" style="width:100%;height:528px;"
						data-options="tabWidth:110,fit:true">
						
						<div title="系統資訊" style="width:100%;height:100%;">
							
							<table id="dg" class="easyui-datagrid" style="width:100%;height:530px;"
							toolbar="#toolbar"  idField="id"  rownumbers="true" fitColumns="true" singleSelect="true"
							data-options="url:'datagrid_data1.json',method:'get',fit:true">
								<thead data-options="frozen:true">
									<tr>
										<th field="n_id" width="100" data-options="hidden:true" editor="text">n_id</th>
										<th field="title" width="100" editor="{type:'validatebox',options:{required:true}}">標題</th>
										<th field="titletype" width="100" editor="text">類型</th>
									</tr>
								</thead>
								<thead>
									<tr>
										<th field="content" width="50" editor="{type:'validatebox',options:{required:true}}">內容</th>
										<th field="data" width="50" editor="text">日期</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dlg').dialog('open')">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">刪除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">儲存</a>
		
	</div>
    
    <script type="text/javascript">
		$('#dlg').dialog('close')
		$(function(){
            $('#dg').edatagrid({
                url: 'get_users.php',
                saveUrl: 'save_user.php',
                updateUrl: 'update_user.php',
                destroyUrl: 'destroy_user.php'
            });
        });
		function addTab(title,url)
		{
			if($('#tt').tabs('exists', title))
			{
				$('#tt').tabs('select',title);
			}
			else {
				var content = 
				'<iframe scrolling="auto" frameborder="0"  src="'+url+'"  style="width:100%;height:99%" ></iframe>'
				$('#tt').tabs('add',{
					title:title,
					content:content,
					closable:true
				});
			}
		}
		
		
    </script>
</body>
</html>