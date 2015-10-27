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
    	<div id="dlg" class="easyui-dialog" title="新增會員" closed="true" style="width:450px;height:400px;padding:10px;"
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
			<form id="memberform" method="post">
				<table cellpadding="5">
					<tr>
						<td>會員名稱</td>
						<td><input class="easyui-textbox" type="text" name="name" data-options="required:true" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>信箱</td>
						<td><input class="easyui-textbox" type="text" name="mail" data-options="required:true,validType:'email'" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>密碼</td>
						<td><input class="easyui-textbox" type="text" name="password" data-options="required:true" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>生日</td>
						<td><input class="easyui-textbox" name="birthday" data-options="required:true" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>手機</td>
						<td><input class="easyui-textbox" name="phone" data-options="required:true" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>金額</td>
						<td><input class="easyui-textbox" name="cash" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>加入日期</td>
						<td><input class="easyui-datebox" name="build_data" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>uid</td>
						<td><input class="easyui-textbox" name="uid" data-options="required:true" style="width:250px;"></input></td>
					</tr>
				</table>
			</form>
			</div>
		</div>
		<div id="insidelayout" class="easyui-layout" data-options="fit:true">
			<table id="dg" class="easyui-datagrid" style="width:100%;height:530px;"
			toolbar="#toolbar"  idField="id"  rownumbers="true" fitColumns="true" singleSelect="true"
			data-options="url:'<?php echo U('Member/member_c');?>',method:'get',fit:'true'">
					<thead>
					<tr>
						<th field="name" width="50" editor="{type:'validatebox',options:{required:true}}">會員名稱</th>
						<th field="email" width="50" editor="{type:'validatebox',options:{required:true},validType:'email'}">信箱</th>
						<th field="password" width="50" editor="{type:'validatebox',options:{required:true}}">密碼</th>
						<th field="birthday" width="50" editor="text">生日</th>
						<th field="phone" width="50" editor="{type:'validatebox',options:{required:true}}">手機</th>
						<th field="cash" width="50" editor="text">金額</th>
						<th field="build_date" width="50" editor="text">加入日期</th>
						<th field="uid" width="50" editor="text">uid</th>
						<th field="m_id" width="50" data-options="hidden:true" editor="text">m_id</th>
					</tr>
				</thead>
			</table>
		<div>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dlg').dialog('open')">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">刪除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">儲存</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="searchOpen()">搜尋UID</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="savemoney()">儲值</a>
	</div>
    <script type="text/javascript">
        $(function(){

        });
		function searchOpen()
		{
			$('#insidelayout').layout('remove', 'east');
			$('#insidelayout').layout('add',{
				region: 'east',
				width: 380,
				title: '搜尋表',
				split: true,
				content:'<form id="searchform" style="padding:20px;font-size:20px;"method="post"><table cellpadding="20"><tr><td>信箱</td><td><input class="easyui-textbox" type="validatebox" name="mail" style="width:200px;"></input></td></tr><tr><td>手機</td><td><input class="easyui-textbox" type="text" name="phone" data-options="required:true" style="width:200px;"></input></td></tr><tr><td>結果</td><td><input class="easyui-textbox" type="text" name="result" data-options="multiline:true" style="width:200px;height:60px;"></input></td></tr><tr><a href="#" class="easyui-linkbutton c5" style="width:50px;" onclick=alert("搜尋")>搜尋</a><a href="#" class="easyui-linkbutton" style="width:50px;" onclick="formclear()">清除</a></tr></table></form>'
			});
		}
		function formclear()
		{
			$('#searchform').form('clear');
		}
		function savemoney()
		{
			$('#insidelayout').layout('remove', 'east');
			$('#insidelayout').layout('add',{
				region: 'east',
				width: 380,
				title: '儲值表',
				split: true,
				content:'<form id="searchform" style="padding:20px;font-size:20px;"method="post"><table cellpadding="20"><tr><td>信箱</td><td><input class="easyui-textbox" type="text" name="mail" style="width:200px;"></input></td></tr><tr><td>手機</td><td><input class="easyui-textbox" type="text" name="phone" data-options="required:true" style="width:200px;"></input></td></tr><tr><td>儲值金額</td><td><select class="easyui-combobox" name="money" style="width:200px;"><option value="money100" selected>100</option><option value="money200">200</option><option value="money500">500</option><option value="money1000">1000</option></select></td></tr></tr><tr><a href="#" class="easyui-linkbutton c5" style="width:50px;" onclick=alert("儲值")>儲值</a><a href="#" class="easyui-linkbutton" style="width:50px;" onclick="formclear()">清除</a></tr></table></form>'
			});
		}
    </script>
    
</body>
</html>