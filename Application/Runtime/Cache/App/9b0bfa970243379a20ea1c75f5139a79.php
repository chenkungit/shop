<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <title>关于我们</title>
    <meta charset="utf-8" />
    <!--页面优化-->
    <meta name="MobileOptimized" content="320">
    <!--默认宽度320-->
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
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

    <style type="text/css" src="/shop/Public/App/css/style.css"></style>

    <script type="text/javascript" src="/shop/Public/App/js/zepto.min.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=StGl5qQsPbsCVg8tizbLbkOw&v=1.0"></script>
    <style type="text/css">
    #map {
        width: 100%;
        height: 300px;
    }
    #track {
    	display:block;
        font-size: 0.8em;
        text-align: center;
        padding-top: 0.2em;
        padding-bottom: 0.2em;
        border-radius:20px 20px 0px 0px;
        background-color: rgb(90,178,226);
    }
    #track p,a{
        color: red;
    }
    #contract {
    	display:block;
        font-size: 0.8em;
        text-align: center;
        padding-top: 0.2em;
        padding-bottom: 0.2em;
        border-radius:0px 0px 20px 20px;
        background-color: rgb(90,178,226);
    }
    #contract p,a{
        color: red;
    }
    </style>
</head>

<body>
    <div id="content">
        <?php echo (htmlspecialchars_decode($shop["content"])); ?>
    </div>
    <div id="track">
        <!-- <p><a href="http://map.baidu.com/marker?latlng=<?php echo ($shop["lat"]); ?>,<?php echo ($shop["lng"]); ?>&title=<?php echo ($shop["name"]); ?>&content=<?php echo ($shop["address"]); ?>&autoOpen=true&l">点击一键导航</a></p> -->
        <p><a href="http://api.map.baidu.com/marker?location=<?php echo ($shop["lat"]); ?>,<?php echo ($shop["lng"]); ?>&title=<?php echo ($shop["name"]); ?>&content=<?php echo ($shop["address"]); ?>&output=html&src=weiba|weiweb">点击一键导航</a></p>
    </div>
    <div id="map">
    </div>
    <div id="contract">
        <p><a href="tel:<?php echo ($shop["phone"]); ?>">联系我们：<?php echo ($shop["name"]); ?></a></p>
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
<script type="text/javascript">
// 百度地图API功能
// var map = new BMap.Map("map"); // 创建Map实例
// var point = new BMap.Point(<?php echo ($shop["lng"]); ?>, <?php echo ($shop["lat"]); ?>); // 创建点坐标
// map.centerAndZoom(point, 15); // 初始化地图,设置中心点坐标和地图级别。
// map.addControl(new BMap.ZoomControl()); //添加地图缩放控件
// 百度地图API功能
	var map = new BMap.Map("map");
	var point = new BMap.Point(<?php echo ($shop["lng"]); ?>, <?php echo ($shop["lat"]); ?>);
	map.centerAndZoom(point, 15);
	map.addControl(new BMap.ZoomControl());          
	var opts = {
		width : 400,    // 信息窗口宽度
		height: 70,     // 信息窗口高度
		title : "<?php echo ($shop["name"]); ?>"  // 信息窗口标题
	}
	var infoWindow = new BMap.InfoWindow("<?php echo ($shop["address"]); ?>", opts);  // 创建信息窗口对象
	map.openInfoWindow(infoWindow,point); //开启信息窗口

	var marker1 = new BMap.Marker(new BMap.Point(<?php echo ($shop["lng"]); ?>, <?php echo ($shop["lat"]); ?>));  // 创建标注
	map.addOverlay(marker1);              // 将标注添加到地图中
	marker1.addEventListener("click", function(){
		/*start|end：（必选）
		{name:string,latlng:Lnglat}
		opts:
		mode：导航模式，固定为
		BMAP_MODE_TRANSIT、BMAP_MODE_DRIVING、
		BMAP_MODE_WALKING、BMAP_MODE_NAVIGATION
		分别表示公交、驾车、步行和导航，（必选）
		region：城市名或县名  当给定region时，认为起点和终点都在同一城市，除非单独给定起点或终点的城市
		origin_region/destination_region：同上
		*/
		var start = {
			 name:"我的位置"
		}
		var end = {
			name:"<?php echo ($shop["name"]); ?>"
		}
		var opts = {
			mode:BMAP_MODE_DRIVING
		}
		var ss = new BMap.RouteSearch();
		ss.routeCall(start,end,opts);
	});
</script>
</html>