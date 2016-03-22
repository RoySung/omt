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
    <div id="dlg" class="easyui-dialog" title="各片票價" closed="true" style="width:450px;height:300px;padding:10px;"
		data-options="
			buttons: [{
				text:'確定',
				iconCls:'icon-ok',
				handler:function(){
					append();
					$('#dlg').dialog('close');
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
		<form id="ticketpriceform" method="post">
			<table cellpadding="5">
				<tr>
					<td>電影名稱</td>
					<td><input class="easyui-textbox" type="text" name="movie_name" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>電影院</td>
					<td><input class="easyui-textbox" type="text" name="theater_name" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>類型</td>
					<td><input class="easyui-textbox" type="text" name="type" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>價格</td>
					<td><input class="easyui-textbox" name="price" data-options="required:true" style="width:250px;"></input></td>
				</tr>
			</table>
		</form>
		</div>
	</div>
	<div id="edit_dialog" class="easyui-dialog" title="編輯票價" closed="true" style="width:450px;height:400px;padding:10px;"
		buttons="#adduser_button">
		<div style="padding:10px 30px 20px 30px">
			<form id="form_edit" method="post" enctype="multipart/form-data">
				<table cellpadding="5">
					<tr>
						<td>電影名稱</td>
						<td><input class="easyui-textbox" type="text" name="movie_name" data-options="required:true" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>電影院</td>
						<td><input class="easyui-textbox" type="text" name="theater_name" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>類型</td>
						<td><input class="easyui-textbox" type="text" name="type" data-options="required:true" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>價格</td>
						<td><input class="easyui-textbox" name="price" data-options="required:true" style="width:250px;"></input></td>
					</tr>
				</table>
			</form>
			<div id="edituser_button" style="float:right;" >
		        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save('#form_edit')" style="width:90px">儲存</a>
		        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#edit_dialog').dialog('close')" style="width:90px">取消</a>
		    </div>
		</div>
	</div>
    <table id="dg" class="easyui-datagrid" style="width:100%;height:530px;"
	toolbar="#toolbar"  idField="id"  rownumbers="true" fitColumns="true" singleSelect="true"
	data-options="url:'<?php echo U('Ticketprice/ticketprice_r');?>',method:'get',fit:true">
			<thead>
			<tr>
				<th field="movie_name" width="50" editor="text">電影名稱</th>
				<th field="theater_name" width="50" editor="text">電影院</th>
				<th field="type" width="50" editor="{type:'validatebox',options:{required:true}}">類型</th>
				<th field="price" width="50" editor="{type:'validatebox',options:{required:true}}">價格</th>
				<th field="t_id"  width="50" data-options="hidden:true" editor="text">t_id</th>
				<th field="tp_id"  width="50" data-options="hidden:true" editor="text">t_id</th>
			</tr>
		</thead>
	</table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dlg').dialog('open')">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyRow()">刪除</a>
        <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').        edatagrid('saveRow')">儲存</a>-->
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit_ticketprice()">編輯</a>
    </div>
    <script type="text/javascript">
    	function edit_ticketprice(){
			var row = $('#dg').datagrid('getSelected');
			if(row.tp_id!=''){
				$('#edit_dialog').dialog('open');
				$('#form_edit').form('load',row);
				url = "<?php echo U('ticketprice/edit_c');?>?tp_id=" + row.tp_id;
			}
		}
		function save(form){
			$(form).form('submit',{
                url: url,
                success: function(result){
                    $('#edit_dialog').dialog('close');
                    $('#dg').datagrid('reload');
                }
            });
		}
        function append(){
        	$('#ticketpriceform').form('submit',{
	            onSubmit: function(){
	            	if( $('#ticketpriceform').form('validate')==false){
	            		$.messager.confirm('警告','紅色欄位為必要欄位!!',function(r){
						    if (r){
						        $('#dlg').dialog('open');
						    }
						});
	            	}
	            	else{
	            		/*append_forDB();*/
	            		$.ajax({
			                url: "<?php echo U('ticketprice/append_c');?>",
			                data:$('#ticketpriceform').serialize(),
			                type:"POST",
			                dataType:'text',
			                
			                success: function(result){

			                    result = JSON.parse(result);
			                    if (result==true) {
			                    	$.messager.alert('訊息','成功新增資料');
			                    	setTimeout("location.href='<?php echo U('Index/ticketprice');?>'",850);
			                    } 
			                },
			                 error:function(result){ 
			                     console.log(result);
			                }
			        	});
	            		$('#ticketpriceform').form('clear'); 
	            		return $('#ticketpriceform').form('validate');
	            	}             
	            }
            });	
        }
   /*     	var name = $('#name').val()
        	var theater_name = $('#theater_name').val()
        	var ticketprice = $('#ticketprice').val()
        	var type = $('#type').val()
        	var price = $('#price').val()
        	var size = $('#size').val()

        	if(name==''||theater_name==''||ticketprice==''||type==''||price==''||size==''){
        		$.messager.confirm('Confirm','紅色欄位為必要欄位!!',function(r){
				    if (r){
				        $('#dlg').dialog('open');
				    }
				});
        	}else {
	        	$('#dg').datagrid('appendRow',{
					name: name,
					theater_name: theater_name,
					ticketprice: ticketprice,
					type: type,
					price: price,
					size: size
				});

				$('#dlg').dialog('close');
				$('#ticketpriceform').form('clear');
        	}*/

        function destroyRow(){
        	var row=$('#dg').datagrid('getSelected');
        	if(row){
        		$.messager.confirm('警告','確定要刪除此列',function(r){
        			if(r){
        				/*destroyRow_forDB()*/
        				$.ajax({
			                url:"<?php echo U('ticketprice/destroyRow_c');?>",
                            data:{
                                delete_tp_id:row.tp_id
                            },
                            type:"POST",
                            async:false,
			                success: function(result){
			                    result = JSON.parse(result);
			                    if (result==true) {
			                    	$.messager.alert('訊息','成功刪除資料');
			                    	setTimeout("location.href='<?php echo U('Index/ticketprice');?>'",850);
			                    }
			                },
			                error:function(result){ 
			                     console.log(result);
			                }
			        	});

        			}

        		});
        	}
        }
    </script>
    
</body>
</html>