<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title>资料绑定</title>
	    <meta charset="utf-8" />
		<!--页面优化-->
		<meta name="MobileOptimized" content="320">
		<!--默认宽度320-->
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
		<!--viewport 等比 不缩放-->
		<meta http-equiv="cleartype" content="on">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<!--删除苹果菜单-->
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<!--默认颜色-->
		<meta name="apple-mobile-web-app-title" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<!--加载全部后 显示-->
		<meta content="telephone=no" name="format-detection" />
		<!--不识别电话-->
		<meta content="email=no" name="format-detection" />
		<link rel="stylesheet" href="/shop/Public/App/css/style.css" />
		<script type="text/javascript" src="/shop/Public/App/js/zepto.min.js"></script>
        <script type="text/javascript" src="/shop/Public/App/gmu/gmu.min.js"></script>
        <script type="text/javascript" src="/shop/Public/App/gmu/app-basegmu.js"></script>
	</head>
	<body class="back1">
		<p class="add-hd color6">资料绑定</p>
		<div class="add-ads back2">
			<ul class="add-uls">
				<li class="border-b1 ovflw"><span class="fl">手机号码</span><input type="text" value="<?php echo ($data["mobile"]); ?>" id="mobile" /></li>
				<li class="border-b1 ovflw"><span class="fl">真实姓名</span><input type="text" placeholder="请输入姓名" value="<?php echo ($data["name"]); ?>" id="name"/></li>
				<li class="ovflw"><span class="fl">电子邮箱</span><input type="text" placeholder="例如：email@youx.com" value="<?php echo ($data["email"]); ?>" id="email"/></li>
			</ul>			
		</div>
		<div class="insert1"></div>
		<div class="dtl-ft ovflw">
				<div class=" fl dtl-icon dtl-bck ovflw">
					<a href="javascript:history.go(-1);">
						<i class="iconfont">&#xe679</i>
					</a>
				</div>
				<a href="#" class="fr ads-btn fonts9 back3">保存</a>
		</div>
		<!--通用分享-->
		<script type="text/javascript">
	function onBridgeReady(){
 		WeixinJSBridge.call('hideOptionMenu');
	}

	if (typeof WeixinJSBridge == "undefined"){
	    if( document.addEventListener ){
	        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
	    }else if (document.attachEvent){
	        document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
	        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
	    }
	}else{
	    onBridgeReady();
	}	
</script>

	</body>
	
</html>
<script>
	$('.ads-btn').click(function(){
		var mobile = $('#mobile').val();
		var name = $('#name').val();
		var email = $('#email').val();
		if (name=='') {
			zbb_msg("请输入姓名！");
			return;
		}
		if (mobile=='') {
			zbb_msg("请输入手机！");
			return;
		}
		var re = /^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/;
		if (re.test(email)==false) {
			zbb_msg("请输入正确的电子邮箱！");
			return;
		}
	    $.ajax({
			type:'post',
			data:{'mobile':mobile,'name':name,'email':email},
			url:"<?php echo U('Vip/info');?>",
			dataType:'json',
			success:function(e){
				zbb_msg(e.msg);
				return false;
			},
			error:function(){
			    zbb_alert('通讯失败！');
				return false;
			}
		});	
		return false;
	})
</script>