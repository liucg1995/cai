requirejs(["jquery", "common"], function($) {
        $(function() {
            var statusType = null;
            var pageIndex = 1; //初始化
            getDepositList(); //初始化
            
            function initLoading() {
                var loadHtml = '<li class="loading">' + '<div class="order-list-tit"></div>' + '<div class="c-gary" style="text-align: center">正在加载...</div>' + '</li>';
                $('ul#deposit_list').html(loadHtml);
                $('a.on-more').hide();
                $('div.mine-message').hide();
            }
            $('a.on-more').on("click", function() {
                getDepositList(1);
            });
            $('div.ui-bett-refresh').on("click", function() {
                initLoading();
                getDepositList(2);
            });
            $('div.beet-tips a').on("click", function() {
                $('div.beet-tips a').removeClass('beet-active');
                $('div.beet-tips').hide();
                $(this).addClass('beet-active');
                $('span#status_type').text($(this).text());
                statusType = $(this).data('type');
                initLoading();
                getDepositList(2);
            });

            $("#status_type").click(function () {

                $.ajax({
                    url: '/index.php/sign/s_sign',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                    },
                    timeout: 30000,
                    success: function(data) {
                        if(data.errcode=='200'){
                            $("#status_type").hide();
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

            function getDepositList(more) {
                if (more == 1) {
                    pageIndex++;
                } else if (more == 2) {
                    pageIndex = 1;
                }
                $.ajax({
                    url: '/index.php/Sign/getList',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'pageIndex': pageIndex
                    },
                    timeout: 30000,
                    success: function(results) {
                        $('ul#deposit_list li.loading').remove();
                        if (results.status == "100") {
                            location.href = "/safe/Personal";
                            return;
                        }
                        if (results.status == "200") {
                            var data = results.data.data;
                            var txtHtml = '';
                            for (var i = 0; i < data.length; i++) {
                               var  statusName = "签到日期："+data[i].date;
                                txtHtml += '<li>'
                                    + '<div class="order-list-tit">' + '<span class="fr c-red" style="color: #00bf16;">'
                                    + "奖励："+data[i].money + '元</span><span class="order-top-left">' + statusName + '</span>'
                                    + '</div>' + '<div class="c-gary"><span class="fr" style="font-size: 12px;">'
                                    + (data[i].add_time) + '</span><p class="order-time" style="font-size: 12px;">IP: '
                                    + data[i].ip + '</p></div>'  + '</li>';
                            }
                            if (!data.length) {
                                $('div.mine-message').show();
                            } else {
                                $('div.mine-message').hide();
                            }
                            if (results.data.totalPage > (pageIndex*10)) {
                                $('a.on-more').show();
                            } else {
                                $('a.on-more').hide();
                            }
                            if (more == 2) { //刷新
                                $('ul#deposit_list').html(txtHtml);
                            } else {
                                $('ul#deposit_list').append(txtHtml);
                            }
                        }
                    }
                });
            }
        });
    });