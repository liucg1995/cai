<?php $this->display('C38_header_new.php'); ?>

    <div id="nsc_subContent">


        <?php $this->display('siderbar.php'); ?>

        <link rel="stylesheet" href="/css/nsc/reset.css?v=1.16.11.9"/>
        <link rel="stylesheet" href="/css/nsc/list.css?v=1.16.11.9"/>
        <link rel="stylesheet" href="/css/nsc/activity.css?v=1.16.11.9"/>
        </head>
        <body>
        <div id="subContent_bet_re" class="subContent_bet_re">

            <script type="text/javascript">
                $(function () {
                    $('.chazhao').click(function () {
                        $(this).closest('form').submit();
                    });
                    $('.bottompage a[href]').live('click', function () {
                        $('.biao-cont').load($(this).attr('href'));
                        return false;
                    });
                    //查看
                    $('.viewbox').live('click', function () {
                        var tourl = $(this).attr("tourl");
                        var dataid = $(this).attr("dataid");
                        if (tourl) {
                            $('.boxdetail').load(tourl);
                        }
                    });
                    //全选
                    $("input[name=chk_All]").live("click", function () {
                        var item = $("input[name=chk_only]");
                        if (typeof(item.length) == "undefined") {
                            item.checked = !item.checked;
                        }
                        else {
                            for (i = 0; i < item.length; i++) {
                                item[i].checked = $(this).attr("checked");
                            }
                        }
                    });
                    
                    $(".formCheck").click(function () {
                        $.ajax({
                            url: '/index.php/sign/s_sign',
                            async: false,
                            type: "GET",
                            data: {},
                            dataType: "json",
                            error:function(){

                            },
                            success: function (data) {

                                if(data.errcode=='200'){
                                    $(".formCheck").hide();
                                    alert(data.msg);
                                }else if(data.errcode=='203'){
                                    alert(data.msg);
                                    location.href="/index.php/safe/info";
                                }else{
                                    alert(data.msg);
                                }

                            }
                        });

                    });
                });
                function boxSearch(err, data) {
                    if (err) {
                        $.alert(err);
                    } else {
                        $('.biao-cont').html(data);
                        recodeRefresh();
                    }
                }
                function recodeRefresh() {
                    $('.biao-cont').load(
                        $('.bottompage .on').attr('href')
                    );
                }
                function deleteBet(err, data) {
                    if (err) {
                        $.alert(err);
                    } else {
                        $.alert('删除成功');
                        recodeRefresh();
                    }
                }
                /**
                 * 批量撤销前调用
                 */
                function recordBeforeDelete() {
                    //获取ID
                    var byid = "";
                    var tourl = "/index.php/box/deleteAll/";
                    var a = document.getElementsByName("chk_only");
                    for (var i = 0, len = a.length; i < len; i++) {
                        if (a.item(i).checked) {
                            if (byid.length > 0) {
                                byid = byid + "-" + a.item(i).value;
                            }
                            else {
                                byid = byid + a.item(i).value;
                            }
                        }
                    }
                    if (byid.length > 0) {
                        if (confirm('是否确定要删除？')) {
                            tourl += byid;
                            $(".removeAllRecord").attr("href", tourl);
                        } else {
                            return false;
                        }
                    } else {
                        $.alert("请选择需要删除的消息！");
                        return false;
                    }
                }
                function boxBeforSend() {
                    if (!this.boxid.value)  throw('数据有误');
                    if (!this.title.value) throw('请输入主题');
                    if (!this.content.value) throw('请输入内容');
                    if (!this.vcode.value) throw('请输入验证码');
                    if (this.vcode.value < 4) throw('验证码至少4位');
                }
                function boxSend(err, data) {
                    if (err) {
                        $.alert(err);
                        $("#vcode").trigger("click");
                    } else {
                        $.alert(data);
                        this.reset();
                        reload();
                    }
                }
            </script>
            <?php
            // 判断今天是否签到
            $date = date("Y-m-d");
            $sql="select count(*) as count from {$this->prename}sign_time where uid= {$this->user["uid"]} and date='{$date}' ";
            $row=$this->getRow($sql);

            ?>

            <div id="contentBox">
                <form action="/index.php/box/searchReceive" datatype="html" call="boxSearch" target="ajax">

                    <?php
                    if(!$row["count"] && empty($_COOKIE["cookie_sign"])){
                    ?>
                    <div id="searchBox" class="re">
                        <div class="inlineBlock">
                            <input type="button" value="签到" class="formCheck" />
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </form>
            </div>
            <div class="biao-cont">
                <?php

                $sql="select * from {$this->prename}sign_time where isdelete = 0 and uid = {$this->user['uid']} ";
                $list=$this->getPage($sql, $this->page, $this->pageSize);
                $params=http_build_query($_REQUEST, '', '&');

                ?>
                <table width="100%" border="0" cellspacing="1" cellpadding="0" class="grayTable">
                    <thead>
                    <tr class="table_b_th">
                        <td width="60">签到日期</td>
                        <td>奖励</td>
                        <td class="tl">IP</td>
                        <td>时间</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($list['data']) foreach($list['data'] as $var){ ?>
                        <tr class="viewbox" >
                            <td><?=$var['date']?></td>
                            <td><?=$var['money']?></td>
                            <td><?=$var['ip']?></td>
                            <td><?=$var['add_time']?></td>
                        </tr>
                    <?php }else{ ?>
                        <tr>
                            <td colspan="5" align="center">暂无消息。</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php
                $this->display('inc_page.php',0,$list['total'],$this->pageSize, "/index.php/{$this->controller}/{$this->action}-{page}/{$this->type}?$params");
                ?>
            </div>
            <div class="boxdetail"></div>


        </div>
    </div></div></div></div>
<?php $this->display('C38_footer.php'); ?>