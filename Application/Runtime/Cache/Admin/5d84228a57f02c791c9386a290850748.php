<?php if (!defined('THINK_PATH')) exit();?><div class="row">
     <div class="col-xs-12 col-xs-12">
          <div class="widget radius-bordered">
              <div class="widget-header bg-blue">
				<i class="widget-icon fa fa-arrow-down"></i>
				<span class="widget-caption">订单详情</span>
				<div class="widget-buttons">
					<a href="#" data-toggle="maximize">
						<i class="fa fa-expand"></i>
					</a>
					<a href="#" data-toggle="collapse">
						<i class="fa fa-minus"></i>
					</a>
					<a href="#" data-toggle="dispose">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
              <div class="widget-body">
                   <form id="AppForm" action="" method="post" class="form-horizontal"
                                                  data-bv-message=""
                                                  data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                                                  data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                                                  data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                  <input type="hidden" name="id" value="<?php echo ($cache["id"]); ?>">
                  <div class="form-title">
                        <a href="<?php echo U('Admin/Shop/order/',array('status'=>$status));?>" class="btn btn-primary" data-loader="App-loader" data-loadername="商城订单">
						<i class="fa fa-mail-reply"></i>返回
						</a>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">订单编号</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["oid"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">订单状态</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value=
                        	'<?php switch($cache["status"]): case "0": ?>已取消<?php break;?>
								<?php case "1": ?>待付款<?php break;?>
								<?php case "2": ?>待发货<?php break;?>
								<?php case "3": ?>已发货<?php break;?>
								<?php case "4": ?>退货中<?php break;?>
								<?php case "5": ?>已完成-<?php echo (date("Y/m/d",$cache["etime"])); break;?>
								<?php case "6": ?>已关闭-<?php echo (date("Y/m/d",$cache["closetime"])); break;?>
								<?php case "7": ?>已退货-<?php echo (date("Y/m/d",$cache["tuihuotime"])); break; endswitch;?>' readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">订单总额</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["totalprice"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">实付总额</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["payprice"]); ?>" readonly>
                        </div>
                   </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">邮费总额</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["yf"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">创建时间</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value='<?php echo (date("Y/m/d H:i:s",$cache["ctime"])); ?>' readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">收件人</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["vipname"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">联系方式</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["vipmobile"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">收货地址</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["vipaddress"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">客户留言</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["msg"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-title"></div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">会员ID</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["vipid"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">会员昵称</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($vip["nickname"]); ?>" readonly>
                        </div>
                   </div>
                   <?php if($cache["paytime"] != ''): ?><div class="form-title"></div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">支付方式</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value=
                        	'<?php switch($cache["paytype"]): case "money": ?>余额支付<?php break;?>
								<?php case "alipaywap": ?>支付宝WAP支付<?php break;?>
								<?php case "wxpay": ?>微信支付<?php break; endswitch;?>' readonly>
                        </div>
                   </div>
                   <?php if(($cache["paytype"]) == "alipaywap"): ?><div class="form-group">
	                        <label class="col-lg-2 control-label">支付宝支付帐户</label>
	                        <div class="col-lg-4">
	                        	<input type="text" class="form-control" value="aliaccount" readonly>
	                        </div>
	                   </div><?php endif; ?>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">支付时间</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo (date("Y/m/d H:i:s",$cache["paytime"])); ?>" readonly>
                        </div>
                   </div><?php endif; ?>
                   <?php if($cache["fahuokd"] != ''): ?><div class="form-title"></div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">发货快递</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["fahuokd"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">发货快递单号</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["fahuokdnum"]); ?>" readonly>
                        </div>
                   </div><?php endif; ?>
                   <?php if($cache["changetime"] != ''): ?><div class="form-title"></div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">改价说明</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["changemsg"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">改价客服</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["changeadmin"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">改价时间</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo (date("Y/m/d H:i:s",$cache["changetime"])); ?>" readonly>
                        </div>
                   </div><?php endif; ?>
                   <?php if($cache["closetime"] != ''): ?><div class="form-title"></div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">关闭说明</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["closemsg"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">关闭客服</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["closeadmin"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">关闭时间</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo (date("Y/m/d H:i:s",$cache["closetime"])); ?>" readonly>
                        </div>
                   </div><?php endif; ?>
                    <?php if($cache["tuihuotime"] != ''): ?><div class="form-title"></div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">退货金额</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["tuihuoprice"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">退货快递公司</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["tuihuokd"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">退货快递单号</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["tuihuokdnum"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">退货说明</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["tuihuomsg"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">关闭客服</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo ($cache["tuihuoadmin"]); ?>" readonly>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">退货时间</label>
                        <div class="col-lg-4">
                        	<input type="text" class="form-control" value="<?php echo (date("Y/m/d H:i:s",$cache["tuihuotime"])); ?>" readonly>
                        </div>
                   </div><?php endif; ?>
                   <div class="form-title"></div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">商品明细</label>
                        <div class="col-lg-4">
                        	<table class="table table-hover">
                                <thead class="bordered-darkorange">
                                    <tr>
                                        <th>#</th>
                                        <th>名称</th>
                                        <th>数量</th>
                                        <th>属性</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php if(is_array($cache["items"])): $i = 0; $__LIST__ = $cache["items"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                        <td><?php echo ($key+1); ?></td>
                                        <td><?php echo ($vo["name"]); ?></td>
                                        <td><?php echo ($vo["num"]); ?></td>
                                        <td><?php echo ($vo["skuattr"]); ?></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                   </div>
                   <div class="form-title"></div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">订单进度</label>
                        <div class="col-lg-4">
                        	<p><label class="control-label"><?php echo (date("Y/m/d H:i",$cache["ctime"])); ?> 订单生成</label></p>
                        	<?php if(($cache["status"]) == "0"): ?><p><label class="control-label">订单已取消，不再跟踪状态。</label></p><?php endif; ?>
                        	<?php if(is_array($log)): foreach($log as $key=>$vo): ?><p><label class="control-label"><?php echo (date("Y/m/d H:i",$vo["ctime"])); ?> <?php echo ($vo["msg"]); ?></label></p><?php endforeach; endif; ?>
                        </div>
                   </div>
                   <!--分销逻辑-->
                   <div class="form-title"></div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">分销日志</label>
                        <div class="col-lg-4">
                        	<?php if(is_array($fxlog)): foreach($fxlog as $key=>$vo): ?><p><label class="control-label"><?php echo (date("Y/m/d H:i",$vo["ctime"])); ?> <span class="darkorange"><?php echo ($vo["fromname"]); ?></span>&nbsp;贡献给&nbsp;<span class="darkorange"><?php echo ($vo["toname"]); ?></span>&nbsp;分销佣金：<span class="darkorange"><?php echo ($vo["fxyj"]); ?></span>元</label></p><?php endforeach; endif; ?>
                        </div>
                   </div>
                   
                </div>
               </form>
            </div>
        </div>
	</div>
     
</div>
<!--面包屑导航封装-->
<div id="tmpbread" style="display: none;"><?php echo ($breadhtml); ?></div>
<script type="text/javascript">
	setBread($('#tmpbread').html());
</script>
<!--/面包屑导航封装-->