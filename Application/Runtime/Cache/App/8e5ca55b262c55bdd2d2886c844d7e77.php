<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title>推广日志</title>
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
	</head>
	<body class="back1">
			<?php if(empty($cache)): ?><div class="list_none text-c" style="height: 100%;">
					<p class="color6">暂无推广记录</p>
				</div>
				<?php else: ?>
				<div class="ovflw back2">
					<ul class="achos-ul ovflw">
						<li class="ovflw border-b1"><h3>团队总人数：<?php echo ($_SESSION['WAP']['vip']['total_xxlink']); ?></h3><p>为缓解服务器压力，只显示最新50条新记录。</p></li>
					</ul>
					<ul class="achos-ul ovflw">
						<?php if(is_array($cache)): $i = 0; $__LIST__ = $cache;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="ovflw border-b1"><h3 class="ads-h3">贡献会员：<?php echo ($vo["xxnickname"]); ?></h3><p>内容：<?php echo ($vo["msg"]); ?></p><p class="ads-p"><?php echo (date("Y-m-d",$vo["ctime"])); ?></p></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>					
				</div><?php endif; ?>
		
		<div class="insert1"></div>
		<div class="dtl-ft ovflw">
			<div class=" fl dtl-icon dtl-bck ovflw">
				<a href="<?php echo U('App/Fx/index');?>">
					<i class="iconfont">&#xe679</i>
				</a>
			</div>
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