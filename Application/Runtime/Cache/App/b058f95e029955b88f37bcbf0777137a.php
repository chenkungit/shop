<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <title>订单列表</title>
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
	    <!--组件依赖js begin-->
	    <script src="/shop/Public/App/js/zepto.min.js"></script>
	    <!--组件依赖js end-->		
		<script type="text/javascript" src="/shop/Public/App/gmu/gmu.min.js"></script>
        <script type="text/javascript" src="/shop/Public/App/gmu/app-basegmu.js"></script>
    

</head>
<body class="back1 ">
		<div class="odrd_cc back2 ovflw color9 border-b1 border-t1 mr-b" >
			<div class="border-b1 odrd_tt">订单信息</div>
			<div class="odrd_stu">
				<p>订单状态：<em class="color3"><?php switch($cache["status"]): case "0": ?>已取消<?php break;?>
					<?php case "1": ?>待付款<?php break;?>
					<?php case "2": ?>待发货<?php break;?>
					<?php case "3": ?>待收货<?php break;?>
					<?php case "4": ?>退货中<?php break;?>
					<?php case "5": ?>已完成-<?php echo (date("Y/m/d",$cache["etime"])); break;?>
					<?php case "6": ?>已关闭-<?php echo (date("Y/m/d",$cache["closetime"])); break; endswitch;?></em></p>
				<p>实付总额：<em class="color3"><?php echo ($cache["payprice"]); ?></em></p>
				<p>订单编号：<?php echo ($cache["oid"]); ?></p>
				<p>创建时间：<?php echo (date("Y/m/d H:i:s",$cache["ctime"])); ?></p>
				<p>收件人：<?php echo ($cache["vipname"]); ?></p>
				<p>联系方式：<?php echo ($cache["vipmobile"]); ?></p>
				<p>收货地址：<?php echo ($cache["vipaddress"]); ?></p>
				<p>邮费：<?php echo ($cache["yf"]); ?>元</p>
				<!--<p>代金卷：<?php if(!empty($djq)): echo ($djq["money"]); ?>元代金卷<?php else: ?>未使用<?php endif; ?></p>-->
				<p>金果：<?php if(($cache["appleqty"]) > "0"): echo ($cache["appleqty"]); ?>个<?php else: ?>未使用<?php endif; ?></p>
				<p>购物券：<?php if(($cache["gwq"]) > "0"): echo ($cache["gwq"]); ?>元<?php else: ?>未使用<?php endif; ?></p>
				<p>现金券：<?php if(($cache["cashq"]) > "0"): echo ($cache["cashq"]); ?>元<?php else: ?>未使用<?php endif; ?></p>
				<p>升级免付：<?php if(($cache["mf"]) > "0"): echo ($cache["mf"]); ?>元<?php else: ?>未使用<?php endif; ?></p>
				<p>备注：<?php echo ($cache["msg"]); ?></p>
			</div>
		</div>
		<div class="odrd_cc back2 ovflw color9 border-b1 border-t1 mr-b" >
			<div class="border-b1 odrd_tt">订单进度<i class="iconfont fr up">&#xe6de</i><i class="iconfont fr down">&#xe661</i></div>
			<div class="odrd_stu">
				<p><?php echo (date("Y/m/d H:i",$cache["ctime"])); ?> 订单生成</p>
				<?php if(($cache["status"]) == "0"): ?><p><em class="color3">订单已取消，不再跟踪状态。</em></p><?php endif; ?>
				<?php if(is_array($log)): foreach($log as $key=>$vo): ?><p><?php echo (date("Y/m/d H:i",$vo["ctime"])); ?> <?php echo ($vo["msg"]); ?></p><?php endforeach; endif; ?>
			</div>
		</div>
		<?php if(!empty($cache["fahuokd"])): ?><div class="odrd_cc back2 ovflw color9 border-b1 border-t1 mr-b" >
			<div class="border-b1 odrd_tt">发货物流<i class="iconfont fr up">&#xe6de</i><i class="iconfont fr down">&#xe661</i></div>
			<div class="odrd_stu">
				<p>快递公司：<?php echo ($cache["fahuokd"]); ?></p>
				<p>快递单号：<?php echo ($cache["fahuokdnum"]); ?></p>
				<?php if(is_array($express["data"])): $i = 0; $__LIST__ = $express["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p><?php echo ($vo["time"]); ?>：<?php echo ($vo["context"]); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div><?php endif; ?>
		<div class="ads-lst border-b1 ovflw mr-b back2 color6 border-t1">
			<p class="ads-tt border-b1 color9">商品明细</p>
			<?php if(is_array($cache["items"])): $i = 0; $__LIST__ = $cache["items"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><div class="ads_orinfo ads_padding3 ovflw border-b1">
						<div class="ads_orinfol ovflw fl">
							<div class="ads_or_img fl">
								<!-- 图片大小为147*101 -->
								<img  src="<?php echo ($vt["pic"]); ?>"/>
							</div>
							<h3><?php echo ($vt["name"]); ?></h3>
							<?php if(!empty($vt["skuattr"])): ?><p class="color3 fonts2"><?php echo ($vt["skuattr"]); ?></p><?php endif; ?>
						</div>
						<div class="ads_orprice ovflw ">
							<p ><em class="fonts85">￥</em><em class="fonts18"><?php echo ($vt["price"]); ?></em></p>
							<p class="ads_ornum fonts85">X<?php echo ($vt["num"]); ?></p>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<!-- 支付方式 -->
			<p class=" ads_ortt3 fonts85 ovflw border-b1"><span class="fl">共<?php echo ($cache["totalnum"]); ?>件商品</span><span class="fr">实付：<em class="fonts18">￥<?php echo ($cache["payprice"]); ?></em></span></p>
			<?php if(($cache["status"]) != "1"): ?><p class=" ads_ortt3 fonts85 ovflw"><span class="fr"><a href="<?php echo U('App/Shop/orderList',array('sid'=>0));?>" class="home-cz">返回列表</a><?php if(($cache["status"]) == "1"): ?><a href="<?php echo U('App/Shop/orderCancel',array('sid'=>0,'orderid'=>$cache['id']));?>" class="home-cz">取消订单</a><?php endif; if(($cache["status"]) == "3"): ?><a href="<?php echo U('App/Shop/orderOK',array('sid'=>0,'orderid'=>$cache['id']));?>" class="home-rz">确认收货</a><?php endif; ?></span></p><?php endif; ?>
			</div>
			<?php if(($cache["status"]) == "1"): ?><div class="ads-lst border-t1 border-b1 ovflw mr-b back2">
				<p class="ads-tt border-b1">更换支付方式</p>
						<div class="ads_pay ovflw ads_border_dashed" data-paytype = "money" data-disable="<?php echo ($isyue); ?>">
							<span class="iconfont fl ads_pay_lineh dtl_mar1" id="ccmoney">&#xe6d4</span>
							<div class="ads_orimg fl dtl_mar1">
								<img src="/shop/Public/App/img/tue.jpg" />
							</div>
							<p class="ads_pay_p1 ads_pay_lineh1">余额：<i>￥<?php echo ($_SESSION['WAP']['vip']['money']); ?></i></p>
							<p class="ads_pay_p2 ads_pay_lineh1 color10 ads_font_size2">余额不足由其他方式支付</p>
						</div>					
						<div class="ads_pay ovflw ads_border_dashed" data-paytype = "alipayApp" data-disable="0">
							<span class="iconfont fl ads_pay_lineh dtl_mar1" id="ccalipayApp">&#xe656</span>
							<div class="ads_orimg fl dtl_mar1">
								<img src="/shop/Public/App/img/zhif.jpg" />
							</div>
							<p class="ads_pay_lineh">手机支付宝支付</p>
						</div>
						<div class="ads_pay ovflw" data-paytype = "wxpay" data-disable="0">
							<span class="iconfont fl ads_pay_lineh dtl_mar1">&#xe656</span>
							<div class="ads_orimg fl dtl_mar1">
								<img src="/shop/Public/App/img/wxpay.jpg" />
							</div>
							<p class="ads_pay_lineh">微信安全支付</p>
						</div>
						<!-- 银联支付备用 -->
						<!--<div class="ads_pay ovflw " data-paytype = "yinlian">
							<span class="iconfont fl ads_pay_lineh dtl_mar1">&#xe656</span>
							<div class="ads_orimg fl dtl_mar1">
								<img src="/shop/Public/App/img/yl.jpg" />
							</div>
							<p class="ads_pay_lineh">银联支付</p>
						</div>-->
					<p class=" ads_ortt3 fonts85 ovflw"><span class="fr"><a href="<?php echo U('App/Shop/orderList',array('sid'=>0));?>" class="home-cz">返回列表</a><?php if(($cache["status"]) == "1"): ?><a href="<?php echo U('App/Shop/orderCancel',array('sid'=>0,'orderid'=>$cache['id']));?>" class="home-cz">取消订单</a><?php endif; if(($cache["status"]) == "1"): ?><a href="#" class="home-rz" id="paybtn" data-paytype = "<?php echo ($cache["paytype"]); ?>">付款</a><?php endif; ?></span></p>
		
			</div><?php endif; ?>
		<!-- 底部导航 -->
				<div class="insert1"></div>
		<div class="ui-nav">
			<ul class="ui-navul ovflw">
				<li><a href="<?php echo U('App/Shop/index');?>" id="fthome"><span class="iconfont">&#xe6b8</span><p class="ui-navtt">首页</p></a></li>
				<li><a href="<?php echo U('App/Shop/orderList',array('sid'=>0));?>" id="ftorder"><span class="iconfont">&#xe699</span><p class="ui-navtt">订单</p></a></li>
				<li><a href="<?php echo U('App/Shop/basket',array('sid'=>0,'lasturl'=>$footlasturl));?>" id="ftbasket"><span class="iconfont">&#xe6af</span><p class="ui-navtt">购物车</p></a></li>
				<li><a href="<?php echo U('App/Vip/index');?>" id="ftvip"><span class="iconfont">&#xe686</span><p class="ui-navtt">个人中心</p></a></li>
			</ul>
		</div>
		<script type="text/javascript">
			 var actname="<?php echo ($actname); ?>";
			 $('#'+actname).css('color','#19a5f3');
		</script>
		<!--未支付时的支付方式-->
		<?php if(($cache["status"]) == "1"): ?><script type="text/javascript">
				var nowtype="<?php echo ($cache["paytype"]); ?>";
				var paybtn=$('#paybtn');
				var oid="<?php echo ($cache["oid"]); ?>";
				$('#cc'+nowtype).css('color',' #ff3000');
				$('.ads_pay').click(function(){
					var isdis=$(this).data('disable');
					if(isdis==0){
						var sp=$('.ads_pay span');
						$(sp).css('color',' #cfcfcf');
						$(this).find('span').css('color',' #ff3000');
						$(paybtn).data('paytype',$(this).data('paytype'));
					}else{
						App_gmuMsg('您的余额不足，请使用其它方式！');
					}				
				});
				$(paybtn).on('click',function(){
					var pt=$(paybtn).data('paytype');
					var tourl="<?php echo U('App/Shop/pay',array('sid'=>0,'price'=>$cache['payprice'],'orderid'=>$cache['id']));?>"+'/type/'+pt;
					window.location.href=tourl;
				});
			</script><?php endif; ?>
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