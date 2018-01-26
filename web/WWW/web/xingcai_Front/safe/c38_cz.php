<?php $this->display('C38_header_new.php'); ?>
<?php
$sql="select * from {$this->prename}code order by id asc";
$data=$this->getRows($sql);
?>
<script src="../../team_js/bootstrap-datetimepicker.min.js"></script>
<script src="../../team_js/bootstrap-datetimepicker.zh-CN.js"></script>

<script src="../../team_js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="/files/pay.css" type="text/css">
<div id="h2" class="wrap" style=" width:1220px; margin:0 auto;">
    <style type="text/css">
        .pay-top_1>a{
            float: none;
            display: inline-block;
            width: 18%;
            font-size: 15px;
        }
        .wechat-tit{
            text-align: left !important;
            text-indent: 57px;
        }

        .wechat-top p{
            text-align: left;
            text-indent: 57px;
        }  
        .bank-tit,.bank-tit ul{
            width: 100%;
            height: 40px;
            text-align: center;
        }
        .bank-tit ul li{
            width: 24% !important;
            float: none;
            display: inline-block;
        }
        #div_2{
            float: left;
            width: 1046px;
            background-color: #f1f1f1;
        }
        .datepicker-dropdown{
            position: absolute;
            border: 1px solid #ccc !important;
        }
        .datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top{
            position: absolute !important;
            background-color: #fff;
            border: 1px solid #ccc !important;
        }
    </style>
    <?php $this->display('siderbar.php'); ?>
    <link rel="stylesheet" href="/css/nsc/list.css?v=1.16.11.9" />
    <div id="div_1" class="clearfix right-div">
        <div class="play-wrap">
            <div class="deposit-info subContent_bet_re" style="width: 1046px;margin-left: 0;">
                <div class="pay-top_1 clearfix" style="text-align: left;width: 875px;text-indent: 21px;">
                    <a class="current" data-func="weChatDeposit_1">微信支付</a>
                    <a data-func="baoDeposit_1">支付宝支付</a>
                    <a data-func="bankDeposit">银行入款</a>
                </div>
                <!-- 微信支付 -->
                <div id="WePay_div" class="pay-info" style="display: block;width: 875px;float: left;">
                    <div style="height:1000px;margin-top:10px;margin-left:20px;">
                        <tr>
                            <td style="text-align:right;"><b>充值方式：</b></td>
                            <td colspan="2" id="pay_type_name">微信</td>
                        </tr><br /><br />
                        <tr>
                            <td style="text-align:right;" width="120"><b>收款姓名：</b></td>
                            <td id="Bname_info" width="200"><?= $data[0]["title"] ?></td>
                        </tr><br /><br />
                        <tr>
                            <td style="text-align:right;"><b>收款帐号：</b></td>
                            <td id="Baccount_info"><?= $data[0]["account"] ?></td>
                        </tr><br /><br />
                        <tr id="qrcode_img_wrap">
                            <td style="text-align:right;"><b>二维码：</b></td>
                            <td colspan="2"><img src="<?= $data[0]["imgaddr"] ?>" id="qrcode_img_id" style="width: 300px; height: 300px;padding:5px 0">
                                <div style="font-size:20px;color:red;margin-top:6px">扫码支付后，请填写充值金额，并点击确定充值！</div></td>
                        </tr><br />
                        <tr>
                            <td style="text-align:right;"><b>充值金额：</b></td>
                            <td>
                                <input class="text" id="amount" name="amount" style="ime-mode: disabled; width: 90px; height: 28px; line-height: 28px; margin-right: 10px;" type="text">元
                            </td>
                            <td id="dan_bi_limit">（单笔充值限额：最低 <span class="red">1</span> 元 ，最高<span class="red">10000</span> 元）</td>
                        </tr><br /><br />
                        <tr id="deposit_pay_type_id">
                            <td style="text-align:right;"><b>必填微信昵称：</b></td>
                            <td colspan="2"><input class="text" name="bank_cards" minlength="5" maxlength="20" style="ime-mode: disabled; width: 100px; height: 28px; line-height: 28px; margin-right: 10px;" type="text">
                            <span class="cz-fasts">请填写正确的<span class="payType">必填微信昵称</span>，否则无法到帐（如遇充值成功后仍未及时到账请及时联系客服）</span></td>
                        </tr><br /><br />
                        <div class="clearfix pay-button" style="margin-left:-2px;">
                            <a name="next_btn" class="btn fl" style="line-height: 32px;">下一步</a>
                        </div>
                    </div>
                </div>

                <!-- 微信支付 -->
                <div id="baoDeposit_1_div" class="pay-info" style="display: none">
                    <div style="height:1000px;margin-top:10px;margin-left:20px;">
                        <tr>
                            <td style="text-align:right;"><b>充值方式：</b></td>
                            <td colspan="2" id="pay_type_name">支付宝</td>
                        </tr><br /><br />
                        <tr>
                            <td style="text-align:right;" width="120"><b>收款姓名：</b></td>
                            <td id="Bname_info" width="200"><?= $data[1]["title"] ?></td>
                        </tr><br /><br />
                        <tr>
                            <td style="text-align:right;"><b>收款帐号：</b></td>
                            <td id="Baccount_info"><?= $data[1]["account"] ?></td>
                        </tr><br /><br />
                        <tr id="qrcode_img_wrap">
                            <td style="text-align:right;"><b>二维码：</b></td>
                            <td colspan="2"><img src="<?= $data[1]["imgaddr"] ?>" id="qrcode_img_id" style="width: 300px; height: 300px;padding:5px 0">
                                <div style="font-size:20px;color:red;margin-top:6px">扫码支付后，请填写充值金额，并点击确定充值！</div></td>
                        </tr><br />
                        <tr>
                            <td style="text-align:right;"><b>充值金额：</b></td>
                            <td>
                                <input class="text" id="zfbamount" name="amount" style="ime-mode: disabled; width: 90px; height: 28px; line-height: 28px; margin-right: 10px;" type="text">元
                            </td>
                            <td id="dan_bi_limit">（单笔充值限额：最低 <span class="red">1</span> 元 ，最高<span class="red">10000</span> 元）</td>
                        </tr><br /><br />
                        <tr id="deposit_pay_type_id">
                            <td style="text-align:right;"><b>必填支付宝昵称：</b></td>
                            <td colspan="2"><input class="text" name="bank_cards" minlength="5" maxlength="20" style="ime-mode: disabled; width: 100px; height: 28px; line-height: 28px; margin-right: 10px;" type="text">
                                <span class="cz-fasts">请填写正确的<span class="payType">必填支付宝昵称</span>，否则无法到帐（如遇充值成功后仍未及时到账请及时联系客服）</span></td>
                        </tr><br /><br />
                        <div class="clearfix pay-button" style="margin-left:-2px;">
                            <a name="next_btn" class="btn fl" style="line-height: 32px;">下一步</a>
                        </div>
                    </div>
                </div>
                <!-- 银行入款 -->
                <div id="bankDeposit_div" class="pay-info" style="display: none">
                    <form class="pay-form1">
                        <div class="row">
                            <label>存款人姓名 ：</label>
                            <div>
                                <input name="userName" type="text" class="pay-int" placeholder="请输入真实姓名" maxlength="20">
                            </div>
                        </div>
                        <div class="row">
                            <label>开户银行 ：</label>
                            <div class="pay-select">
                                <select>
                                    <option>请选择银行</option>
                                    <option value=" 中国农业银行" bankurl="http://www.abchina.com"> 中国农业银行</option>
                                    <option value=" 中国建设银行" bankurl="http://www.ccb.com/"> 中国建设银行</option>
                                    <option value=" 中国工商银行" bankurl="http://www.icbc.com.cn"> 中国工商银行</option>
                                    <option value=" 招商银行" bankurl="http://www.cmbchina.com/"> 招商银行</option>
                                    <option value=" 中国银行" bankurl="http://www.boc.cn/"> 中国银行</option>
                                    <option value=" 中国邮政储蓄" bankurl="http://www.psbc.com/"> 中国邮政储蓄</option>
                                    <option value=" 中国民生银行" bankurl="http://www.cmbc.com.cn/"> 中国民生银行</option>
                                    <option value=" 中信银行" bankurl="http://bank.ecitic.com/"> 中信银行</option>
                                    <option value=" 中国光大银行" bankurl="http://www.cebbank.com/"> 中国光大银行</option>
                                    <option value=" 兴业银行" bankurl="http://www.cib.com.cn"> 兴业银行</option>
                                    <option value=" 华夏银行" bankurl="http://www.hxb.com.cn/"> 华夏银行</option>
                                    <option value=" 北京银行" bankurl="http://www.bankofbeijing.com.c"> 北京银行</option>
                                    <option value=" 浦发银行" bankurl="http://www.spdb.com.cn"> 浦发银行</option>
                                    <option value=" 广发银行" bankurl="http://www.cgbchina.com.cn"> 广发银行</option>
                                    <option value=" 平安银行" bankurl="http://bank.pingan.com/"> 平安银行</option>
                                    <option value=" 交通银行" bankurl="1"> 交通银行</option>
                                </select>
                                <input type="text" class="pay-int" style="display:none;" placeholder="其他银行请输入" maxlength="12">
                            </div>
                        </div>
                        <div class="row">
                            <label>充值金额 ：</label>
                            <div>
                                <input name="ipt_money" class="pay-int" type="text" maxlength="7">
                                <div class="f12 c-gray ml-10"><span class="c-red">*</span></div>
                            </div>
                        </div>
                        <div class="clearfix pay-button">
                            <a name="next_btn" class="btn fl" style="line-height: 32px;">下一步</a>
                        </div>
                    </form>
                    <div class="pay-info-tit">
                        <div class="tip_input_blue bold">
                            推荐使用银行转账：　更快捷 / 3分钟到账　更划算/ 更大额
                        </div>
                        <div class="tips f12">
                            <div class="tip_input_blue bold">
                                温馨提示：
                            </div>
                            <p>
                                推荐使用银行卡入款：<i class="pay-dian"></i> 更快捷/<span class="c-red">3分钟到账</span>
