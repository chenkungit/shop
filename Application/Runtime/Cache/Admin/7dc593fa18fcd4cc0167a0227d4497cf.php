<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header bg-blue">
                <i class="widget-icon fa fa-arrow-down"></i>
                <span class="widget-caption">商品管理</span>
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
                <div class="table-toolbar">
                    <a href="<?php echo U('Admin/Shop/goodsSet/');?>" class="btn btn-primary" data-loader="App-loader" data-loadername="设置商品">
                        <i class="fa fa-plus"></i>新增商品
                    </a>
                    <a href="#" class="btn btn-danger" id="App-delall">
                        <i class="fa fa-delicious"></i>全部删除
                    </a>
                    <div class="pull-right">
                        <form id="App-search">
                            <label style="margin-bottom: 0px;">
                                <input name="name" type="search" class="form-control input-sm">
                            </label>
                            <a href="<?php echo U('Admin/Shop/goods/');?>" class="btn btn-success" data-loader="App-loader" data-loadername="商品" data-search="App-search">
                                <i class="fa fa-search"></i>搜索
                            </a>
                        </form>
                    </div>
                </div>
                <table id="App-table" class="table table-bordered table-hover">
                    <thead class="bordered-darkorange">
                        <tr role="row">
                            <th width="30px">
                                <div class="checkbox" style="margin-bottom: 0px; margin-top: 0px;">
                                    <label style="padding-left: 4px;">
                                        <input type="checkbox" class="App-checkall colored-blue">
                                        <span class="text"></span>
                                    </label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>SPU</th>
                            <th>分类名称</th>
                            <th>商品名称</th>
                            <th>商品单位</th>
                            <th>商品库存</th>
                            <th>商品单价</th>
                            <th>商品原价</th>
                            <th>商品点击</th>
                            <th>商品销量</th>
                            <th>商品排序</th>
                            <th>上下架</th>
                            <th>SKU管理</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($cache)): $i = 0; $__LIST__ = $cache;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="item<?php echo ($vo["id"]); ?>">
                                <td>
                                    <div class="checkbox" style="margin-bottom: 0px; margin-top: 0px;">
                                        <label style="padding-left: 4px;">
                                            <input name="checkvalue" type="checkbox" class="colored-blue App-check" value="<?php echo ($vo["id"]); ?>">
                                            <span class="text"></span>
                                        </label>
                                    </div>
                                </td>
                                <td class=" sorting_1"><?php echo ($vo["id"]); ?></td>
                                <td class=" "><?php echo ($vo["spu"]); ?></td>
                                <td class=" "><?php echo ($vo["cid"]); ?></td>
                                <td class=" "><?php echo ($vo["name"]); ?></td>
                                <td class=" "><?php echo ($vo["unit"]); ?></td>
                                <td class=" "><?php echo ($vo["num"]); ?></td>
                                <td class=" "><?php echo ($vo["price"]); ?></td>
                                <td class=" "><?php echo ($vo["oprice"]); ?></td>
                                <td class=" "><?php echo ($vo["clicks"]); ?></td>
                                <td class=" "><?php echo ($vo["sells"]); ?></td>
                                <td class=" "><?php echo ($vo["sorts"]); ?></td>
                                <td class=" ">
                                    <?php if(($vo["status"]) == "1"): ?><button class="btn btn-danger btn-xs status" data-id="<?php echo ($vo["id"]); ?>" data-status="<?php echo ($vo["status"]); ?>"><i class="fa fa-arrow-down"></i>下架</button>
                                        <?php else: ?>
                                        <button class="btn btn-success btn-xs status" data-id="<?php echo ($vo["id"]); ?>" data-status="<?php echo ($vo["status"]); ?>"><i class="fa fa-arrow-up"></i>上架</button><?php endif; ?>
                                </td>
                                <td class=" ">
                                    <?php if(($vo["issku"]) == "1"): ?><a href="<?php echo U('Admin/Shop/sku/',array('id'=>$vo['id']));?>" class="btn btn-azure btn-xs" data-loader="App-loader" data-loadername="SKU管理"><i class="fa fa-edit"></i> 管理</a>
                                        <?php else: ?>未启用SKU<?php endif; ?>
                                </td>
                                <td class="center "><a href="<?php echo U('Admin/Shop/goodsSet/',array('id'=>$vo['id']));?>" class="btn btn-success btn-xs" data-loader="App-loader" data-loadername="设置商品"><i class="fa fa-edit"></i> 管理</a>&nbsp;&nbsp;<button class="btn btn-success btn-xs getlink" data-id="<?php echo ($vo["id"]); ?>"><i class="fa fa-link"></i> 商品链接</button>&nbsp;&nbsp;<a href="<?php echo U('Admin/Shop/goods/');?>" class="btn btn-danger btn-xs" data-type="del" data-ajax="<?php echo U('Admin/Shop/goodsDel/',array('id'=>$vo['id']));?>"><i class="fa fa-trash-o"></i> 删除</a></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <div class="row DTTTFooter">
                    <?php echo ($page); ?>
                </div>
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
<!--全选特效封装/全部删除-->
<script type="text/javascript">
//全选
var checkall = $('#App-table .App-checkall');
var checks = $('#App-table .App-check');
var trs = $('#App-table tbody tr');
$(checkall).on('click', function() {
    if ($(this).is(":checked")) {
        $(checks).prop("checked", "checked");
    } else {
        $(checks).removeAttr("checked");
    }
});
$(trs).on('click', function() {
    var c = $(this).find("input[type=checkbox]");
    if ($(c).is(":checked")) {
        $(c).removeAttr("checked");
    } else {
        $(c).prop("checked", "checked");
    }
});
//全删
$('#App-delall').on('click', function() {
    var checks = $(".App-check:checked");
    var chk = '';
    $(checks).each(function() {
        chk += $(this).val() + ',';
    });
    if (!chk) {
        $.App.alert('danger', '请选择要删除的项目！');
        return false;
    }
    var toajax = "<?php echo U('Admin/Shop/goodsDel');?>" + "/id/" + chk;
    var funok = function() {
        var callok = function() {
            //成功删除后刷新
            $('#refresh-toggler').trigger('click');
            return false;
        };
        var callerr = function() {
            //拦截错误
            return false;
        };
        $.App.ajax('post', toajax, 'nodata', callok, callerr);
    }
    $.App.confirm("确认要删除吗？", funok);
});
//上下架
$('.status').on('click', function() {
    var id = $(this).data('id');
    var status = $(this).data('status');
    var toajax = "<?php echo U('Admin/Shop/goodsStatus');?>";
    var data = {
        'id': id,
        'status': status
    };
    var callok = function() {
        $('#refresh-toggler').trigger('click');
        return false;
    };
    var callerr = function() {
        //拦截错误
        return false;
    };
    $.App.ajax('post', toajax, data, callok, callerr);
});
</script>
<!--/全选特效封装-->
<!--获取商品链接-->
<script type="text/javascript">
$('.getlink').on('click',function(){
	var id = $(this).data('id');
	var mb="<p>http://"+window.location.host+"/App/Shop/goods/sid/0/id/"+id+"</p>";
	bootbox.dialog({
        message: mb,
    	title: "商品链接展示",
    	className: "modal-darkorange",
    	buttons: {
            "关闭": {
                className: "btn-danger",
                callback: function () {}
            }
    	}
	});
	return false;
});
</script>
<!--获取商品链接-->