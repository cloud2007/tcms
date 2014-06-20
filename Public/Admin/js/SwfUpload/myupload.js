var flash_buttonImg = "/Public/Admin/js/SwfUpload/images/upload_bigbottom.gif";
var flash_buttonImg_small = "/Public/Admin/js/SwfUpload/images/upload_smallbottom.gif";
var upload_list = $('#multipicDiv');//图片群根节点
var upload_path = '/Public/Uploads'
var z_index=99;
$(document).ready(function() {

    //上传按钮初始化
    uploadSigle('smallpic');
    uploadSigle('bigpic');
    uploadSigle('pic');
    uploadSigle('upload1');
    uploadSigle('upload2');
    uploadSigle('upload3');
    uploadSigle('upload4');
    uploadSigle('upload5');
    uploadSigle('category_smallpic');
    uploadSigle('category_bigpic');
    uploadMulti('multipic');
    uploadMulti('category_multipic');

    //设置默认图事件
    $(".default_box a").live('click',function(){
        BatchSetDefault($(this).parent().parent());
    });

    //绑定删除事件
    $(".closed").live('click',function(event){
        BatchDeleteImgBox($(this).parents('li').eq(0),event);
    });

    //默认图片是否显示控制
    $('.list_img').live('mouseover mouseout',function(event){
        if(event.type =='mouseover'){
            $(this).parent().find(".default_box").show();
            var button = $(this).parent().find(".default_box");
            button.hover(
                function(){
                    button.show();
                },
                function(){
                    if(button.find('.default_pictext').text()!='默认图片'){
                        button.hide();
                    }
                }
                );
        }else if(event.type =='mouseout'){
            var button = $(this).parent().find(".default_box");
            if(button.find("a").text()=='默认图片'){
                button.show();
            }else{
                button.hide();
            }
        }
    });
	
    $('.list_img').each(function(){
        var button = $(this).parent().find(".default_box");
        if(button.find("a").text()=='默认图片'){
            button.show();
        }else{
            button.hide();
        }
		
    });

})//DOCUMENT END


//下面是图片function
/*删除图片节点*/
function BatchDeleteImgBox(box,e) {
    box.remove();
}

//Action “设置默认”
function BatchSetDefault(button, catId) {
    var button_old = upload_list.find('li').has('[name="multiDefault[]"][value!=0]').find('.default_box');
    if(button.parent().find('[name="multiDefault[]"]').val()!=1){
        if(button_old.length>0){
            BatchCreateSetDefaultButton(button_old, catId);//变更原“默认图”为“设置默认”按钮
            button_old.hide();
        }
        $('input[name="multiDefault[]"]').val(0);//处理全部图片为非默认图
        button.parent().find('[name="multiDefault[]"]').val(1);//将当前节点设为“默认图”
        button.html('');//移除原文案
        BatchCreateDefaultIcon(button, catId);
    }
}

//将当前节点设为“默认图”
function BatchCreateDefaultIcon(op, catId) {
    op.show();
    $("<span></span>").addClass('default_picbg').appendTo(op);
    $("<span></span>").addClass('default_pictext').append($("<a></a>").text('默认图片')).appendTo(op);
}

//构造“设置默认”按钮
function BatchCreateSetDefaultButton(op, catId) {//op-图片节点
    op.html('');
    $("<span></span>").addClass('default_picbg').appendTo(op);
    var default_pictext = $("<span></span>").addClass('default_pictext').appendTo(op);
    var button = $('<a></a>');
    button.html('设为默认图').prependTo(default_pictext);
}

/*上传失败，保存出错信息*/
function BatchUploaderOnError(id,err_msg){
    alert('一张图片上传失败，可能的原因是：'+err_msg+'，请检查后重试！');
    /*移除上传节点*/
    removeErrorUploaderBox(id);
    return false;
}

/*移除节点*/
function removeErrorUploaderBox(id){
    if($('#'+id).length>0){
        $('#'+id).remove();
    }
}

/*添加一张图片到图库中*/
function addthispic(ID,picthumb,pic_sub_cate,pic_show_name){
    $('#load_li_'+ID).find('.house_ok').css('display','block');
    $('#load_li_'+ID).find('.list_selects1').css('display','none');
    $('#info ul').append('<li id="' + ID + '" style="z-index:'+z_index+';"></li>');
    z_index=z_index-1;
    $('#'+ID).html('<div class="list_img"><img src="'+ picthumb +'" /></div>');
    $('#'+ID).append('<div class="default_box" style="display: none;"><span class="default_picbg"></span><span class="default_pictext"><a>设为默认图</a></span></div>');
    $('#'+ID).append('<span class="closed"></span>');
    $('#'+ID).append('<div id="select_'+ ID +'" class="list_select"><em>'+pic_show_name+'</em><div class="choice" style="display: none;"><i></i><span subcate="1_1">外立面</span><span subcate="2_2">大楼入口</span><span subcate="3_3">大堂</span><span subcate="4_4">电梯厅</span><span subcate="5_5">公共走廊</span><span subcate="6_6">卫生间</span><span subcate="7_7">楼内配套</span><span subcate="8_8">办公区域</span><span subcate="9_9">停车场</span><span subcate="10_10">高层景观</span><span subcate="11_11">周边环境</span><span subcate="12_12">户型图</span><span subcate="13_13">平面图</span><span subcate="14_14">效果图</span><span subcate="15_15">实景图</span><span subcate="16_16">区位图</span></div></div>');
    //$('#'+ID).append('排序:<input type="text" name="pic_order[]" size="4" value="">');
    $('#'+ID).append('<input type="hidden" name="pic_thumb[]" value="'+picthumb+'">');
    $('#'+ID).append('<input type="hidden" name="pic_sub_cate[]" id="subcate_'+ ID +'" value="'+pic_sub_cate+'">');
    $('#'+ID).append('<input type="hidden" name="multiDefault[]" value="0">');
    $('#'+ID).append('<input type="hidden" name="pic_category[]" value="0">');
}

