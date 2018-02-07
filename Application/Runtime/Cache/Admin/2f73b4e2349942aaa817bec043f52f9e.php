<?php if (!defined('THINK_PATH')) exit();?><!--百度编辑器-->
<script src="/shop/Public/Admin/ueditor/ueditor.config.js"></script>
<script src="/shop/Public/Admin/ueditor/ueditor.all.min.js"></script>
<div class="row">
    <div class="col-xs-12 col-xs-12">
        <div class="widget radius-bordered">
            <div class="widget-header bg-blue">
                <i class="widget-icon fa fa-arrow-down"></i>
                <span class="widget-caption">商品设置</span>
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
                        <a href="<?php echo U('Admin/Shop/goods/');?>" class="btn btn-primary" data-loader="App-loader" data-loadername="商品分组">
                            <i class="fa fa-mail-reply"></i>返回
                        </a>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">选择分类</label>
                        <div class="col-lg-4">
                            <select class="form-control" name="cid">
                                <option value="0">顶级分类</option>
                                <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $cache["cid"]): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option>
                                    <?php if(is_array($vo['_child'])): $i = 0; $__LIST__ = $vo['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo2["id"]); ?>" <?php if(($vo2["id"]) == $cache["cid"]): ?>selected<?php endif; ?>>&nbsp;&nbsp;└<?php echo ($vo2["name"]); ?></option>
                                        <?php if(is_array($vo2['_child'])): foreach($vo2['_child'] as $key=>$vo3): ?><option value="<?php echo ($vo3["id"]); ?>" <?php if(($vo3["id"]) == $cache["cid"]): ?>selected<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└<?php echo ($vo3["name"]); ?></option>
                                            <?php if(is_array($vo3['_child'])): foreach($vo3['_child'] as $key=>$vo4): ?><option value="<?php echo ($vo4["id"]); ?>" <?php if(($vo4["id"]) == $cache["cid"]): ?>selected<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└<?php echo ($vo4["name"]); ?></option>
                                                <?php if(is_array($vo4['_child'])): foreach($vo4['_child'] as $key=>$vo5): ?><option value="<?php echo ($vo5["id"]); ?>" <?php if(($vo5["id"]) == $cache["cid"]): ?>selected<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└<?php echo ($vo5["name"]); ?></option><?php endforeach; endif; endforeach; endif; endforeach; endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品名称<sup>*</sup></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="name" placeholder="必填" data-bv-notempty="true" data-bv-notempty-message="不能为空" value="<?php echo ($cache["name"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">首页大图片</label>
                        <div class="col-lg-4">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="indexpic" value="<?php echo ($cache["indexpic"]); ?>" id="App-indexpic" placeholder="尺寸：675*320px">
                                <span class="input-group-btn">
                                <button class="btn btn-default shiny" type="button" onclick="appImgviewer('App-indexpic')"><i class="fa fa-camera-retro"></i>预览</button><button class="btn btn-default shiny" type="button" onclick="appImguploader('App-indexpic',false)"><i class="glyphicon glyphicon-picture"></i>上传</button>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">首页列表图片</label>
                        <div class="col-lg-4">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="listpic" value="<?php echo ($cache["listpic"]); ?>" id="App-listpic" placeholder="尺寸：335*260px">
                                <span class="input-group-btn">
                                <button class="btn btn-default shiny" type="button" onclick="appImgviewer('App-listpic')"><i class="fa fa-camera-retro"></i>预览</button><button class="btn btn-default shiny" type="button" onclick="appImguploader('App-listpic',false)"><i class="glyphicon glyphicon-picture"></i>上传</button>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品图片</label>
                        <div class="col-lg-4">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="pic" value="<?php echo ($cache["pic"]); ?>" id="App-pic" placeholder="尺寸：720*400px">
                                <span class="input-group-btn">
                                <button class="btn btn-default shiny" type="button" onclick="appImgviewer('App-pic')"><i class="fa fa-camera-retro"></i>预览</button><button class="btn btn-default shiny" type="button" onclick="appImguploader('App-pic',false)"><i class="glyphicon glyphicon-picture"></i>上传</button>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品图集</label>
                        <div class="col-lg-4">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="album" value="<?php echo ($cache["album"]); ?>" id="App-album">
                                <span class="input-group-btn">
                                <button class="btn btn-default shiny" type="button" onclick="appImgviewer('App-album')"><i class="fa fa-camera-retro"></i>预览</button><button class="btn btn-default shiny" type="button" onclick="appImguploader('App-album',true)"><i class="glyphicon glyphicon-picture"></i>上传</button>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品单位<sup>*</sup></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="unit" placeholder="" value="<?php echo ($cache["unit"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品价格<sup>*</sup></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="price" placeholder="必填" data-bv-notempty="true" data-bv-notempty-message="不能为空" value="<?php echo ($cache["price"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品原价<sup>*</sup></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="oprice" placeholder="必填" data-bv-notempty="true" data-bv-notempty-message="不能为空" value="<?php echo ($cache["oprice"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">分销佣金</label>
                        <div class="col-lg-2">
                            <div class="input-group input-group-xs">
                                <span class="input-group-btn">
                           <button class="btn btn-darkorange" type="button">一级(%)：</button>
                            </span>
                                <input name="fx1rate" type="text" class="form-control" value="<?php echo ($cache["fx1rate"]); ?>">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group input-group-xs">
                                <span class="input-group-btn">
                             <button class="btn btn-darkorange" type="button">二级(%)：</button>
                         </span>
                                <input name="fx2rate" type="text" class="form-control" value="<?php echo ($cache["fx2rate"]); ?>">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group input-group-xs">
                                <span class="input-group-btn">
                             <button class="btn btn-darkorange" type="button">三级(%)：</button>
                         </span>
                                <input name="fx3rate" type="text" class="form-control" value="<?php echo ($cache["fx3rate"]); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品库存<sup>*</sup></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="num" placeholder="必填" data-bv-notempty="true" data-bv-notempty-message="不能为空" value="<?php echo ($cache["num"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">启用SKU</label>
                        <div class="col-lg-4">
                            <label>
                                <input type="hidden" name="issku" value="<?php echo ($cache["issku"]); ?>" id="issku">
                                <input class="checkbox-slider slider-icon colored-darkorange" type="checkbox" id="isskubtn" <?php if(($cache["issku"]) == "1"): ?>checked="checked"<?php endif; ?>>
                                <span class="text darkorange">&nbsp;&nbsp;&larr;重要：启用后将采用商品SKU模式管理库存，价格与销量。</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">是否免邮费</label>
                        <div class="col-lg-4">
                            <label>
                                <input type="hidden" name="ismy" value="<?php echo ($cache["ismy"]); ?>" id="ismy">
                                <input class="checkbox-slider slider-icon colored-darkorange" type="checkbox" id="ismybtn" <?php if(($cache["ismy"]) == "1"): ?>checked="checked"<?php endif; ?>>
                                <span class="text darkorange">&nbsp;&nbsp;&larr;重要：启用后纯免邮商品免邮费。</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">开启自定义销量</label>
                        <div class="col-lg-4">
                            <label>
                                <input type="hidden" name="issells" value="<?php echo ($cache["issells"]); ?>" id="issells">
                                <input class="checkbox-slider slider-icon colored-darkorange" type="checkbox" id="issellsbtn" <?php if(($cache["issells"]) == "1"): ?>checked="checked"<?php endif; ?>>
                                <span class="text darkorange">&nbsp;&nbsp;&larr;重要：开启后前端显示自定义销量。</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group" id="dissells">
                        <label class="col-lg-2 control-label">自定义销量</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="dissells" placeholder="填写自定义销量，此销量也会自动增长" value="<?php echo ($cache["dissells"]); ?>">
                        </div>
                    </div>

                   <div class="form-group">
                        <label class="col-lg-2 control-label">开启每天返现功能</label>
                        <div class="col-lg-4">
                            <label>
                                <input type="hidden" name="cashback" value="<?php echo ($cache["cashback"]); ?>" id="cashback">
                                <input class="checkbox-slider slider-icon colored-darkorange" type="checkbox" id="cashbackbtn" <?php if(($cache["cashback"]) == "1"): ?>checked="checked"<?php endif; ?>>
                                <span class="text darkorange">&nbsp;&nbsp;&larr;重要：开启后可每天返现。</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group" id="backratio">
                        <label class="col-lg-2 control-label">自定义返现比例</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="backratio" placeholder="例如0.01" value="<?php echo ($cache["backratio"]); ?>">
                        </div>
                    </div>  

                    <div class="form-group">
                        <label class="col-lg-2 control-label">选择标签</label>
                        <div class="col-lg-4">
                            <?php if(is_array($label)): $i = 0; $__LIST__ = $label;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo_l): $mod = ($i % 2 );++$i;?><label>
                                    <input type="checkbox" class="colored-blue label-check" <?php if(in_array(($vo_l["id"]), is_array($cache["lid"])?$cache["lid"]:explode(',',$cache["lid"]))): ?>checked="checked"<?php endif; ?> value="<?php echo ($vo_l["id"]); ?>" data-label="<?php echo ($vo_l["name"]); ?>">
                                    <span class="text"><?php echo ($vo_l["name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                </label><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <input type="hidden" name="lid" id="lid" value="<?php echo ($cache["lid"]); ?>" />
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品备注</label>
                        <div class="col-lg-4">
                            <textarea class="form-control" name="summary" rows="5"><?php echo ($cache["summary"]); ?></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-lg-2 control-label">商品排序<sup>*</sup></label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="sorts" placeholder="必填" data-bv-notempty="true" data-bv-notempty-message="不能为空" value="<?php echo ($cache["sorts"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品详情</label>
                        <div class="col-lg-4">
                            <!--必须插入空input避免验证冲突-->
                            <input type="hidden">
                            <script type="text/plain" id="J-ueditor">
                                <?php echo (htmlspecialchars_decode($cache["content"])); ?>
                            </script>
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
<!--编辑器封装-->
<script type="text/javascript">
var ue = UE.getEditor('J-ueditor', {
    textarea: 'content' //提交字段名，必须填写，数据库必须有此字段    
});
</script>
<!--/编辑器封装-->
<!--表单验证与提交封装-->
<script type="text/javascript">
if ($('#issellsbtn').prop('checked')) {
    $('#dissells').slideDown();
} else {
    $('#dissells').slideUp();
}
$('#AppForm').bootstrapValidator({
    submitHandler: function(validator, form, submitButton) {
        var lid = '';
        var checks = $('.label-check');
        $(checks).each(function() {
            if ($(this).is(":checked")) {
                lid += $(this).val() + ',';
            }
        });
        $('#lid').val(lid);
        var tourl = "<?php echo U('Admin/Shop/goodsSet');?>";
        var data = $('#AppForm').serialize();
        $.App.ajax('post', tourl, data, null);
        return false;
    },
});
$('#isskubtn').on('click', function() {
    var value = $(this).prop('checked') ? 1 : 0;
    $('#issku').val(value);
});
$('#ismybtn').on('click', function() {
    var value = $(this).prop('checked') ? 1 : 0;
    $('#ismy').val(value);
});
$('#issellsbtn').on('click', function() {
    var value;
    if ($(this).prop('checked')) {
        value = 1;
        $('#dissells').slideDown();
    } else {
        value = 0;
        $('#dissells').slideUp();
    }
    $('#issells').val(value);
});
if ($('#cashbackbtn').prop('checked')) {
    $('#backratio').slideDown();
} else {
    $('#backratio').slideUp();
}
$('#cashbackbtn').on('click', function() {
    var value;
    if ($(this).prop('checked')) {
        value = 1;
        $('#backratio').slideDown();
    } else {
        value = 0;
        $('#backratio').slideUp();
    }
    $('#cashback').val(value);
});
</script>
<!--/表单验证与提交封装-->