$(function() {
	$('.help_box').each(function() {//覆盖员工左侧折叠
        var oBtn = $(this).find('span');
        var oDiv = $(this).find('.hp_cont');
        oBtn.click(function() {
            $('.hp_cont').slideUp(200);
            $('.help_box').find('span').removeClass('down');
            if (oDiv.is(":visible")) {
                oDiv.slideUp(200);
            } else {
                oBtn.addClass("down");
                oDiv.slideDown(300);
            }
        });
    });
    $("input[name='checkall']").bind('click',function(){//全选
		$(this).parents('.help_box').find('input[type=checkbox]').prop('checked',$(this).prop('checked'));
	});
    $("input[name=choose-supp]").on('click',function(){//勾选员工
    	var pnum=$(".showcont").find("p").length;//右侧p的个数
    	var supp='i_'+$(this).attr("id");
        var id = supp.substr(supp.lastIndexOf('_') + 1);
        var name = $(this).val();
		if($(this).prop("checked") ==1 && $(".showcont").find("p").length<=5){
			// $(".showcont").append("<i id='"+supp+"'>"+$(this).val()+"</i>");
			$(".showcont").append('<p id='+supp+' onclick="delrgtlist(this);"><a href="javascript:void(0);"  class="fr delicon" ></a>'+$(this).val()+'</p>');
			$("input[name='checkall']").bind('click');
			$("input[name=checkall]").prop('disabled',false);
            
		}else{
			$(this).prop('checked',false);
			$("input[name='checkall']").unbind('click');
			$("input[name=checkall]").prop('disabled',true);
			// alert("已经达到上限，不能再勾选");
			$("#"+supp).remove();
		}
		// $('.checkAll').attr('checked',$('input[name=choose-supp]:checked').length == $('input[name=choose-supp]').length);
    });
	
	
	
    // 福利分配
    var accountmoney=$("#accountmoney").text();//账户可用余额
    $("#PerSet").blur(function(){
    	$(".maxkxnum").show();
    	$("#totalnum").text(accountmoney/$(this).val());
    });

    $("input[name='get_authCode']").on('click',function(){
    	alert(111);
    	$(this).attr('id','').val('59秒后可重发').addClass('is-disabled');
    	var start = parseInt($(this).val().replace(/[^0-9]/ig,""));
	    $(this).attr({id:'',disabled:'disabled'}).val((start-1)+'秒后可重发').addClass('is-disabled');
    });
});
// function checkAll(obj){//全选
// 	$(obj).parents('.help_box').find('input[type=checkbox]').prop('checked',$(obj).prop('checked'));
// }
function delrgtlist(obj){//删除单个所选
	var ctext=$(obj).text();//获得当前名称
	$(obj).remove();//移除右侧单个员工名称
	$("input[value="+ctext+"]").prop('checked',false);
}
function clearAll(){//清除全部所选
	$(".showcont").empty();//清除右侧所选列表
	$("input[type='checkbox']").each(function(){//清除左侧复选框勾选
		$(this).prop("checked",false);
	});  
}













$(function(){
	//input text文字提示语
	$(".inputext").focus(function(){
		if($(this).val()==this.defaultValue){
			$(this).val("").css({"color":"ccc"});
		}
	});
	$(".inputext").blur(function(){
		if($(this).val()==''){
			$(this).val(this.defaultValue).css({"color":"ccc"});
		}
	});
	
});

/*互动样式 文字提示*/
function showMsg(id, msg, num){
	$('#'+id+'_msg').html(msg);
	switch(num){
		case 1:
			$('#'+id+'_msg').removeClass();
			$('#'+id+'_msg').addClass('wrong');
			break;
		case 2:
			$('#'+id+'_msg').removeClass();
			$('#'+id+'_msg').addClass('warning');
			break;
		case 3:
			$('#'+id+'_msg').removeClass();
			$('#'+id+'_msg').addClass('fine');
			break;
		case 7:
			if(msg!='&nbsp;' && msg!='')$('#'+id+'_msg').css('display','');
			break;
		default:
			$('#'+id+'_msg').removeClass();
			$('#'+id+'_msg').addClass('import');
	}
}

