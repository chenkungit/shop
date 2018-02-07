<?php
namespace Admin\Controller;

use Think\Controller;

class ScoreController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
        $bread = array(
            '0' => array(
                'name' => '积分管理',
                'url' => U('Admin/Score/index'),
            ),
        );
        $this->assign('breadhtml', $this->getBread($bread));
        
        $product = M('Score'); // 实例化User对象
        $p = $_GET['p'] ? $_GET['p'] : 1;
        $psize = self::$CMS['set']['pagesize'] ? self::$CMS['set']['pagesize'] : 20;
        $cache = $product->where(array())->page($p, $psize)->select();
        
        $count = $product->where(array())->count();
        $this->getPage($count, $psize, 'App-loader', '积分管理', 'App-search');

        $this->assign('product', $cache);// 赋值分页输出
        $this->display(); // 输出模板
    }

    public function add()
    {
        if ($_GET["id"]) {
            $product = M("Score")->where(array("id" => $_GET["id"]))->find();
            $this->assign("product", $product);
        }
        $this->display();
    }

    public function addProduct()
    {
        if ($_FILES["image"]["name"]) {
            $image = array();
            $image["image"] = $_FILES["image"];
            $image = $this->upload($image);
            $_POST["image"] = $image[0];
        } else {
            unset($_POST["image"]);
        }
        if ($_POST["id"] == 0) {
            M("Score")->add($_POST);
        } else {
            M("Score")->save($_POST);
        }
        $this->ajaxReturn(array("status"=>"1","msg"=>"添加成功"));
    }

    public function del()
    {
        $id = $_GET["id"];
        M("Score")->where(array("id" => $id))->delete();
        $this->ajaxReturn(array("status"=>"1","msg"=>"删除成功"));
    }
    public function order()
    {
        $order = M('ScoreOrder'); // 实例化User对象
        $p = $_GET['p'] ? $_GET['p'] : 1;
        $psize = self::$CMS['set']['pagesize'] ? self::$CMS['set']['pagesize'] : 20;
        $cache = $order->where(array())->page($p, $psize)->select();
        
        $count = $order->where(array())->count();
        $this->getPage($count, $psize, 'App-loader', '积分订单管理', 'App-search');

        $this->assign('order', $order);// 赋值分页输出
        $this->display(); // 输出模板
    }

    public function cancel()
    {
        $data ["status"] = "-1";
        $data ["id"] = $_GET ["id"];
        M("ScoreOrder")->save($data);
        $this->ajaxReturn(array("status"=>"1","msg"=>"操作成功"));
    }

    public function delOrder()
    {
        M("ScoreOrder")->where(array("id" => $_GET["id"]))->delete();
        $this->ajaxReturn(array("status"=>"1","msg"=>"操作成功"));
    }

    public function publish()
    {
        $data ["status"] = "1";
        $data ["id"] = $_GET ["id"];
        M("ScoreOrder")->save($data);
        $this->ajaxReturn(array("status"=>"1","msg"=>"操作成功"));
    }

    public function payComplete()
    {
        $data ["pay_status"] = "1";
        $data ["id"] = $_GET ["id"];
        M("ScoreOrder")->save($data);
        $this->ajaxReturn(array("status"=>"1","msg"=>"操作成功"));
    }

    public function complete()
    {
        $data ["status"] = "2";
        $data ["id"] = $_GET ["id"];
        M("ScoreOrder")->save($data);
        $this->ajaxReturn(array("status"=>"1","msg"=>"操作成功"));
    }
}