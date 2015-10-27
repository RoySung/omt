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
    <div id="dlg" class="easyui-dialog" title="電影資訊" closed="true" style="width:450px;height:450px;padding:10px;"
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
					<td>電影院</td>
					<td><input class="easyui-textbox" type="text" name="theater_name" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>電影名稱</td>
					<td><input class="easyui-textbox" type="text" name="movie_name" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>電影種類</td>
					<td><input class="easyui-textbox" type="text" name="movie_type" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>描述</td>
					<td><input class="easyui-textbox" name="synopsis" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>預告片</td>
					<td><input class="easyui-textbox" name="video" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>影片長度</td>
					<td><input class="easyui-textbox" name="film_length" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>上映時間</td>
					<td><input class="easyui-textbox" name="start_data" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>下檔時間</td>
					<td><input class="easyui-textbox" name="end_data" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>評分</td>
					<td><input class="easyui-textbox" name="grade" style="width:250px;"></input></td>
				</tr>
			</table>
		</form>
		</div>
	</div>
    <table id="dg" class="easyui-datagrid" style="width:100%;height:530px;"
	toolbar="#toolbar"  idField="id"  rownumbers="true" fitColumns="true" singleSelect="true"
	data-options="url:'<?php echo U('Movie/movie_c');?>',method:'get',fit:true">
			<thead>
			<tr>
				<th field="theater_name" width="50" editor="text">電影院</th>
				<th field="movie_name" width="50" editor="{type:'validatebox',options:{required:true}}">電影名稱</th>
				<th field="movie_type" width="50" editor="{type:'validatebox',options:{required:true}}">電影種類</th>
				<th field="synopsis" width="50" editor="{type:'validatebox',options:{required:true}}">描述</th>
				<th field="video" width="50" editor="{type:'validatebox',options:{required:true}}">預告片</th>
				<th field="film_length" width="50" editor="text">影片長度</th>
				<th field="start_data" width="50" editor="text">上映時間</th>
				<th field="end_data" width="50" editor="text">下檔時間</th>
				<th field="grade" width="50" editor="text">評分</th>
				<th field="m_id" width="50" data-options="hidden:true" editor="text">m_id</th>
				<th field="film_type" width="50" data-options="hidden:true" editor="text">film_type</th>
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