<!--                                    <i class="pay-dian"></i> 更划算/<span class="c-red">1%存款优惠</span>-->
                                <i class="pay-dian"></i> 更大额度
                            </p>
                            <p>*接下来您可以通过以下方式完成转帐:</p>
                            <p>
                                1.网银转帐:登录您的网上银行完成转帐。</p><p>
                                2.ATM转帐:到您最近的ATM将款项转到左侧收款账号。</p><p>
                                3.ATM现存:到银行ATM以现金存入到左侧收款账号。</p><p>
                                4.银行柜台:到您最近的银行将款项转到左侧收款账号。</p><p>
                                5.手机转帐:通过您的手机验证将款项转到左侧收款账号。</p><p>
                            </p>
                            <p>*请您注意:</p>
                            <p>1.完成转帐后请联系在线客服提供用户名帮你确认是否到账。</p>
                            <p>2.请如实填写大概存入时间。</p>
                            <p>3.请勿存入整数金额，以免延误财务查收。</p>
                            <p>4.转帐完成后请保留单据作为核对证明。</p>
                        </div>
                    </div>

<input id="current_time" type="hidden" value="<?= date('d/m/Y') ?>" timestamp="<?= date('d/m/Y') ?>">
<link rel="stylesheet" href="/team_css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/team_css/bootstrap-datetimepicker.min.css">

