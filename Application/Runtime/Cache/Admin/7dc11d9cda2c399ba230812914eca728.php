<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded">
                <form action="<?php echo U('Admin/Score/addproduct');?>" enctype="multipart/form-data" method="post" id="myForm"
                      onsubmit="return false;" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-2">商品名称</label>

                        <div class="col-md-7">
                            <input class="form-control" name="name" value="<?php echo ($product["name"]); ?>" placeholder="" type="text">
                            <input class="form-control" name="id" value="0" placeholder="" type="hidden">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">商品积分</label>

                        <div class="col-md-7">
                            <input class="form-control" name="score" value="<?php echo ($product["score"]); ?>" placeholder=""
                                   type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">商品排序</label>

                        <div class="col-md-7">
                            <input class="form-control" name="rank" value="<?php echo ($product["rank"]); ?>" placeholder="" type="text">
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-lg-2 control-label">商品图片</label>
                        <div class="col-lg-4">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="pic" value="" data-bv-notempty="true" data-bv-notempty-message="不能为空" id="App-pic" data-bv-field="pic"><i class="form-control-feedback" data-bv-field="pic" style="display: none;"></i>
                                <span class="input-group-btn">
                                <button class="btn btn-default shiny" type="button" onclick="appImgviewer('App-pic')"><i class="fa fa-camera-retro"></i>预览</button><button class="btn btn-default shiny" type="button" onclick="appImguploader('App-pic',false)"><i class="glyphicon glyphicon-picture"></i>上传</button>
                            </span>
                            </div>
                            <small data-bv-validator="notEmpty" data-bv-validator-for="pic" class="help-block" style="display: none;">不能为空</small></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">商品状态</label>

                        <div class="col-md-7">
                            <select class="form-control" name="status">
                                <option value="1">出售</option>
                                <option value="0">下架</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">商品推荐</label>

                        <div class="col-md-7">
                            <select class="form-control" name="recommend">
                                <option value="1">推荐</option>
                                <option value="0">正常</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2"></label>

                        <div class="col-md-7">
                            <button class="btn btn-primary" type="submit">提交</button>
                            <button class="btn btn-default-outline">取消</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    if ('<?php echo ($product); ?>') {
        $('input[name="id"]').val('<?php echo ($product["id"]); ?>');
        $('select[name="menu_id"]').val('<?php echo ($product["menu_id"]); ?>');
        $('select[name="status"]').val('<?php echo ($product["status"]); ?>');
        $('select[name="recommend"]').val('<?php echo ($product["recommend"]); ?>');
    }
    $('#myForm').bootstrapValidator({
        submitHandler: function(validator, form, submitButton) {
            var tourl = "<?php echo U('Admin/Score/addproduct');?>";
            var data = $('#myForm').serialize();
            $.App.ajax('post', tourl, data, null);
            return false;
        },
    });
</script>