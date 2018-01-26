<!DOCTYPE html>
<html>
<head>

    <meta http-equiv=Content-Type content="text/html;charset=utf-8">
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" name="viewport" />
    <meta name=format-detection content="telphone=no" />
    <meta name=apple-mobile-web-app-capable content=yes />

    <title>金沙彩票</title>

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="uploadimg/wapicon/icon-57.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="uploadimg/wapicon/icon-72.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="uploadimg/wapicon/icon-114.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="uploadimg/wapicon/icon-144.png">

    <link rel="stylesheet" href="/assets/statics/css/style.css" type="text/css">
    <link rel="stylesheet" href="/assets/statics/css/global.css" type="text/css">

    <script type="text/javascript">
        if(('standalone' in window.navigator)&&window.navigator.standalone){
            var noddy,remotes=false;
            document.addEventListener('click',function(event){
                noddy=event.target;
                while(noddy.nodeName!=='A'&&noddy.nodeName!=='HTML') noddy=noddy.parentNode;
                if('href' in noddy&&noddy.href.indexOf('http')!==-1&&(noddy.href.indexOf(document.location.host)!==-1||remotes)){
                    event.preventDefault();
                    document.location.href=noddy.href;
                }
            },false);
        }
    </script>
</head>

<body class="login-bg">
<div class="header">
    <div class="headerTop">
        <div class="ui-toolbar-left">
            <button id="reveal-left3" onclick="location.href='/safe/Personal'">reveal</button>
        </div>
        <?php
        // 判断今天是否签到
        $date = date("Y-m-d");
        $sql="select count(*) as count from {$this->prename}sign_time where uid= {$this->user["uid"]} and date='{$date}' ";
        $row=$this->getRow($sql);

        if(!$row["count"] && empty($_COOKIE["cookie_sign"])){

        ?>
        <h1 class="ui-betting-title">
            <div class="bett-top-box">
                <div class="bett-tit"><span id="status_type">签到</span></div>
            </div>
        </h1>
        <?php
        }
        ?>
        <div class="ui-bett-refresh">
            <a class="bett-refresh" href="javascript:;"></a>
        </div>
    </div>
</div>

<div id="wrapper_1" class="scorllmain-content scorll-order top_bar nobottom_bar">
    <div class="sub_ScorllCont">
        <div class="mine-message" style="display: none;">
            <div class="mine-mess"><img src="/assets/statics/images/wuxinxi.png"></div>
            <p>目前暂无记录哦！</p>
        </div>
        <div class="order-center">
            <ul id="deposit_list">

                <li class="loading">
                    <div class="order-list-tit"></div>
                    <div class="c-gary" style="text-align: center">正在加载...</div>
                </li>
            </ul>
            <a class="on-more" href="javascript:;" style="display: none;">点击加载更多</a>
        </div>
    </div>
</div>

<style>
    .order-top-left{
        width: 12em;
    }
</style>

<script src="/assets/js/require.js" data-main="/assets/js/application/signlog"></script>
<script src="/assets/js/require.config.js"></script>
<script>

</script>
</body>
</html>