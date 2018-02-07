<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">

	<head>
		<title>我的卡券</title>
		<meta charset="utf-8" />
		<!--页面优化-->
		<meta name="MobileOptimized" content="320">
		<!--默认宽度320-->
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
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
		<div class="tabs ovflw">
			<a href="<?php echo U('App/Vip/card');?>" class="fl text-c"><span <?php if(($status) == "1"): ?>class="active"<?php endif; ?>>未使用</span></a>
			<a href="<?php echo U('App/Vip/card',array('status'=>2));?>" class="fl text-c"><span <?php if(($status) == "2"): ?>class="active"<?php endif; ?>>已使用</span></a>
			<a href="<?php echo U('App/Vip/card',array('status'=>3));?>" class="fl text-c"><span <?php if(($status) == "3"): ?>class="active"<?php endif; ?>>已过期</span></a>
		</div>
		<div class="card-cc ovflw">
			<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="card-lst back2 border-b1 border-t1">
				<h3 class="color6"><?php echo ($vo["money"]); ?>元代金券（满<?php echo ($vo["usemoney"]); ?>元可使用）</h3>
				<p>券号：<?php echo ($vo["cardno"]); ?></p>
				<p>使用期限：<?php echo (date('Y/m/d',$vo["stime"])); ?> - <?php echo (date('Y/m/d',$vo["etime"])); ?></p>
				<p>状态：<?php if(($vo["status"]) == "1"): ?>未使用<?php endif; if(($vo["status"]) == "2"): ?>已使用<?php endif; if(($vo["status"]) == "3"): ?>已过期<?php endif; ?></p>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<?php if(empty($data)): ?><div class="list_none text-c">
			<i class="iconfont">&#xe677</i>
			<p class="color6">暂无卡券</p>
		</div><?php endif; ?>
		<div class="insert1"></div>
		<div class="dtl-ft ovflw">
			<div class=" fl dtl-icon dtl-bck ovflw">
				<a href="<?php echo U('App/Vip/index');?>">
					<i class="iconfont">&#xe679</i>
				</a>
			</div>
			 <a href="javascript:void(0)" class="fr ads-btn fonts9 back3">添加卡券</a>
		</div>
		<script>
			var url = '<?php echo U("App/Vip/addVipCard");?>';
			$('.ads-btn').click(function(){
				zbb_input2("添加卡券");
			})
		</script>
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