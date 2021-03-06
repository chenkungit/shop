<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget-container fluid-height" style="box-shadow: 0 0px 0px rgba(0, 0, 0, 0);">
                            <div class="heading tabs" style="background: transparent;">
                                <ul class="nav nav-tabs pull-left" data-tabs="tabs" id="tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#tab1"><i class="icon-comments"></i><span>邮件设置</span></a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#tab2"><i class="icon-user"></i><span>邮件记录</span></a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#tab3"><i class="icon-user"></i><span>添加收件人</span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content padded" id="my-tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <h3>
                                        邮件设置
                                    </h3>

                                    <p>

                                    <form action="<?php echo U('Admin/Mail/addConfig');?>" id="myForm" method="post" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-md-2">SMTP</label>

                                            <div class="col-md-7">
                                                <input class="form-control" placeholder="" value="<?php echo ($config["smtp"]); ?>"
                                                       name="smtp" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2">邮箱</label>

                                            <div class="col-md-7">
                                                <input class="form-control" placeholder=""
                                                       value="<?php echo ($config["mail"]); ?>" name="mail" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2">密码</label>

                                            <div class="col-md-7">
                                                <input class="form-control" placeholder="" value="<?php echo ($config["password"]); ?>"
                                                       name="password" type="text">
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
                                    </p>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <h3>
                                        邮件记录
                                    </h3>

                                    <p>

                                    <div class="widget-content padded clearfix">
                                        <table class="table table-hover" style="margin-bottom: 12px">
                                            <thead>
                                            <th class="check-header hidden-xs">
                                                <label><input id="checkAll" name="checkAll"
                                                              type="checkbox"><span></span></label>
                                            </th>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                邮箱
                                            </th>
                                            <th class="hidden-xs">
                                                时间
                                            </th>
                                            <th class="hidden-xs">
                                                操作
                                            </th>
                                            </thead>
                                            <tbody>
                                            <?php if(is_array($receiver)): $i = 0; $__LIST__ = $receiver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$receiver): $mod = ($i % 2 );++$i;?><tr>
                                                    <td class="check hidden-xs">
                                                        <label><input name="optionsRadios1" type="checkbox"
                                                                      value="option1"><span></span></label>
                                                    </td>
                                                    <td>
                                                        <?php echo ($receiver["id"]); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($receiver["receiver"]); ?>
                                                    </td>
                                                    <td class="hidden-xs">
                                                        <?php echo ($receiver["time"]); ?>
                                                    </td>
                                                    <td class="hidden-xs">
                                                        <style type="text/css">
                                                            .action-buttons > a {
                                                                margin-left: 5px;
                                                            }
                                                        </style>
                                                        <div class="action-buttons" style="cursor: pointer;">
                                                            <a class="table-actions"
                                                               onclick="openTab('<?php echo U('Admin/Mail/getMail');?>','<?php echo ($receiver["id"]); ?>')">修改</a><a class="table-actions" href="<?php echo U('Admin/Mail/del');?>" data-type="del" data-ajax="<?php echo U('Admin/Mail/del',array('id'=>$receiver['id']));?>">删除</a>
                                                        </div>
                                                    </td>
                                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </tbody>
                                        </table>
                                        <?php echo ($page); ?>
                                    </div>
                                    </p>
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <h3>
                                        添加收件人
                                    </h3>

                                    <p>

                                    <form action="<?php echo U('Admin/Mail/addMail');?>" id="myForm2" method="post"
                                          onsubmit="return false;" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-md-2">收件人</label>

                                            <div class="col-md-7">
                                                <input class="form-control" placeholder="" value=""
                                                       name="receiver" type="text">
                                                <input class="form-control" placeholder="" value="0"
                                                       name="id" type="hidden">
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
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function openTab(url , id){
        $.ajax({
            type: "post",
            url: url,
            data: {
                id: id
            },
            success: function (data) {
//                $('#tabs li').removeClass("active");
//                $('#tabs li').eq(2).addClass("active");
                $('#tabs li').eq(2).children().click();
                var json = eval(data);
                $('input[name="receiver"]').val(json.receiver);
                $('input[name="id"]').val(json.id);

            },
            beforeSend: function () {
                $("#popover-loader").show();
            },
            complete: function () {
                $("#popover-loader").hide();
            }
        });
    }
    $('#myForm').bootstrapValidator({
        submitHandler: function(validator, form, submitButton) {
            var tourl = "<?php echo U('Admin/Mail/addConfig');?>";
            var data = $('#myForm').serialize();
            $.App.ajax('post', tourl, data, null);
            return false;
        },
    });
    $('#myForm2').bootstrapValidator({
        submitHandler: function(validator, form, submitButton) {
            var tourl = "<?php echo U('Admin/Mail/addMail');?>";
            var data = $('#myForm2').serialize();
            $.App.ajax('post', tourl, data, function(){
                $('#refresh-toggler').click();
            });
            return false;
        },
    });
</script>