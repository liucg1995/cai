<?php
@session_start();

class sign extends WebLoginBase
{
    public $title = '\x51\x51\x34\x31\x30\x37\x34\x39\x39\x38\x35';
    private $vcodeSessionName = 'blast_vcode_session_name';
    public $pageSize = 5;

    public final function index()
    {

        $this->display('sign/index.php');
    }

    public final function s_sign()
    {
        $uid = $this->user["uid"];

        // 判断cookie 签到 cookie_sign

        if ($_COOKIE["cookie_sign"]) {

            $return = array("errcode" => '201',"msg"=>'已签到');

        } else {

            // 判断用户是否绑定卡号

            $sql = "select count(*) as count from {$this->prename}member_bank where uid=?";
            $count = $this->getRow($sql, $uid);

            if (!$count["count"]) {
                $return = array("errcode" => '203',"msg"=>'未绑定卡号');
            } else {


                $date = date("Y-m-d");

                $sql = "select count(*) as count from {$this->prename}sign_time where date='{$date}' and uid=?";
                $mycount = $this->getRow($sql, $uid);

                if ($mycount["count"] > 0) { // 判断数据库 是否插入
                    $return = array("errcode" => '202',"msg"=>'已签到');
                } else {
                    // 获取签到 领取金额
                    $sql = "select *  from {$this->prename}params where name=?";
                    $row = $this->getRow($sql, "sign_num");

                    $para['add_time'] = date("Y-m-d H:i:s", $this->time);
                    $para['uid'] = $uid;
                    $para['date'] = $date;
                    $para['money'] = $row["value"];
                    $para['ip'] = $this->ip();
                    //$para['bankId'] = $id;


                    $this->beginTransaction();
                    try {
                        if ($this->insertRow($this->prename . 'sign_time', $para)) {


                            $amount = floatval($para['money']);
                            $data = array(
                                'amount' => $amount,
                                'actionUid' => $uid,
                                'actionIP' => $this->ip(true),
                                'actionTime' => $this->time,
                                'rechargeTime' => $this->time
                            );
                            // 查找用户信息
                            $user = $this->getRow("select uid, username, coin, fcoin from {$this->prename}members where uid=$uid");
                            if (!$user) throw new Exception('用户不存在');

                            $info = '签到';

                            $data['uid'] = $user['uid'];
                            $data['coin'] = $user['coin'];
                            $data['fcoin'] = $user['fcoin'];
                            $data['username'] = $user['username'];
                            $data['info'] = $info;
                            $data['state'] = 9;

                            $sql = "select id from {$this->prename}member_recharge where rechargeId=?";
                            do {
                                $data['rechargeId'] = mt_rand(100000, 999999);
                            } while ($this->getValue($sql, $data['rechargeId']));

                            if ($this->insertRow($this->prename . 'member_recharge', $data)) {
                                $dataId = $this->lastInsertId();
                                $this->addCoin(array(
                                    'uid' => $user['uid'],
                                    'liqType' => 1,
                                    'coin' => $amount,
                                    'extfield0' => $dataId,
                                    'extfield1' => $data['rechargeId'],
                                    'info' => '充值'
                                ));
                            }

                            $this->rechargeCommission($data['amount'], $data['uid'], $dataId, $data['rechargeId']);
                            $this->addLog(3, '[ID:' . $dataId . ']', $data['uid'], $data['username']);
                            $this->commit();
                            $time = strtotime($date);
                            setcookie("cookie_sign", 1, $time + 3600 * 24);
                            $return = array("errcode" => '200',"msg"=>'签到成功');
                        } else {
                            $return = array("errcode" => '204',"msg"=>'签到失败');
                        }
                    } catch (Exception $e) {
                        $this->rollBack();
                        throw $e;
                        $return = array("errcode" => '205',"msg"=>'签到失败');
                    }


                }

            }
        }

        echo json_encode($return);
        die;

    }

    public function rechargeCommission($coin, $uid, $rechargeId, $rechargeSerialize = '')
    {

        // 加载系统设置

        $sql = "select parentId from {$this->prename}members where `uid`=?";
        $log = array(
            'liqType' => 52,
            'info' => '充值佣金',
            'extfield0' => $rechargeId,
            'extfield1' => $rechargeSerialize
        );

        if ($parentId = $this->getValue($sql, $uid)) {
            if ($pro = floatval($this->settings['rechargeCommission'])) {
                //$log['coin']=$pro * $coin /100;
                $log['coin'] = $pro;
                $log['uid'] = $parentId;
                $this->addCoin($log);
            }

            if ($parentId = $this->getValue($sql, $parentId)) {
                if ($pro = floatval($this->settings['rechargeCommission2'])) {
                    //$log['coin']=$pro * $coin /100;
                    $log['coin'] = $pro;
                    $log['uid'] = $parentId;
                    $this->addCoin($log);
                }
            }
        }
    }


}
