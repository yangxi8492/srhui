var liwu = {
	winId:"liwu",
	addUrl:'index.php?c=family&a=addupdmem&rand='+Math.random()
};

liwu.window = function(url){
	$('<div id="'+liwu.winId+'" class="easyui-window" closed="true"></div>').appendTo('body');
	var _this = $('#'+liwu.winId);
	_this.window({
		href: url,
		cache:false,
		title:'修改家庭群组',
	    width:500,  
	    height:195,  
	    modal:true,
	    loadingMessage: '加载数据中，请稍后...',
	    minimizable: false,
	    collapsible: false
	});
};

liwu.window.close = function(){
	$('#'+liwu.winId).window('close');
};

liwu.window.open = function(url){
	liwu.window(url);
	$('#'+liwu.winId).window('open');
};

liwu.window.save = function(){
	var addr = $.trim($('#faddr').val());
	var linkman = $.trim($('#flinkman').val());
	var area_id = $('#farea_id').val();
	if(!linkman){
		$.messager.alert('温馨提示','联系人姓名不能为空','info');
		return false;
	}else if(!addr){
		$.messager.alert('温馨提示','家庭地址不能为空','info');
		return false;
	}else{
		var url = 'index.php?c=family&a=updfamily&rand='+Math.random();
		$.ajax({
			beforeSend:showLoadding(),
			type:'POST',
			url:url,
			data:'addr='+addr+'&linkman='+linkman+'&areaid='+area_id,
			dataType: 'json',
			success: function(e){
				$.messager.progress('close');
				if(e.code*1 == 99){
					vs.window.close();
					loadPage('index.php?c=family&a=index','家庭群组管理');
				}
				$.messager.alert('温馨提示',e.msg,'info');
			}
		});	
	}
};