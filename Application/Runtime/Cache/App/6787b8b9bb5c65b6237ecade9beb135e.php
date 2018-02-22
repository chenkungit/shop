<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title><?php echo ($type); ?>用户</title>
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
		<style>
		.Appbox{ width:94%; margin:0 auto; margin-bottom:10px;}
		.cp_list li{ border-bottom:1px solid #d9d9d9; overflow:hidden; height:70px; padding:2px 3%;}
		.cp_list li i{ line-height:70px;}
		.cp_list li div{ float:left; overflow:hidden;}
		.cp_list li div h3{ font-size:1.05em; line-height:30px; padding-top:8px; color:#535353; font-weight:400;}
		.cp_list li div p{ font-size:0.9em; line-height:20px; height:20px; width:100%; overflow:hidden;text-overflow: ellipsis; color:#9c9b9b; -o-text-overflow:ellipsis;white-space:nowrap;}
		.tb{ padding-right: 10px; float: left;}
		.ar{ width:9%;font-size:1.5em; color:#acacac; float: right;}
		.red{ color: #B80F72;}
		.hot-ico{
			width: 60px;
			height: 60px;
			border-radius: 100%;
		}
		</style>
	</head>
	<body class="back1">
			<?php if(empty($cache)): ?><div class="list_none text-c">
					<p class="color6">暂无<?php echo ($type); ?>用户</p>
				</div>
				<?php else: ?>				
				<div class="ovflw back2">
					<ul class="achos-ul ovflw">
						<li class="ovflw border-b1"><h3><?php echo ($type); ?>用户总数：<?php echo ($total); ?></h3><p>为缓解服务器压力，只显示最新50条记录。</p></li>
					</ul>
					<div class="Appbox">
				   	<ul class="cp_list">
				   		<?php if(is_array($cache)): $i = 0; $__LIST__ = $cache;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="padding-bottom: 10px;"><a href="#"><i class="iconfont tb"><img class="hot-ico" src="<?php echo ($vo["headimgurl"]); ?>" /> </i><div><h3 style="color: red;"><?php echo ($vo["nickname"]); ?></h3>
					    	<p> 总消费:<?php echo ($vo["total_buy"]); ?>&nbsp;加入时间:<?php echo (date("Y-m-d",$vo["ctime"])); ?></p></div></a>
					    	</li><?php endforeach; endif; else: echo "" ;endif; ?>		    	
				     </ul>
		    		</div>
	    		
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