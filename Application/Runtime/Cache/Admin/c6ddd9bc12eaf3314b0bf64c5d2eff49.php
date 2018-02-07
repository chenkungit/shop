<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    <div class="col-xs-12 col-xs-12">
        <div class="widget radius-bordered">
            <div class="widget-header bg-blue">
                <i class="widget-icon fa fa-arrow-down"></i>
                <span class="widget-caption">分类设置</span>
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
                <form id="AppForm" action="" method="post" class="form-horizontal" data-bv-message="" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                    <input type="hidden" name="id" value="<?php echo ($cache["id"]); ?>">
                    <div class="form-title">
                        <a href="<?php echo U('Admin/Shop/cate/');?>" class="btn btn-primary" data-loader="App-loader" data-loadername="门店分类">
                            <i class="fa fa-mail-reply"></i>返回
                        </a>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">选择父类</label>
                        <div class="col-lg-4">
                            <select class="form-control" name="pid">
                                <option value="0">顶级分类</option>
                                <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $cache["pid"]): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option>
                                    <?php if(is_array($vo['_child'])): $i = 0; $__LIST__ = $vo['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo2["id"]); ?>" <?php if(($vo2["id"]) == $cache["pid"]): ?>selected<?php endif; ?>>&nbsp;&nbsp;└<?php echo ($vo2["name"]); ?></option>
                                        <?php if(is_array($vo2['_child'])): foreach($vo2['_child'] as $key=>$vo3): ?><option value="<?php echo ($vo3["id"]); ?>" <?php if(($vo3["id"]) == $cache["pid"]): ?>selected<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└<?php echo ($vo3["name"]); ?></option>
                                            <?php if(is_array($vo3['_child'])): foreach($vo3['_child'] as $key=>$vo4): ?><option value="<?php echo ($vo4["id"]); ?>" <?php if(($vo4["id"]) == $cache["pid"]): ?>selected<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└<?php echo ($vo4["name"]); ?></option>
                                                <?php if(is_array($vo4['_child'])): foreach($vo4['_child'] as $key=>$vo5): ?><option value="<?php echo ($vo5["id"]); ?>" <?php if(($vo5["id"]) == $cache["pid"]): ?>selected<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└<?php echo ($vo5["name"]); ?></option><?php endforeach; endif; endforeach; endif; endforeach; endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"></label>
                        <div class="col-lg-4">
                            <span><sup style="font-size:1em">*商品菜单分最高分两级</sup></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">分类名称<sup>*</sup></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="name" placeholder="必填" data-bv-notempty="true" data-bv-notempty-message="不能为空" value="<?php echo ($cache["name"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">排名</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="rank"  data-bv-notempty="true" data-bv-notempty-message="不能为空" value="<?php echo ($cache["rank"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">首页图标</label>
                        <div class="col-lg-4">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="icon" value="<?php echo ($cache["icon"]); ?>" id="App-icon">
                                <span class="input-group-btn">
                                <button class="btn btn-default shiny" type="button" onclick="appImgviewer('App-icon')"><i class="fa fa-camera-retro"></i>预览</button><button class="btn btn-default shiny" type="button" onclick="appImguploader('App-icon',false)"><i class="glyphicon glyphicon-picture"></i>上传</button>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">分类备注</label>
                        <div class="col-lg-4">
                            <textarea class="form-control" name="summary" rows="5"><?php echo ($cache["summary"]); ?></textarea>
                        </div>
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
    submitHandler: function(validator, form, submitButton) {
        var tourl = "<?php echo U('Admin/Shop/cateSet');?>";
        var data = $('#AppForm').serialize();
        $.App.ajax('post', tourl, data, null);
        return false;
    },
});
</script>
<!--/表单验证与提交封装-->