$(function(){//表单验证
	// 忘记支付密码
	var _ecode = $('#_ecode');
	var _newpassword = $('#_newpassword');
	var _againsurepass = $('#_againsurepass');
	var forgotpaypbtn =$("#forgotpaypbtn");
	// 登录密码重置-旧密码
	var _oldpassword=$("#_oldpassword");
	var passwordresetbtn=$("#passwordresetbtn");
	//支付密码重置
	var _nowpaypassword=$("#_nowpaypassword");
	var _newpaypassword=$("#_newpaypassword");
	var _againsurepaypass=$("#_againsurepaypass");
	var paypasswordresetbtn=$("#paypasswordresetbtn");
	// 登录页面
	var _username=$("#_username");
	var _loginpassword=$("#_loginpassword");
	var loginbtn=$("#loginbtn");
	// 找回密码
	var _phone=$("#_phone");
	var retrievepassbtn=$("#retrievepassbtn");

	// 忘记支付密码
	_ecode.on('blur',function(){
		_validate(_ecode);
	});
	_newpassword.on('blur',function(){
		_validate(_newpassword);
	});
	_againsurepass.on('blur',function(){
		_validate(_againsurepass);
	});
	// 登录密码重置-旧密码
	_oldpassword.on('blur',function(){
		_validate(_oldpassword);
	});
	//支付密码重置
	_nowpaypassword.on('blur',function(){
		_validate(_nowpaypassword);
	});
	_newpaypassword.on('blur',function(){
		_validate(_newpaypassword);
	});
	_againsurepaypass.on('blur',function(){
		_validate(_againsurepaypass);
	});
	// 登录页面
	_username.on('blur',function(){
		_validate(_username);
	});
	_loginpassword.on('blur',function(){
		_validate(_loginpassword);
	});
	// 找回密码-手机
	_phone.on('blur',function(){
		_validate(_phone);
	});




	forgotpaypbtn.click(function(){
		if(_validate(_ecode)&&_validate(_newpassword)&&_validate(_againsurepass)){
			alert(1111);
		}
	});

	passwordresetbtn.click(function(){
		if(_validate(_oldpassword)&&_validate(_newpassword)&&_validate(_againsurepass)){
			alert(222);
		}
	});

	paypasswordresetbtn.click(function(){
		if(_validate(_nowpaypassword)&&_validate(_newpaypassword)&&_validate(_againsurepaypass)){
			alert(222);
		}
	});

	loginbtn.click(function(){
		if(_validate(_username)&&_validate(_loginpassword)){
			
		}
	});
	retrievepassbtn.click(function(){
		if(_validate(_phone)&&_validate(_ecode)&&_validate(_newpassword)&&_validate(_againsurepass)){
			alert(222);
		}
	});
});


