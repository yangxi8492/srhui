// 动态添加dialog对话框----按钮提交
function BombBox(tit, BoxWidth, BoxHeight, ContentURL){
	var dialogBox = top.$("<div></div>").dialog({
		title: tit,
		width: BoxWidth,
		height: BoxHeight,
		content: ContentURL,
	    closed: true,
	    modal: true,
	    buttons: [{
			text:'提交',
			iconCls:'icon-ok',
			handler: function(){
				alert('ok');
			}
		},{
			text:'取消',
			iconCls: 'icon-cancel',
			handler: function(){
				dialogBox.dialog('destroy');
			}
		}]
	}).dialog('open');
};

function PrintBox(tit, BoxWidth, BoxHeight, ContentURL){
	var dialogBox = top.$("<div></div>").dialog({
		title: tit,
		width: BoxWidth,
		height: BoxHeight,
		content: ContentURL,
	    closed: true,
	    modal: true
	    
	}).dialog('open');
};

// 动态添加dialog对话框----没有提交按钮
function BombBoxNoBtn(tit, BoxWidth, BoxHeight, ContentURL){
	var dialogBox = top.$("#win").dialog({
		title: tit,
		width: BoxWidth,
		height: BoxHeight,
		content: ContentURL,
	    closed: true,
	    modal: true
	}).dialog('open')
};

function parentReload(){
	parent.window.location.reload(true);
}

function getObjectKey(source) {
    var result=[],
        key,
        _length=0;
    for(key in source){
       if(source.hasOwnProperty(key)){
          result[_length++] = key;
       }
    }
    return result;
}
$(function(){
	$(".inputexts").focus(function(){//input text文字提示语
		if($(this).val()==this.defaultValue){
			$(this).val("");
		}
	});
	$(".inputexts").blur(function(){
		if($(this).val()==''){
			$(this).val(this.defaultValue);
		}
	});

	$('#CheckedAll').click(function(){//全选医院列表
        $('input[name=h-list]').prop('checked',$('#CheckedAll').prop('checked'));
    });
    $('input[name=h-list]').click(function(){//一个没选中，全选就不被选中
        $('#CheckedAll').attr('checked',$('input[name=h-list]:checked').length == $('input[name=h-list]').length);
    });


	$("input[name=choose-supp]").click(function(){//checkbox选中之后插入到choosesupped中
		var supp='i_'+$(this).attr("id");
        var id = supp.substr(supp.lastIndexOf('_') + 1);
        var name = $(this).val();
        var supplier = {};
        supplier = window.parent.$('#index_tabs').data("supplier");
		if($(this).prop("checked") ==1){
			$(".choosesupped").append("<i id='"+supp+"'>"+$(this).val()+"</i>");
            
            if(supplier == undefined || supplier == 'undefined') {
                var supplier = {};
            }
            supplier[id] = {'id' : id, 'name' : name};
		}else{
			$("#"+supp).remove();
            delete supplier[id];
		}
        supplier['html'] = $(".choosesupped").html();
        window.parent.$('#index_tabs').data("supplier", supplier);
	});

	$(".cancelclose").on('click',function(){//取消弹出窗
		parent.$('#win').window('close');
	});

	$(".unfold").on('click',function(){//就诊疗效展开更多
		var othertext=$(this).parent().find(".othertext").text();
		if($(this).hasClass("more2")){
			$(this).removeClass("more2").html("▼展开");
			$(this).parent().find("i").empty();
		}else{
			$(this).addClass("more2").html("▲收起");
			$(this).parent().find("i").append(othertext);
		};
	});
	if($(".othertext").text().length>0){
		$(".unfold").show();
	}else{
		$(".unfold").hide();
	}

	$(".showmore").hover(function(){
		$(this).find("em").show();
	},function(){
		$(this).find("em").hide();
	});

	$(".upfilebtn").click(function(){
		$(this).next("input").click();
	});

});




// $(function () {
//     var showimg = $('#showimg');
//     var files = $(".files");
//     var btn = $(".btn span");
//     var uploadUrl;
//     if(($("#fileupload").length>0)){
//     	$(".upfilebtn").wrap("<form id='myupload' action='"+uploadUrl+"' method='post' enctype='multipart/form-data'></form>");
//     }
    
//     $("#fileupload").change(function(){
//         $("#myupload").ajaxSubmit({
//             dataType:  'json',
//             beforeSend: function() {
//                 showimg.empty();
//                 btn.html("上传中...");
//             },
//             success: function(data) {                    
//                 if(data.code == -1){                            
// 					parentReload();
// 					return false;
// 				}else if(data.code == 0){
//                     var data =data.data;

//                     $("input[name='attachmentId']").val(data.attachmentId);                        
//                     files.html("<b>"+data.fileName+"</b> <span class='delimg' rel='"+data.attachmentId+"'>删除</span>");
//                     showimg.html("<div class='img'><img src='"+data.filePath+"'><span></span></div>");
//                     btn.html("添加附件");
//                 }else{
//                     btn.html(data.msg);
//                 }
//             },
//             error:function(xhr){
//                 btn.html("上传失败");
//                 files.html(xhr.responseText);
//             }
//         });
//     });
//     $(".delimg").live('click',function(){
//         var attachmentId = $(this).attr("rel");
//         $.post(delImgUrl,{attachmentId:attachmentId},function(data){
//             if(data.code == -1){                            
// 				parentReload();
// 				return false;
// 			}else if(data.code == 0){
//                 $("input[name='attachmentId']").val();
//                 files.html(data.msg);
//                 showimg.empty();
//             }else{
//                 alert(data.msg);
//             }
//         });
//     });
// });