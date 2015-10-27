<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Build CRUD DataGrid with jQuery EasyUI - jQuery EasyUI Demo</title>
	<link rel="stylesheet" type="text/css" href="/omt/Public/include/easyui.1.4.3/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="/omt/Public/include/easyui.1.4.3/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="/omt/Public/include/easyui.1.4.3/themes/color.css">
	<script type="text/javascript" src="/omt/Public/include/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/omt/Public/include/easyui.1.4.3/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="/omt/Public/include/easyui.1.4.3/jquery.edatagrid.js"></script>
</head>
<body>
    <div id="dlg" class="easyui-dialog" title="訂票資料" closed="true" style="width:450px;height:400px;padding:10px;"
		data-options="
			buttons: [{
				text:'確定',
				iconCls:'icon-ok',
				handler:function(){
					alert('ok');
				}
			},{
				text:'取消',
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
					<td>電影名稱</td>
					<td><input class="easyui-textbox" type="text" name="movie_name" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>電影種類</td>
					<td><input class="easyui-textbox" type="text" name="movie_type" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>電影院</td>
					<td><input class="easyui-textbox" type="text" name="theater_name" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>會員名稱</td>
					<td><input class="easyui-textbox" name="name" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>座位</td>
					<td><input class="easyui-textbox" name="seat" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>張數</td>
					<td><input class="easyui-textbox" name="quantity" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>花費</td>
					<td><input class="easyui-textbox" name="cost" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>enable</td>
					<td><input class="easyui-textbox" name="enable" data-options="required:true" style="width:250px;"></input></td>
				</tr>
			</table>
		</form>
		</div>
	</div>
    <table id="dg" class="easyui-datagrid" style="width:100%;height:530px;"
	toolbar="#toolbar"  idField="id"  rownumbers="true" fitColumns="true" singleSelect="true"
	data-options="url:'<?php echo U('Ticket/ticket_c');?>',method:'get',fit:true">
			<thead>
			<tr>
				<th field="movie_name" width="50" editor="text">電影名稱</th>
				<th field="movie_type" width="50" editor="text">電影種類</th>
				<th field="theater_name" width="50" editor="text">電影院</th>
				<th field="name" width="50" editor="text">會員名稱</th>
				<th field="seat" width="50" editor="{type:'validatebox',options:{required:true}}">座位</th>
				<th field="quantity" width="50" editor="{type:'validatebox',options:{required:true}}">張數</th>
				<th field="cost" width="50" editor="text">花費</th>
				<th field="enable" width="50" editor="text">enable</th>
				<th field="m_id" width="50" data-options="hidden:true" editor="text">m_id</th>
				<th field="ot_id" width="50" data-options="hidden:true" editor="text">ot_id</th>
				<th field="s_id" width="50" data-options="hidden:true" editor="text">s_id</th>
				
			</tr>
		</thead>
	</table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dlg').dialog('open')">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">刪除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">儲存</a>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#dg').edatagrid({
                url: 'get_users.php',
                saveUrl: 'save_user.php',
                updateUrl: 'update_user.php',
                destroyUrl: 'destroy_user.php'
            });
        });
    </script>
    
</body>
</html>