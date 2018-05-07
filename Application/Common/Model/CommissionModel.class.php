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
                //根据报单总额金额计算佣金(会员升级 则只计算升级的金额)
                $fxrate = $vipLevel[$type];
                $total += ($vv['bdgoodsmoney']-$vv['mf']) * ($fxrate);
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
    public function orderGwq($items = array(),$vipid,$orderid)
    {
        if (count($items) > 0)
        {
            foreach ($items as $kk => $vv)
            {
                $goods = M('Shop_goods')->where('id='.$vv['goodsid'])->find();
                $mgwq = M('Shop_gwq');
                $mvip = M('vip');
                $fxtmp = array();//缓存数组
                $vip = $mvip->where('id='.$vipid)->find();
                //报单商品
                if ($goods['isbd']==1)
                {
                    $gwqmoney = $goods['gwqmoney']*$vv['num'];
                    $maxgwqmoney = $goods['maxgwqmoney'];
                    //查询今天已经此产品已得购物券总额
                    $condition['user_id'] = $vipid;
                    $condition['good_id'] = $goods['id'];
                    $condition['time'] = date('Y-m-d');
                    $condition['ly'] = 1;
                    $score = $mgwq->where($condition)->sum('score');
                    if(($score + $gwqmoney <= $maxgwqmoney) || $maxgwqmoney == 0)
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

                    $fgwq = round($goods['price']*0.5*$vv['num'],2);
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

                    //平价商城分红10%（一级4%,其他级别平分6%）
//                    $pid = $vip['pid'];
//                    $mfxlog = M('fx_syslog');
//                    if($pid)
//                    {
//                        $fx1 = $mvip->where('id=' . $pid)->find();
//                        $fx1['money'] = $fx1['money'] +  round($goods['price']*0.04,2);
//                        $fx1['total_xxbuy'] = $fx1['total_xxbuy'] + 1;//下线中购买产品总次数
//                        $fx1['total_xxyj'] = $fx1['total_xxyj'] + round($goods['price']*0.04,2);//下线贡献佣金
//                        $rfx = $mvip->save($fx1);
//                        if (FALSE !== $rfx) {
//                            //佣金发放成功
//                            $fxlog['status'] = 1;
//                        } else {
//                            //佣金发放失败
//                            $fxlog['status'] = 0;
//                        }
//                        $fxlog['fhlb'] = "市场奖励";
//                        $fxlog['oid'] = $orderid;
//                        $fxlog['from'] = $vipid;
//                        $fxlog['fromname'] = $vip['nickname'];
//                        $fxlog['to'] = $pid;
//                        $fxlog['toname'] =$fx1['nickname'];
//                        $fxlog['fxprice'] = $goods['price'];
//                        $fxlog['fxyj'] = round($goods['price']*0.04,2);
//                        $fxlog['ctime'] = time();
//                        array_push($fxtmp, $fxlog);
//
//                        //二级以上则平分6%
//                        $path = $vip['path'];
//                        if($path)
//                        {
//                            $arry = explode('-',$path);
//                            if (count($arry) > 2)
//                            {
//                                //平分6%
//                                $yj = round($goods['price']*0.06,2)/(count($arry)-2);
//                                foreach ($arry as $v)
//                                {
//                                    if ($v != '0' && $v != $pid)
//                                    {
//                                        $fxx = $mvip->where('id=' . $v)->find();
//                                        $fxx['money'] = $fxx['money'] +  $yj;
//                                        $fxx['total_xxbuy'] = $fxx['total_xxbuy'] + 1;//下线中购买产品总次数
//                                        $fxx['total_xxyj'] = $fxx['total_xxyj'] + $yj;//下线贡献佣金
//                                        $rfx = $mvip->save($fxx);
//                                        if (FALSE !== $rfx) {
//                                            //佣金发放成功
//                                            $fxlog2['status'] = 1;
//                                        } else {
//                                            //佣金发放失败
//                                            $fxlog2['status'] = 0;
//                                        }
//                                        $fxlog2['fhlb'] = "市场奖励";
//                                        $fxlog2['oid'] = $orderid;
//                                        $fxlog2['from'] = $vipid;
//                                        $fxlog2['fromname'] = $vip['nickname'];
//                                        $fxlog2['to'] = $v;
//                                        $fxlog2['toname'] =$fxx['nickname'];
//                                        $fxlog2['fxprice'] = $goods['price'];
//                                        $fxlog2['fxyj'] = $yj;
//                                        $fxlog2['ctime'] = time();
//                                        array_push($fxtmp, $fxlog2);
//                                    }
//                                }
//                            }
//                        }
//                        if (count($fxtmp) >= 1) {
//                            $refxlog = $mfxlog->addAll($fxtmp);
//                            if (!$refxlog) {
//                                file_put_contents('./Data/app_fx_error.txt', '错误日志时间:' . date('Y-m-d H:i:s') . PHP_EOL . '错误纪录信息:' . $rfxlog . PHP_EOL . PHP_EOL . $mfxlog->getLastSql() . PHP_EOL . PHP_EOL, FILE_APPEND);
//                            }
//                        }
//                    }
                }
            }
        }
    }

    //计算平价商城佣金
    public function orderPj($items = array(),$vipid,$orderid)
    {
        if (count($items) > 0)
        {
            foreach ($items as $kk => $vv)
            {
                $goods = M('Shop_goods')->where('id='.$vv['goodsid'])->find();
                $mvip = M('vip');
                $level = M('vip_level');
                $fxtmp = array();//缓存数组
                $vip = $mvip->where('id='.$vipid)->find();
                if ($goods['isbd']!=1)
                {
                    $pid = $vip['pid'];
                    $mfxlog = M('fx_syslog');
                    if($pid)
                    {
                        $fx1 = $mvip->where('id=' . $pid)->find();
                        $level1 = $level->where('id='.$fx1['levelid'])->find();
                        $fx1rate = $level1['yjrate'];
                        //$fx1rate = $goods['fx1rate'];
                        //if($fx1['ispj']) {
                            $fx1['money'] = $fx1['money'] + round($fx1rate, 2)*$vv['num'];
                            $fx1['total_xxbuy'] = $fx1['total_xxbuy'] + 1;//下线中购买产品总次数
                            $fx1['total_xxyj'] = $fx1['total_xxyj'] + round($fx1rate, 2)*$vv['num'];//下线贡献佣金
                            $rfx = $mvip->save($fx1);
                            if (FALSE !== $rfx) {
                                //佣金发放成功
                                $fxlog['status'] = 1;
                            } else {
                                //佣金发放失败
                                $fxlog['status'] = 0;
                            }
                            $fxlog['fhlb'] = "平价奖励";
                            $fxlog['oid'] = $orderid;
                            $fxlog['from'] = $vipid;
                            $fxlog['fromname'] = $vip['nickname'];
                            $fxlog['to'] = $pid;
                            $fxlog['toname'] = $fx1['nickname'];
                            $fxlog['fxprice'] = $goods['price'];
                            $fxlog['fxyj'] = round($fx1rate, 2)*$vv['num'];
                            $fxlog['ctime'] = time();
                            array_push($fxtmp, $fxlog);
                        //}
                        //第二层分销
                        if ($fx1['pid']) {
                            $fx2 = $mvip->where('id=' . $fx1['pid'])->find();
                            $level2 = $level->where('id='.$fx2['levelid'])->find();
                            $fx2rate = $level2['ejrate'];
                            //$fx1rate = $goods['fx1rate'];
                            //if($fx2['ispj']) {
                                $fx2['money'] = $fx2['money'] + round($fx2rate, 2)*$vv['num'];
                                $fx2['total_xxbuy'] = $fx2['total_xxbuy'] + 1;//下线中购买产品总次数
                                $fx2['total_xxyj'] = $fx2['total_xxyj'] + round($fx2rate, 2)*$vv['num'];//下线贡献佣金
                                $rfx = $mvip->save($fx2);
                                if (FALSE !== $rfx) {
                                    //佣金发放成功
                                    $fxlog['status'] = 1;
                                } else {
                                    //佣金发放失败
                                    $fxlog['status'] = 0;
                                }
                                $fxlog['fhlb'] = "平价奖励";
                                $fxlog['oid'] = $orderid;
                                $fxlog['from'] = $vipid;
                                $fxlog['fromname'] = $vip['nickname'];
                                $fxlog['to'] = $fx1['pid'];
                                $fxlog['toname'] = $fx2['nickname'];
                                $fxlog['fxprice'] = $goods['price'];
                                $fxlog['fxyj'] = round($fx2rate, 2)*$vv['num'];
                                $fxlog['ctime'] = time();
                                array_push($fxtmp, $fxlog);
                            //}
                            //第三层分销
                            if ($fx2['pid']) {
                                $fx3 = $mvip->where('id=' . $fx2['pid'])->find();
                                $level3 = $level->where('id='.$fx3['levelid'])->find();
                                $fx3rate = $level3['sjrate'];
                                //if($fx3['ispj'])
                                //{
                                    $fx3['money'] = $fx3['money'] + round($fx3rate, 2)*$vv['num'];
                                    $fx3['total_xxbuy'] = $fx3['total_xxbuy'] + 1;//下线中购买产品总次数
                                    $fx3['total_xxyj'] = $fx3['total_xxyj'] + round($fx3rate, 2)*$vv['num'];//下线贡献佣金
                                    $rfx = $mvip->save($fx3);
                                    if (FALSE !== $rfx) {
                                        //佣金发放成功
                                        $fxlog['status'] = 1;
                                    } else {
                                        //佣金发放失败
                                        $fxlog['status'] = 0;
                                    }
                                    $fxlog['fhlb'] = "平价奖励";
                                    $fxlog['oid'] = $orderid;
                                    $fxlog['from'] = $vipid;
                                    $fxlog['fromname'] = $vip['nickname'];
                                    $fxlog['to'] = $fx2['pid'];
                                    $fxlog['toname'] = $fx3['nickname'];
                                    $fxlog['fxprice'] = $goods['price'];
                                    $fxlog['fxyj'] = round($fx3rate, 2)*$vv['num'];
                                    $fxlog['ctime'] = time();
                                    array_push($fxtmp, $fxlog);
                                //}
                            }
                        }
                    }
                }

                if (count($fxtmp) >= 1) {
                    $refxlog = $mfxlog->addAll($fxtmp);
                    if (!$refxlog) {
                        file_put_contents('./Data/app_fx_error.txt', '错误日志时间:' . date('Y-m-d H:i:s') . PHP_EOL . '错误纪录信息:' . $rfxlog . PHP_EOL . PHP_EOL . $mfxlog->getLastSql() . PHP_EOL . PHP_EOL, FILE_APPEND);
                    }
                }
            }
        }
    }

    //计算平价商城待收佣金
    public function orderPjDs($items = array(),$vipid,$orderid)
    {
        if (count($items) > 0)
        {
            foreach ($items as $kk => $vv)
            {
                $goods = M('Shop_goods')->where('id='.$vv['goodsid'])->find();
                $mvip = M('vip');
                $level = M('vip_level');
                $fxtmp = array();//缓存数组
                $vip = $mvip->where('id='.$vipid)->find();
                if ($goods['isbd']!=1)
                {
                    $pid = $vip['pid'];
                    $mfxlog = M('fx_dslog');
                    if($pid)
                    {
                        $fx1 = $mvip->where('id=' . $pid)->find();
                        $level1 = $level->where('id='.$fx1['levelid'])->find();
                        $fx1rate = $level1['yjrate'];
                        //$fx1rate = $goods['fx1rate'];
                        //if($fx1['ispj']) {
                        $fxlog['status'] = 1;
                        $fxlog['fhlb'] = "平价奖励";
                        $fxlog['oid'] = $orderid;
                        $fxlog['from'] = $vipid;
                        $fxlog['fromname'] = $vip['nickname'];
                        $fxlog['to'] = $pid;
                        $fxlog['toname'] = $fx1['nickname'];
                        $fxlog['fxprice'] = $goods['price'];
                        $fxlog['fxyj'] = round($fx1rate, 2)*$vv['num'];
                        $fxlog['ctime'] = time();
                        array_push($fxtmp, $fxlog);
                        //}
                        //第二层分销
                        if ($fx1['pid']) {
                            $fx2 = $mvip->where('id=' . $fx1['pid'])->find();
                            $level2 = $level->where('id='.$fx2['levelid'])->find();
                            $fx2rate = $level2['ejrate'];
                            //$fx1rate = $goods['fx1rate'];
                            //if($fx2['ispj']) {
                            //佣金发放成功
                            $fxlog['status'] = 1;
                            $fxlog['fhlb'] = "平价奖励";
                            $fxlog['oid'] = $orderid;
                            $fxlog['from'] = $vipid;
                            $fxlog['fromname'] = $vip['nickname'];
                            $fxlog['to'] = $fx1['pid'];
                            $fxlog['toname'] = $fx2['nickname'];
                            $fxlog['fxprice'] = $goods['price'];
                            $fxlog['fxyj'] = round($fx2rate, 2)*$vv['num'];
                            $fxlog['ctime'] = time();
                            array_push($fxtmp, $fxlog);
                            //}
                            //第三层分销
                            if ($fx2['pid']) {
                                $fx3 = $mvip->where('id=' . $fx2['pid'])->find();
                                $level3 = $level->where('id='.$fx3['levelid'])->find();
                                $fx3rate = $level3['sjrate'];
                                //if($fx3['ispj'])
                                //{

                                //佣金发放成功
                                $fxlog['status'] = 1;

                                $fxlog['fhlb'] = "平价奖励";
                                $fxlog['oid'] = $orderid;
                                $fxlog['from'] = $vipid;
                                $fxlog['fromname'] = $vip['nickname'];
                                $fxlog['to'] = $fx2['pid'];
                                $fxlog['toname'] = $fx3['nickname'];
                                $fxlog['fxprice'] = $goods['price'];
                                $fxlog['fxyj'] = round($fx3rate, 2)*$vv['num'];
                                $fxlog['ctime'] = time();
                                array_push($fxtmp, $fxlog);
                                //}
                            }
                        }
                    }
                }

                if (count($fxtmp) >= 1) {
                    $refxlog = $mfxlog->addAll($fxtmp);
                    if (!$refxlog) {
                        file_put_contents('./Data/app_fx_error.txt', '错误日志时间:' . date('Y-m-d H:i:s') . PHP_EOL . '错误纪录信息:' . $rfxlog . PHP_EOL . PHP_EOL . $mfxlog->getLastSql() . PHP_EOL . PHP_EOL, FILE_APPEND);
                    }
                }
            }
        }
    }
}

?>