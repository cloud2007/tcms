<link href="/Static/js/swfupload/css/upload.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Static/js/kindeditor/kindeditor.js"></script>
<div id="postion"> <a class="tip-bottom" href="/admin.php" title="Go to TcitCms HomePage" target="_top"><i class="icon-home"></i> HOME</a> 系统信息管理</div>
<div id="manager">
	<h2 class="title">菜 单 功 能 管 理</h2>
	<p>管理导航：<a href="/admin.php/Category/">信息管理</a>&nbsp;|&nbsp;<a href="/admin.php/Category/Add">信息添加</a></p>
</div>
<form name="AddForm" id="AddForm" method="post" action="/admin.php/Category/categorySave">
	<input type="hidden" name="lmID" value="<?php echo $_SESSION['lam'];?>" />
	<input type="hidden" name="id" value="<?php echo $cateinfo->id;?>" />
	<input type="hidden" name="orderNo" value="<?php echo $cateinfo->orderNo;?>" />
	<table width="100%" class="content_table">
		<tr>
			<td>所属类别</td>
			<td class="textleft">
				<select name="parentID">
					<option value="0">一级类别</option>
					<?php
					foreach($dataList as $v){
						echo '<option value="'.$v['id'].'" '. $v['selected'] .'>'. $v['spacer'] . $v['categoryTitle'].'</option>';
					}
					?>
				</select>
			</td>
		</tr>
		<?php
			$inputArray=array('categoryTitle','categoryTitle1','categoryTitle2','categoryBremark');
			foreach($inputArray as $v){
				echo $datainfo->showInput("{$v}",$cateinfo);
			}
			for($i=1;$i<3;$i++){
				echo $datainfo->showTextarea('categoryName'.$i,$cateinfo);
			}
			for($i=1;$i<3;$i++){
				echo $datainfo->showEditorContent('categoryContent'.$i,$cateinfo);
			}
			$uploadArray=array('categorySmallPic','categoryBigPic');
			foreach($uploadArray as $v){
				echo $datainfo->showUploadSingle("{$v}",$cateinfo);
			}
			echo $datainfo->showUploadMulti('categoryMultiPic',$cateinfo);
			echo $datainfo->showCreatTime('creatTime',$newsinfo);
		?>
	</table>
	<div class="clearH"></div>
	<table width="100%" class="content_table">
		<tr>
			<td><input type="submit" class="btn green big" value="确 定"> <input type="button" class="btn big" value="返 回" onClick="self.history.back();"></td>
		</tr>
	</table>
</form>
<script type="text/javascript" src="/Static/js/swfupload/scripts/swfobject.js"></script>
<script type="text/javascript" src="/Static/js/swfupload/scripts/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="/Static/js/swfupload/myupload.js"></script>
<script type="text/javascript" src="/Static/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
//content字段Kind初始化
$(function(){
	var items = ['source','undo','redo','fontsize','|','forecolor', 'hilitecolor', 'bold', 'italic', 'underline','removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright','|', 'emoticons', 'image', 'multiimage', 'link'];
	KindEditor.ready(function(K) {
		K.create('textarea[class="content"]', {
			uploadJson : '/admin.php/upload/kindEditor',
			fileManagerJson : '/admin.php/upload/fileManager',
			urlType : 'absolute',
			allowFileManager : true,
			//afterBlur:function(){},
			//items : items
		});
	});
})
</script>