<script src="/files/general.js" type="text/javascript"></script>
<script type="text/javascript">

                        function incharge(banktype)
                        {
                            var money;
                            if (banktype == 1) {

                                money = $("#zfbmoney").val();
                                if (money == '' || money == 0) {
                                    alert('请输入充值金额');
                                    return;
                                }
                            } else if (banktype == 2) {
                                money = $("#money").val();
                                if (money == '' || money == 0) {
                                    alert('请输入充值金额');
                                    return;
                                }
                            } else if (banktype == 3)
                            {
                                money = $("#qqmoney").val();
                                if (money == '' || money == 0) {
                                    alert('请输入充值金额');
                                    return;
                                }
                            }


                            var form = $("<form></form>");
                            form.attr('action', '/index.php/cash/inRecharge');
                            form.attr('method', 'post');
                            form.attr('target', '_self');
                            var input1 = $("<input type='hidden' name='mBankId' />");
                            input1.attr('value', banktype);
                            var input2 = $("<input type='hidden' name='amount' />");
                            input2.attr('value', money);

                            form.append(input1);
                            form.append(input2);
                            form.appendTo("body");
                            form.css('display', 'none');
                            form.submit();

                        }
                        function ddbcharge(banktype)
                        {
                            var money;
                            if (banktype == 1) {

                                money = $("#zfbmoney1").val();
                                if (money == '' || money == 0) {
                                    alert('请输入充值金额');
                                    return;
                                }
                            } else if (banktype == 2) {
                                money = $("#money1").val();
                                if (money == '' || money == 0) {
                                    alert('请输入充值金额');
                                    return;
                                }
                            } else if (banktype == 3)
                            {
                                money = $("#qqmoney1").val();
                                if (money == '' || money == 0) {
                                    alert('请输入充值金额');
                                    return;
                                }
                            } else {
                                money = $("#online_money").val();
                                if (money == '' || money == 0) {
                                    alert('请输入充值金额');
                                    return;
                                }
                            }
                            var form = $("<form></form>");
                            form.attr('action', 'https://cp.juweikeapp.cc/index.php/cash/ddbRecharge');
                            form.attr('method', 'post');
                            form.attr('target', 'frame1');
                            var input1 = $("<input type='hidden' name='mBankId' />");
                            input1.attr('value', banktype);
                            var input2 = $("<input type='hidden' name='amount' />");
                            input2.attr('value', money);
                            var input3 = $("<input type='hidden' name='uid' />");
                            input3.attr('value', <?php echo $this->user['uid']; ?>);
                            form.append(input1);
                            form.append(input2);
                            form.append(input3);
                            form.appendTo("body");
                            form.css('display', 'none');
                            form.submit();

                        }
                        function xmcharge(banktype)
                        {
                            var money;
                            var frame;
                            if (banktype == 1) {

                                money = $("#zfbmoney2").val();
                                frame = "qrcode_zfb";
                                if (money == '' || money <= 0) {
                                    alert('请输入充值金额');
                                    return;
                                }
                            } else if (banktype == 2) {
                                money = $("#money2").val();
                                frame = "qrcode_wx";
                                if (money == '' || money <= 0) {
                                    alert('请输入充值金额');
                                    return;
                                }
                            } else if (banktype == 3)
                            {
                                frame = "qrcode_qq";
                                money = $("#qqmoney2").val();
                                if (money == '' || money <= 0) {
                                    alert('请输入充值金额');
                                    return;
                                }
                            } else {
                                frame = "_self";
                                money = $("#online_money").val();
                                if (money == '' || money <= 0) {
                                    alert('请输入充值金额');
                                    return;
                                }
                            }
                            var form = $("<form></form>");
                            form.attr('action', '/index.php/cash/xmRecharge');
                            form.attr('method', 'post');
                            form.attr('target', "_self");
                            var input1 = $("<input type='hidden' name='mBankId' />");
                            input1.attr('value', banktype);
                            var input2 = $("<input type='hidden' name='amount' />");
                            input2.attr('value', money);
                            var input3 = $("<input type='hidden' name='uid' />");
                            input3.attr('value', <?php echo $this->user['uid']; ?>);
                            form.append(input1);
                            form.append(input2);
                            form.append(input3);
                            form.appendTo("body");
                            form.css('display', 'none');
                            form.submit();



                        }
</script>
<?php $this->display('C38_footer.php'); ?>