//单张图片上传
function uploadSigle(buttonName){
    $('#'+buttonName+'Button').uploadify({
        'uploader'       : '/Public/Admin/js/SwfUpload/scripts/uploadify.swf',
        'script'         : '/Admin/Upload/sigleUpload',
        'scriptAccess'   : 'always',
        'cancelImg'      : '',
        'wmode'          : 'transparent',  //falsh透明
        'buttonImg'      : flash_buttonImg_small,
        'fileDesc'       : '允许上传的文件列表',
        'fileExt'        : '*.gif;*.jpg;*.bmp;*.png;*.jpeg;*.png',
        'queueID'        : 'none',
        'auto'           : true, //自动上传
        'multi'          : false, //允许上传多个文件
        'sizeLimit'      : 1024*1024*2, //控制上传文件的大小，单位byte
        'onSelect'       : function(event,ID,fileObj) {
            $('#'+buttonName+'Div .wait').remove();
            $('#'+buttonName+'ButtonDiv').before('<li id="'+ID+'" class="wait">等待中</li>');
            z_index=z_index-1;
        },
        'onopen'         : function(event,ID,fileObj) {
            $('#'+ID).html('<div class="waiting">照片上传中</div>');
        },
        'onAllComplete'  : function(event,data){},
        'onSelectOnce'   : function(event,data){},
        'onProgress'     : function(event,ID,fileObj,data){
            $('#'+ID).html('<div class="waiting">照片上传中</div>');
            $('#'+ID).append('<div class="uping" style="width:'+(data.percentage-8)+'%"></div>');
        },
        'onComplete'	 : function(event, ID, fileObj, response, data) {
            var json = eval("(" + response + ")");
            if(json['err']){
                alert(json['err']);
                $('#'+buttonName+'Div .wait').remove();
            }else{
                $('#'+ID).html('<a href="' + json['real_path']+'" target="_blank"><img src="' + json['real_path']+'" /></a>');
                $('#'+ID).append('<input type="hidden" name="'+ buttonName+'" value="'+ json['msg'] +'" />');
                $('#'+ID).append('<span class="closed"></span>');
            }
        },
        'onError'         : function (event,ID,fileObj,errorObj) {
            $('#'+ID).html('<div class="waiting">Error!'+errorObj.type+'|'+errorObj.info+'</div>');
        }
    });
}

//多图上传
function uploadMulti(buttonName){
    $('#'+buttonName+'Button').uploadify({
        'uploader'       : '/Public/Admin/js/SwfUpload/scripts/uploadify.swf',
        'script'         : '/Admin/Upload/mutliUpload',
        'scriptAccess'   : 'always',
        'cancelImg'      : '',
        'wmode'          : 'transparent',  //falsh透明
        'buttonImg'      : flash_buttonImg_small,
        'fileDesc'       : '允许上传的文件列表',
        'fileExt'        : '*.gif;*.jpg;*.bmp;*.png;*.jpeg;*.png',
        'queueID'        : 'none',
        'auto'           : true, //自动上传
        'multi'          : true, //允许上传多个文件
        'sizeLimit'      : 1024*1024*2, //控制上传文件的大小，单位byte
        'onSelect'       : function(event,ID,fileObj) {
            $('#'+buttonName+'ButtonDiv').before('<li id="'+ID+'" class="waits">等待中</li>');
            z_index=z_index-1;
        },
        'onopen'         : function(event,ID,fileObj) {
            $('#'+ID).html('<div class="waiting">照片上传中</div>');
        },
        'onAllComplete'  : function(event,data){},
        'onSelectOnce'   : function(event,data){},
        'onProgress'     : function(event,ID,fileObj,data){
            $('#'+ID).html('<div class="waiting">照片上传中</div>');
            $('#'+ID).append('<div class="uping" style="width:'+(data.percentage-8)+'%"></div>');
        },
        'onComplete'	 : function(event, ID, fileObj, response, data) {
            var json = eval("(" + response + ")");
            if(json['err']){
                //alert(json['err']);
                $('#'+ID).remove();
            }else{	
                $('#'+buttonName).val(json['msg']);
                $('#'+ID).html('<div class="list_img"><a href="' + json['real_path']+'" target="_blank"><img src="' + json['real_path']+'" /></a></div>');
                $('#'+ID).append('<input type="text" class="multiInputTitle" name="multiTitle[]" />');
                $('#'+ID).append('<input type="text" class="multiInputOrder" name="multiOrder[]" />');
                $('#'+ID).append('<input type="hidden" name="multiUrl[]" value="'+json['msg']+'">');
                $('#'+ID).append('<input type="hidden" name="multiDefault[]" value="0">');
                $('#'+ID).append('<div class="default_box" style="display: none;"><span class="default_picbg"></span><span class="default_pictext"><a>设为默认图</a></span></div>');
                $('#'+ID).append('<span class="closed"></span>');
            }
        },
        'onError'         : function (event,ID,fileObj,errorObj) {
            $('#'+ID).html('<div class="waiting">Error!'+errorObj.type+'|'+errorObj.info+'</div>');
        }
    });
}