<?php
// +----------------------------------------------------------------------
// | App自定义模型--计算佣金
// +----------------------------------------------------------------------
namespace Common\Model;

use Think\Model;

class CommissionModel
{

    // 多张订单佣金
    // type = fx1rate/fx2rate/fx3rate
    public function ordersCommission($type, $orderids = array())
    {
        $total = 0.0;
        if (is_array($orderids) && !empty($orderids)) {
            $orders = M('Shop_order')->where(array('id' => array('in', in_parse_str($orderids))))->select();
            $temp = M('Shop_goods')->select();
            $goods = array();
            foreach ($temp as $k => $v) {
                $goods[$v['id']] = $v;
            }
            unset($temp);

            // 提取数据
            foreach ($orders as $kk => $vv) {
                // 提取每条订单Items
                $temp = unserialize($vv['items']);
                foreach ($temp as $kkk => $vvv) {
                    // 记录每条订单内部内容
                    $fxrate = $goods[$vvv['goodsid']][$type];
                    // 计算
                    $total += $vvv['total'] * ($fxrate / 100);
                }
            }
        }
        return $total;
    }

    // 多张订单佣金
    // add by ck 分享红利计算
    // type = yj/ej/sj
    public function ordersCommissionNew($vip,$type, $orderids = array())
    {
        $total = 0.0;
        if (is_array($orderids) && !empty($orderids)) {
            $orders = M('Shop_order')->where(array('id' => array('in', in_parse_str($orderids))))->select();
            // 获取分享红利比例
            $vipLevel = M('vip_level')->where('id='.$vip['levelid'])->find();
            // 提取数据
            foreach ($orders as $kk => $vv) {
                // 提取每条订单Items
//                $temp = unserialize($vv['items']);
//                foreach ($temp as $kkk => $vvv) {
//                    $fxrate = $vipLevel[$type];
//                    // 计算
//                    $total += $vvv['total'] * ($fxrate);
//                }
                //根据报单总额金额计算佣金
                $fxrate = $vipLevel[$type];
                $total += $vv['bdgoodsmoney'] * ($fxrate);
            }
        }
        return $total;
    }
    //订单完成后更改待收佣金状态
    public function ordersCommissionDs($orderids = array())
    {
        if (is_array($orderids) && !empty($orderids)) {
            $fx_log = M('Fx_dslog')->where(array('oid' => array('in', in_parse_str($orderids)),'status'=>'1'));
            $data['status'] = 2;
            $fx_log->save($data);
        }
    }
    //计算订单取购物券金额
    public function orderGwq($items = array(),$vipid)
    {
        if (count($items) > 0)
        {
            foreach ($items as $kk => $vv)
            {
                $goods = M('Shop_goods')->where('id='.$vv['goodsid'])->find();
                $mgwq = M('Shop_gwq');
                $mvip = M('vip');
                $vip = $mvip->where('id='.$vipid)->find();
                //报单商品
                if ($goods['isbd']==1)
                {
                    $gwqmoney = $goods['gwqmoney'];
                    $maxgwqmoney = $goods['maxgwqmoney'];
                    //查询今天已经此产品已得购物券总额
                    $condition['user_id'] = $vipid;
                    $condition['good_id'] = $goods['id'];
                    $condition['time'] = date('Y-m-d');
                    $condition['ly'] = 1;
                    $score = $mgwq->where($condition)->sum('score');
                    if($score + $gwqmoney <= $maxgwqmoney)
                    {
                        //插入购物券日志
                        $gwq['user_id'] = $vipid;
                        $gwq['good_id'] = $goods['id'];
                        $gwq['score'] = $gwqmoney;
                        $gwq['time'] = date('Y-m-d');
                        $gwq['ly'] =1;//分享商城
                        //更改vip购物券数量
                        $vip['gwqmoney'] =  $vip['gwqmoney']  +  $gwqmoney;
                        $mvip->save($vip);
                        $mgwq->add($gwq);
                    }
                }
                else//平价商城(返还50%购物券)
                {

                    $fgwq = round($goods['price']*0.5,2);
                    //插入购物券日志
                    $gwq['user_id'] = $vipid;
                    $gwq['good_id'] = $goods['id'];
                    $gwq['score'] = $fgwq;
                    $gwq['time'] = date('Y-m-d');
                    $gwq['ly'] =2;//平价商城
                    //更改vip购物券数量
                    $vip['gwqmoney'] =  $vip['gwqmoney']  +  $fgwq;
                    $mvip->save($vip);
                    $mgwq->add($gwq);
                }
            }
        }
    }
}

?>