//表单验证
function _validate(o, arge){
	var arge = arge || {};
	var objid = o.attr('id');
	var truenameregch = /^[\u4E00-\u9FA5]{1,6}$/;
	var truenamereg = /^[\u4E00-\u9FA5]{2,6}$|^[A-Za-z]{2,18}$/;
	//var passwdreg = /^[0-9a-z~!@#$%^&*()_+:"|<>?;]{6,20}$/i; (([a-z]+[0-9]+)|([0-9]+[a-z]+))
	var passwdreg = /^[0-9a-z]{8,16}$/i;
	var pwdreg	= /^[0-9a-z]*(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*[0-9a-z]*$/i;
	var authCodereg = /^\d{6,6}$/;//短信校验码
	var birthreg = /^\d{4}-\d{1,2}-\d{1,2}$/;
	//var phonereg = /^0?(13[0-9]|15[0-9]|18[0-9]|14[1-5]|14[7-9]|17[0-9])[0-9]{8}$/;
    var phonereg = /^0?(13[0-9]|14[5|7|9]|15[0|1|2|3|5|6|7|8|9]|17[0|1|3|5|6|7|8]|18[0-9])[0-9]{8}$/;
	var emailreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9_]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	var contactreg = /(^(\d{3,4}-)?\d{7,8})$|((\(\d{3}\))|(\d{3}\-))?1[3-8][0-9]\d{8}?$|15[89]\d{8}$/; //联系方式，包括手机、 固话
	var IDCardreg = /(^\d{15}$)|(^\d{17}([0-9]|X|x)$)/; //身份证
	var numreg = /^[0-9]*[1-9][0-9]*$/;　　//正整数
	//出错样式 打叉
	var msg_err = '<i class="icon jup"></i>';
	//提示样式 叹号
	var msg_tip = '<i class="icon_new pi_tip"></i>';
	//正确样式 打勾
	var msg_ok = '<i class="icon_new pi_tip_ok"></i>';
	//显示，加载验证中；
	//showMsg(objid, msg, 2);
	switch(o.attr('id')){
		//手机
		case '_phone':
			if(!o.val()){
				showMsg(objid, msg_tip+"手机号码不能为空",1);
			}else if(!phonereg.test(o.val())){
				showMsg(objid, msg_tip+"手机号码格式错误，请重新输入",1);
			}else{
				showMsg(objid, msg_ok,3);
				return true;
			}
			break;
		//手机验证码
		case '_ecode':
			if($(o).val()==''){
				showMsg(objid, msg_tip+"短信验证码不能为空", 1);
			}else if(!authCodereg.exec($(o).val())){
				showMsg(objid, msg_tip+"验证码格式错误，请重新输入", 1);
			}else{
				showMsg(objid, msg_ok, 3);
				return true;
			}
			break;

		//忘记支付密码-新密码
		case '_newpassword':
			if(!$(o).val()){
				showMsg(objid, msg_tip + "密码不能为空", 1);
			//}else if(!passwdreg.exec($(o).val()) && !pwdreg.exec($(o).val())){
			}else if(!passwdreg.exec($(o).val()) || !pwdreg.exec($(o).val())){
				showMsg(objid, msg_tip + "请输入8－16位由字母（区分大小写）、数字、半角符号组成", 1);//请输入8－16位由字母（区分大小写）、数字、半角符号组成
			}else{
				showMsg(objid, msg_ok, 3);
				return true;
			}
			break;
		// 忘记支付密码-确认密码
		case '_againsurepass':
			if(!o.val()){
				showMsg(objid, msg_tip+"密码不能为空",1);
			}else if(o.val()!=$("#_newpassword").val()){
				showMsg(objid, msg_tip+"两次密码不一致",1);
			}else{
				showMsg(objid, msg_ok,3);
				return true;
			}
			break;
		// 登录密码重置-旧密码
		case '_oldpassword':
			if(!o.val()){
				showMsg(objid, msg_tip+"密码不能为空",1);
			}else if(o.val()!='aaa'){
				showMsg(objid, msg_tip+"密码不正确，请重新输入",1);
			}else{
				showMsg(objid, msg_ok,3);
				return true;
			}
			break;
		// 支付密码重置
		case '_nowpaypassword':
			if(!o.val()){
				showMsg(objid, msg_tip+"当前支付密码不能为空",1);
			}else if(o.val()!='aaa'){
				showMsg(objid, msg_tip+"当前支付密码错误",1);
			}else{
				showMsg(objid, msg_ok,3);
				return true;
			}
			break;
		case '_newpaypassword':
			if(!$(o).val()){
				showMsg(objid, msg_tip + "新支付密码不能为空", 1);
			//}else if(!passwdreg.exec($(o).val()) && !pwdreg.exec($(o).val())){
			}else if(!passwdreg.exec($(o).val()) || !pwdreg.exec($(o).val())){
				showMsg(objid, msg_tip + "请输入8－16位由字母（区分大小写）、数字、半角符号组成", 1);//请输入8－16位由字母（区分大小写）、数字、半角符号组成
			}else{
				showMsg(objid, msg_ok, 3);
				return true;
			}
			break;
		case '_againsurepaypass':
			if(!o.val()){
				showMsg(objid, msg_tip+"密码不能为空",1);
			}else if(o.val()!=$("#_newpaypassword").val()){
				showMsg(objid, msg_tip+"两次密码不一致",1);
			}else{
				showMsg(objid, msg_ok,3);
				return true;
			}
			break;
		// 登录页面
		case '_username':
			if(!o.val()){
				showMsg(objid, msg_tip+"用户名不能为空",1);
			}else{
				showMsg(objid,'',3);
				return true;
			}
			break;
		case '_loginpassword':
			if(!o.val()){
				showMsg(objid, msg_tip+"密码不能为空",1);
			}else{
				showMsg(objid,'',3);
				return true;
			}
			break;

	}

	return false;
}

    





