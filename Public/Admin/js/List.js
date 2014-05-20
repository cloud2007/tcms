$(function(){
	//隔行换色
  	$("tr.content").mouseover(function(){
      	$(this).addClass("over");}).mouseout(function(){
            $(this).removeClass("over");})
      	$("tr.content:even").addClass("alt");
	
	//全选/全不选 按钮事件
	$('#checkAll').click(function(){
		if($(this).attr("checked")){
			$("input[name='checkID[]']").attr("checked",true);
		}else{
			$("input[name='checkID[]']").attr("checked",false);
		}
	});
	
	//某一个checkbox点击事件 如果全部选中了 自动勾选全选checkbox
	$("input[name='checkID[]']").bind("click",function(){
		if(count('N')<1)
			$('#checkAll').attr("checked",true);
		else
			$('#checkAll').attr("checked",false);
	});
	
	//点击删除时候先判断是否选中了至少一条数据 然后弹出删除确认对话框
	$("input[name='del']").click(function(){
		if(count('Y')<1){
			alert("未选中任何数据！")
			return false;
		}
		if(confirm("此操作不能恢恢复，是否确定？")){
			//$('#EditForm').attr("action","/admin.php/News/Deletes");
			$('#ListForm').submit();
			return true;
		}else{
			return false;
		}
	})
	
	//统计选中和未选中的按钮个数 Y选中个数 N未选中个数
	function count(nReturn){
		var nTrue = 0 , nFalse = 0;
		for(var i = 0; i<$("input[name='checkID[]']").length;i++){
			if($("input[name='checkID[]']").eq(i).attr("checked")){
				nTrue++;
			}else{
				nFalse++;
			}
		}
		if(nReturn == 'Y')
			return nTrue;
		else
			return nFalse;
	}
	
	//控制上移下移按钮显示
	$('.textleftlist .btn').addClass('none');
	$('.textleftlist').bind({
		mouseover:function(){$(this).find('.btn').removeClass('none');},
		mouseout :function(){$(this).find('.btn').addClass('none');},
	})
	
	$("input[name='search']").click(function(){
		var wd = $('#wd').val();
		var categoryID = $('#categoryID').val();
		/*
		if(wd==false && categoryID==false){
			alert('没有检索条件');
			return false;
		}*/
		self.location.href="/admin.php/News?wd=" + wd + "&categoryID=" + categoryID;
	})
	
})

//表单名ListForm 全选按钮name=checkAll checkbox name=checkID[]