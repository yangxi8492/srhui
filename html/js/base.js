// 固定导航
$(function(){
	var lazyheight = 0; 
	function showload(){
		lazyheight = $(window).scrollTop();
		if ( lazyheight >= 90 ){ 
			$("nav").addClass("fixedtop");
		} else{
			$("nav").removeClass("fixedtop");
		} 
	}
	$(window).bind("scroll", function(){
		showload();
	}); 
	// 登录
	$(".btn-login").click(function(){
		$(".modals-backdrop").show();
	});
	$(".modal-close").click(function(){
		$(".modals-backdrop").hide();
	});
	// 在线客服
	$(".btn_top").hide();
	$(".btn_top").on("click",function(){
		$('html, body').animate({scrollTop: 0},300);return false;
	})
	$(window).on('scroll resize',function(){
		if($(window).scrollTop()<=300){
			$(".btn_top").hide();
		}else{
			$(".btn_top").show();
		}
	});
});