<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title>消息中心</title>
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
	<body>
		<ul class="color6 ovflw info-lst">
			<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li onclick="readMsg(<?php echo ($vo["id"]); ?>)" id="list<?php echo ($vo["id"]); ?>">
				<h3 class="info-tt <?php if(($vo["read"]) == "0"): ?>color3<?php endif; ?>"><?php echo ($vo["title"]); ?></h3>
				<p class="info-time"><?php echo (date('Y/m/d',$vo["ctime"])); ?></p>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<div class="info-bg">
			<div class="info-cc">
				<div class="info-chd ovflw font-visib"><div class="info-ctt fl" id="title"></div><i class="iconfont fr info-close">&#xe659</i></div>
				<div class="info-scroll" id="content"></div>
			</div>
		</div>
		<?php if(empty($data)): ?><div class="list_none text-c">
			<p class="color6">暂无消息</p>
		</div><?php endif; ?>
		<div class="insert1"></div>
		<div class="dtl-ft ovflw">
			<div class=" fl dtl-icon dtl-bck ovflw">
				<a href="<?php echo U('App/Vip/index');?>" id="addressback">
					<i class="iconfont">&#xe679</i>
				</a>
			</div>
		</div>
		<script type="text/javascript">
			//弹出详情页
			function readMsg(id){
				$.getJSON("<?php echo U('Vip/msgRead');?>",{'id':id},function(e){
					if(e.status=1){
						$('#list'+id).find('h3').removeClass('color3');
					}
					$('#title').text(e.data.title);
					$('#content').html(e.data.content);
					$('.info-bg').show();
				});
			}
			
			$('.info-close').click(function(){
				$('.info-bg').hide();
			});
			
			 //底部导航
		    $('.ui-navul li a').click(function(){
		    	$('.ui-navul li a').css('color','#929292');
		    	$(this).css('color','#19a5f3');
		    });
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