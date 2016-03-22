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
    <div id="dlg" class="easyui-dialog" title="優惠資料" closed="true" style="width:450px;height:400px;padding:10px;"
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
		<form id="discountform" method="post">
			<table cellpadding="5">
				<tr>
					<td>會員名稱</td>
					<td><input class="easyui-textbox" type="text" name="name" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>電影院</td>
					<td><input class="easyui-textbox" type="text" name="theater_name" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>類型</td>
					<td><input class="easyui-textbox" name="type_name" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>折扣金額</td>
					<td><input class="easyui-textbox" name="discount" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>開始時間</td>
					<td><input class="easyui-textbox" name="start_date" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>到期時間</td>
					<td><input class="easyui-textbox" name="end_date" data-options="required:true" style="width:250px;"></input></td>
				</tr>
				<tr>
					<td>enable</td>
					<td><input class="easyui-textbox" name="enable" data-options="required:true" style="width:250px;"></input></td>
				</tr>
			</table>
		</form>
		</div>
	</div>
	<div id="edit_dialog" class="easyui-dialog" title="編輯優惠紀錄" closed="true" style="width:450px;height:400px;padding:10px;"
		buttons="#adduser_button">
		<div style="padding:10px 30px 20px 30px">
			<form id="form_edit" method="post" enctype="multipart/form-data">
				<table cellpadding="5">
					<tr>
						<td>會員名稱</td>
						<td><input class="easyui-textbox" type="text" name="name" data-options="required:true" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>電影院</td>
						<td><input class="easyui-textbox" type="text" name="theater_name" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>類型</td>
						<td><input class="easyui-textbox" name="type_name" data-options="required:true" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>折扣金額</td>
						<td><input class="easyui-textbox" name="discount" data-options="required:true" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>開始時間</td>
						<td><input class="easyui-textbox" name="start_date" data-options="required:true" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>到期時間</td>
						<td><input class="easyui-textbox" name="end_date" data-options="required:true" style="width:250px;"></input></td>
					</tr>
					<tr>
						<td>enable</td>
						<td><input class="easyui-textbox" name="enable" data-options="required:true" style="width:250px;"></input></td>
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
	data-options="url:'<?php echo U('Discount/discount_r');?>',method:'get',fit:true">
			<thead>
			<tr>
				<th field="name" width="50" editor="text">會員名稱</th>
				<th field="theater_name" width="50" editor="text">電影院</th>
				<th field="type_name" width="50" editor="text">類型</th>
				<th field="discount" width="50" editor="{type:'validatebox',options:{required:true}}">折扣金額</th>
				<th field="start_date" width="50" editor="{type:'validatebox',options:{required:true}}">開始時間</th>
				<th field="end_date" width="50" editor="{type:'validatebox',options:{required:true}}">到期時間</th>
				<th field="enable" width="50" editor="{type:'validatebox',options:{required:true}}">enable</th>
				<th field="m_id"  width="50" data-options="hidden:true" editor="text">m_id</th>
				<th field="d_id"  width="50" data-options="hidden:true" editor="text">d_id</th>
			</tr>
		</thead>
	</table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dlg').dialog('open')">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyRow()">刪除</a>
        <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').        edatagrid('saveRow')">儲存</a>-->
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit_discount()">編輯</a>
    </div>
    <script type="text/javascript">
        function edit_discount(){
			var row = $('#dg').datagrid('getSelected');
			if(row.d_id!=''){
				$('#edit_dialog').dialog('open');
				$('#form_edit').form('load',row);
				url = "<?php echo U('Discount/edit_c');?>?d_id=" + row.d_id;
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
        	$('#discountform').form('submit',{
	            onSubmit: function(){
	            	if( $('#discountform').form('validate')==false){
	            		$.messager.confirm('警告','紅色欄位為必要欄位!!',function(r){
						    if (r){
						        $('#dlg').dialog('open');
						    }
						});
	            	}
	            	else{
	            		/*append_forDB();*/
	            		$.ajax({
			                url: "<?php echo U('Discount/append_c');?>",
			                data:$('#discountform').serialize(),
			                type:"POST",
			                dataType:'text',
			                
			                success: function(result){

			                    result = JSON.parse(result);
			                    if (result==true) {
			                    	$.messager.alert('訊息','成功新增資料');
			                    	setTimeout("location.href='<?php echo U('Index/discount');?>'",850);
			                    } 
			                },
			                 error:function(result){ 
			                     console.log(result);
			                }
			        	});
	            		$('#discountform').form('clear'); 
	            		return $('#discountform').form('validate');
	            	}             
	            }
            });	
        }
   /*     	var name = $('#name').val()
        	var theater_name = $('#theater_name').val()
        	var food = $('#food').val()
        	var type = $('#type').val()
        	var price = $('#price').val()
        	var size = $('#size').val()

        	if(name==''||theater_name==''||food==''||type==''||price==''||size==''){
        		$.messager.confirm('Confirm','紅色欄位為必要欄位!!',function(r){
				    if (r){
				        $('#dlg').dialog('open');
				    }
				});
        	}else {
	        	$('#dg').datagrid('appendRow',{
					name: name,
					theater_name: theater_name,
					food: food,
					type: type,
					price: price,
					size: size
				});

				$('#dlg').dialog('close');
				$('#discountform').form('clear');
        	}*/

        function destroyRow(){
        	var row=$('#dg').datagrid('getSelected');
        	if(row){
        		$.messager.confirm('警告','確定要刪除此列',function(r){
        			if(r){
        				/*destroyRow_forDB()*/
        				$.ajax({
			                url:"<?php echo U('Discount/destroyRow_c');?>",
                            data:{
                                delete_d_id:row.d_id
                            },
                            type:"POST",
                            async:false,
			                success: function(result){
			                    result = JSON.parse(result);
			                    if (result==true) {
			                    	$.messager.alert('訊息','成功刪除資料');
			                    	setTimeout("location.href='<?php echo U('Index/discount');?>'",850);
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