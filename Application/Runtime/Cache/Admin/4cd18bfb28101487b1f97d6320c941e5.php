<?php if (!defined('THINK_PATH')) exit();?><div class="row">
     <div class="col-xs-12 col-xs-12">
          <div class="widget radius-bordered">
              <div class="widget-header bg-blue">
				<i class="widget-icon fa fa-arrow-down"></i>
				<span class="widget-caption">管理员设置</span>
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
                        <a href="<?php echo U('Admin/User/userList/');?>" class="btn btn-primary" data-loader="App-loader" data-loadername="管理员管理">
							<i class="fa fa-mail-reply"></i>返回
						</a>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">管理员昵称<sup>*</sup></label>
                        <div class="col-lg-4">
                        <input type="text" class="form-control" name="nickname" placeholder="必填"
                                                               data-bv-notempty="true"
                                                               data-bv-notempty-message="不能为空" value="<?php echo ($cache["nickname"]); ?>">
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">管理员登陆名<sup>*</sup></label>
                        <div class="col-lg-4">
                        <input type="text" class="form-control" name="username" placeholder="必填"
                                                               data-bv-notempty="true"
                                                               data-bv-notempty-message="不能为空" value="<?php echo ($cache["username"]); ?>">
                        </div>
                   </div>
                   <?php if(empty($cache["id"])): ?><div class="form-group">
                        <label class="col-lg-2 control-label">管理员登陆密码<sup>*</sup></label>
                        <div class="col-lg-4">
                        <input type="text" class="form-control" name="userpass" placeholder="必填"
                                                           data-bv-notempty="true"
                                                               data-bv-notempty-message="不能为空" value="">
                        </div>
                   </div>
                   <?php else: ?>
                   <div class="form-group">
                        <label class="col-lg-2 control-label">管理员登陆密码</label>
                        <div class="col-lg-4">
                        <input type="text" class="form-control" name="userpass" placeholder="不修改请留空" value="">
                       	<span class="text darkorange">&nbsp;&nbsp;&larr;重要：不修改请留空。</span>
                        </div>
                         
                   </div><?php endif; ?>
                  <div class="form-group">
                   		<label class="col-lg-2 control-label">管理员权限</label>
                   		<div class="col-lg-4">
                   			<?php if(is_array($oath)): $i = 0; $__LIST__ = $oath;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label>
						  		<input type="checkbox" class="colored-blue oa-check" <?php if(in_array(($vo["name"]), is_array($cache["oath"])?$cache["oath"]:explode(',',$cache["oath"]))): ?>checked="checked"<?php endif; ?> value="<?php echo ($vo["name"]); ?>" data-label="<?php echo ($vo["option"]); ?>">
								<span class="text"><?php echo ($vo["option"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
				      		</label><?php endforeach; endif; else: echo "" ;endif; ?>
			       		</div>
			       		<input type="hidden" name="oath" id="oath" value="<?php echo ($cache["oath"]); ?>" />
                   </div>
						<div class="form-group">
                             <div class="col-lg-offset-2 col-lg-4">
                             <button class="btn btn-primary btn-lg" type="submit">保存</button>&nbsp;&nbsp;&nbsp;&nbsp;
                             <button class="btn btn-palegreen btn-lg" type="reset">重填</button>
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
<!--表单验证与提交封装-->
<script type="text/javascript">
	$('#AppForm').bootstrapValidator({
		submitHandler: function (validator, form, submitButton) {
			var oa='';
			var checks=$('.oa-check');
			$(checks).each(function(){
				if($(this).is(":checked")){
					oa+=$(this).val()+',';
				}
			});
			$('#oath').val(oa);
           	var tourl="<?php echo U('Admin/User/userSet');?>";
			var data=$('#AppForm').serialize();
			$.App.ajax('post',tourl,data,null);
			return false;
        },
	});
</script>
<!--/表单验证与提交封装-->